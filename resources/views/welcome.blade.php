@extends('layouts.app')


@section('content')
<div id="content">
    <section class="container">
        <div class="row mt-4">
            <div class="col-md-12 col-lg-10">
                <div id="verticalTab">
                    <div class="row no-gutters">
                        <div class="col-md-3 my-0 my-md-4">
                            <ul class="resp-tabs-list">
                                <li>
                                    <span>
                                    <i class="fas fa-plane"></i>
                                    </span> Flights
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="resp-tabs-container bg-white shadow-md rounded h-100 p-3">
                                <!-- Search Flights
                                    ============================================= -->
                                <div>
                                    <livewire:flight-check>
                                </div>
                                <!-- Search Flights end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner
                ============================================= -->
            <div class="col-lg-2 mt-4 mt-lg-0">
                <div class="row">
                    <div class="col-6 col-lg-12 text-center">
                        <a href="#">
                        <img src="assets/images/slider/small-banner-9.jpg" alt="" title="" class="img-fluid rounded shadow-md">
                        </a>
                    </div>
                    <div class="col-6 col-lg-12 mt-lg-3 text-center">
                        <a href="">
                        <img src="assets/images/slider/small-banner-10.jpg" alt="" title="" class="img-fluid rounded shadow-md">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Content end -->
        </div>
    </section>
</div>
@endsection