<script>
    function initialize() {
          initAutocomplete();

          }
    var placeSearch, autocomplete, autocomplete1, autocomplete2, autocomplete3;
        var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };
        
        var componentForm1 = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };
        
        function initAutocomplete() {
          // Create the autocomplete object, restricting the search to geographical
          // location types.
          autocomplete = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
              {types: ['geocode']});
          autocomplete1 = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('autocomplete1')),
              {types: ['geocode']});
          autocomplete2 = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('autocomplete2')),
              {types: ['geocode']});
          autocomplete3 = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('autocomplete3')),
              {types: ['geocode']});

          // When the user selects an address from the dropdown, populate the address
          // fields in the form.
          autocomplete.addListener('place_changed', fillInAddress);
          autocomplete1.addListener('place_changed', fillInAddress1);
          autocomplete2.addListener('place_changed', fillInAddress2);
          autocomplete3.addListener('place_changed', fillInAddress3);
        }

        function fillInAddress() {
          // Get the place details from the autocomplete object.
          var place = autocomplete.getPlace();

          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }

          // Get each component of the address from the place details
          // and fill the corresponding field on the form.
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType).value = val;
            }
          }
        }
        
        function fillInAddress1() {
          // Get the place details from the autocomplete object.
          var place = autocomplete1.getPlace();

          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }

          // Get each component of the address from the place details
          // and fill the corresponding field on the form.
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm1[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType + "1").value = val;
            }
          }
        }
        function fillInAddress2() {
          // Get the place details from the autocomplete object.
          var place = autocomplete2.getPlace();

          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }

          // Get each component of the address from the place details
          // and fill the corresponding field on the form.
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm1[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType + "2").value = val;
            }
          }
        }
        function fillInAddress3() {
          // Get the place details from the autocomplete object.
          var place = autocomplete3.getPlace();

          for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
          }

          // Get each component of the address from the place details
          // and fill the corresponding field on the form.
          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm1[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
              document.getElementById(addressType + "3").value = val;
            }
          }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
              });
              autocomplete.setBounds(circle.getBounds());
            });
          }
        }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4EFKbbWeDCGWiH4VHV6aQTDVI0op9bP8&libraries=places&callback=initialize">
  </script>
  <div class="slider-area">
    <div class="slider-content">
      <div class="row">
        <h2>Bringing You Closer To Your Dream Home</h2><br>
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
          <button class="navbar-btn nav-button wow bounceInRight login" data-target="#myModal" data-toggle="modal" type="button">FOR SALE</button>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                  <h1 class="modal-title">For Sale</h1>
                </div>
                <div class="modal-body">
                  <!-- -->
                  <div class="tab-pane active" id="sale">
                    <div class="search-form wow pulse" data-wow-delay="0.8s">
                      <ul class="nav nav-tabs nav-justified" id="myTab">
                        
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="sale">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="forsale">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete" onfocus="geolocate()" placeholder="Search a Property" type="text"> <input id="country" name="country" type="hidden"> <input id="postal_code" name="zip" type="hidden"> <input id="administrative_area_level_1" name="state" type="hidden"> <input id="locality" name="city" type="hidden"> <input id="route" name="route" type="hidden"> <input id="street_number" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="bed" title="Bedrooms">
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                  <option value="4">
                                    4 and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <div class="tab-pane" id="rent">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="forrent">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete1" onfocus="geolocate()" placeholder="Search a Property" type="text"> <input id="country1" name="country" type="hidden"> <input id="postal_code1" name="zip" type="hidden"> <input id="administrative_area_level_11" name="state" type="hidden"> <input id="locality1" name="city" type="hidden"> <input id="route1" name="route" type="hidden"> <input id="street_number1" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="bed" title="Bedrooms">
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                  <option value="4">
                                    4 and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <div class="tab-pane" id="dev">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="new">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete2" onfocus="geolocate2()" placeholder="Search a Property" type="text"> <input id="country2" name="country" type="hidden"> <input id="postal_code2" name="zip" type="hidden"> <input id="administrative_area_level_12" name="state" type="hidden"> <input id="locality2" name="city" type="hidden"> <input id="route2" name="route" type="hidden"> <input id="street_number2" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="bed" title="Bedrooms">
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                  <option value="4">
                                    4 and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <div class="tab-pane" id="com">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="commercialland">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete3" onfocus="geolocate3()" placeholder="Search a Property" type="text"> <input id="country3" name="country" type="hidden"> <input id="postal_code3" name="zip" type="hidden"> <input id="administrative_area_level_13" name="state" type="hidden"> <input id="locality3" name="city" type="hidden"> <input id="route3" name="route" type="hidden"> <input id="street_number3" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                      </div><!-- End of  --><!-- End of  -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="navbar-btn nav-button wow bounceInRight login" data-target="#myModal1" data-toggle="modal" type="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOR RENT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
          <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                  <h1 class="modal-title">FOR RENT</h1>
                </div>
                <div class="modal-body">
                  <!-- -->
                  <div class="tab-pane active" id="sale">
                    <div class="search-form wow pulse" data-wow-delay="0.8s">
                      <ul class="nav nav-tabs nav-justified" id="myTab">
                        
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="sale">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="forsale">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete" onfocus="geolocate()" placeholder="Search a Property" type="text"> <input id="country" name="country" type="hidden"> <input id="postal_code" name="zip" type="hidden"> <input id="administrative_area_level_1" name="state" type="hidden"> <input id="locality" name="city" type="hidden"> <input id="route" name="route" type="hidden"> <input id="street_number" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="bed" title="Bedrooms">
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                  <option value="4">
                                    4 and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <div class="tab-pane" id="rent">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="forrent">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete1" onfocus="geolocate()" placeholder="Search a Property" type="text"> <input id="country1" name="country" type="hidden"> <input id="postal_code1" name="zip" type="hidden"> <input id="administrative_area_level_11" name="state" type="hidden"> <input id="locality1" name="city" type="hidden"> <input id="route1" name="route" type="hidden"> <input id="street_number1" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="bed" title="Bedrooms">
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                  <option value="4">
                                    4 and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <div class="tab-pane" id="dev">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="new">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete2" onfocus="geolocate2()" placeholder="Search a Property" type="text"> <input id="country2" name="country" type="hidden"> <input id="postal_code2" name="zip" type="hidden"> <input id="administrative_area_level_12" name="state" type="hidden"> <input id="locality2" name="city" type="hidden"> <input id="route2" name="route" type="hidden"> <input id="street_number2" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="bed" title="Bedrooms">
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                  <option value="4">
                                    4 and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <div class="tab-pane" id="com">
                          <form action="" class="form-inline">
                            <input name="source" type="hidden" value="property-forsale"> <input name="type" type="hidden" value="commercialland">
                            <div class="form-group">
                              <input class="col-xs-12 form-control" id="autocomplete3" onfocus="geolocate3()" placeholder="Search a Property" type="text"> <input id="country3" name="country" type="hidden"> <input id="postal_code3" name="zip" type="hidden"> <input id="administrative_area_level_13" name="state" type="hidden"> <input id="locality3" name="city" type="hidden"> <input id="route3" name="route" type="hidden"> <input id="street_number3" type="hidden">
                            </div>
                            <div class="search-row">
                              <div class="form-group">
                                <input class="form-control" name="minprice" placeholder="Minimum Price" type="text">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="maxprice" placeholder="Maximum Price" type="text">
                              </div>
                              <div class="form-group">
                                <select class="selectpicker form-control" name="size" title="Select Size">
                                  <option value="a">
                                    30sqm and below
                                  </option>
                                  <option value="b">
                                    31-60sqm
                                  </option>
                                  <option value="c">
                                    61-100sqm
                                  </option>
                                  <option value="d">
                                    101sqm and above
                                  </option>
                                </select>
                              </div>
                            </div><button class="btn search-btn prop-btm-search" type="submit"><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                      </div><!-- End of  --><!-- End of  -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>