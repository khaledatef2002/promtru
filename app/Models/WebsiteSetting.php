<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['display_logo', 'display_cover'];

    public function getDisplayLogoAttribute()
    {
        return asset('storage/' . $this->logo);
    }

    public function getDisplayCoverAttribute()
    {
        return asset('storage/' . $this->cover);
    }
}
