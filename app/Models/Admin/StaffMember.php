<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMember extends Model
{
    use HasFactory;
    protected $table = 'staff_members';

    // Specify which fields can be mass-assigned
    protected $fillable = [
        'name',
        'name_in_hindi',
        'email',
        'image',
        'description',
        'description_in_hindi',
        'designation',
        'designation_in_hindi',
        'section',
        'country_code',
        'std_code',
        'phone_internal_office',
        'phone_internal_residence',
        'phone_pt_office',
        'phone_pt_residence',
        'mobile',
        'abbreviation',
        'rank',
        'present_at_station',
        'acm_member',
        'acm_status_in_committee',
        'co_opted_member',
        'page_status',
    ];

    // If you have timestamps (created_at, updated_at), keep this true
    public $timestamps = true;

    // If you have custom accessor methods or relationships, you can define them here
    // Example relationship: Assuming staff members belong to a section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
