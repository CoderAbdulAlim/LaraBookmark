<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopicComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'topic_id',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function topic():BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
