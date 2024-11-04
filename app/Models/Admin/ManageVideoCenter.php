<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageVideoCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name', 
        'audio_title_en', 
        'audio_title_hi', 
        'video_upload', 
        'page_status'
    ];
}
