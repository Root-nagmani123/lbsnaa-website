<?php 
// app/Models/ManagePhotoGallery.php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePhotoGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'image_title_english',
        'image_title_hindi',
        'related_news',
        'related_training_program',
        'related_events',
        'status',
    ];
}
