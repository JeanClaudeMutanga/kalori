<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Weight extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;

    protected $casts = [
        'created_at' => 'datetime:m/d/Y H:i:s',
        'updated_at' => 'datetime:m/d/Y H:i:s',
    ];

    //$fromUTC = Carbon::parse($from, $user->timezone)->setTimezone('UTC');
    //$toUTC = Carbon::parse($to, $user->timezone)->setTimezone('UTC');    


    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->setTimezone("EST");
    }
    
    public function getUpdatedAtAttribute(){
        return Carbon::parse($this->attributes['updated_at'])->setTimezone("EST");
    }
}
