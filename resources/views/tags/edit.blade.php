<x-app-layout>

    <x-slot name="header">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Tag') }}
                </h2>
            </div>
            <div class="flex md:mt-0 md:ml-4">
                <button type="button" onclick="window.location='{{ route('tags.index') }}'"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                   Go Back
                </button>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('tags.update', $tag) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Tag Name</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       value="{{ $tag->name }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
