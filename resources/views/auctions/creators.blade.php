@extends('layouts.usersLayout.MainLayout')

@section('content')
    <div class="rn-creator-title-area rn-section-gapTop">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h2 class="title mb--0">Our Best Creators</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--15">
                    <div class="shortby-default text-start text-sm-end">
                        <label class="filter-leble">SHOT BY:</label>
                        <select id="creatorSort">
                            <option value="best_seller">Best Seller</option>
                            <option value="top_rated">Top Rated</option>
                            <option value="recent_added">Recent Added</option>
                            <option value="verified">Verified</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--30 creator-list-wrapper" id="creators-section">
                @include('component.creator-list')
            </div>
            <div class="row">
                <div class="col-lg-12" data-sal="slide-up" data-sal-delay="950" data-sal-duration="800">
                    <nav class="pagination-wrapper" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#creatorSort').change(function() {
                var sortValue = $(this).val();
                $.ajax({
                    url: '{{ route("creators.sort") }}',
                    type: 'GET',
                    data: { sort: sortValue },
                    success: function(data) {
                        $('.creator-list-wrapper').html(data);
                    }
                });
            });
        });
    </script>

@endsection
