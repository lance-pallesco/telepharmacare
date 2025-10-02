<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Profile')
                    ->square()
                    ->disk('public'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('pharmacistDetail.license_number')
                    ->label('License Number')
                    ->searchable(),
                TextColumn::make('pharmacistDetail.specialization')
                    ->label('Specialization')
                    ->searchable()
                    ->limit(20),
                // TextColumn::make('pharmacistDetail.phone')
                //     ->label('Phone Number')
                //     ->searchable(),
                TextColumn::make('pharmacistDetail.is_active')
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
                // TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                // // IconColumn::make('has_email_authentication')
                // //     ->boolean(),
                // TextColumn::make('role')
                //     ->searchable(),
                // TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
