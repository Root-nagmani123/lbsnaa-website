<?php 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTender extends Model
{
    use HasFactory;

    protected $fillable = [
        'language', 'type', 'title', 'description', 'file','corrigendum', 
        'publish_date', 'expiry_date', 'status',
    ];

    // Optional: Additional methods or relationships can go here
}
