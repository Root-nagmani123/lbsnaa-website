<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFooterImage extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'status', 'deleted_on'];
}
