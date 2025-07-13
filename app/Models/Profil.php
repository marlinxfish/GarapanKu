<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_profil'];

    public function user() { return $this->belongsTo(User::class); }
    public function wallets() { return $this->hasMany(Wallet::class); }
    public function socials() { return $this->hasMany(Social::class); }
    public function projects() { return $this->belongsToMany(Project::class, 'profil_project'); }
}
