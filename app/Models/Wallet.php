<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'profil_id', 'chain_id', 'address', 'private_key', 'seed_phrase'];

    public function user() { return $this->belongsTo(User::class); }
    public function profil() { return $this->belongsTo(Profil::class); }
    public function chain() { return $this->belongsTo(Chain::class); }
}
