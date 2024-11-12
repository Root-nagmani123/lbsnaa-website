<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageCoordinator extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'coordinator_name',
        'status',
    ];
}
