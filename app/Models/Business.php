<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'users_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
