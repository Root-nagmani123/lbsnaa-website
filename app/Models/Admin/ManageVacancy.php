<?php 

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageVacancy extends Model
{
    use HasFactory;
    protected $table = 'manage_vacancy';
    protected $fillable = [
        'language', 'job_title', 'job_description', 'content_type',
        'document_upload', 'website_link', 'publish_date', 'expiry_date', 'status'
    ];
}
