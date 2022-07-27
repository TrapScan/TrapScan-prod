<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property array catch_filter
 */
class UserProject extends Pivot
{
    protected $casts = [
        'catch_filter' => 'array'
    ];

    public function hasCatchFilter() {
        return $this->catch_filter ? true : false;
    }

    public function shouldNotify($species) {
        if ($this->notify_catches) {
            if ($this->catch_filter) {
                if(in_array($species, $this->catch_filter)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
        return false;
    }

    public function shouldNotifyTrapIssue() {
        if ($this->notify_problems) {
            return true;
        }
        return false;
    }
}
