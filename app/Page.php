<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Markdowner;

class Page extends Model
{

    protected $fillable = [
        'title',
        'content',
        'image',
        'show_slider'
    ];

    /**
     * Set the title attribute and automatically the slug
     *
     * @param string $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        
        if (! $this->exists) {
            $this->setUniqueSlug($value, '');
        }
    }

    /**
     * Recursive routine to set a unique slug
     *
     * @param string $title
     * @param mixed $extra
     */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title . '-' . $extra);
        
        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }
        
        $this->attributes['slug'] = $slug;
    }
}
