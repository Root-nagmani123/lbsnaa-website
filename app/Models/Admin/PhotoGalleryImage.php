<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGalleryImage extends Model
{
    protected $fillable = [
        'photo_gallery_id',
        'file_path',
    ];

    // Define the inverse relationship to the gallery
    public function gallery()
    {
        return $this->belongsTo(PhotoGallery::class);
    }
}
