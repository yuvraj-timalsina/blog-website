<?php

    namespace App\Http\Livewire;

    use App\Models\Category;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;
    use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
    use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

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
                ButtonGroupColumn::make('Actions')
                    ->attributes(function ($row) {
                        return [
                            'class' => 'space-x-2',
                        ];
                    })
                    ->buttons([
                        LinkColumn::make('Show')
                            ->title(fn($row) => 'Show ')
                            ->location(fn($row) => route('categories.show', $row))
                            ->attributes(function ($row) {
                                return [
                                    'target' => '_blank',
                                    'class' => 'btn btn-sm btn-success',
                                ];
                            }),
                         LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit ')
                            ->location(fn($row) => route('categories.edit', $row))
                            ->attributes(function ($row) {
                                return [
                                    'class' => 'btn btn-sm btn-primary',
                                ];
                            }),
                    ]),
            ];
        }

        public function bulkActions() : array
        {
            return [
                'deleteCategory' => 'Delete',
            ];
        }

        public function deleteCategory() : void
        {
            Category::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }
    }
