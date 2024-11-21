<?php 

namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroManageVacancy extends Model
{
    use HasFactory;
    
    protected $table = 'micro_manage_vacancies';

    protected $fillable = [
        'language', 'job_title', 'job_description', 'content_type',
        'document_upload', 'website_link', 'publish_date', 'expiry_date', 'status'
    ];
}
