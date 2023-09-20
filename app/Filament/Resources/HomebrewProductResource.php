<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomebrewProductResource\Pages;
use Filament\Forms\Components\TextInput\Mask;
use App\Filament\Resources\HomebrewProductResource\RelationManagers;
use App\Models\HomebrewProduct;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomebrewProductResource extends Resource
{
    protected static ?string $model = HomebrewProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('price')->label('Price(RM)')
                            ->required()
                            ->numeric()
                            ->mask(
                                fn(Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                    ->decimalSeparator('.') // Add a separator for decimal numbers.
                                    ->minValue(1) // Set the minimum value that the number can be.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','),
                                // Add a separator for thousands.
                            )
                    ]),
                    Forms\Components\RichEditor::make('desc')->label('Description')
                        ->required()
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'link',
                        ])
                        ->maxLength(65535),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('homebrew_product_category_id')->label('Homebrew Product Category')->relationship('homebrewProductCategory', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('availability')->required()
                            ->numeric()
                            ->mask(
                                fn(Mask $mask) => $mask
                                    ->numeric()
                                    ->integer()
                                    ->minValue(1)
                                    ->thousandsSeparator(','),
                            ),
                    ]),
                    Forms\Components\FileUpload::make('img')->label('Thumbnail')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')->label('Price(RM)'),
                Tables\Columns\TextColumn::make('availability'),
                Tables\Columns\ImageColumn::make('img')->label('Thumbnail'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListHomebrewProducts::route('/'),
            'create' => Pages\CreateHomebrewProduct::route('/create'),
            'view' => Pages\ViewHomebrewProduct::route('/{record}'),
            'edit' => Pages\EditHomebrewProduct::route('/{record}/edit'),
        ];
    }
}