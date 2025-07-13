<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'profil_id', 'nama_social', 'email', 'username', 'password', 'status'];

    public function user() { return $this->belongsTo(User::class); }
    public function profil() { return $this->belongsTo(Profil::class); }
}
