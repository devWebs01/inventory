<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengguna')
                    ->description('Kelola data akun pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Email Terverifikasi Pada')
                            ->native(false)
                            ->readOnly()
                            ->hidden(fn (string $context): bool => $context === 'create')
                            ->helperText('Otomatis terisi saat user verifikasi email'),
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rule(Password::default())
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? \Illuminate\Support\Facades\Hash::make($state) : null)
                            ->revealable()
                            ->helperText('Minimal 8 karakter'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Hak Akses')
                    ->description('Atur role dan hak akses pengguna')
                    ->schema([
                        Forms\Components\Select::make('roles')
                            ->relationship(
                                name: 'roles',
                                titleAttribute: 'name',
                            )
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->label('Role')
                            ->helperText('Pilih satu atau lebih role untuk pengguna ini'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
