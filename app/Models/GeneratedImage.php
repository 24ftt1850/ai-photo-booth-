<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_session_id',
        'event_id',
        'theme_id',
        'original_image_path',
        'generated_image_path',
        'status',
        'error_message',
        'rating',
        'feedback_comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function photoSession()
    {
        return $this->belongsTo(PhotoSession::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
