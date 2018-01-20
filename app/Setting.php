<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        'name',
        'code',
        'value'
    ];

    public static function getConfiguration()
    {
        $config = array();
        foreach (Setting::all() as $con) {
            $config[$con->code] = $con->value;
        }
        return $config;
    }
}
