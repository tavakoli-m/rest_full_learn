<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($permission) {
            Role::where('name','Admin')->first()->permissions()->attach([$permission->id]);
        });
    }

    public function roles() : BelongsToMany
    {
        $this->belongsToMany(Role::class);
    }
}
