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
        $sql = "select * from weights where user_id = $user_id order by created_at desc";
        $weight = \DB::connection('mysql')->select($sql);

        //weight stats
        $avarage_daily = 0;
        $avarage_weekly = 0;
        $avarage_monthly = 0;
        $avarage_yearly = 0;

        $stats = [
            'daily' => $avarage_daily,
            'weekly' => $avarage_weekly,
            'monthly' => $avarage_monthly,
            'yearly' => $avarage_yearly
        ];

        $user = \Auth::user();
        return response()->json(['weight' => $weight,'user' => $user, 'quick_stats' => $stats]);
    }

    public function postRecordWeight(Request $req){

        http_response_code(500);
        dd("test");

        $validator = Validator::make($req->all(), 
            [   'weight' => 'required|integer',
                'name' => 'required'
            ]);

        if ($validator->fails()){ 
            $errors = $validator->errors(); 
            return response()->json($errors,422);
        }

        $w = Weight::first();
        //return $w;
        $dte = \Carbon\Carbon::parse($w->created_at, 'UTC')->setTimezone('EST')->format('m/d/Y H:i:s');
        return $dte;
        
        //return date('m/d/y H:i:s');
        $today = date('Y-m-d');
        $sql = "select * from weights where DATE(created_at) <= '$today' order by created_at desc limit 1 ";
        $table = \DB::connection('mysql')->select($sql);

        if(count($table)){
            $date = $table[0]->created_at;
            $now = \Carbon\Carbon::now();
            if($now->diffInDays($date) <= 6){
                return response()->json(['message' => '7 days have not yet lapsed'],422);
            }
        }

        if(!$req->has('weight')){
            abort(400,'Weight required');
        }

        if(!is_numeric($req->weight)){
            abort(400,'Invalid weight format');
        }

        //check for last weight recording
        //$last_weight = Weight::where('user_id',\Auth()->user()->id)->where('created_at','<',date('m/d/Y'));

        //validate 7 day rule

        $w = new Weight();
        $w->user_id = \Auth::user()->id;
        $w->weight = $req->weight;
        $w->save();

        return response()->json($w,200);

    }
}
