<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keuntungan extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'modal', 'pendapatan', 'total_keuntungan'];

    public function project() { return $this->belongsTo(Project::class); }
}
