<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Question extends Model
{

    protected $fillable = [
        'title',
        'name',
        'email',
        'description'
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%$keyword%")
                    ->orWhere("description", "LIKE","%$keyword%");
            });
        }
        return $query;
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($group) {
            if ($group->answers->count() > 0) {
                // menyiapkan pesan error
                $html = 'Pertanyaan tidak bisa dihapus karena masih memiliki : ';
                $html .= '<ul>';
                foreach ($group->answers as $answers) {
                    $html .= "<li>$answers->answer</li>";
                }
                $html .= '</ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html
                ]);
                return false;
            }
        });
    }
}
