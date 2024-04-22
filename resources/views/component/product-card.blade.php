<div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12" style="    opacity: unset">
    <a href="{{ route('product.details', $product->auction->id) }}" class="rn-collection-inner-one">
        <div class="collection-wrapper">
            <div class="collection-big-thumbnail">
                @if ($product->getFirstMedia('product_picture'))
                    <img src="{{ $product->getFirstMediaUrl('product_picture') }}" alt="Product Image">
                @else
                    <img src="{{ asset('assets/images/collection/collection-lg-01.jpg') }}" alt="Default Product Image">
                @endif
            </div>
            <div class="collection-profile">
                @if ($product->auction && $product->auction->owner)
                    @if ($product->auction->owner->getFirstMedia('profile_images'))
                        <img src="{{ $product->auction->owner->getFirstMediaUrl('profile_images') }}" alt="Profile Image">
                    @else
                        <img src="{{ asset('assets/images/client/client-15.png') }}" alt="Default Profile Image">
                    @endif
                @else
                    <img src="{{ asset('assets/images/client/client-15.png') }}" alt="Default Profile Image">
                @endif
            </div>
            <div class="collection-deg">
                <h6 class="title">{{ $product->title }}</h6>
                <span class="items"> {{ $product->category->name }} </span>
            </div>
        </div>
    </a>
</div>
