<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Media extends Model
{
    protected $fillable = [
        'title',
        'type',
        'file_url',
        'link_url',
        'description',
    ];

    protected $casts = [
        'file_url' => 'array',
    ];

    /**
     * Get the file_url as string for display purposes
     */
    protected function fileUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
        );
    }

    /**
     * Get the first file URL (for backward compatibility)
     */
    public function getFirstFileUrlAttribute(): ?string
    {
        $files = $this->file_urls;
        return $files[0] ?? null;
    }

    /**
     * Get all file URLs
     */
    public function getFileUrlsAttribute(): array
    {
        $files = $this->attributes['file_url'] ?? null;

        if ($files === null) {
            return [];
        }

        if (is_array($files)) {
            return $files;
        }

        if (is_string($files)) {
            $decoded = json_decode($files, true);
            return $decoded !== null ? $decoded : [$files];
        }

        return [];
    }
}
