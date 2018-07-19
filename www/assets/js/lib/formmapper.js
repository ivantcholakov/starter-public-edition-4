;(function($, window, document, undefined){

  var defaults = {
    bounds: true, //Whether to snap geocode search to map bounds. Default: true if null search globally.
    country: null,
    map: false, //A selector, a jQuery object or a DOM element. Default: false which shows no map.
    details: false, //The container that should be populated with form data. Default: false which ignores the setting.
    detailsAttribute: "name", //The attribute's name to use as an indicator. Default: name
	useViewport: true, //Should map zoom to the google suggested viewport
    location: false, //Location to initialize the map on. Default is false shows a blank map.
	satelliteOnZoom: false, //Switch to satellite view when zoomed in. Default: false
	findme: false, //Ask user access to their location. Default: false

    mapOptions: { //Options to pass to the google.maps.Map constructor. 
	//See the full list of options at http://code.google.com/apis/maps/documentation/javascript/reference.html#MapOptions
      zoom: 5,
	  minZoom: 2,
	  maxZoom: 20, //The maximum zoom level the user is allowed achieve with controls. Default: 20
      scrollwheel: false,
	  panControl: false,
      mapTypeId: "roadmap"
    },

    markerOptions: {
      draggable: false
    },

    maxZoom: 16, //The maximum zoom level to zoom in to after a geocoding response. Default: 16
    types: ['geocode'],  //An array containing one or more of the supported types for the places request. Default: geocode 
	//See the full list of options at http://code.google.com/apis/maps/documentation/javascript/places.html#place_search_requests
    blur: false, //triggers on blur event. Default: false
	dragged: false //default state of marker to determine if map should zoom in steps
  };

  // See: https://developers.google.com/maps/documentation/geocoding/#Types on Google Developers
  var componentTypes = ("street_address route intersection political " +
    "country administrative_area_level_1 administrative_area_level_2 " +
    "administrative_area_level_3 colloquial_area locality sublocality " +
    "neighborhood premise subpremise postal_code natural_feature airport " +
    "park point_of_interest post_box street_number floor room " +
    "lat lng viewport location " +
    "formatted_address location_type bounds").split(" ");

  // See: Places Details Responses at https://developers.google.com/maps/documentation/javascript/places#place_details_responses on Google Developers.
  var placesDetails = ("id url website vicinity reference name rating " +
    "international_phone_number icon formatted_phone_number").split(" ");

  // The actual plugin constructor.
  function formmapper(input, options) {

    this.options = $.extend(true, {}, defaults, options);

    this.input = input;
    this.$input = $(input);

    this._defaults = defaults;
    this._name = 'formmapper';

    this.init();
  }

  // Initialize all parts of the plugin.
  $.extend(formmapper.prototype, {
    init: function(){
      this.initMap();
      this.initMarker();
      this.initGeocoder();
      this.initDetails();
      this.initLocation();
    },

    // Initialize the map but only if the option map was set.
    // This will create a map within the given container
    // using the provided mapOptions or link to the existing map instance.
    initMap: function(){
      if (!this.options.map){ return; }

      if (typeof this.options.map.setCenter == "function"){
        this.map = this.options.map;
        return;
      }

      this.map = new google.maps.Map(
        $(this.options.map)[0],
        this.options.mapOptions
      );

      // add click event listener on the map
      google.maps.event.addListener(
        this.map,
        'click',
        $.proxy(this.mapClicked, this)
      );
    },

    // Add a marker with the provided markerOptions but only
    // if the option was set. Additionally it listens for the dragend event
    // to notify the plugin about changes.
    initMarker: function(){
      if (!this.map){ return; }
      var options = $.extend(this.options.markerOptions, { map: this.map });

      if (options.disabled){ return; }

      this.marker = new google.maps.Marker(options);

      google.maps.event.addListener(
        this.marker,
        'dragend',
        $.proxy(this.markerDragged, this)
      );
    },

    // Associate the input with the autocompleter and create a geocoder
    // to fall back when the autocompleter does not return a value.
    initGeocoder: function(){

      var options = {
        types: this.options.types,
        bounds: this.options.bounds === true ? null : this.options.bounds,
        componentRestrictions: this.options.componentRestrictions
      };

      if (this.options.country){
        options.componentRestrictions = {country: this.options.country}
      }

      this.autocomplete = new google.maps.places.Autocomplete(
        this.input, options
      );

      this.geocoder = new google.maps.Geocoder();

      // Bind autocomplete to map bounds but only if there is a map
      // and options.bindToMap is set to true.
      if (this.map && this.options.bounds === true){
        this.autocomplete.bindTo('bounds', this.map);
      }

      // Watch place_changed events on the autocomplete input field.
      google.maps.event.addListener(
        this.autocomplete,
        'place_changed',
        $.proxy(this.placeChanged, this)
      );

      // Prevent parent form from being submitted if user hit enter.
      this.$input.keypress(function(event){
        if (event.keyCode === 13){ return false; }
      });

      // Listen for geocode events and trigger find action.
      this.$input.bind("geocode", $.proxy(function(){
        this.find();
      }, this));

      // Trigger find action when input element is blured out.
      // (Usefull for typing partial location and tabing to the next field or clicking somewhere else.)
      if (this.options.blur === true){
        this.$input.blur($.proxy(function(){
          this.find();
        }, this));
      }
    },

    // Prepare a given DOM structure to be populated when we got some data.
    // This will cycle through the list of component types and map the
    // corresponding elements.
    initDetails: function(){
      if (!this.options.details){ return; }

      var $details = $(this.options.details),
        attribute = this.options.detailsAttribute,
        details = {};

      function setDetail(value){
        details[value] = $details.find("[" +  attribute + "=" + value + "]");
      }

      $.each(componentTypes, function(index, key){
        setDetail(key);
        setDetail(key + "_short");
      });

      $.each(placesDetails, function(index, key){
        setDetail(key);
      });

      this.$details = $details;
      this.details = details;
    },

    // Set the initial location of the plugin if the `location` options was set.
    // This method will care about converting the value into the right format.
    initLocation: function() {

      var location = this.options.location, latLng;
	  
	  if (this.options.findme) {
		  
		  findMyLocation(this.input);
		   
		   return;
	  }

      if (!location) { return; }

      if (typeof location == 'string') {
        this.find(location);
        return;
      }

      if (location instanceof Array) {
        latLng = new google.maps.LatLng(location[0], location[1]);
      }

      if (location instanceof google.maps.LatLng){
        latLng = location;
      }

      if (latLng){
        if (this.map){ this.map.setCenter(latLng); }
        if (this.marker){ this.marker.setPosition(latLng); }
      }
    },

    // Look up a given address. If no address was specified it uses the current value of the input.
    find: function(address){
      this.geocode({
        address: address || this.$input.val()
      });
    },

    // Requests details about a given location.
    geocode: function(request){
      if (this.options.bounds && !request.bounds){
        if (this.options.bounds === true){
          request.bounds = this.map && this.map.getBounds();
        } else {
          request.bounds = this.options.bounds;
        }
      }

      if (this.options.country){
        request.region = this.options.country;
      }

      this.geocoder.geocode(request, $.proxy(this.handleGeocode, this));
    },

    // Handles the geocode response. If more than one result was found
    // it triggers the "geocode:multiple" events. If there was an error
    // the "geocode:error" event is fired.
    handleGeocode: function(results, status){
      if (status === google.maps.GeocoderStatus.OK) {
        var result = results[0];
        this.$input.val(result.formatted_address);
        this.update(result);

        if (results.length > 1){
          this.trigger("geocode:multiple", results);
        }

      } else {
        this.trigger("geocode:error", status);
      }
    },

    // Triggers a given event with optional arguments on the input.
    trigger: function(event, argument){
      this.$input.trigger(event, [argument]);
    },

    // Set the map to a new center by passing a geometry.
    // If the geometry has a viewport, the map zooms out to fit the bounds.
    // Additionally it updates the marker position.
    center: function(geometry){

      if (!this.options.dragged){
		  if(geometry.viewport && this.options.useViewport){
			this.map.fitBounds(geometry.viewport);
			if (this.map.getZoom() > this.options.maxZoom){
			  this.map.setZoom(this.options.maxZoom);
			}
		  }else{
			  this.map.setZoom(this.options.maxZoom);
			  this.map.setCenter(geometry.location);
		  }
      } else {
		if((this.map.getZoom()+4)<this.options.maxZoom) this.map.setZoom(this.map.getZoom()+4);
		else this.map.setZoom(this.options.maxZoom);
        this.map.setCenter(geometry.location);
      }
	   	 
      if (this.marker){
        this.marker.setPosition(geometry.location);
        this.marker.setAnimation(this.options.markerOptions.animation);
      }
	  	diff=Math.floor(this.options.maxZoom/2);
	   if (this.options.satelliteOnZoom && this.map.getZoom()>diff){
		   this.map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
		   this.options.dragged = false;
	   }
	   
    },

    // Update the elements based on a single places or geoocoding response
    // and trigger the "geocode:result" event on the input.
    update: function(result){

      if (this.map){
        this.center(result.geometry);
      }

      if (this.$details){
        this.fillDetails(result);
      }

      this.trigger("geocode:result", result);
    },

    // Populate the provided elements with new result data.
    // This will lookup all elements that has an attribute with the given component type.
    fillDetails: function(result){
      var data = {},
        geometry = result.geometry,
        viewport = geometry.viewport,
        bounds = geometry.bounds;

      // Create a simplified version of the address components.
      $.each(result.address_components, function(index, object){
        var name = object.types[0];
        data[name] = object.long_name;
        data[name + "_short"] = object.short_name;
      });

      // Add properties of the places details.
      $.each(placesDetails, function(index, key){
        data[key] = result[key];
      });

      // Add infos about the address and geometry.
      $.extend(data, {
        formatted_address: result.formatted_address,
        location_type: geometry.location_type || "PLACES",
        viewport: viewport,
        bounds: bounds,
        location: geometry.location,
        lat: geometry.location.lat(),
        lng: geometry.location.lng()
      });

      // Set the values for all details.
      $.each(this.details, $.proxy(function(key, $detail){
        var value = data[key];
        this.setDetail($detail, value);
		if (value) $detail.removeAttr("disabled", "disabled");
		else $detail.attr("disabled", "disabled");
      }, this));

      this.data = data;
    },

    // Assign a given value to a single $element.
    // If the element is an input, the value is set, otherwise it updates the text content.
    setDetail: function($element, value){

      if (value === undefined){
        value = "";
      } else if (typeof value.toUrlValue == "function"){
        value = value.toUrlValue();
      }

      if ($element.is(":input")){
        $element.val(value);
      } else {
        $element.text(value);
      }
    },

    // Fire the geocode:dragged event and pass the new position.
    markerDragged: function(event){
	  this.options.dragged = true;
	  this.map.setCenter(event.latLng);
      this.trigger("geocode:dragged", event.latLng);
    },

    mapClicked: function(event) {
        this.trigger("geocode:click", event.latLng);
    },

    // Update the plugin after the user has selected an autocomplete entry.
    // If the place has no geometry it passes it to the geocoder.
    placeChanged: function(){
      var place = this.autocomplete.getPlace();
      if (!place.geometry){
        this.find(place.name);
      } else {
        this.update(place);
      }
    }
  });

  // A plugin wrapper around the constructor.
  // Pass options with all settings that are different from the default.
  // The attribute is used to prevent multiple instantiations of the plugin.
  $.fn.formmapper = function(options) {

    var attribute = 'plugin_formmapper';

    // If you call .formmapper() with a string as the first parameter
    // it returns the corresponding property or calls the method with the following arguments.
    if (typeof options == "string"){

      var instance = $(this).data(attribute) || $(this).formmapper().data(attribute),
        prop = instance[options];

      if (typeof prop == "function"){
        prop.apply(instance, Array.prototype.slice.call(arguments, 1));
        return $(this);
      } else {
        if (arguments.length == 2){
          prop = arguments[1];
        }
        return prop;
      }
    } else {
      return this.each(function() {
        // Prevent against multiple instantiations.
        var instance = $.data(this, attribute);
        if (!instance) {
          instance = new formmapper( this, options )
          $.data(this, attribute, instance);
        }
      });
    }
  };
  
})( jQuery, window, document );

  function findMyLocation(theObj){
	  if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(function(position) {
				$(theObj).val(position.coords.latitude + ", " + position.coords.longitude);	
				$(theObj).trigger("geocode");
			  });
		   }
  }