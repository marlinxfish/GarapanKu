<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\Profil;
use App\Models\Wallet;
use App\Models\Social;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Proyek', Project::where('user_id', auth()->id())->count())
                ->description('Semua proyek yang Anda kelola')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),

            Stat::make('Total Profil', Profil::where('user_id', auth()->id())->count())
                ->description('Jumlah profil yang terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Wallet', Wallet::where('user_id', auth()->id())->count())
                ->description('Semua wallet di semua profil')
                ->descriptionIcon('heroicon-m-wallet')
                ->color('warning'),

            Stat::make('Total Social', Social::where('user_id', auth()->id())->count())
                ->description('Semua social media yang terdaftar')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('danger'),
        ];
    }
} 