<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'data_type',
        'is_public',
        'description',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }

            return match ($setting->data_type) {
                'number' => is_numeric($setting->value) ? $setting->value + 0 : $setting->value,
                'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                'json' => json_decode($setting->value, true) ?: $setting->value,
                default => $setting->value,
            };
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general', ?string $description = null): static
    {
        $dataType = 'string';
        $storedValue = $value;

        if (is_bool($value)) {
            $dataType = 'boolean';
            $storedValue = $value ? '1' : '0';
        } elseif (is_numeric($value)) {
            $dataType = 'number';
            $storedValue = (string)$value;
        } elseif (is_array($value) || is_object($value)) {
            $dataType = 'json';
            $storedValue = json_encode($value);
        }

        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $storedValue,
                'data_type' => $dataType,
                'group' => $group,
                'description' => $description,
            ]
        );

        Cache::forget("setting_{$key}");
        Cache::forget('public_site_settings');

        return $setting;
    }
}
