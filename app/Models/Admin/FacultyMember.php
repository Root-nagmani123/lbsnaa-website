<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'category', 'name', 'name_in_hindi', 'email', 'image', 'description',
        'description_in_hindi', 'designation', 'designation_in_hindi', 'cadre', 'batch', 
        'service', 'country_code', 'std_code', 'phone_internal_office', 
        'phone_internal_residence', 'phone_pt_office', 'phone_pt_residence', 
        'mobile', 'abbreviation', 'rank', 'present_at_station', 'acm_member', 
        'acm_status_in_committee', 'co_opted_member', 'page_status',
    ];
}
