<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageVenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'venue_title',
        'venue_detail',
        'status',
    ];
}
