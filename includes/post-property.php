
<br><br><br>
        <!-- register-area -->

 
  
<style>
.img-responsive{
	max-width: 150px;
}
</style>

<script src='http://code.jquery.com/jquery.js'></script>
<script src='http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    <script src='includes/js/uploadImages.js'></script>

<script src="assets/js/parsley.min.js"></script>
<script>

$(function(){
document.getElementById("loadimg").style.visibility = "hidden";
/* Check File API compatibility */  
if (!$.fileReader()){
  alert("File API is not supported on your browser");
}
else{
  console.log("File API is supported on your browser");
}

/* createImage Event */
$(document).on("createImage", function(e){
  console.log(e.file.name);
  console.log(e.file.size);
  console.log(e.file.type);
});

/* deleteImage Event */
$(document).on("deleteImage", function(e){
  console.log(e.file.name);
  console.log(e.file.size);
  console.log(e.file.type);
  /* if not there are images, the button is disabled */
  if ($("#upload-preview").countImages() == 0)
  {
    $("#btn").attr("disabled", "disabled");
  }
});
  
/* Prevent form submit */
$("#form").on("submit", function(e){
  e.preventDefault();
});
  
/* Preview and Validate */
$("#form input[type='file']").on("change", function(){
  
  $("#upload-preview").uploadImagesPreview("#form", 
  {
    image_type: "jpg|jpeg|png|gif",
    min_size: 24,
    max_size: (1024*1024*3), /* 3 Mb */
    max_files: 10
  }, function(){
    switch(__errors__upload__) /* Check the possibles erros */
    {
      case 'ERROR_CONTENT_TYPE': alert("Error content type"); break;
      case 'ERROR_MIN_SIZE': alert("Error min size"); break;
      case 'ERROR_MAX_SIZE': alert("Error max size"); break;
      case 'ERROR_MAX_FILES': alert("Error max files"); break;
      default: $("#btn").removeAttr("disabled"); break; /* Activate the button Form */
    }
  });
});

/* Send form */
$( "form" ).submit(function( event ){
  
  /*images are required */
  if ($("#upload-preview").countImages() > 0)
  {
    $("#upload-preview").uploadImagesAjax("includes/ajax.php", {
      params: { id: '<?php echo $_SESSION['ID'];?>',
				title: $('input[name=post_title]').val(),
				price:			 $('input[name=post_price]').val(),
				type:			 $('select[name=post_type]').val(),
				desc:			 $('textarea[name=post_description]').val(),
				country:			 $('input[name=post_country]').val(),
				zip:			 $('input[name=post_zip]').val(),
				state:			 $('input[name=post_state]').val(),
				city:			 $('input[name=post_city]').val(),
				route:			 $('input[name=post_route]').val(),
				p_lat:			 $('input[name=post_lat]').val(),
				p_long:			 $('input[name=post_long]').val(),
				stories:			 $('input[name=post_stories]').val(),
				bed:			 $('input[name=post_bed]').val(),
				bath:			 $('input[name=post_bath]').val(),
				garage:			 $('input[name=post_garage]').val(),
				land:			 $('input[name=post_land]').val(),
				floor:			 $('input[name=post_floor]').val()}, 
	  
	  /* Set the extra parameters here */
      beforeSend: function(){console.log("Sending ...");
      			     document.getElementById("loadimg").style.visibility = "visible";
			     $("#btn").attr("disabled", "disabled");},
      success: function(data){$("#upload-preview").html(data);},
      error: function(e){console.log(e.status);console.log(e.statusText);},
      complete: function(){console.log("Completed");
      			     }
    });
	
  }
  else{ // The button is not activated
    $(this).attr("disabled", "disabled");
  }
});
});
</script>

