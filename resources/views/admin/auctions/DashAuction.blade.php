@extends('layouts.dashminLayout.DashMainLayout')


@section('content')
    <style>
        .custom-table-container {
            max-width: 100%;
            overflow-x: auto;
        }

    </style>
    <div class="rn-upcoming-area rn-section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="table-title-area d-flex justify-content-between align-items-center mb-4">
                        <h3>Pending Auctions</h3>
                    </div>
                            <div class="box-table table-responsive">
                                <div class="table custom-table-container">
                                    <table class="table table-striped text-white">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Prod Year</th>
                                            <th>Starting Price</th>
                                            <th>Owner</th>
                                            <th>Auction Type</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody class="ranking">
                                        @foreach ($pendingAuctions as $index => $auction)
                                            <tr class="{{ $index % 2 === 0 ? 'color-light' : '' }} text-white">
                                                <td>{{ $auction->id }}</td>
                                                <td>{{ $auction->product->title }}</td>
                                                <td>{{ $auction->product->description }}</td>
                                                <td>{{ $auction->product->production_year }}</td>
                                                <td>{{ $auction->starting_bid_price }}</td>
                                                <td>{{ $auction->owner->firstname }} {{ $auction->owner->lastname }}</td>
                                                <td>
                                                    @if ($auction->duration === null)
                                                        Instant Auction
                                                    @else
                                                        {{ $auction->duration }} hours
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Auction Actions">
                                                        <button type="button" class="btn" title="View Details" data-bs-toggle="modal" data-bs-target="#auctionModal{{ $auction->id }}">
                                                            <script src="https://cdn.lordicon.com/lordicon.js"></script>
                                                            <lord-icon src="https://cdn.lordicon.com/yxczfiyc.json" trigger="hover" style="width:30px;height:30px;"
                                                                       colors="primary:#ee8f66">
                                                            </lord-icon>
                                                        </button>
                                                        <form method="POST" action="{{ route('admin.auctions.accept', $auction) }}">
                                                            @csrf
                                                            <button type="submit" class="btn" title="Accept Auction">
                                                                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                                                                <lord-icon src="https://cdn.lordicon.com/oqdmuxru.json" trigger="hover" style="width:30px;height:30px;"
                                                                           colors="primary:#109121">
                                                                </lord-icon>
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn" title="Reject Auction" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $auction->id }}">
                                                            <script src="https://cdn.lordicon.com/lordicon.js"></script>
                                                            <lord-icon src="https://cdn.lordicon.com/nqtddedc.json" trigger="hover" style="width:30px;height:30px;"
                                                                       colors="primary:#c71f16">
                                                            </lord-icon>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{ $pendingAuctions->links() }}
                        </div>
            </div>
        </div>
    </div>


    <!-- Modal for reject action -->
    @foreach ($pendingAuctions as $auction)
        <div class="modal fade" id="rejectModal{{ $auction->id }}" tabindex="-1" role="dialog"
            aria-labelledby="rejectModalLabel{{ $auction->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel{{ $auction->id }}">Reject Auction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.auctions.reject', $auction) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="motif" class="form-label">Motif:</label>
                                <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal for each auction -->
    @foreach ($pendingAuctions as $auction)
        <div class="modal fade" id="auctionModal{{ $auction->id }}" tabindex="-1" role="dialog"
            aria-labelledby="auctionModalLabel{{ $auction->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auctionModalLabel{{ $auction->id }}">Auction Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Title: {{ $auction->product->title }}</p>
                        <p>Owner: {{ $auction->owner->firstname }} {{ $auction->owner->lastname }}</p>
                        <p>Description: {{ $auction->product->description }}</p>
                        <p>Condition: {{ $auction->product->condition }}</p>
                        <p>Manufacturer: {{ $auction->product->manufacturer }}</p>
                        <p>Production Year: {{ $auction->product->production_year }}</p>
                        <p>Starting Price: {{ $auction->starting_bid_price }}</p>
                        <p>Description: {{ $auction->product->description }}</p>
                        <img src="{{ $auction->product->getFirstMediaUrl('product_picture') }}" alt="Product Image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Add additional buttons or actions here -->
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
