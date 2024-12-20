<?php 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageMediaCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_gallery',
        'name',
        'hindi_name',
        'category_image',
        'status',
    ];
}
