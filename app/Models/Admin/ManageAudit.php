<?php 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAudit extends Model
{
    use HasFactory;

    protected $table = 'manage_audit';

    protected $fillable = [
        'Module_Name',
        'Time_Stamp',
        'Created_By',
        'Updated_By',
        'Action_Type',
        'timestamps',
        'IP_Address',
    ];
}

