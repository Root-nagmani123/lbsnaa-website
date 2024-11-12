<?php
namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    use HasFactory;
    protected $table = 'micro_manage_training_programs';
    protected $fillable = [
        'research_centre', 'language', 'program_name', 'venue', 'program_coordinator',
        'program_description', 'start_date', 'end_date', 'important_links',
        'registration_status', 'page_status',
    ];
}
