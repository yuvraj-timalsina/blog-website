<?php

    namespace App\Http\Livewire;

    use App\Exports\PostExport;
    use App\Models\Category;
    use App\Models\Post;
    use Illuminate\Database\Eloquent\Builder;
    use Maatwebsite\Excel\Facades\Excel;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;
    use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
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
                        fn($value, $row, Column $column) => $row->created_at?->format('M d, Y'))
                    ->sortable(),
                Column::make('Action')->label(function ($row, Column $column) {
                    return view('action.post', ['post' => $row]);
                }),
            ];
        }

        public function builder() : Builder
        {
            return Post::query()->with(['image', 'category', 'tags']);
        }

        public function bulkActions() : array
        {
            return [
                'bulkDelete' => 'Delete',
                'export' => 'Export',
            ];
        }

        public function bulkDelete() : void
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
