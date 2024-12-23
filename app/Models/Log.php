<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $guarded = ['id'];
    public function loggable() {
        return $this->morphTo();
    }
}
