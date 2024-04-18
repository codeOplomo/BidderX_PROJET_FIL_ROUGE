@extends('layouts.dashminLayout.DashMainLayout')

@section('content')
    <div class="rn-upcoming-area rn-section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <!-- Start Table Title -->
                    <div class="table-title-area d-flex justify-content-between align-items-center mb-4">
                        <h3>Creator Application Reviews</h3>
                    </div>
                    <!-- End Table Title -->

                    <!-- Table area Start -->
                    <div class="box-table table-responsive">
                        <table class="table upcoming-projects text-white">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Experience Description</th>
                                <th>Qualifications</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="ranking">
                            @foreach($applications as $index => $application)
                                <tr class="{{ $index % 2 === 0 ? 'color-light' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $application->firstname }} {{ $application->lastname }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->experience_description }}</td>
                                    <td>
                                        <a href="{{ $application->getFirstMediaUrl('qualifications') }}" target="_blank">View PDF</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('creators.approveApplication', $application->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('creators.rejectApplication', $application->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Table area End -->

                </div>
            </div>
        </div>
    </div>
@endsection
