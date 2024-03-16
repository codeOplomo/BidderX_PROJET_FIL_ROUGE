@extends('layouts.usersLayout.MainLayout')

@section('content')
    <div class="create-area rn-section-gapTop">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 offset-1 ml-md--0 ml-sm--0">
                    <!-- file upload area -->
                    <div class="upload-area" id="uploadArea">

                        <div class="upload-formate mb--30">
                            <h6 class="title">
                                Upload file
                            </h6>
                            <p class="formate">
                                Drag or choose your file to upload
                            </p>
                        </div>

                        <div class="brows-file-wrapper">
                            <!-- actual upload which is hidden -->
                            <input type="file" class="inputfile" id="product_picture" name="product_picture" />
                            {{-- <input name="createinputfile" id="createinputfile" type="file" class="inputfile" /> --}}
                            <img id="createfileImage" src="{{ asset('assets/images/portfolio/portfolio-05.jpg') }}"
                                alt="" data-black-overlay="6">
                            <!-- our custom upload button -->
                            <label for="product_picture" title="No File Choosen">
                                <i class="feather-upload"></i>
                                <span class="text-center">Choose a Product Image</span>
                                <p class="text-center mt--10">PNG, GIF, WEBP, MP4 or MP3. <br> Max 1Gb.</p>
                            </label>
                        </div>
                    </div>
                    <!-- end upload file area -->

                    <div class="mt--100 mt_sm--30 mt_md--30 d-none d-lg-block">
                        <h5> Note: </h5>
                        <span> Service fee : <strong>2.5%</strong> </span> <br>
                        <span> You will receive : <strong>25.00 ETH $50,000</strong></span>
                    </div>

                </div>

                <div class="col-lg-7">
                    <div class="form-wrapper-one">
                        <form id="auctionForm" class="row" method="POST" action="{{ route('owner.auction.submit') }}"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="col-md-12">
                                <div class="input-box pb--20">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input id="name" name="name" placeholder="e.g. `Digital Awesome Game`">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-box pb--20">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description" rows="3"
                                        placeholder="e.g. “After purchasing the product you can get item...”"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-box pb--20">
                                    <label for="condition" class="form-label">Condition</label>
                                    <input id="condition" name="condition" type="text" placeholder="e.g. Condition">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box pb--20">
                                    <label for="price" class="form-label">Item Price in $</label>
                                    <input id="price" name="price" type="number" step="0.01"
                                        placeholder="e.g. 20">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box pb--20">
                                    <label for="productionYear" class="form-label">Production Year</label>
                                    <input id="productionYear" name="productionYear" type="number"
                                        placeholder="e.g. Production Year">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box pb--20">
                                    <label for="manufacturer" class="form-label">Manufacturer</label>
                                    <input id="manufacturer" name="manufacturer" type="text"
                                        placeholder="e.g. Manufacturer">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box pb--20">
                                    <label for="category" class="form-label">Category</label>
                                    <select id="category" name="category" class="form-control">
                                        <option value="">Choose a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="input-box pb--20">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="datetime-local" id="startDate" name="startDate" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-box pb--20">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="datetime-local" id="endDate" name="endDate" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-6">
                                <div class="input-box pb--20 rn-check-box">
                                    <input class="rn-check-box-input" type="radio" id="instantsale" name="auctionType"
                                        value="instantSale" checked>
                                    <label class="rn-check-box-label" for="instantsale">
                                        Instant Sale
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-6">
                                <div class="input-box pb--20 rn-check-box">
                                    <input class="rn-check-box-input" type="radio" id="putonauction"
                                        name="auctionType" value="auction">
                                    <label class="rn-check-box-label" for="putonauction">
                                        Put on Auction
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-4">
                                <div class="input-box">
                                    <button type="button" class="btn btn-primary-alta btn-large w-100"
                                        data-bs-toggle="modal" data-bs-target="#uploadModal">Preview</button>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-8 mt_lg--15 mt_md--15 mt_sm--15">
                                <div class="input-box">
                                    <button class="btn btn-primary btn-large w-100" type="submit">Submit Auction</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

                <div class="mt--100 mt_sm--30 mt_md--30 d-block d-lg-none">
                    <h5> Note: </h5>
                    <span> Service fee : <strong>2.5%</strong> </span> <br>
                    <span> You will receive : <strong>25.00 ETH $50,000</strong></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function appendFileInput() {
            // Clone the file input from the upload area
            var fileInput = document.getElementById('product_picture').cloneNode(true);
            // Set the attributes of the cloned file input
            fileInput.setAttribute('name', 'product_picture'); // Ensure it has the same name as in the form
            fileInput.setAttribute('style', 'display: none'); // Hide the cloned file input
            // Append the cloned file input to the form
            document.getElementById('auctionForm').appendChild(fileInput);
        }

        // Add event listener to form submission
        document.getElementById('auctionForm').addEventListener('submit', function(event) {
            // Call the function to append file input to form
            appendFileInput();
        });
        // Get the radio buttons
        const putOnAuction = document.getElementById('putonauction');
        const instantSale = document.getElementById('instantsale');

        // Get the datetime inputs
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        // Function to disable datetime inputs
        function disableDateTimeInputs() {
            startDateInput.disabled = true;
            endDateInput.disabled = true;
        }

        // Function to enable datetime inputs
        function enableDateTimeInputs() {
            startDateInput.disabled = false;
            endDateInput.disabled = false;
        }

        // Initially disable datetime inputs
        disableDateTimeInputs();

        // Set minimum value for end date based on start date
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
        });

        // Set minimum value for start date to current time
        const currentDateTime = new Date().toISOString().slice(0, 16);
        startDateInput.min = currentDateTime;

        // Add event listeners to radio buttons
        putOnAuction.addEventListener('change', function() {
            if (this.checked) {
                enableDateTimeInputs();
            }
        });

        instantSale.addEventListener('change', function() {
            if (this.checked) {
                disableDateTimeInputs();
            }
        });
    </script>
@endsection
