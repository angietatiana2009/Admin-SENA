<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computers extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'brand',
        'imagen_url',
        'imagen_public_id',
    ];

    public function apprentices()
    {
        return $this->hasMany(Apprentices::class, 'computer_id');
    }
}
