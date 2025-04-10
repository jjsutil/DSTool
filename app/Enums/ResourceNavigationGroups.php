<?php

declare(strict_types=1);

namespace App\Enums;

enum ResourceNavigationGroups: string
{
    case BUSINESS  = 'user, business and integrations';
    case PRODUCTS  = 'Products related';
    case PROVIDERS = 'Providers related';
    case CUSTOMERS = 'Customers related';

    public function label(): string
    {
        return __('Resources.NavigationGroups.' . $this->name);
    }

    public static function asSelectOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->toArray();
    }
}
