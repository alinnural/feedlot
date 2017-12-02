<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Markdowner;

class Post extends Model
{
    protected $dates = ['published_at'];
    // Add the following near the top of the class, after $dates
    protected $fillable = [
      'title', 'subtitle', 'content_raw', 'page_image', 'meta_description',
      'layout', 'is_draft', 'published_at',
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
        $slug = str_slug($title.'-'.$extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Set the HTML content automatically when the raw content is set
     *
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    // Add the following three methods

    /**
    * Return the date portion of published_at
    */
    public function getPublishDateAttribute($value)
    {
        return $this->published_at->format('M-j-Y');
    }

    /**
    * Return the time portion of published_at
    */
    public function getPublishTimeAttribute($value)
    {
        return $this->published_at->format('g:i A');
    }

    /**
    * Alias for content_raw
    */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }
}