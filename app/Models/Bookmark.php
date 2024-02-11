<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'description',
        'category_id',
        'contenttype_id',
        'readstatus_id',
    ];

    protected $attributes = [
        'readstatus_id' => 2,
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function contenttype():BelongsTo
    {
        return $this->belongsTo(ContentType::class);
    }

    public function readstatus():BelongsTo
    {
        return $this->belongsTo(ReadStatus::class);
    }

    public function bmark_comments(): HasMany
    {
        return $this->hasMany(BmarkComment::class);
    }
}
