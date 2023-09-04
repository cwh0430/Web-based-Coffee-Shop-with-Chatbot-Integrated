<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrewingGuideResource\Pages;
use App\Filament\Resources\BrewingGuideResource\RelationManagers;
use App\Models\BrewingGuide;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrewingGuideResource extends Resource
{
    protected static ?string $model = BrewingGuide::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Guiding Materials Manage';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Brewing Guide Information')
                    ->description('General information of the guide')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(191),
                            Forms\Components\FileUpload::make('cover_img')->label('Front Cover Thumbnail')
                                ->required(),
                        ]),

                        Forms\Components\RichEditor::make('desc')->label('Description')
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                                'codeBlock',
                                'link',
                            ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\FileUpload::make('working_img')->label('Brewing Process Thumbnail')
                                ->required(),
                            Forms\Components\FileUpload::make('final_product_img')->label('Final Product Thumbnail')
                                ->required(),
                        ]),

                    ]),

                Forms\Components\Section::make('Tools and Tips Information')
                    ->description('Tools, tips(optional), and recommended items in this brewing guide')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('using_tools')->label('Tools Needed')
                            ->collapsible()
                            ->minItems(1)
                            ->schema([
                                Forms\Components\TextInput::make('tool_name')->required()->label('Tool')
                            ])
                            ->createItemButtonLabel('More Tools'),
                        Forms\Components\Repeater::make('instructions')
                            ->collapsible()
                            ->minItems(2)
                            ->createItemButtonLabel('More Steps')
                            ->schema([
                                Forms\Components\TextInput::make('step')
                                    ->required()
                                    ->label('Brewing Step'),
                            ]),
                        Forms\Components\Repeater::make('tips')
                            ->collapsible()
                            ->minItems(1)
                            ->label('Tips(Optional)')
                            ->createItemButtonLabel('Add More Tips')
                            ->schema([
                                Forms\Components\TextInput::make('brewing_tip'),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('homebrew_product_id')->label('Recommended Coffee')->relationship('homebrewProduct', 'name')
                                    ->required(),
                                Forms\Components\Select::make('mechanic_id')->label('Recommended Machines')->relationship('mechanic', 'name')
                                    ->required(),
                            ]),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('cover_img')->label('Front Cover Thumbnail'),
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
            'index' => Pages\ListBrewingGuides::route('/'),
            'create' => Pages\CreateBrewingGuide::route('/create'),
            'view' => Pages\ViewBrewingGuide::route('/{record}'),
            'edit' => Pages\EditBrewingGuide::route('/{record}/edit'),
        ];
    }
}