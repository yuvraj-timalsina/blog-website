<div class="d-flex justify-content-start gap-2">
    <a class="btn btn-sm btn-primary" href="{{ route('categories.edit', $category) }}">Edit</a>
    <form action="{{ route('categories.destroy', $category) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</div>
