<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $table = 'problem';
    protected $primaryKey = 'problem_id';
    protected $fillable = [
        'problem_id',
        'problem'
    ];
}
