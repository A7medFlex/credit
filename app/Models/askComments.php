<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class askComments extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ask()
    {
        return $this->belongsTo(ask::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
