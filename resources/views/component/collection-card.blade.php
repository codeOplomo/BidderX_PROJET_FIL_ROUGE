<style>

    .new-collection-inner .new-collection-wrapper {
        position: relative;
        padding: 18px;
        background: var(--background-color-1);
        border-radius: 5px;
    }
    .new-collection-inner .new-collection-wrapper .new-collection-big-thumbnail {
        overflow: hidden;
        border-radius: 5px;
    }
    .new-collection-inner .new-collection-wrapper .new-collection-big-thumbnail img {
        border-radius: 5px;
        object-fit: cover;
        width: 100%;
        height: auto;
        transition: var(--transition);
    }
    .new-collection-inner .new-collection-wrapper .new-collenction-small-thumbnail {
        isplay: flex;
        justify-content: space-between;
        margin: -4px;
        margin-top: 4px;
    }
    .new-collection-inner .new-collection-wrapper .new-collenction-small-thumbnail img {
        display: inline-block;
        width: 33.33%;
        padding: 4px;
        border-radius: 10px;
    }
    .new-collection-inner .new-collection-wrapper .new-collection-profile {
        display: inline-block;
        width: 33.33%;
        padding: 4px;
        border-radius: 10px;
    }
</style>

{{--<div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">--}}
{{--    <a href="{{ route('collection.show', $collection->id) }}" class="new-collection-inner">--}}
{{--        <div class="new-collection-wrapper">--}}
{{--            <div class="new-collection-big-thumbnail">--}}
{{--                <a href="{{ route('collection.show', $collection->id) }}"><img class="img-fluid"   src="{{$collection->getFirstMediaUrl("blog_cover_image")}}" alt="cover_image"></a>--}}
{{--            </div>--}}
{{--            <div class="new-collenction-small-thumbnail">--}}
{{--                <img class="img-fluid"  src="{{$collection->getFirstMediaUrl("blog_featured_image")}}" alt="blog_featured_image">--}}
{{--                <img class="img-fluid"  src="{{$collection->getFirstMediaUrl("blog_featured_image")}}" alt="blog_featured_image">--}}
{{--                <img class="img-fluid"  src="{{$collection->getFirstMediaUrl("blog_featured_image")}}" alt="blog_featured_image">--}}
{{--            </div>--}}
{{--            <div class="new-collection-profile">--}}
{{--                <img class="img-fluid"   src="{{$collection->getFirstMediaUrl("blog_logo_image")}}" alt="blog_logo_image">--}}
{{--            </div>--}}
{{--            <div class="new-collection-deg">--}}
{{--                <h6 class="title">{{ $collection->name }}</h6>--}}
{{--                <span class="items">{{ $collection->products_count }} Items</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </a>--}}
{{--</div>--}}


<div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800" class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
    <a href="{{ route('collection.show', $collection->id) }}" class="rn-collection-inner-one">
        <div class="collection-wrapper">
            <div class="collection-big-thumbnail">
                <img src="{{$collection->getFirstMediaUrl("blog_cover_image") ?: asset('assets/images/collection/collection-lg-02.jpg')}}" alt="Nft_Profile">
            </div>
            <div class="collenction-small-thumbnail">
                @foreach ($collection->getMedia('blog_featured_image') as $image)
                    @if ($image->exists())
                        <img src="{{ $image->getUrl() }}" alt="Nft_Profile">
                    @else
                        <img src="{{ asset('assets/images/collection/collection-lg-02.jpg') }}" alt="Default Image">
                    @endif
                @endforeach
            </div>

            <div class="collection-profile">
                <img src="{{$collection->getFirstMediaUrl("blog_logo_image") ?: asset('assets/images/collection/collection-lg-02.jpg')}}" alt="Nft_Profile">
            </div>
            <div class="collection-deg">
                <h6 class="title">{{ $collection->name }}</h6>
                <span class="items">{{ $collection->products_count }} Items</span>
            </div>
        </div>
    </a>
</div>

