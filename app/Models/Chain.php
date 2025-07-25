<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chain extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nama_chain'];

    public function user() { return $this->belongsTo(User::class); }
}
