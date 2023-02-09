<?php

    namespace App\Http\Livewire;

    use App\Models\Post;
    use Illuminate\Database\Eloquent\Builder;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;
    use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
    use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

    class PostTable extends DataTableComponent
    {
        protected $model = Post::class;

        public function configure() : void
        {
            $this->setPrimaryKey('id')
             ->setAdditionalSelects(['posts.id as id']);
        }

        public function columns() : array
        {
            return [
                Column::make("Title", "title")
                    ->sortable(),
                Column::make("Slug", "slug"),
                Column::make("Category", "category.name")
                    ->sortable(),
                Column::make('Tags')
                    ->label(fn($row) => $row->tags->pluck('name')->implode(', ')),
                Column::make("Created At", "created_at")
                    ->sortable(),
                ButtonGroupColumn::make('Actions')
                    ->attributes(function ($row) {
                        return [
                            'class' => 'space-x-2',
                        ];
                    })
                    ->buttons([
                        LinkColumn::make('Show')
                            ->title(fn($row) => 'Show ')
                            ->location(fn($row) => route('posts.show', $row))
                            ->attributes(function ($row) {
                                return [
                                    'target' => '_blank',
                                    'class' => 'btn btn-sm btn-success',
                                ];
                            }),
                        LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit ')
                            ->location(fn($row) => route('posts.edit', $row))
                            ->attributes(function ($row) {
                                return [
                                    'class' => 'btn btn-sm btn-primary',
                                ];
                            }),
                    ]),
            ];
        }

        public function builder() : Builder
        {
            return Post::query()->whereBelongsTo(auth()->user())->with(['image', 'category', 'tags']);
        }

        public function bulkActions() : array
        {
            return [
                'deletePost' => 'Delete',
            ];
        }

        public function deletePost() : void
        {
            Post::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }
    }
