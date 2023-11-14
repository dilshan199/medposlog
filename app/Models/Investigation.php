<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;
    protected $table = 'investigation';
    protected $primaryKey = 'investigation_id';
    protected $fillable = [
        'investigation_id',
        'investigation'
    ];
}
