<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }
}
