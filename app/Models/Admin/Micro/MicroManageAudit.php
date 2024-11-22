<?php 
namespace App\Models\Admin\Micro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroManageAudit extends Model
{
    use HasFactory;

    protected $table = 'micro_manage_audit';

    protected $fillable = [
        'Module_Name',
        'Time_Stamp',
        'Created_By',
        'Updated_By',
        'Action_Type',
        'IP_Address',
    ];
}

