<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_inspections',
        'total_catches',
        'total_traps',
        'total_projects',
        'total_users',
        'average_catches_per_user',
        'average_inspections_per_user',
        'average_trap_per_project',
        'average_project_per_user',
    ];
}
