<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

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
