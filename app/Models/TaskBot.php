<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskBot extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

