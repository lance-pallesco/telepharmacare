<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\Register as PagesRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Schema;

class Register extends PagesRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
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
            Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->label('Gender')
                ->required(),
            TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->maxLength(20),
            Textarea::make('address')
                ->label('Address')
                ->rows(3)
                ->maxLength(500)
                ->columnSpanFull(),
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->unique('users', 'email')
                ->required(),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required()
                ->minLength(8),

            TextInput::make('password_confirmation')
                ->label('Confirm Password')
                ->password()
                ->required()
                ->same('password'),
        ]);
    }
}
