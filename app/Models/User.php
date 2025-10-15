<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\QueriesRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 * @mixin QueriesRelationships
 *
 * @property int id
 * @property string name
 * @property string city
 * @property Carbon created_at
 */
class User extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'city',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [];

    public const UPDATED_AT = null;

    protected $dateFormat = 'Y-m-d H:i:s';

    public function images(): HasMany
    {
        return $this->hasMany(UserImage::class);
    }

    public function casts(): array
    {
        return [
            'created_at' => 'date'
        ];
    }

}
