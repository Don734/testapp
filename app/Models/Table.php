<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'project',
        'description',
        'name',
        'score',
        'codeprod',
        'unit',
        'count',
        'comingcur',
        'expenscur'
    ];
}
