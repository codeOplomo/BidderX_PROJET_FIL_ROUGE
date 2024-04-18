

@extends('layouts.dashminLayout.DashMainLayout')

@section('content')

        <div class="rn-upcoming-area rn-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <!-- start Table Title -->
                        <div class="table-title-area d-flex">
                            <div class="col-lg-10 col-md-10 col-12 d-flex">
                                <i data-feather="briefcase"></i>
                                <h3>Manage Categories</h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Add</a>
                            </div>
                        </div>
                        <!-- End Table Title -->

                        <!-- table area Start -->
                        <div class="box-table table-responsive">
                            <table class="table upcoming-projects text-white">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="ranking">
                                @foreach($categories as $category)
                                    <tr class="{{ $loop->odd ? 'color-light' : '' }}">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $category->id }}">Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form to edit category -->
                                                    <!-- You can customize this form as per your requirement -->
                                                    <form id="editForm{{ $category->id }}" action="{{ route('admin.category.edit', $category->id) }}" method="POST">
                                                        @csrf
                                                        <!-- Your form fields -->
                                                        <div class="mb-3">
                                                            <label for="editCategoryName{{ $category->id }}" class="form-label">Category Name</label>
                                                            <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="name" value="{{ $category->name }}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this category?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <!-- Form to handle deletion -->
                                                    <form id="deleteForm{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to create category -->
                    <!-- You can customize this form as per your requirement -->
                    <form id="createForm" action="{{ route('admin.category.create') }}" method="POST">
                        @csrf
                        <!-- Your form fields -->
                        <div class="mb-3">
                            <label for="createCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="createCategoryName" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
