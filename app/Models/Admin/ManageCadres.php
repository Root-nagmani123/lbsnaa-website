<?php 

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageCadres extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'description', 'language', 'status'];
}
