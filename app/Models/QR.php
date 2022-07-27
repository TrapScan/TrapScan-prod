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
}
