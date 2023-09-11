<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\RecipeGuide;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\RecipeGuideResource\Pages;

class RecipeGuideResource extends Resource
{
    protected static ?string $model = RecipeGuide::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Guiding Materials Manage';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Recipe Guide Information')
                    ->description('General information of the guide')
                    ->collapsible()
                    ->schema([

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(191),

                            Forms\Components\FileUpload::make('img')->label('Beverage Thumbnail')
                                ->required()
                        ]),

                        Forms\Components\RichEditor::make('desc')->label('Description')
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                                'link',
                            ]),



                    ]),

                Forms\Components\Section::make('Ingredients and Tips Information')
                    ->description('Ingredients, instructions, tips(optional), and recommended homebrew product in this recipe guide')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('ingredients')->label('Ingredients Needed')
                            ->collapsible()
                            ->required()
                            ->minItems(1)
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('ingredientInfo.quantity')->required()->label('Quantity')->placeholder('4')
                                    ->numeric()
                                    ->integer()
                                    ->minValue(1),
                                Forms\Components\TextInput::make('ingredientInfo.unit')->required()->label('Unit')->placeholder('oz'),
                                Forms\Components\TextInput::make('ingredientInfo.item')->required()->label('Item')->placeholder('coffee'),
                            ])
                            ->createItemButtonLabel('More Ingredients'),

                        Forms\Components\Repeater::make('instructions')
                            ->minItems(1)
                            ->required()
                            ->createItemButtonLabel('More Steps')
                            ->schema([
                                Forms\Components\TextInput::make('step')
                                    ->required()
                                    ->label('Working Step'),
                            ]),
                        Forms\Components\Repeater::make('tips')
                            ->collapsible()
                            ->minItems(1)
                            ->label('Tips(Optional)')
                            ->createItemButtonLabel('Add More Tips')
                            ->schema([
                                Forms\Components\TextInput::make('recipe_tip'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListRecipeGuides::route('/'),
            'create' => Pages\CreateRecipeGuide::route('/create'),
            'view' => Pages\ViewRecipeGuide::route('/{record}'),
            'edit' => Pages\EditRecipeGuide::route('/{record}/edit'),
        ];
    }
}