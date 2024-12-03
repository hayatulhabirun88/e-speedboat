<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speedboat extends Model
{
    use HasFactory;

    protected $table = 'speedboats';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
