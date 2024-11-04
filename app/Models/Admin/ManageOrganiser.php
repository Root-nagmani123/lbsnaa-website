<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageOrganiser extends Model
{
    use HasFactory;
    
    // Define a custom table name
    protected $table = 'manage_organisers';

    protected $fillable = [ 
        'language', 'organiser_name', 'status'
    ];
}
