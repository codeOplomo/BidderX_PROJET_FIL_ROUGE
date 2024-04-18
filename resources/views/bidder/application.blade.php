@extends('layouts.usersLayout.MainLayout')

@section('content')
    <div class="container" style="display: flex; align-items: center; justify-content: center;">
        <div class="col-lg-6" data-sal="slide-up" data-sal-delay="200" data-sal-duration="800" style="opacity: unset;">
            <div class="form-wrapper-one registration-area">
                <h3 class="mb--30 text-center">Apply to Become a Creator</h3>
                <form action="{{ route('bidder.submitApplication') }}" method="POST" enctype="multipart/form-data" class="rwt-dynamic-form" id="creator-application-form">
                    @csrf
                    <div class="mb-5">
                        <label for="experience_description" class="form-label">Experience Description</label>
                        <textarea name="experience_description" id="experience_description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="professional_qualifications" class="form-label">Upload Professional Qualifications (PDF)</label>
                        <input type="file" name="professional_qualifications" id="professional_qualifications" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
@endsection
