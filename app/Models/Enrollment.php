<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'subject_id', 'enrollment_date',
    ];

    // Relationship with student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship with subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relationship with grades
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}