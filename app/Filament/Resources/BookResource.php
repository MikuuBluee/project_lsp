<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\View\LegacyComponents\Widget;
use GuzzleHttp\Psr7\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// use app\Filament\Resources\BookResource\Widgets\BookStats;


class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Book Title')
                    ->required()
                    ->unique(ignoreRecord:true),

                TextInput::make('author')
                    ->label('Writer'),

                TextInput::make('tahun_terbit')
                    ->label('Published Year'),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Categories')
                    ->preload()
                    ->searchable()
                    ->native(false),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Book Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author')
                    ->label('Writer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tahun_terbit')
                    ->label('Published Year'),

                TextColumn::make('category.name')
                    ->label('Categories')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->format('F j, Y')),
                //
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BookResource\Widgets\BookStats::class,
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Books';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-book-open';
    }

    public static function getNavigationSort(): ?int
    {
        return 1; // books
    }
}
