<?php 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
        use HasFactory;
    
      

    // Relationship to get child menus
 
    protected $fillable = [
        'menutitle',
        'parent_id',
        'menucategory',
        'texttype',
        'txtpostion',
        'content',
        'pdf_file',
        'website_url',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
