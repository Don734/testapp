<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'project',
        'name',
        'score',
        'codeprod',
        'unit',
        'weight',
        'size',
        'weight_one_material',
        'count',
        'comingcur',
        'expenscur',
        'size_unit',
        'general_weight'
    ];
}
