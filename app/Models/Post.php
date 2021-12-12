<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App\Models
 */
class Post extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\belongsTo {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'hero',
        'text',
        'image',
        'published'
    ];
}
