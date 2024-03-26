@extends('layouts.dashminLayout.DashMainLayout')

@section('content')

    <div class="creat-collection-area pt--80">
        <div class="container">
            <div class="row g-5 ">

                <div class="col-lg-8">
                    <form action="{{ route('admin.blogs.store') }}" id="blogForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="create-collection-form-wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="collection-single-wized">
                                        <label for="title" class="title required">Title</label>
                                        <div class="create-collection-input">
                                            <input id="title" name="title" class="title" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="collection-single-wized">
                                            <label for="category" class="title">Category</label>
                                            <div class="create-collection-input">
                                                <select id="category" name="category" class="nice-select mb--30" tabindex="0">
                                                    <option value="" selected disabled>Select a Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="nuron-information mb--30">
                                        <div class="single-notice-setting">
                                            <label for="tags" class="title">Tags</label>
                                                @foreach($tags as $tag)
                                                    <div class="input mb-5">
                                                        <input type="checkbox" class="theme-switch__input" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" style="opacity: unset">
                                                        <label class="theme-switch__input" style="opacity: unset" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                                                    </div>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="collection-single-wized">
                                        <label for="content" class="title">Content</label>
                                        <div class="create-collection-input">
                                            <textarea id="content" name="content" class="text-area"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="button-wrapper">
                                        <!-- <a href="#" class="btn btn-primary btn-large mr--30" data-bs-toggle="modal" data-bs-target="#collectionModal">Preview</a> -->
                                        <button type="submit" class="btn btn-primary-alta btn-large">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-2 offset-1 ml_md--0 ml_sm--0">
                    <div class="collection-single-wized banner">
                        <label class="title">Cover Image</label>
                        <div class="create-collection-input feature-image">
                            <div class="logo-c-image feature">
                                <img id="rbtinput2" src="assets/images/profile/cover-04.png" alt="Profile-NFT">
                                <label for="blog_image" title="No File Choosen">
                                    <span class="text-center color-white"><i class="feather-edit"></i></span>
                                </label>
                            </div>
                            <div class="button-area">
                                <div class="brows-file-wrapper">
                                    <!-- actual upload which is hidden -->
                                    <input name="blog_image" class="inputfile" id="blog_image" type="file" accept="image/*">
                                    <!-- our custom upload button -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function appendFileInput() {
            // Clone the file input from the upload area
            var fileInput = document.getElementById('blog_image').cloneNode(true);
            // Set the attributes of the cloned file input
            fileInput.setAttribute('name', 'blog_image'); // Ensure it has the same name as in the form
            fileInput.setAttribute('style', 'display: none'); // Hide the cloned file input
            // Append the cloned file input to the form
            document.getElementById('blogForm').appendChild(fileInput);
        }

        // Add event listener to form submission
        document.getElementById('blogForm').addEventListener('submit', function(event) {
            // Call the function to append file input to form
            appendFileInput();
        });
    </script>
@endsection

@push('scripts')


@endpush
