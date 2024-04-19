

<div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-5 col-lg-4 col-md-6 col-sm-6 col-12" style="opacity: unset">
    <div class="product-style-one no-overlay with-placeBid">
        <div class="card-thumbnail">
            <a href="{{ route('product.details', $auction->id) }}">
                @if($auction->product && $auction->product->getFirstMediaUrl("product_picture"))
                    <img src="{{ $auction->product->getFirstMediaUrl("product_picture") }}" alt="NFT_portfolio">
                @else
                    <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Default Image">
                @endif
            </a>
            @auth
                @if(
                    ((!$auction->is_instant && \Carbon\Carbon::now()->lessThan($auction->end_time) && is_null($auction->winner_id)) ||
                     ($auction->is_instant && is_null($auction->current_bid_price) && is_null($auction->winner_id))))
                    <a href="{{ route('product.details', $auction->id) }}" class="btn btn-primary">Place Bid</a>
                @endif
            @endauth

        </div>
        <div class="product-share-wrapper">
            <div class="profile-share">
                @php $count = 0; @endphp
                @foreach ($auction->bids()->with('user')->get()->unique('user_id') as $bid)
                    @if ($count < 3)
                        <a href="#" class="avatar" data-tooltip="{{ $bid->user->firstname }} {{ $bid->user->lastname }}">
                            <img src="{{ $bid->user->getFirstMediaUrl('profile_images') ?: asset('assets/images/client/client-1.png') }}" alt="Nft_Profile">
                        </a>
                        @php $count++; @endphp
                    @endif
                @endforeach

                <a class="more-author-text" href="#">
                    {{ $auction->uniqueBidderCount - 1 }}+ Place Bit.
                </a>
            </div>
            <div class="share-btn share-btn-activation dropdown">
                <button class="icon" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg viewBox="0 0 14 4" fill="none" width="16" height="16" class="sc-bdnxRM sc-hKFxyN hOiKLt">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 2C3.5 2.82843 2.82843 3.5 2 3.5C1.17157 3.5 0.5 2.82843 0.5 2C0.5 1.17157 1.17157 0.5 2 0.5C2.82843 0.5 3.5 1.17157 3.5 2ZM8.5 2C8.5 2.82843 7.82843 3.5 7 3.5C6.17157 3.5 5.5 2.82843 5.5 2C5.5 1.17157 6.17157 0.5 7 0.5C7.82843 0.5 8.5 1.17157 8.5 2ZM11.999 3.5C12.8274 3.5 13.499 2.82843 13.499 2C13.499 1.17157 12.8274 0.5 11.999 0.5C11.1706 0.5 10.499 1.17157 10.499 2C10.499 2.82843 11.1706 3.5 11.999 3.5Z" fill="currentColor"></path>
                    </svg>
                </button>

                <div class="share-btn-setting dropdown-menu dropdown-menu-end">
                    <button type="button" class="btn-setting-text share-text" data-bs-toggle="modal" data-bs-target="#shareModal">
                        Share
                    </button>
                    <button type="button" class="btn-setting-text report-text" data-bs-toggle="modal" data-bs-target="#reportModal">
                        Report
                    </button>
                </div>

            </div>
        </div>
        <a href="{{ route('product.details', $auction->id) }}"><span class="product-name">{{ $auction->product->title }}</span></a>
        <span class="auction-type"></span>
        <span class="auction-type">
            @if ($auction->winner_id)
                Owned by {{ $auction->winner->firstname }} {{ $auction->winner->lastname }}
            @elseif ($auction->is_instant)
                Instant Auction
            @else
                Normal Auction
            @endif
        </span>
        <div class="bid-react-area">
            <div class="last-bid">{{ $auction->current_bid_price }} $</div>
            @auth
                <!-- React area for authenticated users -->
                @can('react', Auth::user())
                    <div class="react-area" onclick="toggleReaction({{ $auction->id }}, this)">
                        @include('component.react-icon')
                        <span class="number" id="reactCount-{{ $auction->id }}">{{ $auction->total_reactions }}</span>
                    </div>
                @else
                    <div class="" >
                        @include('component.react-icon')
                        <span class="number" id="reactCount-{{ $auction->id }}">{{ $auction->total_reactions }}</span>
                    </div>
                @endcan


            @endauth
            @guest
                <!-- Static react count display for guests -->
                <div class="react-count-display">
                    @include('component.react-icon')
                    <span class="number">{{ $auction->total_reactions }}</span>
                </div>
            @endguest
        </div>

    </div>
</div>
