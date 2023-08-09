<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'field',
        'salary',
        'dateFrom',
        'dateTo',
        'description',
        'requirements',
        'company_id',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)
            ->as('application')
            ->withPivot('status');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
