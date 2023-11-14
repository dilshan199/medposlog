<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinic';
    protected $primaryKey = 'clinic_id';
    protected $fillable = [
        'clinic_id',
        'clinic_followup'
    ];
}
