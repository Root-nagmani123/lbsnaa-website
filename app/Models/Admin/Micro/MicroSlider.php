<?php
namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroSlider extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel's naming convention)
    protected $table = 'micro_sliders';

    // Mass-assignable fields
    protected $fillable = [
        'language',
        'research_centre',
        'slider_image',
        'slider_text',
        'slider_description',
        'status',
    ];
}
