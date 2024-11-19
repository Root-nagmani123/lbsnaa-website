<?php

namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class micromenu extends Model
{
    use HasFactory;

    protected $table = 'micromenus';

    protected $fillable = [
        'language',
        'research_centreid',
        'parent_id',
        'menutitle',
        'menu_slug',
        'menucategory',
        'texttype',
        'txtpostion',
        'content',
        'pdf_file',
        'website_url',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'web_site_target',
        'start_date',
        'termination_date',
        'menu_status',
        'is_deleted',
    ];

    public function parent()
    {
        return $this->belongsTo(micromenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(micromenu::class, 'parent_id');
    }
}
