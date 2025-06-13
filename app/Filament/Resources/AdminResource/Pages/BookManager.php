<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use App\Filament\Resources\BookResource;
use Filament\Resources\Pages\Page;
use Filament\Widgets\Widget;

class BookManager extends Page
{
    protected static string $resource = BookResource::class;

    protected static string $view = 'filament.resources.admin-resource.pages.book-manager';
}
