<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BookResource\Widgets\BookStats;
use App\Models\category;
use Filament\Resources\Components\Tab;


class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BookStats::class,
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('📚 All')
                ->modifyQueryUsing(fn ($query) => $query), // default tanpa filter
        ];

        foreach (Category::orderBy('name')->get() as $category) {
            $tabs['cat_' . $category->id] = Tab::make($category->name)
                ->badge(fn () => \App\Models\Book::where('category_id', $category->id)->count())
                ->modifyQueryUsing(fn ($query) => $query->where('category_id', $category->id));
        }

        return $tabs;
    }

}
