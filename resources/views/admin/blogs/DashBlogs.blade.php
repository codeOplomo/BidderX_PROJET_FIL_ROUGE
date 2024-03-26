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
                        <h3>Blogs List</h3>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Create Blog</a></div>
                </div>
                <!-- End Table Title -->

                <!-- table area Start -->
                <div class="box-table table-responsive">
                    <table class="table upcoming-projects">
                        <thead>
                        <tr>
                            <th>
                                <span>ID</span>
                            </th>
                            <th>
                                <span>Title</span>
                            </th>
                            <th>
                                <span>Category</span>
                            </th>
                            <th>
                                <span>Tags</span>
                            </th>
                            <th>
                                <span>Status</span>
                            </th>
                            <th>
                                <span>Actions</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="ranking">
                        @foreach ($blogs as $index => $blog)
                            <tr class="{{ $index % 2 === 0 ? 'color-light' : '' }}">
                                <td><span>{{ $index + 1 }}</span></td>
                                <td>{{ $blog->title }}</td>
                                <td>
                                        <span>{{ $blog->category->name }}</span>
                                </td>
                                <td>
                                    @foreach ($blog->tags as $tag)
                                        <span>{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span>{{ $blog->status }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-primary">Archive</button>
                                    <button class="btn btn-primary">View Details</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
