<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class askImages extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ask()
    {
        return $this->belongsTo(ask::class);
    }
}
