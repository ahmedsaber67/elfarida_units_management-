<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
         protected $fillable = ['name', 'email', 'phone'];

    // مكتب عنده عمليات كتير
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'office_id');
    }
}
