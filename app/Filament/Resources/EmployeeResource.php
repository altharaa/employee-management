<?php

namespace App\Filament\Resources;

use App\Filament\Exports\EmployeeExporter;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Tables\Actions\ExportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-m-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Email')
                    ->placeholder('example@domain.com'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->label('Phone Number'),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->label('Position'),
                Forms\Components\TextInput::make('department')
                    ->required()
                    ->label('Department'),
                Forms\Components\DatePicker::make('hire_date')
                    ->required()
                    ->label('Hire Date'),
                Forms\Components\FileUpload::make('photo')
                    ->required()
                    ->label('Photo')
                    ->image()
                    ->directory('photos')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(EmployeeExporter::class)
            ])
            ->columns([
                    Tables\Columns\TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('email')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('phone')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('position')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('department')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('hire_date')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\ImageColumn::make('photo')
                        ->searchable()
                        ->sortable()
                        ->width(100)->height(100),
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportAction::make()
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
