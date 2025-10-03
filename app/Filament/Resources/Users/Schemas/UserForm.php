<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->maxLength(255),

                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                        
                        Select::make('gender')
                            ->label('Gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female'
                            ])
                            ->required(),

                        TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->required(fn ($record) => $record === null)
                        ->hidden(fn ($record) => $record !== null),
                    ]),
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
                        ->placeholder('e.g. (+639) 231 453')
                        ->maxLength(20),

                    TextInput::make('specialization')
                        ->label('Specialization')
                        ->placeholder('e.g. Oncology, Pediatrics, General')
                        ->maxLength(255),

                    Textarea::make('address')
                        ->label('Address')
                        ->rows(3)
                        ->columnSpanFull(),
                    
                    TextInput::make('role')
                    ->default('pharmacist')
                    ->hidden(),

                    Toggle::make('is_active')
                        ->label('Account Status')
                        ->helperText('Toggle to activate or deactivate the pharmacist account.')
                        ->onColor('success')  // Green when active
                        ->offColor('danger')  // Red when inactive
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        ->default(true),
                ]),
        ]);
    }
}
