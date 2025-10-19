<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
      protected $fillable = ['unit_id', 'office_id', 'status', 'price', 'date'];

    // العملية تخص وحدة
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // العملية تخص مكتب
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    // العملية تخص مستخدم
    public function user()
    {
        return $this->belongsTo(User::class);

    }

    
}
