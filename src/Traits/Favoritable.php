<?php

namespace Admin\Extend\AdminFavorite\Traits;

use Admin\Extend\AdminFavorite\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Favoritable
{
    /**
     * @return MorphMany
     */
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        /** @var \Illuminate\Database\Eloquent\Model $userModel */
        $userModel = new (config('auth.providers.users.model'));
        $userField = \Illuminate\Support\Str::singular($userModel->getTable()) . '_id';

        return $this->favorites()
            ->where($userField, auth()->id())
            ->exists();
    }

    /**
     * @return Model|int
     */
    public function toggleFavorite(): Model|int
    {
        if ($this->isFavorite()) {

            return $this->unsetFavorite();
        }

        return $this->setFavorite();
    }

    /**
     * @return Model
     */
    public function setFavorite(): Model
    {
        /** @var \Illuminate\Database\Eloquent\Model $userModel */
        $userModel = new (config('auth.providers.users.model'));
        $userField = \Illuminate\Support\Str::singular($userModel->getTable()) . '_id';

        return $this->favorites()->firstOrCreate([
            $userField => auth()->id(),
        ]);
    }

    /**
     * @return int
     */
    public function unsetFavorite(): int
    {
        /** @var \Illuminate\Database\Eloquent\Model $userModel */
        $userModel = new (config('auth.providers.users.model'));
        $userField = \Illuminate\Support\Str::singular($userModel->getTable()) . '_id';

        return $this->favorites()
            ->where($userField, auth()->id())
            ->delete();
    }
}
