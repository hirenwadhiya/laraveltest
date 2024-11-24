<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'content',
        'url',
        'image_url',
        'category_id',
        'source_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => Str::limit(trim($value), 255),
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower($value),
            set: fn (string $value) => Str::slug(Str::limit(trim($this->title), 255),),
        );
    }

    protected function author(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn ($value) => ucwords($value),
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn ($value) => trim($value),
        );
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => trim($value),
        );
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => trim($value),
            set: fn (string $value) => trim($value),
        );
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => trim($value),
            set: fn ($value) => trim($value) ?? "#",
        );
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }
}
