<?php

namespace App\Models;

use App\Jobs\PostCheckerJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_published'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_published' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * model booted
     */
    public static function booted()
    {
        parent::booted();

        static::created(function ($post) {
            dispatch(new PostCheckerJob($post)); // run post checker on post created
        });
    }
}
