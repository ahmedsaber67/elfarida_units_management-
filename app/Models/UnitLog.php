<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'user_id',
        'action',
        'old_value',
        'new_value',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    
}
