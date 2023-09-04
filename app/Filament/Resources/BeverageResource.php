<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;

use App\Models\Beverage;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput\Mask;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\BeverageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\BeverageResource\RelationManagers;


class BeverageResource extends Resource
{
    protected static ?string $model = Beverage::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Stocking Manage';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')
                            ->dehydrateStateUsing(fn($state) => ucwords($state))
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
                        ->maxLength(65535)
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'link',
                        ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('beverage_category_id')->label('Beverage Category')->relationship('beverageCategory', 'name')
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
                Tables\Columns\ImageColumn::make('img')->label('Thumbnail'),
                Tables\Columns\TextColumn::make('updated_at')->since(),
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
                ExportBulkAction::make()->exports([
                    ExcelExport::make('table')->fromTable(),
                ])
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
            'index' => Pages\ListBeverages::route('/'),
            'create' => Pages\CreateBeverage::route('/create'),
            'view' => Pages\ViewBeverage::route('/{record}'),
            'edit' => Pages\EditBeverage::route('/{record}/edit'),
        ];
    }
}