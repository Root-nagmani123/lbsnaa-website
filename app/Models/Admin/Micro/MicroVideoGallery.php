<?php

namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroVideoGallery extends Model
{
    use HasFactory;

    protected $table = 'micro_video_galleries';

    protected $fillable = [
        'category_name',
        'video_title_en',
        'video_title_hi',
        'video_upload',
        'page_status',
    ];
}
