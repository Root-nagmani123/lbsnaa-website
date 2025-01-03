<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];  // Adjust fields based on your course table
    protected $table = 'courses'; // Ensure this matches your database table name

    public function ManagePhotoGallery()
    {
        return $this->hasMany(ManagePhotoGallery::class, 'course_id' , 'id');
    }
}


