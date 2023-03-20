<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Priority extends Model
{
    use HasFactory;

    /**
     *
     * @return BelongsToMany<Todo>
     */
    public function todos(): BelongsToMany
    {
        return $this->BelongsToMany(Todo::class);
    }
}
