<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentices extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'cell_number',
        'course_id',
        'computer_id'
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function computer()
    {
        return $this->belongsTo(Computers::class, 'computer_id');
    }
}
