<?php
// app/Models/OrganizationSetup.php

namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ResearchCentre;

class OrganizationSetup extends Model
{
    protected $table = 'mirco_organization_setups';

    protected $fillable = [
        'research_centre',
        'language',
        'employee_name',
        'designation',
        'email',
        'program_description',
        'main_image',
        'page_status',
    ];

    public function researchCentre()
    {
        return $this->belongsTo(ResearchCentre::class, 'research_centre');
    }
}
