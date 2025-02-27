<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_organization')->required(),
                TextInput::make('type_organization')->required(),
                Textarea::make('address')->required(),
                TextInput::make('city')->required(),
                TextInput::make('province')->required(),
                TextInput::make('npwp_number')->nullable(),
                FileUpload::make('npwp_file')
                    ->directory('npwp')
                    ->maxSize(10240) // 10MB
                    ->acceptedFileTypes(['application/pdf', 'image/*']),
                TextInput::make('phone_number')->required(),
                TextInput::make('email_organization')->email()->required(),
                TextInput::make('name_pic')->required(),
                TextInput::make('pic_phone_number')->required(),
                TextInput::make('pic_email')->email()->required(),
                TextInput::make('position')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_organization')->sortable()->searchable(),
                TextColumn::make('type_organization')->sortable(),
                TextColumn::make('city')->sortable(),
                TextColumn::make('province')->sortable(),
                TextColumn::make('phone_number')->sortable(),
                TextColumn::make('email_organization')->sortable(),
                TextColumn::make('name_pic')->sortable(),
                TextColumn::make('pic_phone_number')->sortable(),
                ImageColumn::make('npwp_file')->label('NPWP File'),
                // Menampilkan nama user yang membuat data
                TextColumn::make('creator.name')
                ->label('Created By')
                ->sortable()
                ->searchable(),

                // Menampilkan nama user yang mengupdate data
                TextColumn::make('updater.name')
                    ->label('Updated By')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')->dateTime()->label('Created At'),
                TextColumn::make('updated_at')->dateTime()->label('Updated At'),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected function beforeSave($record)
    {
        if (!$record->exists) {
            $record->created_by = auth()->id();
        }
        $record->updated_by = auth()->id();
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
