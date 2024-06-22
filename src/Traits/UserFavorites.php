<?php

namespace Admin\Extend\AdminFavorite\Traits;

use Admin\Extend\AdminFavorite\Models\Favorite;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserFavorites
{
    /**
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, $this->getForeignKey(), 'id');
    }
}
