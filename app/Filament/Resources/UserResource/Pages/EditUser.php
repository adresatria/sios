<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $role = $data['role'] ?? null;
        unset($data['role']); // Hapus 'role' dari data utama

        $user = $this->getRecord(); // Ambil user yang sedang diedit
        if ($role) {
            $user->syncRoles([$role]); // Update role user
        }

        return $data;

        $data['email_verified_at'] = now(); // Set email_verified_at ke waktu sekarang
        return $data;
    }
}
