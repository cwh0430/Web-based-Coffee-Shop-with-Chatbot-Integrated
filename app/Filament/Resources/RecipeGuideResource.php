<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeGuideResource\Pages;
use App\Filament\Resources\RecipeGuideResource\RelationManagers;
use App\Models\RecipeGuide;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                        Forms\Components\Repeater::make('ingredients')->label('Ingredient')
                            ->collapsible()
                            ->required()
                            ->minItems(1)
                            ->columns(3)
                            ->createItemButtonLabel('More Ingredients')
                            ->schema([
                                Forms\Components\TextInput::make('ingredient.quantity')->required()->label('Quantity')->placeholder('4')
                                    ->numeric()
                                    ->integer()
                                    ->minValue(1),
                                Forms\Components\TextInput::make('ingredient.unit')->required()->label('Unit')->placeholder('oz'),
                                Forms\Components\TextInput::make('ingredient.item')->required()->label('Item')->placeholder('coffee'),
                            ]),

                        Forms\Components\Repeater::make('instructions')
                            ->collapsible()
                            ->minItems(2)
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

                        Forms\Components\Select::make('homebrew_product_id')->label('Recommended Homebrew Product')->relationship('homebrewProduct', 'name')
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