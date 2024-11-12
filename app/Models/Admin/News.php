<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'language',                // News language
        'title',                // News Title
        'short_description',    // News Short Description
        'meta_title',           // Meta Title
        'meta_keyword',         // Meta Keyword
        'meta_description',     // Meta Description
        'description',          // Full Description
        'main_image',           // Main Image
        'multiple_images',      // Multiple Images (usually a JSON or text field)
        'start_date',           // Start Date
        'end_date',             // End Date
        'status',               // News Status
        'deleted_at'           // Soft delete timestamp (if using soft deletes)
    ];
}
