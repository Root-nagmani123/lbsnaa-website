<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageEvents extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'event_title',
        'description',
        'course_id',
        'start_date',
        'end_date',
        'status',
    ];

    // Relation to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
