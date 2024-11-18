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
        'name',
        'hindi_name',
        'status',
    ];
}
