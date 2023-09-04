<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\User;
use App\Models\Experience;
use App\Models\Certification;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'gpa',
        'university',
        'major',
        'dateEnrolled',
        'credits',
    ];

    public function offers(): BelongsToMany
    {
        return $this->belongsToMany(Offer::class)
            ->as('application')
            ->withPivot('status');
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class);
    }
}
