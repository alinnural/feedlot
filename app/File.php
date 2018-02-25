<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        'name',
        'file',
        'extension',
        'is_public'
    ];

    public function scopePublic($query)
    {
        return $query->where('is_public', 1);
    }

    public function scopeExtensionSelected($query, $ext)
    {
        return $query->where('extension', $ext);
    }
}
