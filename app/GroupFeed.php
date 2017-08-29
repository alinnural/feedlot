<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class GroupFeed extends Model
{
    protected $fillable = ['name'];

    public function feeds()
    {
        return $this->hasMany('App\Feed');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($group) {
            // mengecek apakah penulis masih punya buku
            if ($group->feeds->count() > 0) {
                // menyiapkan pesan error
                $html = 'Group feed tidak bisa dihapus karena masih memiliki : ';
                $html .= '<ul>';
                foreach ($group->feeds as $feeds) {
                    $html .= "<li>$feeds->name</li>";
                }
                $html .= '</ul>';
                Session::flash("flash_notification", [
                    "level"=>"danger",
                    "message"=>$html
                ]);
                // membatalkan proses penghapusan
                return false;
            }
        }); 
    }
}
