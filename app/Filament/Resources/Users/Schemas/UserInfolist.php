<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('avatar')
                            ->square()
                            ->disk('public')
                            ->label('Avatar'),
                        TextEntry::make('name')
                            ->label('Full Name'),
                        TextEntry::make('email')
                            ->label('Email Address'),
                        TextEntry::make('pharmacistDetail.is_active')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                '1' => 'success',
                                '0' => 'danger',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state){
                                '1' => 'Active',
                                '0' => 'Deactivated',
                            }),
                    ]),

                Section::make('Pharmacist Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('pharmacistDetail.license_number')
                            ->label('License Number'),
                        TextEntry::make('pharmacistDetail.license_expiry')
                            ->date()
                            ->label('License Expiry'),
                        TextEntry::make('pharmacistDetail.specialization')
                            ->label('Specialization'),
                        TextEntry::make('pharmacistDetail.phone')
                            ->label('Phone Number'),
                        TextEntry::make('pharmacistDetail.address')
                            ->label('Address'),
                    ]),
            ]);
    }
}
