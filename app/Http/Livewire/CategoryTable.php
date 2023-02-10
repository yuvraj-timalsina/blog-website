<?php

    namespace App\Http\Livewire;

    use App\Models\Category;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;

    class CategoryTable extends DataTableComponent
    {
        protected $model = Category::class;

        public function configure() : void
        {
            $this->setPrimaryKey('id')
                ->setAdditionalSelects(['categories.id as id']);
        }

        public function columns() : array
        {
            return [
                Column::make("Name", "name")
                    ->sortable()
                    ->searchable(),
                Column::make("Slug", "slug"),
                Column::make('Action') ->label(function ($row, Column $column) { return view('action.category', ['category' => $row]); },),
            ];
        }

        public function bulkActions() : array
        {
            return [
                'bulkDelete' => 'Delete',
            ];
        }

        public function bulkDelete() : void
        {
            Category::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }

    }
