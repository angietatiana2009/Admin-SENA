<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'area_id',
        'training_centers_id'
    ];

    public function area()
    {
        return $this->belongsTo("App\Models\Areas");
    }

    public function trainingCenter()
    {
        return $this->belongsTo(TrainingCenters::class, 'training_centers_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'course_teachers', 'teacher_id', 'course_id');
    }
}
