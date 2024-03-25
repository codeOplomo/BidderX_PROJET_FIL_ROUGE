@extends('layouts.usersLayout.MainLayout')

@section('content')

    <div class="rn-blog-area rn-blog-details-default rn-section-gapTop">
        <div class="container">
            <div class="row g-5 flex-wrap">
                <!-- start single blog -->
                <div class="col-xl-8 col-lg-8">
                    @foreach($blogPosts as $blog)
                        @include('component.blog-card')
                    @endforeach
                </div>
                <!-- end single blog -->
                <div class="col-xl-4 col-lg-4 mt_md--40 mt_sm--40">
                    @include('component.side-blog')
                </div>

                <!-- navigation Pagination -->
                <div class="row">
                    <div class="col-lg-8" data-sal="slide-up" data-sal-delay="550" data-sal-duration="800">
                        <nav class="pagination-wrapper" aria-label="Page navigation example">
                            <ul class="pagination single-column-blog">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- navigation Pagination End-->
            </div>
        </div>
    </div>
@endsection
