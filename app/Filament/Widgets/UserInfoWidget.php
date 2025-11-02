<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

final class UserInfoWidget extends Widget
{
    protected string $view = 'filament-panels::widgets.user-info-widget';

    public function getColumnSpan(): string
    {
        return 'full';
    }

    public function getUser()
    {
        return filament()->auth()->user();
    }

    public function isAdmin(): bool
    {
        return $this->getUser()->is_admin ?? false;
    }

    public function getWelcomeMessage(): string
    {
        $user = $this->getUser();
        $hour = now()->hour;

        $greeting = match (true) {
            $hour < 12 => 'Good morning',
            $hour < 17 => 'Good afternoon',
            default => 'Good evening',
        };

        return $greeting.', '.$user->name.'!';
    }
}
