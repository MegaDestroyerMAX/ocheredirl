<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyQueue extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'phone', 'date'];
}