<style>
.img-responsive{
  max-width: 150px;
}
</style>







  <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4EFKbbWeDCGWiH4VHV6aQTDVI0op9bP8&libraries=places">
		function initialize() {
		initMap();
		initAutocomplete();
		}

      var placeSearch, autocomplete;
      var componentForm = {
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

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
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
	  
	  function initMap() {
										var checker = -1;
										var myLatLng1 = {lat: 14.599512, lng: 120.984222};

										// Create a map object and specify the DOM element for display.
										var map1 = new google.maps.Map(document.getElementById('map'), {
										  center: myLatLng1,
										  zoom: 9
										});
										var marker1 = new google.maps.Marker({});
										// Create a marker and set its position.
										//var marker = new google.maps.Marker({
										//  map: map,
										//  position: myLatLng
										//});
										
										google.maps.event.addListener(map1, 'click', function(event) {
										placeMarker(event.latLng);
										});
										function placeMarker(location) {
											var locstring = location.toString();
											var coords = locstring.match(/\((-?[0-9\.]+), (-?[0-9\.]+)\)/);
											
													
													
											if(checker==-1){
												marker1.setPosition(location);
												marker1.setMap(map1);
												checker = 1;
												//document.getElementById('lat');
												document.getElementById("lat").value = coords[1];
												document.getElementById("long").value = coords[2];
											}
											else {
												marker1.setPosition(location);
												document.getElementById("lat").value = coords[1];
												document.getElementById("long").value = coords[2];
												
											}
										}
										
									}
	  
	  
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4EFKbbWeDCGWiH4VHV6aQTDVI0op9bP8&libraries=places&callback=initialize"
        async defer></script>
  
  
  
        <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

                <div class="col-md-12">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 register-blocks">
                            <h2>Post A Property </h2> 

                           
                        
    <form method="POST" data-parsley-validate id="form"  enctype="multipart/form-data">
        <div class="form-group">
          <input type="file" multiple class="btn btn-primary" />
        </div>
        
        
        <div class="form-group">
          Images: <span class="badge count-images">0</span>
        </div>



 
    <hr />
    <!-- Show the images preview here -->
    <div id="upload-preview"></div>
    <hr/>


<div class="form-group">
    <label for="Lastname">Title</label>
    <input type="text" data-parsley-validate-if-empty required class="form-control" name="post_title" placeholder="Title">
</div>
<div class="form-group">
    <label for="Firstname">Price</label>
    <input type="number"  data-parsley-validate-if-empty required class="form-control" name="post_price" placeholder="&#8369 Price">
</div>
<div class="form-group">
    <label for="Firstname">Type</label>
     <select id="lunchBegins" data-parsley-validate-if-empty class="selectpicker" name="post_type" title="Select Type">

                                        <option value="a">For Sale</option>
                                        <option value="b">For Rent</option>
                                        
                                        
                                    </select>
                               
</div>
<div class="form-group">
    <label for="Firstname">Description</label>
   <textarea class="form-control" data-parsley-validate-if-empty rows="5" name="post_description" id="comment"></textarea>
</div>

<div class="form-group">
    <label for="Firstname">Location</label>
    <input type="text" required class="form-control" data-parsley-validate-if-empty onFocus="geolocate()" id="autocomplete" name="post_location" placeholder="Address"></input>
	<input type="hidden"  id="country" name="post_country" ></input>
	<input type="hidden" id="postal_code" name="post_zip" ></input>
	<input type="hidden" id="administrative_area_level_1" name="post_state" ></input>
	<input type="hidden" id="locality" name="post_city" ></input>
	<input type="hidden" id="route" name="post_route" ></input>
	<input type="hidden" id="street_number" ></input>
	
</div>

<div class="form-group" id="map2">
    <label for="Firstname">Map</label>
	<!--<input type="text" id="lat" name="post_lat" disabled></input>
	<input type="text" id="long" name="post_long" disabled></input>-->
	
   <div class="video-thumb" id="map"></div>
								<script>
									function initMap() {
										var checker = -1;
										var myLatLng1 = {lat: 14.599512, lng: 120.984222};

										// Create a map object and specify the DOM element for display.
										var map1 = new google.maps.Map(document.getElementById('map'), {
										  center: myLatLng1,
										  zoom: 9
										});
										var marker1 = new google.maps.Marker({});
										// Create a marker and set its position.
										//var marker = new google.maps.Marker({
										//  map: map,
										//  position: myLatLng
										//});
										
										google.maps.event.addListener(map1, 'click', function(event) {
										placeMarker(event.latLng);
										});
										function placeMarker(location) {
											var locstring = location.toString();
											var coords = locstring.match(/\((-?[0-9\.]+), (-?[0-9\.]+)\)/);
											
													
													
											if(checker==-1){
												marker1.setPosition(location);
												marker1.setMap(map1);
												checker = 1;
												//document.getElementById('lat');
												document.getElementById("lat").value = coords[1];
												document.getElementById("long").value = coords[2];
											}
											else {
												marker1.setPosition(location);
												document.getElementById("lat").value = coords[1];
												document.getElementById("long").value = coords[2];
												
											}
										}
										
									}
									

									

								</script>
								
								<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4EFKbbWeDCGWiH4VHV6aQTDVI0op9bP8&callback=initMap"
								async defer></script>-->
								
	
</div>
<div class="form-group">
    <label for="Lastname">Latitude</label>
    <input type=""text" required class="form-control" id="lat" name="post_lat" disabled></input>
</div>
<div class="form-group">
    <label for="Lastname">Longitude</label>
    <input type=""text" required class="form-control" id="long" name="post_long" disabled></input>
</div>






<div class="form-group">
    <label for="Firstname">Features</label>
   <div class="row">
        <div class="col-xs-6 form-group">
            <label>Stories</label>
            <input class="form-control" data-parsley-validate-if-empty type="number" placeholder="No. of Stories" name="post_stories"/>
        </div>
        <div class="col-xs-6 form-group">
            <label>Bed</label>
            <input class="form-control" data-parsley-validate-if-empty type="number" placeholder="No. of Bedrooms" name="post_bed"/>
        </div>
        <div class="col-xs-6 form-group">
            <label>Baths</label>
            <input class="form-control" data-parsley-validate-if-empty type="number" placeholder="No. of Bathrooms" name="post_bath"/>
        </div>

        <div class="col-xs-6 form-group">
            <label>Garage</label>
            <input class="form-control" data-parsley-validate-if-empty type="number" placeholder="No. of Cars fit in Garage" name="post_garage"/>
        </div>
    </div>
</div>
<label for="Lastname">Size</label>
<div class="form-group">
    <label for="Lastname">Land Size</label>
    <input type="text" required class="form-control" data-parsley-validate-if-empty name="post_land" placeholder="Land Size">
</div>

<div class="form-group">
    <label for="Firstname">Floor Size</label>
    <input type="number" required class="form-control"  data-parsley-validate-if-empty name="post_floor" placeholder="Floor Size">
</div>

<div class="text-center">
	<img id="loadimg" src="img/loading.gif"></img>
    <button type="submit" id="btn" name="post_submit" data-parsley-validate-if-empty class="btn btn-default" disabled>Post Now!</button>
</div>
</form>




                        </div>
                    </div>
                </div>

               
                        
                    </div>
                </div>






            </div>
        </div>      
