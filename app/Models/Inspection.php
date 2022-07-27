<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inspection
 * @package App\Models
 *
 * @mixin Eloquent
 */
class Inspection extends Model
{
    use HasFactory;

    const VALID_SPECIES = ['Rat','Mouse','Stoat','Weasel','Hedgehog','Rat - Kiore','Rat - Norway','Unspecified','Bird',
        'Rat - Ship','Cat','Deer','Dog','Ferret','Goat','Hare','Magpie','Peafowl','Pig','Possum','Rabbit','Turkey'];


    protected $fillable = [
        'date',
        'trap_id',
        'recorded_by',
        'strikes',
        'species_caught',
        'status',
        'rebaited',
        'bait_type',
        'trap_condition',
        'notes',
        'words',
        'anon',
        'upload_to_nz'
    ];

    public function trap() {
        return $this->belongsTo(Trap::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'recorded_by', 'id');
    }
}
