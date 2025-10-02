<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Profile Information')
                ->description('Basic details for the pharmacist account.')
                ->schema([
                    FileUpload::make('avatar')
                        ->label('Profile Picture')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('avatars')
                        ->visibility('public')
                        ->required()
                        ->columnSpanFull(),

                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                    ]),

                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->required(fn ($record) => $record === null)
                        ->hidden(fn ($record) => $record !== null),
                ]),

            Section::make('Pharmacist Details')
                ->description('Professional details of the pharmacist.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('license_number')
                            ->label('License Number')
                            ->required()
                            ->maxLength(100),

                        DatePicker::make('license_expiry')
                            ->label('License Expiry Date')
                            ->required(),
                    ]),

                    TextInput::make('phone')
                        ->label('Contact Number')
                        ->tel()
                        ->maxLength(20),

                    TextInput::make('specialization')
                        ->label('Specialization')
                        ->placeholder('e.g. Oncology, Pediatrics, General')
                        ->maxLength(255),

                    Textarea::make('address')
                        ->label('Address')
                        ->rows(3)
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('Account Status')
                        ->helperText('Toggle to activate or deactivate the user account.')
                        ->onColor('success')  // Green when active
                        ->offColor('danger')  // Red when inactive
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        ->default(true),
                ]),
        ]);
    }
}
