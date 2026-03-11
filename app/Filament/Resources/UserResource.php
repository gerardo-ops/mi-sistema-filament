<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
class UserResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-users'; // Icono de personas
    protected static ?string $navigationLabel = 'Gestión de Vendedores'; // Nombre más profesional
    protected static ?string $navigationGroup = 'Administración'; // Crea un encabezado en el menú
    protected static ?string $model = User::class;

    
    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nombre del Vendedor'),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),
             Forms\Components\TextInput::make('password')
    ->password()
    ->required(fn (string $context): bool => $context === 'create')
    // ESTA LÍNEA ES LA QUE FALTA:
    ->dehydrateStateUsing(fn ($state) => Hash::make($state)) 
    ->dehydrated(fn ($state) => filled($state))
    ->label('Contraseña'),
            Forms\Components\Select::make('role')
                ->options([
                    'admin' => 'Administrador',
                    'vendedor' => 'Vendedor',
                ])
                ->required(),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
       ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nombre Completo')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('email')
                ->label('Correo Electrónico')
                ->icon('heroicon-m-envelope') // Icono de sobre
                ->copyable(), // Permite copiar el correo con un clic
            Tables\Columns\TextColumn::make('role')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'admin' => 'danger',
                    'vendedor' => 'success',
                    default => 'gray',
                }),
        ])
        ->filters([
            //
        ])
        ->actions([
            // AQUÍ ES DONDE APARECEN LOS BOTONES AL FINAL DE LA FILA
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

  public static function getPages(): array
{
    return [
        'index' => Pages\ListUsers::route('/'),
        'create' => Pages\CreateUser::route('/create'), // <--- ESTA LÍNEA ACTIVA EL BOTÓN "NEW"
        'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
}
}
