<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class WeightController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        
        $user_id = \Auth::user()->id;
        $sql = "select * from weights where user_id = $user_id order by created_at asc";
        
        $weight = [];
        $table = \DB::connection('mysql')->select($sql);
        if(count($table )){
            foreach($table  as $w){

                $w->display_stat = 0;
                $w->weight_gain_status = NULL;

                if($w->weight_gain != 0){
                    $w->weight_gain_status = true;
                    $w->display_stat = $w->weight_gain;
                }

                if($w->weight_loss != 0){
                    $w->weight_gain_status = false;
                    $w->display_stat = $w->weight_loss;
                }

                array_push($weight,$w);
            }
        }

        //weight stats
        $avarage_daily = 0;
        $avarage_weekly = 0;
        $avarage_monthly = 0;
        $avarage_yearly = 0;

        //daily avarage
        $first_recording = Weight::first();
        $last_recording = Weight::orderBy('created_at','desc')->first();

        if($first_recording && $last_recording){
            $last_recording_day = \Carbon\Carbon::parse($last_recording->created_at);
            $total_days = $last_recording_day->diffInDays($first_recording->created_at);
            //dd($total_days);
        }


        $w = Weight::first();
        $d = (array)(\Carbon\Carbon::parse($w->created_at)->getTimezone());

        $stats = [
            'daily' => $avarage_daily,
            'weekly' => $avarage_weekly,
            'monthly' => $avarage_monthly,
            'yearly' => $avarage_yearly,
        ];

        $user = \Auth::user();
        return response()->json(['weight_recordings' => $weight,'user' => $user, 'quick_stats' => $stats , 'timezone' => $d['timezone']]);
    }

    public function postRecordWeight(Request $req){

        $validator = Validator::make($req->all(),  
            [   'weight' => 'required|numeric'
            ]);

        if ($validator->fails()){ 
            $errors = $validator->errors(); 
            return response()->json($errors,422);
        }

        //return date('m/d/y H:i:s');
        $today = date('Y-m-d');
        $sql = "select * from weights where DATE(created_at) <= '$today' order by created_at desc limit 1 ";
        $table = \DB::connection('mysql')->select($sql);

        //validate 7 day rule

        if(count($table)){
            $date = $table[0]->created_at;
            $now = \Carbon\Carbon::now();
            if($now->diffInDays($date) <= 6){
                return response()->json(['weight' => ['7 days have not yet lapsed']],422);
            }
        }   
        
        //calculate weight gain or loss.
        $weight_gain = false;
        $weight_loss = false;
        $weight_change = 0;

        if($last_recording = Weight::where('created_at','<',date('Y-m-d'))->first()){
            $weight_change = $req->weight - $last_recording->weight;

            if($weight_change > 0){
                $weight_gain = true;
            }

            if($weight_change < 0){
                $weight_loss = true;
            }

        }

        $w = new Weight();
        $w->user_id = \Auth::user()->id;
        $w->weight = $req->weight;

        if($weight_gain){
            $w->weight_gain = $weight_change;
        }

        if($weight_loss){
            $w->weight_loss = $weight_change;
        }
        
        $w->save();

        return response()->json($w,200);

    }
}
