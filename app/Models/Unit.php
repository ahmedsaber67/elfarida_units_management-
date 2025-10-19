<?php

namespace App\Models;
use App\Models\Transaction;


use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $casts = [
    'history' => 'array',
];

    protected $fillable = ['name','area','price','floor','wing','status', 'history', 'user_id', 'office'];

    // الوحدة ليها عمليات كتير
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function logs()
{
    return $this->hasMany(UnitLog::class, 'unit_id');
}
public function user()
{
    return $this->belongsTo(User::class);
}


}
