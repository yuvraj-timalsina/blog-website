<?php

    namespace App\Http\Livewire;

    use App\Models\Tag;
    use Rappasoft\LaravelLivewireTables\DataTableComponent;
    use Rappasoft\LaravelLivewireTables\Views\Column;

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
                Column::make('Action') ->label(function ($row, Column $column) { return view('action.tag', ['tag' => $row]); },),
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
            Tag::whereIn('id', $this->getSelected())->delete();
            flash('All selected tags deleted successfully.');
            $this->clearSelected();
        }

    }
