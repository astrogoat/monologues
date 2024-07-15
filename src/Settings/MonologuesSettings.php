<?php

namespace Astrogoat\Monologues\Settings;

use Astrogoat\Cashier\Models\Price;
use Astrogoat\Cashier\Models\Product;
use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class MonologuesSettings extends AppSettings
{
    public string $primary_price_id;

    public function rules(): array
    {
        return [
            'primary_price_id' => Rule::requiredIf($this->enabled === true),
        ];
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
