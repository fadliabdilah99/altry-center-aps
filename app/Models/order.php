<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function invoice(){
        return $this->belongsTo(invoice::class);
    }
}
