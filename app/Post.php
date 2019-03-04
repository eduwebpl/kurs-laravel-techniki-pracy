<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Post extends Model implements Feedable
{
    protected $fillable = ['user_id', 'title', 'type', 'date', 'content', 'published', 'premium', 'image'];
    protected $dates = ['date'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = is_null($value) ? now() : $value;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 300);
    }

    public function getPhotoAttribute()
    {
        return Str::startsWith($this->image, 'http') ? $this->image : Storage::url($this->image);
    }

    public function scopePublished($query)
    {
        $user = auth()->user();

        if ($user && $user->can('manage-posts')) {
            return $query;
        }

        if (!$user) {
            $query->where('premium', '<>', 1);
        }

        return $query->where('published', 1);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function toFeedItem()
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->excerpt,
            'updated' => $this->updated_at,
            'link' => route('posts.single', $this->slug),
            'author' => $this->author->name,
        ]);
    }

    public static function getFeedItems()
    {
        return Post::published()->get();
    }
}
