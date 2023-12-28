@extends('admin.dashboard')

@section('dashboard-content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Categories</h1>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                Add New Category
            </button>
        </div>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $category->slug }}</h6>
                            <p class="card-text">{{ Str::limit($category->description, 50) }}</p>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="card-link">Edit</a>
                            <a href="#" class="card-link link-danger" onclick="confirmDelete({{ $category->id }})">
                                Delete
                            </a>
                        </div>
                    </div>
                    <form id="delete-form-{{ $category->id }}"
                        action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Bootstrap Modal for deletion-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this category?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bootstrap modal for addition --}}
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="categoryName" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="categoryDescription" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if ($errors->any())
            new bootstrap.Modal(document.getElementById('addCategoryModal')).show();
        @endif
    </script>
    <!-- JavaScript for Delete Confirmation -->
    <script>
        let categoryIdToDelete = 0;

        function confirmDelete(categoryId) {
            categoryIdToDelete = categoryId;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            document.getElementById('delete-form-' + categoryIdToDelete).submit();
        });
    </script>
@endsection
