<?php

namespace App\Filament\Resources\KeuntunganResource\Pages;

use App\Filament\Resources\KeuntunganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKeuntungan extends CreateRecord
{
    protected static string $resource = KeuntunganResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Pastikan project yang dipilih adalah milik user yang sedang login
        $project = \App\Models\Project::where('id', $data['project_id'])
            ->where('user_id', auth()->id())
            ->first();
            
        if (!$project) {
            throw new \Exception('Project tidak ditemukan atau tidak memiliki akses.');
        }
        
        return $data;
    }
}
