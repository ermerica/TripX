<?php
	
	extract($_POST);
	
	$tripArray = array('origin' => $origin, 
										 'destination' => $destination, 
										 'travelers' => $travelers, 
										 'hours_per_day' => $hoursPerDay, 
										 'efficiency' => $vehicleEfficiency, 
										 'use_toll_roads' => $useTollRoads, 
										 'meal_grade' => $mealGrade, 
										 'hotel_grade' => $hotelGrade, 
										 'created_by' => 1, 
										 'created' => mktime()
							 );
	
	$trip = new Trip($tripArray);
	$trip->save();
	
	$costPerMeal = ($mealGrade * BASE_MEAL) * $travelers;
	$mealCostPerDay = $costPerMeal * 3;
	
	$numRooms = ($travelers / 4 < 1) ? 1 : ceil($travelers / 4);
	$costPerRoom = $hotelGrade * BASE_HOTEL;
	$roomCostPerDay = $numRooms * $costPerRoom;
	
	switch($mealGrade) {
		case 1:
			$mealGradeText = 'Roach Coach';
			break;
		case 2:
			$mealGradeText = 'Budget';
			break;
		case 3:
			$mealGradeText = 'Upscale';
			break;
		default:
			$mealGradeText = 'Not Selected';
			break;
	}
	
	switch($hotelGrade) {
		case 1:
			$hotelGradeText = 'Sleep in Shifts';
			break;
		case 2:
			$hotelGradeText = 'Budget';
			break;
		case 3:
			$hotelGradeText = 'Upscale';
			break;
		default:
			$hotelGradeText = 'Not Selected';
			break;
	}
?>
<div class="page-title">
	<h1>Review Your Trip</h1>
</div>

<div class="trip-review">
	<div class="row">
  	<div class="col-xs-12">
    	<div class="map-wrap">
    		<div id="map"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
    	<div class="trip-data">
      
      	<div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Origin</label>
              </div>
              <div class="col-xs-12">
                <span class="result-origin"><?php echo $origin; ?></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Destination</label>
              </div>
              <div class="col-xs-12">
                <span class="result-destination"><?php echo $destination; ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>One Way</label>
              </div>
              <div class="col-xs-12">
                <span id="distance"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Round Trip</label>
              </div>
              <div class="col-xs-12">
                <span id="distanceRdTrip"></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Travelers</label>
              </div>
              <div class="col-xs-12">
                <span id="travelers"><?php echo $travelers; ?></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Daily Travel</label>
              </div>
              <div class="col-xs-12">
                <span id="timePerDay"><?php echo $hoursPerDay.' hours'; ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Vehicle Efficiency</label>
              </div>
              <div class="col-xs-12">
                <span id="efficiency"><?php echo ($vehicleEfficiency - 5).'mpg - '.($vehicleEfficiency + 5).'mpg'; ?></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Use Toll Roads</label>
              </div>
              <div class="col-xs-12">
                <span id="useTolls"><?php echo ($useTollRoads > 0) ? 'Yes' : 'No'; ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Meal Grade</label>
              </div>
              <div class="col-xs-12">
                <span id="mealGrade"><?php echo $mealGradeText; ?></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Hotel Grade</label>
              </div>
              <div class="col-xs-12">
                <span id="hotelGrade"><?php echo $hotelGradeText; ?></span>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="page-title">
	<h1>Trip Analysis</h1>
</div>

<div class="trip-analysis">
	
  <div class="row">
    <div class="col-xs-12">
    	<div class="trip-data">
      	
        <div class="row">
          <div class="col-xs-12">
            <h3>One Way Trip</h3>
          </div>
        </div>
      	
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Meal Costs</label>
              </div>
              <div class="col-xs-12">
                <span id="mealCostsOneWay"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Hotel Cost</label>
              </div>
              <div class="col-xs-12">
                <span id="hotelCostsOneWay"></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Fuel Costs</label>
              </div>
              <div class="col-xs-12">
                <span id="fuelCostsOneWay"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Toll Costs</label>
              </div>
              <div class="col-xs-12">
                <span id="tollCostsOneWay"></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Low Estimate</label>
              </div>
              <div class="col-xs-12">
                <span id="lowOneWay"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>High Estimate</label>
              </div>
              <div class="col-xs-12">
                <span id="highOneWay"></span>
              </div>
            </div>
          </div>
      	</div>
        
        <div class="row">
          <div class="col-xs-12">
            <h3>Round Trip</h3>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Meal Costs</label>
              </div>
              <div class="col-xs-12">
                <span id="mealCostsRdTrip"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Hotel Cost</label>
              </div>
              <div class="col-xs-12">
                <span id="hotelCostsRdTrip"></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Fuel Costs</label>
              </div>
              <div class="col-xs-12">
                <span id="fuelCostsRdTrip"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Toll Costs</label>
              </div>
              <div class="col-xs-12">
                <span id="tollCostsRdTrip"></span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>Low Estimate</label>
              </div>
              <div class="col-xs-12">
                <span id="lowRdTrip"></span>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6">
            <div class="field row">
              <div class="field-label col-xs-12">
                <label>High Estimate</label>
              </div>
              <div class="col-xs-12">
                <span id="highRdTrip"></span>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>


