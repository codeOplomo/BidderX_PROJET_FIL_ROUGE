@extends('layouts.usersLayout.MainLayout')

@section('content')

    <!-- start connect area -->
    <div class="rn-connect-area rn-section-gapTop">
        <div class="container">
            <div class="row g mb--50 mb_md--30 mb_sm--30 align-items-center">
                <div class="col-lg-6"  data-sal-delay="150" data-sal-duration="800">
                    <h3 class="connect-title">Connect your wallet</h3>
                    <p class="connect-td">Connect with one of available wallet providers or create a new wallet. <a href="#">What is a wallet?</a></p>
                </div>
                <div class="col-lg-6" data-sal-delay="200" data-sal-duration="800">
                    <p class="wallet-bootm-disc">
                        We do not own your private keys and cannot access your funds without your confirmation.
                    </p>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6" data-sal-delay="150" data-sal-duration="500">
                    <div class="connect-thumbnail">
                        <div class="left-image">
                            <img src="{{ asset('assets/images/connect/connect-01.jpg') }}" alt="Nft_Profile">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-5">
                        <!-- start single wallet -->
                        <div class="col-xxl-4 col-lg-6 col-md-4 col-12 col-sm-6 col-12" data-sal-delay="150" data-sal-duration="800">
                            <div class="wallet-wrapper">
                                <div class="inner">
                                    <div class="icon">
                                        <i data-feather="cast"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a href="#">Bitcollet</a></h4>
                                        <p class="description">I throw myself down among the tall.</p>
                                    </div>
                                </div>
                                <a class="over-link" href="#"></a>
                            </div>
                        </div>
                        <!-- start single wallet -->

                        <!-- start single wallet -->
                        <div class="col-12" data-sal-delay="450" data-sal-duration="800">
                            <div class="wallet-wrapper">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="color-red" data-feather="gitlab"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a href="{{ route('payment.page') }}">Wallet</a></h4>
                                        <p class="description">Make a Deposit</p>
                                    </div>
                                </div>
                                <a class="over-link" href="{{ route('payment.page') }}"></a>
                            </div>
                        </div>
                        <!-- start single wallet -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End connect area -->


@endsection
