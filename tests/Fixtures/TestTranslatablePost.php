<?php

namespace Vlados\LaravelRelatedContent\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Vlados\LaravelRelatedContent\Concerns\HasRelatedContent;

/**
 * Test model that simulates Spatie Translatable behavior.
 */
class TestTranslatablePost extends Model
{
    use HasRelatedContent;

    protected $table = 'test_posts';

    protected $guarded = [];

    /**
     * Simulated translatable fields.
     */
    public array $translatable = ['title', 'content'];

    /**
     * Simulated translations storage.
     */
    protected array $translations = [];

    public function embeddableFields(): array
    {
        return ['title', 'content'];
    }

    /**
     * Disable auto-sync during tests to prevent API calls.
     */
    protected function shouldSyncRelatedContent(): bool
    {
        return false;
    }

    /**
     * Simulate Spatie Translatable's isTranslatableAttribute method.
     */
    public function isTranslatableAttribute(string $key): bool
    {
        return in_array($key, $this->translatable);
    }

    /**
     * Simulate Spatie Translatable's getTranslations method.
     */
    public function getTranslations(string $key): array
    {
        return $this->translations[$key] ?? [];
    }

    /**
     * Helper to set translations for testing.
     */
    public function setTranslations(string $key, array $translations): self
    {
        $this->translations[$key] = $translations;

        return $this;
    }
}
