@extends('layouts.usersLayout.MainLayout')

@section('content')
<div class="creat-collection-area pt--80">
    <div class="container">
        <div class="row g-5 ">
            <div class="col-lg-3 offset-1 ml_md--0 ml_sm--0">
                <div class="collection-single-wized banner">
                    <label class="title required">Logo image</label>

                    <div class="create-collection-input logo-image">
                        <div class="logo-c-image logo">
                            <img id="rbtinput1" src="assets/images/profile/profile-01.jpg" alt="Profile-NFT">
                            <label for="fatima" title="No File Choosen">
                                <span class="text-center color-white"><i class="feather-edit"></i></span>
                            </label>
                        </div>
                        <div class="button-area">
                            <div class="brows-file-wrapper">
                                <!-- actual upload which is hidden -->
                                <input name="fatima" id="fatima" type="file">
                                <!-- our custom upload button -->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="collection-single-wized banner">
                    <label class="title">Cover Image</label>
                    <div class="create-collection-input feature-image">
                        <div class="logo-c-image feature">
                            <img id="rbtinput2" src="assets/images/profile/cover-04.png" alt="Profile-NFT">
                            <label for="nipa" title="No File Choosen">
                                <span class="text-center color-white"><i class="feather-edit"></i></span>
                            </label>
                        </div>
                        <div class="button-area">
                            <div class="brows-file-wrapper">
                                <!-- actual upload which is hidden -->
                                <input name="nipa" id="nipa" type="file">
                                <!-- our custom upload button -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collection-single-wized banner">
                    <label class="title">Featured image</label>
                    <div class="create-collection-input feature-image">
                        <div class="logo-c-image feature">
                            <img id="createfileImage" src="assets/images/profile/cover-03.jpg" alt="Profile-NFT">
                            <label for="createinputfile" title="No File Choosen">
                                <span class="text-center color-white"><i class="feather-edit"></i></span>
                            </label>
                        </div>
                        <div class="button-area">
                            <div class="brows-file-wrapper">
                                <!-- actual upload which is hidden -->
                                <input name="createinputfile" id="createinputfile" type="file">
                                <!-- our custom upload button -->
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <div class="col-lg-7">
                <form action="{{ route('owner.collections.store') }}" method="POST">
                    @csrf
                    <div class="create-collection-form-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="collection-single-wized">
                                    <label for="name" class="title required">Name</label>
                                    <div class="create-collection-input">
                                        <input id="name" name="name" class="name" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="collection-single-wized">
                                        <label class="title">Category</label>
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
                                <div class="collection-single-wized">
                                    <label for="description" class="title">Description</label>
                                    <div class="create-collection-input">
                                        <textarea id="description" name="description" class="text-area"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="nuron-information mb--30">
                                    <div class="single-notice-setting">
                                        <div class="input">
                                            <input type="checkbox" id="themeSwitch" name="theme-switch" class="theme-switch__input">
                                            <label for="themeSwitch" class="theme-switch__label">
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="content-text">
                                            <p>Explicit & sensitive content</p>
                                        </div>
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
        </div>
    </div>
</div>


@endsection

