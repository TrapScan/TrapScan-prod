<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QR extends Model
{
    protected $table = 'qr';

    protected $fillable = [
        'qr_code',
        'trap_id'
    ];

    public function trap() {
        return $this->hasOne(Trap::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('qr_code', 'like', '%'.$search.'%');
            });
        });
    }
}
