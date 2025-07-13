<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nama_project', 'status'];

    public function user() { return $this->belongsTo(User::class); }
    public function keuntungan() { return $this->hasOne(Keuntungan::class); }
    public function profils() { return $this->belongsToMany(Profil::class, 'profil_project'); }
}
