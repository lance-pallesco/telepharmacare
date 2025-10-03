<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = 'pharmacist';
        return $data;
    }

    protected function afterCreate(): void {
        $this->record->pharmacistDetail()->create([
            'license_number' => $this->data['license_number'],
            'license_expiry' => $this->data['license_expiry'],
            'specialization' => $this->data['specialization'] ?? null,
            'is_active' => $this->data['is_active'] ?? true,
        ]);
    }
}
