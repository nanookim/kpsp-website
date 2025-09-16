<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = 'children';

    protected $fillable = [
        'id_user',
        'name',
        'gender',
        'date_of_birth',
        'birth_history', // ✅ tambahkan ini'
        'gestational_age',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'gestational_age' => 'integer',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function children()
    {
        return $this->hasMany(\App\Models\Child::class, 'id_user'); // tambahkan foreign key
    }

}
