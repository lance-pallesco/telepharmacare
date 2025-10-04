<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class Profile extends EditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Personal Information')
                ->description('Basic personal details of your account.')
                ->schema([
                    Grid::make(1)->schema([
                        FileUpload::make('avatar')
                            ->avatar()
                            ->imageEditor()
                            ->disk('public')
                            ->visibility('public')
                            ->image()
                            ->columnSpanFull(),
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
                        ]),
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
                    ]),
            Section::make('Pharmacist Details')
                ->description('Professional details of your account.')
                ->relationship('pharmacistDetail')
                ->visible(fn (): bool => Auth::user()->role === 'pharmacist')
                ->schema([
                        TextInput::make('license_number')
                            ->label('License Number')
                            ->required()
                            ->maxLength(100),

                        DatePicker::make('license_expiry')
                            ->label('License Expiry Date')
                            ->required(),

                        TextInput::make('specialization')
                            ->label('Specialization')
                            ->placeholder('e.g. Oncology, Pediatrics, General')
                            ->required(),

                        Toggle::make('is_active')
                        ->label('Status')
                        ->helperText('Toggle to activate or deactivate your account.')
                        ->onColor('success')  // Green when active
                        ->offColor('danger')  // Red when inactive
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        ->default(true),
                ]),
            Section::make('Account Credentials')
                ->description('Manage your login information.')
                ->schema([
                    $this->getEmailFormComponent(),
                    Grid::make(1)->schema([
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ]),
                    $this->getCurrentPasswordFormComponent(),
                ]),
        ]);
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return parent::getPasswordConfirmationFormComponent()
            ->rules([
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ]);
    }
}
