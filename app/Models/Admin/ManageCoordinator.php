<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageCoordinator extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_language',
        'coordinator_name',
        'status',
    ];
}
