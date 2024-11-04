<?php 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ManageMediaCenter extends Model
{
    use HasFactory;

    protected $table = 'manage_media_centers'; // Ensure this matches your table name
    protected $fillable = ['category_name', 'audio_title_en', 'audio_title_hi', 'audio_upload', 'page_status'];
}

