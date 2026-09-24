<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

// Model Import
use App\Models\Berita;
use App\Models\CreativeDistrict;
use App\Models\Layanan;
use App\Models\Penyiar;
use App\Models\SekolahKita;
use App\Models\Streaming;
use App\Models\Umkm;
use App\Models\Wisata;

class StatsOverview extends BaseWidget
{
    // Mengatur agar tampil 2 kolom sesuai mockup Anda
    protected static ?int $columns = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Berita', Berita::count())
                ->description('Total berita terbit')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),

            Stat::make('Jumlah Creative District', CreativeDistrict::count())
                ->description('Total entri kreatif')
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('primary'),

            Stat::make('Jumlah Layanan Publik', Layanan::count())
                ->description('Total layanan tersedia')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('primary'),

            Stat::make('Jumlah Penyiar', Penyiar::count())
                ->description('Total penyiar aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Jumlah Kegiatan Sekolah', SekolahKita::count())
                ->description('Total kegiatan sekolah')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Jumlah Streaming', Streaming::count())
                ->description('Total tautan streaming')
                ->descriptionIcon('heroicon-m-play-circle')
                ->color('primary'),

            Stat::make('Jumlah UMKM', Umkm::count())
                ->description('Total mitra UMKM')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('primary'),

            Stat::make('Jumlah Wisata', Wisata::count())
                ->description('Total destinasi wisata')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary'),
        ];
    }
}