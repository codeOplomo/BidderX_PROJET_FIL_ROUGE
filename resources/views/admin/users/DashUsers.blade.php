@extends('layouts.dashminLayout.DashMainLayout')

@section('content')
    <div class="rn-upcoming-area rn-section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <!-- start Table Title -->
                    <div class="table-title-area d-flex justify-content-between align-items-center mb-4">
                        <h3>User Management</h3>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
                    </div>
                    <!-- End Table Title -->

                    <!-- table area Start -->
                    <div class="box-table table-responsive">
                        <table class="table upcoming-projects">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="ranking">
                            @foreach ($users as $index => $user)
                                <tr class="{{ $index % 2 === 0 ? 'color-light' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td><span class="badge bg-primary">{{ $user->roles->first()->name ?? 'N/A' }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">Delete</button>
                                        @if ($user->is_banned)
                                            <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Unban</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Ban</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
