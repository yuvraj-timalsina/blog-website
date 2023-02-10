<div class="d-flex justify-content-start gap-2">
    <a class="btn btn-sm btn-primary" href="{{ route('posts.edit', $post) }}">Edit</a>
    <a class="btn btn-sm btn-secondary" target="_blank" href="{{ route('posts.show', $post) }}">Show</a>
    <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</div>
