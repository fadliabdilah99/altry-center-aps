<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dap extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
