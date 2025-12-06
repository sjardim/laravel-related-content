<?php

declare(strict_types=1);

namespace Vlados\LaravelRelatedContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Pgvector\Laravel\Vector;

/**
 * @property int $id
 * @property string $embeddable_type
 * @property int $embeddable_id
 * @property Vector|null $embedding
 * @property string|null $model
 * @property int|null $dimensions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $similarity Virtual property from similarity queries
 */
class Embedding extends Model
{
    protected $fillable = [
        'embeddable_type',
        'embeddable_id',
        'embedding',
        'model',
        'dimensions',
    ];

    protected $casts = [
        'embedding' => Vector::class,
        'dimensions' => 'integer',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('related-content.tables.embeddings', 'embeddings');
    }

    /**
     * Get the parent embeddable model.
     */
    public function embeddable(): MorphTo
    {
        return $this->morphTo();
    }
}
