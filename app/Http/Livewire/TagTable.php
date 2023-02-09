<?php

    namespace App\Http\Livewire;

    use App\Models\Tag;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;
    use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
    use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

    class TagTable extends DataTableComponent
    {
        protected $model = Tag::class;

        public function configure() : void
        {
            $this->setPrimaryKey('id')
            ->setAdditionalSelects(['tags.id as id']);
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
                            ->location(fn($row) => route('tags.show', $row))
                            ->attributes(function ($row) {
                                return [
                                    'target' => '_blank',
                                    'class' => 'btn btn-sm btn-success',
                                ];
                            }),
                         LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit ')
                            ->location(fn($row) => route('tags.edit', $row))
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
                'deleteTag' => 'Delete',
            ];
        }

        public function deleteTag() : void
        {
            Tag::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }

    }
