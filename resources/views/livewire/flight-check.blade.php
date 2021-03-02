<h2 class="font-weight-600 mb-4">Search Flights</h2>
<form id="bookingFlight" method="post">
    <div class="mb-3">
        <div class="custom-control custom-radio custom-control-inline">
            <input id="oneway" name="flight-trip" class="custom-control-input" checked="" required="" type="radio">
            <label class="custom-control-label" for="oneway">One Way</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input id="roundtrip" name="flight-trip" class="custom-control-input" required="" type="radio">
            <label class="custom-control-label" for="roundtrip">Round Trip</label>
        </div>
    </div>
    <div class="form-row">
        <div class="col-lg-6 form-group">
            <label for="flightFrom">From</label>
            <div class="position-relative">
                <input type="text" class="form-control rounded-right" id="flightFrom" required="" placeholder="From">
                <span class="icon-inside">
                <i class="fas fa-map-marker-alt"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-6 form-group">
            <label for="flightTo">To</label>
            <div class="position-relative">
                <input type="text" class="form-control" id="flightTo" required="" placeholder="To">
                <span class="icon-inside">
                <i class="fas fa-map-marker-alt"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-lg-6 form-group">
            <label for="flightDepart">Adult</label>
            <div class="position-relative">
                <input id="flightDepart" type="text" class="form-control" required="" placeholder="Pick a Date">
                <span class="icon-inside">
                <i class="far fa-calendar-alt"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-6 form-group">
            <label for="flightReturn">Return On</label>
            <div class="position-relative">
                <input id="flightReturn" type="text" class="form-control" required="" placeholder="Pick a Date">
                <span class="icon-inside">
                <i class="far fa-calendar-alt"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-lg-4 form-group">
            <label for="flightDepart">Depart On</label>
            <div class="position-relative">
                <input id="flightDepart" type="number" min="0" value="1" class="form-control" required="" placeholder="Number of Adult">
                <span class="icon-inside">
                <i class="far fa-users"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 form-group">
            <label for="flightReturn">Children</label>
            <div class="position-relative">
                <input id="flightReturn" type="number" min="0" value="0" class="form-control" required="" placeholder="Number of Children">
                <span class="icon-inside">
                <i class="far fa-users"></i>
                </span>
            </div>
        </div>
        <div class="col-lg-4 form-group">
            <label for="flightReturn">Infant</label>
            <div class="position-relative">
                <input id="flightReturn" type="number" min="0" value="0" class="form-control" required="" placeholder="Number of Infant">
                <span class="icon-inside">
                <i class="far fa-users"></i>
                </span>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-block" type="submit">Search Flights</button>
</form>