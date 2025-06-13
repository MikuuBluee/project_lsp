<x-filament-panels::page>
    <div>
        <x-filament::tabs>
            <x-filament::tabs.item name="books" label="Books" />
            <x-filament::tabs.item name="categories" label="categories" />
        </x-filament::tabs>

        <div x-show="$activeTab === 'books'">
            @livewire('books-table')
        </div>

        <div x-show="$activeTab === 'categories'">
            @livewire('categories-table')
        </div>
    </div>
</x-filament-panels::page>
