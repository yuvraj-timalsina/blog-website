<?php

    namespace App\Http\Livewire;

    use App\Exports\PostExport;
    use App\Models\Category;
    use App\Models\Post;
    use Illuminate\Database\Eloquent\Builder;
    use Maatwebsite\Excel\Facades\Excel;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;
    use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
    use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
    use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
    use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

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
                ImageColumn::make('Thumbnail')
                    ->location(fn($row) => asset('/storage/' . $row->image?->imageFile))->attributes(fn($row) => [

                        'class' => 'rounded-full ',
                        'style' => 'height:40px',
                        'alt' => $row->name,
                    ]),
                Column::make("Title", "title")
                    ->sortable()
                    ->searchable(),
                Column::make("Slug", "slug"),
                Column::make('Author', 'user.name')
                    ->sortable()
                    ->searchable(),
                Column::make("Category", "category.name")
                    ->sortable()
                    ->searchable(),
                Column::make('Tags')
                    ->label(fn($row) => $row->tags->pluck('name')->implode(', ')),
                Column::make('Created At')
                    ->format(
                        fn($value, $row, Column $column) => $row->created_at?->format('M d, Y')
                    )
                    ->sortable(),
                ButtonGroupColumn::make('Actions')
                    ->attributes(function ($row) {
                        return [
                            'class' => 'space-x-1',
                        ];
                    })
                    ->buttons([

                        LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit ')
                            ->location(fn($row) => route('posts.edit', $row))
                            ->attributes(function ($row) {
                                return [
                                    'class' => 'btn btn-sm btn-primary',
                                ];
                            }),
                        LinkColumn::make('Show')
                            ->title(fn($row) => 'Show ')
                            ->location(fn($row) => route('posts.show', $row))
                            ->attributes(function ($row) {
                                return [
                                    'target' => '_blank',
                                    'class' => 'btn btn-sm btn-success',
                                ];
                            }),
                    ]),
            ];
        }

        public function builder() : Builder
        {
            return Post::query()->with(['image', 'category', 'tags'])
                ->when($this->columnSearch['title'] ?? null, fn($query, $title) => $query->where('posts.title', 'like', '%' . $title . '%'));
        }

        public function bulkActions() : array
        {
            return [
                'deletePost' => 'Delete',
                'export' => 'Export',
            ];
        }

        public function deletePost() : void
        {
            Post::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }

        public function filters() : array
        {
            return [
                MultiSelectFilter::make('Categories')
                    ->options(
                        Category::query()
                            ->orderBy('name')
                            ->get()
                            ->keyBy('id')
                            ->map(fn($category) => $category->name)
                            ->toArray()
                    )->filter(function (Builder $builder, array $values) {
                        $builder->withWhereHas('category', fn($query) => $query->whereIn('categories.id', $values));
                    }),

            ];
        }

        public function export()
        {
            $posts = $this->getSelected();

            $this->clearSelected();

            return Excel::download(new PostExport($posts), 'posts.xlsx');
        }
    }