<?php //echo '<p><pre>'.print_r($_REQUEST, true).'</pre></p>'; ?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEQLC74uucCw72FM8V_QRcTcakOgkpOJ4&callback=initMap"></script>

<script type="text/javascript">
	
	var mapCenter = {};
	var distance = 0;
	var map;
	var roomCostPerDay = <?php echo $roomCostPerDay; ?>;
	var mealCostPerDay = <?php echo $mealCostPerDay; ?>;
	var averageSpeed = <?php echo AVERAGE_SPEED; ?>;
	var vehicleMPG = <?php echo $vehicleEfficiency; ?>;
	var hoursPerDay = <?php echo $hoursPerDay; ?>;
	var gallonGas = <?php echo GALLON_GAS; ?>;
	var tollPerMile = <?php echo TOLL_PER_MILE; ?>;
	var estimateModifier = <?php echo COST_RANGE_MODIFIER; ?>;
	
	jQuery(function($) {
	
		jQuery.ajax({  
			type       : "GET",   				// This can also be GET
			url        : 'http://maps.googleapis.com/maps/api/geocode/json?address=<?php echo $_POST['origin']; ?>&sensor=false',
			success    : function(data){  
				//console.log(data);
				mapCenter.lat =  parseFloat(data.results[0].geometry.location.lat);
				mapCenter.lng = parseFloat(data.results[0].geometry.location.lng);
				//console.log(parseFloat(mapCenter.lat)+', '+mapCenter.lng);
			},  
			error      : function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
	
	});

	
	function initMap() {
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 7,
			center: {lat: mapCenter.lat, lng: mapCenter.lng}
		});
		directionsDisplay.setMap(map);
	
		
		directionsService.route({
			origin: '<?php echo $_POST['origin']; ?>',
			destination: '<?php echo $_POST['destination']; ?>',
			travelMode: google.maps.TravelMode.DRIVING
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
				
				console.log(response);
				console.log();
				for(var i = 0; i < response.routes.length; i++) {
					for(var j = 0; j < response.routes[i].legs.length; j++) {
						distance += (parseInt(response.routes[i].legs[j].distance.value) / 1609.344 );
					}
				}
				distance = Math.round(distance);
				calculate_results();
			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});
	}
	
	function calculate_results() {
		
		var travelDays = Math.ceil(distance / (averageSpeed * hoursPerDay));
		var hotelNights = travelDays - 1;
		var mealCosts = travelDays * mealCostPerDay;
		var hotelCosts = hotelNights * roomCostPerDay;
		var fuelCosts = (distance / vehicleMPG) * gallonGas;
		var tollCosts = (distance * tollPerMile);
		
		var totalCost = mealCosts + hotelCosts + fuelCosts + tollCosts;
		var lowEstimate = totalCost - (totalCost * estimateModifier);
		var highEstimate = totalCost + (totalCost * estimateModifier);
		
		$('#distance').html(distance+' Miles');
		$('#mealCostsOneWay').html('$'+Math.round(mealCosts)+'.00');
		$('#hotelCostsOneWay').html('$'+Math.round(hotelCosts)+'.00');
		$('#fuelCostsOneWay').html('$'+Math.round(fuelCosts)+'.00');
		$('#tollCostsOneWay').html('$'+Math.round(tollCosts)+'.00');
		$('#lowOneWay').html('$'+Math.round(lowEstimate)+'.00');
		$('#highOneWay').html('$'+Math.round(highEstimate)+'.00');
		
		$('#distanceRdTrip').html((distance * 2)+' Miles');
		$('#mealCostsRdTrip').html('$'+(Math.round(mealCosts) * 2)+'.00');
		$('#hotelCostsRdTrip').html('$'+(Math.round(hotelCosts) * 2)+'.00');
		$('#fuelCostsRdTrip').html('$'+(Math.round(fuelCosts) * 2)+'.00');
		$('#tollCostsRdTrip').html('$'+(Math.round(tollCosts) * 2)+'.00');
		$('#lowRdTrip').html('$'+(Math.round(lowEstimate) * 2)+'.00');
		$('#highRdTrip').html('$'+(Math.round(highEstimate) * 2)+'.00');
	}
	
</script>