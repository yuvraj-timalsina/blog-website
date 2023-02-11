<x-app-layout>

    <x-slot name="header">
        <div class="d-md-flex md md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Posts') }}
                </h2>
            </div>
            <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input type="file" name="file" class="form-control custom-file-input" id="customFile"
                           aria-describedby="inputGroupAddon" aria-label="Upload">
                    <button class="btn btn-sm btn-success" id="inputGroupAddon">Import Posts</button>
                </div>
            </form>
            <div class="flex md:mt-0 md:ml-4">
                <button type="button" onclick="window.location='{{ route('posts.create') }}'"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Add Post
                </button>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <div class="card-body">
                        <livewire:post-table/>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
