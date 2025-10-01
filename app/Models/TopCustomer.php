<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopCustomer extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getDisplayImageAttribute()
    {
        return asset('storage/' . $this->customer_image);
    }
}
