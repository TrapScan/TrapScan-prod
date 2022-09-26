<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QR extends Model
{
    protected $table = 'qr';

    protected $fillable = [
        'qr_code',
        'trap_id',
        'given_to'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
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
