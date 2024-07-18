<?php

namespace Astrogoat\Monologues\Settings;

use Illuminate\Support\Str;
use Helix\Lego\Models\Model;
use Astrogoat\Cashier\Models\Price;
use Astrogoat\Cashier\Models\Product;
use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class MonologuesSettings extends AppSettings
{
    public string $landing_page;
    public string $primary_price_id;

    public function rules(): array
    {
        return [
            'landing_page' => Rule::requiredIf($this->enabled === true),
            'primary_price_id' => Rule::requiredIf($this->enabled === true),
        ];
    }

    public function landingPageOptions()
    {
        $strata = app('lego');

        $publishableModels = [
            'Select your landing pages' => ['' => '-- No landing page --'],
        ];

        foreach ($strata->getPublishables() as $publishable) {
            $label = Str::of(class_basename($publishable))->title()->plural()->__toString();

            $models = $publishable::all()->pluck($publishable::getDisplayKeyName(), $publishable::getPrimaryKeyName())
                ->mapWithKeys(fn ($name, $id) => [$publishable.':'.$id => $name])
                ->toArray();

            $publishableModels[$label] = $models;
        }

        return $publishableModels;
    }

    public function getLandingPageModel(): Model|null
    {
        if (! $this->landing_page) {
            return null;
        }

        $model = Str::before($this->landing_page, ':');
        $modelId = Str::after($this->landing_page, ':');

        return $model::find($modelId);
    }

    public function primaryPriceIdOptions(): array
    {
        return Product::all()->mapWithKeys(function (Product $product) {
            return [
                $product->name => $product->prices->mapWithKeys(function (Price $price) {
                    return [$price->id => $price->name];
                }),
            ];
        })->prepend(['' => '-- SELECT A PRICE --'], '-- SELECT A PRICE --')->toArray();
    }

    public function labels(): array
    {
        return [
            'primary_price_id' => 'Primary Price',
        ];
    }

    public function description(): string
    {
        return 'Interact with Monologues.';
    }

    public static function group(): string
    {
        return 'monologues';
    }
}
