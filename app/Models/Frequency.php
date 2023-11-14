<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    use HasFactory;
    protected $table = 'frequency';
    protected $primaryKey = 'frequency_id';
    protected $fillable = [
        'frequency_id',
        'frequency'
    ];
}
