<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded = [];

    public function amin()
    {
        return $this->hasOne(desamin::class);
    }
    public function properti()
    {
        return $this->hasOne(desproperti::class);
    }

    public function vnp()
    {
        return $this->hasOne(desvnp::class);
    }

    public function rent()
    {
        return $this->hasOne(desrent::class);
    }

    public function fotoprod()
    {
        return $this->hasMany(fotoprod::class);
    }

    public function order()
    {
        return $this->hasMany(order::class);
    }

    public function invoice()
    {
        return $this->hasMany(invoice::class);
    }
}
