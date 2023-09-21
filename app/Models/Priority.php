<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
        'created_at',
    ];


    /**
     *
     * @return BelongsToMany<Todo>
     */
    public function todos(): BelongsToMany
    {
        return $this->BelongsToMany(Todo::class);
    }
}
