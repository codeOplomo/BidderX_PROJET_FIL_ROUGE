<div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
    <a href="{{ route('collection.show', $collection->id) }}" class="rn-collection-inner-one">
        <div class="collection-wrapper">
            <div class="collection-big-thumbnail">
                <img src="{{ asset('assets/images/collection/collection-lg-01.jpg') }}" alt="Nft_Profile">
            </div>
            <div class="collenction-small-thumbnail">
                <img src="{{ asset('assets/images/collection/collection-sm-01.jpg') }}" alt="Nft_Profile">
                <img src="{{ asset('assets/images/collection/collection-sm-02.jpg') }}" alt="Nft_Profile">
                <img src="{{ asset('assets/images/collection/collection-sm-03.jpg') }}" alt="Nft_Profile">
            </div>
            <div class="collection-profile">
                <img src="{{ asset('assets/images/client/client-15.png') }}" alt="Nft_Profile">
            </div>
            <div class="collection-deg">
                <h6 class="title">{{ $collection->name }}</h6>
                <span class="items">{{ $collection->products_count }} Items</span>
            </div>
        </div>
    </a>
</div>
