<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrapLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'sponsored_by'
    ];

    public function traps() {
        return $this->hasMany(Trap::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
