<?php 
// app/Models/ManagePhotoGallery.php

namespace App\Models\Admin\Micro;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroManagePhotoGallery extends Model
{
    use HasFactory;
    protected $table = 'micro_manage_photo_galleries'; // Replace 'your_table_name' with the actual table name.

    protected $fillable = [
        'image_title_english',
        'image_title_hindi',
        'status',
        'image_path',
        'course_id',
        'related_news',
        'related_training_program',
        'related_events',
    ];


    // public function courses()
    // {
    //     return $this->belongsTo(Course::class, 'course_id');

    // }

}