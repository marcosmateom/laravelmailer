<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = ['name', 'email', 'active', 'company_id'];
    protected $attributes = [
        'active' => 1,
    ];

    public function getActiveAttribute($attribute)
    {
        return [
            0 => 'inactive',
            1 => 'active',
        ][$attribute];
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }

    public function company()
    {   
        return $this->belongsTo(Company::class);
    }
}
