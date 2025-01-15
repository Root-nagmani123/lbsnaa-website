<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickLink extends Model
{
    use HasFactory;
    protected $fillable = ['language','text', 'url', 'file', 'status', 'url_type','is_deleted'];
}
