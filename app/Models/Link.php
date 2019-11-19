<?php

namespace App\Models;

use App\Exceptions\CodeGenerationException;
use App\Helpers\Math;
use App\Traits\Eloquent\TouchesTimestamps;
use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    use TouchesTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original_url',
        'code',
        'requested_count',
        'used_count',
        'last_requested',
        'last_used',
        'private',
        'user_id'
    ];

    protected $appends = ['shortened_url'];

    protected $dates = [
        'last_requested', 'last_used'
    ];

    public function getCode() {
        if ($this->id === null) {
            throw new CodeGenerationException();
        }

        return (new Math())->toBase($this->id);
    }

    public static function byCode($code) {
        return static::where('code', $code);
    }

    /**
     * Get the user's first name.
     *
     * @param  string $value
     * @return string
     */
    public function getShortenedUrlAttribute($value) {
        if ($this->code === null) {
            return null;
        }

        return config('app.app_url') . '/r/' . $this->code;
    }
}
