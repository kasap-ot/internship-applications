<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\User;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'numEmployees',
        'field',
        'foundingYear',
        'description',
        'website',
        'address',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
