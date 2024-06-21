<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource as FilamnetResource;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Translation\MessageSelector;

abstract class Resource extends FilamnetResource
{
    public static function getModelLabel(): string
    {
        $modelLabel = static::getModelLabelFromClass(static::getModel());

        $translationKey = "filament::resources/messages.{$modelLabel}.singular";

        // dd($translationKey);
        return Lang::has($translationKey)
            ? __($translationKey)
            : $modelLabel;
    }

    public static function getPluralModelLabel(): string
    {
        if (filled($label = static::$pluralModelLabel ?? static::getPluralLabel())) {
            return $label;
        }

        $originalModelLabel = static::getModelLabelFromClass(static::getModel());
        $pluralLabelKey = "filament::resources/messages.{$originalModelLabel}.plural";

        if (Lang::has($pluralLabelKey)) {
            return __($pluralLabelKey);
        }

        if (static::localeHasPluralization()) {
            return Str::plural(static::getModelLabel());
        }

        return static::getModelLabel();
    }

    protected static function getModelLabelFromClass(string $model): string
    {
        return (string) Str::of(class_basename($model))
            ->kebab()
            ->replace('-', ' ');
    }

    protected static function localeHasPluralization(): bool
    {
        return (new MessageSelector)->getPluralIndex(app()->getLocale(), 10) > 0;
    }
}
