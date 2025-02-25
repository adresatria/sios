<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $role = $data['role'];
        unset($data['role']); // Hapus field role dari data utama

        $user = User::create($data);
        $user->assignRole($role); // Assign role ke user

        return $data;

        $data['email_verified_at'] = now(); // Set email_verified_at ke waktu sekarang
        return $data;
    }
}

