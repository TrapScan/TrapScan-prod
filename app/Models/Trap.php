<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

class Trap extends Model
{
    use HasFactory;

    protected $fillable = [
        'nz_trap_id',
        'qr_id',
        'trap_line_id',
        'project_id',
        'user_id',
        'coordinates',
        'name',
        'notes'
    ];

    protected $casts = [
        'coordinates' => Point::class,
    ];

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }

    public function getRouteKeyName() {
        return 'qr_id';
    }

    public function qrCode() {
        return $this->belongsTo(QR::class);
    }

    public function trapline() {
        return $this->belongsTo(TrapLine::class, 'trap_line_id', 'id');
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function inspections() {
        return $this->hasMany(Inspection::class);
    }

    public function scopeNoCode($query) {
        return $query->whereNotNull('nz_trap_id')->whereNotNull('project_id')->whereNull('qr_id');
    }

    public function scopeMapped($query) {
        return $query->whereNotNull('nz_trap_id')->whereNotNull('project_id')->whereNotNull('qr_id');
    }

    public function scopeUnmapped($query) {
        return $query->whereNull('nz_trap_id')->whereNull('trap_line_id')->whereNull('user_id');
    }

    public function scopeUnmappedInProject($query) {
        return $query->whereNull('nz_trap_id')->whereNull('trap_line_id')->whereNull('user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        });
    }
}
