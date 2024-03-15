@extends('layouts.usersLayout.MainLayout')

@section('content')
<div class="nav-pills">
    <ul>
        <li class="nav-item">
            <a href="{{ route('your-page', ['tab' => 'description']) }}" class="nav-link {{ $activeTab == 'description' ? 'active' : '' }}">
                Description
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('your-page', ['tab' => 'bids']) }}" class="nav-link {{ $activeTab == 'bids' ? 'active' : '' }}">
                Bids
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('your-page', ['tab' => 'message']) }}" class="nav-link {{ $activeTab == 'message' ? 'active' : '' }}">
                Private Message
            </a>
        </li>
    </ul>
</div>

{{-- Tab Content --}}
@if ($activeTab == 'description')
    <div>
        <p>Description content goes here...</p>
    </div>
@elseif ($activeTab == 'bids')
    <div>
        <p>Bids content goes here...</p>
    </div>
@elseif ($activeTab == 'message')
    <div>
        <p>Private message content goes here...</p>
    </div>
@endif
@endsection
