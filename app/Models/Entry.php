<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'poll_id',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
