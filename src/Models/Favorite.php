<?php

namespace Admin\Extend\AdminFavorite\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Admin\Extend\AdminShopify\Models\FavoriteProduct
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite query()
 * @property int $id
 * @property int $user_id
 * @property int $favoritable_type
 * @property int $favoritable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $favoritable
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereFavoritableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereFavoritableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereUserId($value)
 * @property-read \App\Models\User|null $user
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'favoritable_id',
        'favoritable_type',
        //'user_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'favoritable_id' => 'integer',
        'favoritable_type' => 'integer',
        //'user_id' => 'integer',
    ];

    /**
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        /** @var \Illuminate\Database\Eloquent\Model $userModel */
        $userModel = new (config('auth.providers.users.model'));
        $userField = \Illuminate\Support\Str::singular($userModel->getTable()) . '_id';
        $this->fillable[] = $userField;
        $this->casts[$userField] = 'integer';
    }

    /**
     * @return MorphTo
     */
    public function favoritable(): MorphTo
    {
        return $this->morphTo('favoritable');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        /** @var \Illuminate\Database\Eloquent\Model $userModel */
        $userModel = new (config('auth.providers.users.model'));
        $userField = \Illuminate\Support\Str::singular($userModel->getTable()) . '_id';
        return $this->hasOne(config('auth.providers.users.model'), 'id', $userField);
    }
}
