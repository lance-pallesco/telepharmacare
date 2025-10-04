<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
        Section::make('Personal Information')
            ->description('Basic personal details of your account.')
            ->schema([
                    FileUpload::make('avatar')
                        ->avatar()
                        ->imageEditor()
                        ->disk('public')
                        ->visibility('public')
                        ->image()
                        ->inlineLabel()
                        ->columnSpanFull(),
                    TextInput::make('first_name')
                        ->label('First Name')
                        ->required()
                        ->inlineLabel()
                        ->maxLength(255),

                    TextInput::make('middle_name')
                        ->label('Middle Name')
                        ->inlineLabel()
                        ->maxLength(255),

                    TextInput::make('last_name')
                        ->label('Last Name')
                        ->required()
                        ->inlineLabel()
                        ->maxLength(255),
                    Select::make('gender')
                        ->inlineLabel()
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                        ])
                        ->label('Gender')
                        ->required(),
                    TextInput::make('phone')
                            ->inlineLabel()
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20),
                    Textarea::make('address')
                        ->inlineLabel()
                        ->label('Address')
                        ->maxLength(500)
                        ->columnSpanFull(),
                    
                    TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->inlineLabel()
                    ->email(),
                ])
            ->columnSpanFull(),
        ]);
    }
}
