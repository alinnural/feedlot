<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Unit extends Model
{

    protected $fillable = [
        'name',
        'symbol'
    ];

    public function nutrients()
    {
        return $this->hasMany('App\Nutrient');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($group) {
            // mengecek apakah penulis masih punya buku
            if ($group->nutrients->count() > 0) {
                // menyiapkan pesan error
                $html = 'Unit tidak bisa dihapus karena masih memiliki : ';
                $html .= '<ul>';
                foreach ($group->nutrients as $nutrients) {
                    $html .= "<li>$nutrients->name</li>";
                }
                $html .= '</ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html
                ]);
                // membatalkan proses penghapusan
                return false;
            }
        });
    }
}
 