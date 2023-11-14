<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patient';
    protected $primaryKey = 'patient_id';
    protected $fillable = [
        'patient_id',
        'name',
        'nic',
        'contact_no',
        'age',
        'allegic_status',
        'allegic_des',
        'sh',
        'kg',
        'bp',
        'investigation',
        'next_day_investigation',
        'problem',
        'clinic_followup',
        'note'
    ];
}
