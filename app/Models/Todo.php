<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Tags\HasTags;

class Todo extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = [
        'id',
        'user_id',
        'task',
        'note',
        'status',
        'priority',
        'hour',
        'date',
    ];

    public function User(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function priority(): HasMany
    {
        return $this->hasMany(Priority::class);
    }
}
