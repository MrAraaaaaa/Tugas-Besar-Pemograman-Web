<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Menambahkan kolom 'student_id' ke properti $fillable
    protected $fillable = ['student_id', 'date', 'status'];
}

