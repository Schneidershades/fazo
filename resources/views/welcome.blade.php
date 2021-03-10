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
                                    <h2 class="font-weight-600 mb-4">Search Flights</h2>
                                    <form id="bookingFlight" method="post" action="{{route('flight-check')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input id="oneway" name="flightSearchType" value="Oneway" class="custom-control-input" checked="" required="" type="radio">
                                                <label class="custom-control-label" for="Oneway">One Way</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input id="roundtrip" name="flightSearchType" value="Return" class="custom-control-input" required="" type="radio">
                                                <label class="custom-control-label" for="Return">Round Trip</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-6 form-group">
                                                <label for="flightFrom">Depature</label>
                                                <div class="position-relative">
                                                    <input type="text" name="departure" class="form-control rounded-right" id="flightFrom" required="" placeholder="From">
                                                    <span class="icon-inside">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 form-group">
                                                <label for="flightTo">Destination</label>
                                                <div class="position-relative">
                                                    <input type="text" name="destination" class="form-control" id="flightTo" required="" placeholder="To">
                                                    <span class="icon-inside">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-6 form-group">
                                                <label for="flightDepart">Departure Date</label>
                                                <div class="position-relative">
                                                    <input id="flightDepart" name="depatureDate" type="text" class="form-control" required="" placeholder="Pick a Date">
                                                    <span class="icon-inside">
                                                    <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 form-group">
                                                <label for="flightReturn">Return Date</label>
                                                <div class="position-relative">
                                                    <input id="flightReturn" name="returnDate" type="text" class="form-control" required="" placeholder="Pick a Date">
                                                    <span class="icon-inside">
                                                    <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-4 form-group">
                                                <label for="flightDepart">Adults</label>
                                                <div class="position-relative">
                                                    <input id="flightDepart" name="adults"  type="number" min="0" value="1" class="form-control" required="" placeholder="Number of Adult">
                                                    <span class="icon-inside">
                                                    <i class="far fa-users"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <label for="flightReturn">Children</label>
                                                <div class="position-relative">
                                                    <input id="flightReturn" name="children" type="number" min="0" value="0" class="form-control" required="" placeholder="Number of Children">
                                                    <span class="icon-inside">
                                                    <i class="far fa-users"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <label for="flightReturn">Infant</label>
                                                <div class="position-relative">
                                                    <input id="flightReturn" name="infants" type="number" min="0" value="0" class="form-control" required="" placeholder="Number of Infant">
                                                    <span class="icon-inside">
                                                    <i class="far fa-users"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Search Flights</button>
                                    </form>
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