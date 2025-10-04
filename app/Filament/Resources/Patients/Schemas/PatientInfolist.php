<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                ->description('Basic personal details of your account.')
                    ->schema([
                        ImageEntry::make('avatar')
                        ->disk('public')
                        ->label('Profile Picture')
                        ->columnSpanFull(),
                        TextEntry::make('name')
                        ->label('Full Name'),
                        TextEntry::make('email')
                        ->label('Email Address'),
                        TextEntry::make('phone')
                        ->label('Phone Number'),
                        TextEntry::make('address')
                        ->label('Address'),  
                ])->columnSpanFull(),
            ]);
    }
}
