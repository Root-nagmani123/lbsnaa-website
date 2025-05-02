<?php 
namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroManageMediaCategories extends Model
{
    use HasFactory;
    protected $table = 'micro_media_categories';
    protected $fillable = [
        'media_gallery',
        'research_centre',
        'name',
        'hindi_name',
        'category_images',
        'status',
        'year',
    ];
}
