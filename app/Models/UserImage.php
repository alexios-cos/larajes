<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\UserImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string image
 * @property Carbon created_at
 */
class UserImage extends Model
{

    /**
     * @use HasFactory<UserImageFactory>
     */
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    public const UPDATED_AT = null;

    protected $dateFormat = 'Y-m-d H:i:s';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function casts(): array
    {
        return [
            'created_at' => 'date',
        ];
    }

}
