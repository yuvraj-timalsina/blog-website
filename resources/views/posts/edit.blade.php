<x-app-layout>

    <x-slot name="header">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Post') }}
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <button type="button" onclick="window.location='{{ route('posts.index') }}'"
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
                        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <img src="{{ $post->thumbnail }}" alt="" width="225px" id="previewImg">
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
                                       type="file" id="thumbnail" onchange="preview()">
                                @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" type="text"
                                       class="form-control @error('title') is-invalid @enderror" id="title"
                                       value="{{ $post->title }}">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                             <textarea name="content" class="content form-control" id="content" cols="30"
                                          rows="10">{!! $post->content !!}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" class="form-select @error('category') is-invalid @enderror"
                                        id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if ($category->id === $post->category_id) selected @endif>
                                            {{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <select class="form-select tags @error('tags') is-invalid @enderror" name="tags[]"
                                        multiple="multiple"
                                        id="tags">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->name }}"
                                                @if ($post->hasTag($tag->name)) selected @endif>
                                            {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
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
    @include('inc.extras')
</x-app-layout>
