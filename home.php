<?php

?>
<div class="page-title">
	<h1>Plan Your Trip</h1>
</div>

<div class="home-trip-form">
	<form class="trip-form" action="<?php echo base_url(); ?>/result/" method="post" enctype="multipart/form-data">
    
    <div class="row">
    	<div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Origin</label>
          </div>
          <div class="col-xs-12">
            <input class="form-control" type="text" name="origin" placeholder="IE: Melbourne,FL" />
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Destination</label>
          </div>
          <div class="col-xs-12">
            <input class="form-control" type="text" name="destination" placeholder="IE: New Orleans,LA" />
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Travelers</label>
          </div>
          <div class="col-xs-12">
            <input class="form-control" type="text" name="travelers" placeholder="IE: 2" />
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Hours Traveling Per Day</label>
          </div>
          <div class="col-xs-12">
            <input class="form-control" type="text" name="hoursPerDay" placeholder="IE: 10" />
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Vehicle Efficiency</label>
          </div>
          <div class="col-xs-12">
            <select class="form-control" name="vehicleEfficiency">
            	<option selected="selected" disabled="disabled">Choose Effieciency</option>
            	<option value="35">31-40 MPG</option>
              <option value="25">21-30 MPG</option>
              <option value="15">11-20 MPG</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Use Toll Roads</label>
          </div>
          <div class="col-xs-12">
            <select class="form-control" name="useTollRoads">
            	<option selected="selected" disabled="disabled">Choose Use of Toll Roads</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>
      </div>
  	</div>
      
    <div class="row">
    	<div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Meal Preference</label>
          </div>
          <div class="col-xs-12">
            <select class="form-control" name="mealGrade">
            	<option selected="selected" disabled="disabled">Choose Meal Preference</option>
            	<option value="3">Upscale</option>
              <option value="2">Budget</option>
              <option value="1">Roach Coach</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="field row">
          <div class="field-label col-xs-12">
            <label>Hotel Preference</label>
          </div>
          <div class="col-xs-12">
            <select class="form-control" name="hotelGrade">
            	<option selected="selected" disabled="disabled">Choose Hotel Preference</option>
            	<option value="3">Upscale</option>
              <option value="2">Budget</option>
              <option value="1">Sleep in Shifts</option>
            </select>
          </div>
        </div>
      </div>
  	</div>
    
    <div class="row">
    	<div class="col-xs-6">
        <div class="field row">
          <div class="col-xs-12">
          	<input class="form-control" type="submit" name="submit" value="Caclulate My Trip!" />
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="field row">
          <div class="col-xs-12">
            <input class="form-control" type="reset" name="reset" value="Start Over" />
          </div>
        </div>
      </div>
  	</div>
    
  </form>
</div>

