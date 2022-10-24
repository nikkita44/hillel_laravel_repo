<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial_change extends Model
{
    use HasFactory;

    public function changeable()
    {
        return $this->morphTo();
    }
}
