<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array {
        if ($data['id'] ?? false){
            $user = User::with('pharmacistDetail')->find($data['id']);
        }
        if ($user && $user->pharmacistDetail){
            $data = array_merge($data, $user->pharmacistDetail->toArray());
        };

        return $data;
    }

    protected function afterSave(): void{
        $this->record->pharmacistDetail()->updateOrCreate([
            'user_id' => $this->record->id,
        ], [
            'license_number' => $this->data['license_number'],
            'license_expiry' => $this->data['license_expiry'],
            'specialization' => $this->data['specialization'] ?? null,
            'phone' => $this->data['phone'] ?? null,
            'address' => $this->data['address'] ?? null,
            'is_active' => $this->data['is_active'] ?? true,
        ]);
    }
}
