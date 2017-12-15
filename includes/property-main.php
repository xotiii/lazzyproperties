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
  <script src="assets/js/jquery-1.10.2.min.js"></script>
  
<script type="text/javascript">
function reply_click(clicked_id)
{
    alert(clicked_id);
}
</script>

<br><br><br><br>
        <!-- property area -->
        <div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                    <div class="col-md-12 clear"> 
                        <div class="col-xs-10 page-subheader sorting pl0">
                            


                        <!--/ .layout-switcher-->
                    </div>
                    <div class="col-md-12 clear"> 
                        <div id="list-type" class="proerty-th">
                        <button class="navbar-btn nav-button wow bounceInRight login .nav-button.login" data-target="#myModal" data-toggle="modal" type="button">Smart Search</button>
                        <div class="modal fade" id="myModal" role="dialog">
                            <center>
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

                                          <!-- End of  Smart Search Form -->


                                            </div>
                                          </div><!-- End of  --><!-- End of  -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </center>
                        </div>
						            
                        <form id="form" action="" method="GET" class="form-inline" onchange="getHouseModel">
                                 <div class="form-group">
                                      <select id="filter" class="selectpicker form-control" name="filter" title="Filter By">
                                                  <option value="cheapest">
                                                      Cheapest First
                                                  </option>
                                                  <option value="expensive">
                                                      Expensive First
                                                  </option>
                                                  <option value="asc">
                                                      Date Posted Ascending
                                                  </option>
                                                   <option value="desc">
                                                      Date Posted Descending
                                                  </option>
                                        </select>
                                  </div><!--/ .sort-by-list-->
                                <div class="items-per-page">
                                    
                                   <!--/ .sel-->
                                </div><!--/ .items-per-page-->
                            </div>
                        </form>
                      <script type="text/javascript">
                              
                                $(document).ready(function(){
                                    $("#filter").change(function(){
                                        
                                        var typevalue=$("#filter").val();
                                        var myURL = document.location;
                                        //     myURL=  myURL.replace('&filter=cheapest', " ");
                                        //     myURL = myURL.replace('&filter=expensive', " ");
                                        //     myURL = myURL.replace('&filter=asc', " ");
                                        //     myURL = myURL.replace('&filter=desc', " ");
                                        document.location = myURL +"&filter="+typevalue;
                                                      
                                    });
                                });
                            </script>
                       

								<?php echo property_list();?>
								<!--<div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-3.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div>


                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-2.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a onclick="location.href='  index.php?source=property-page'" ><img src="assets/img/demo/property-1.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
											<span class="pull-left"><b> Bagong Calzada Tuktukan, Taguig City</b> </span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)
												
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-3.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-1.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div>

                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-2.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-3.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-2.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                <div class="col-sm-6 col-md-4 p0">
                                    <div class="box-two proerty-item">
                                        <div class="item-thumb">
                                            <a href="property-1.html" ><img src="assets/img/demo/property-1.jpg"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="property-1.html"> Super nice villa </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Land :</b> 120sqm </span>
											<br/>
											<span class="pull-left"><b> Floor :</b> 120sqm </span>
                                            <span class="proerty-price pull-right"> $ 300,000</span>
                                            <p style="display: none;">Suspendisse ultricies Suspendisse ultricies Nulla quis dapibus nisl. Suspendisse ultricies commodo arcu nec pretium ...</p>
                                            <div class="property-icon">
                                                <img src="assets/img/icon/bed.png">(5)|
                                                <img src="assets/img/icon/shawer.png">(2)|
                                                <img src="assets/img/icon/cars.png">(1)  
                                            </div>
                                        </div> 
                                    </div>
                                </div> -->
								
								<div id="sloadMore" style="">
									<a href="#">Load More</a>
								</div>
								
                        </div>
                    </div>

                    
                    <div class="col-md-12"> 
                        <div class="pull-right">
                            
                        </div>                
                    </div>
                </div>              
            </div>
        </div>
		
		
<script type="text/javascript">
  
$( document ).ready(function () {
  $(".smoreBox").slice(0, 9).show();
    if ($(".sblogBox:hidden").length != 0) {
      $("#sloadMore").show();
    }   
    $("#sloadMore").on('click', function (e) {
      e.preventDefault();
      $(".smoreBox:hidden").slice(0, 9).slideDown();
      if ($(".smoreBox:hidden").length == 0) {
        $("#sloadMore").fadeOut('slow');
      }
    });
  });


</script>

        