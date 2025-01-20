<?php
// app/Models/OrganizationSetup.php
// namespace App\Models\Admin\Micro;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class OrganizationSetup extends Model
// {
//     use HasFactory;

//     // Corrected the table name to match the actual table name in the database
//     protected $table = 'mirco_organization_setups';

//     protected $fillable = [
//         'research_centre',
//         'language',
//         'employee_name',
//         'designation',
//         'email',
//         'program_description',
//         'main_image',
//         'page_status',
//     ];
// }

// namespace App\Models\Admin\Micro;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;  // Make sure this is included

// class OrganizationSetup extends Model
// {

//     protected $table = 'mirco_organization_setups';

//     protected $fillable = [
//         'research_centre',
//         'language',
//         'employee_name',
//         'designation',
//         'email',
//         'program_description',
//         'main_image',
//         'page_status',
//     ];
    
// }



namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Model;

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
}



