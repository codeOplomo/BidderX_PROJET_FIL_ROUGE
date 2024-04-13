@foreach($creators as $creator)
    <div class="creator-single col-lg-3 col-md-4 col-sm-6" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" style="opacity: unset">
        <a href="{{ url('author/' . $creator->id) }}" >

            <div class="top-seller-inner-one explore">
                <div class="top-seller-wrapper">
                    <div class="thumbnail verified">
                        <a href="{{ url('author/' . $creator->id) }}"><img src="{{ $creator->avatar ?? 'assets/images/default-avatar.png' }}" alt="Nft_Profile"></a>
                    </div>
                    <div class="top-seller-content">
                        <a href="{{ url('author/' . $creator->id) }}">
                            <h6 class="name">{{ $creator->firstname }} {{ $creator->lastname }}</h6>
                        </a>
                        <span class="count-number">
                        ${{ number_format($creator->total_revenue, 2) }}
                    </span>
                    </div>
                </div>
                <a class="over-link" href="{{ url('author/' . $creator->id) }}"></a>
            </div>

        </a>
    </div>
@endforeach
