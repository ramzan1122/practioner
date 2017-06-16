
var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name',
  sublocality_level_1:'long_name'
};

$(document).on('keyup', '.locationAddr', function () {

    var id = $(this).attr('id');
    var address = (document.getElementById(id));
    var autocomplete = new google.maps.places.Autocomplete(address);
    autocomplete.setTypes(['geocode']);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {

        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return false;
        }
       
        var lati, longi;
        lati = (place.geometry.location.lat()).toFixed(7);
        longi = (place.geometry.location.lng()).toFixed(7);
        place = autocomplete.getPlace();
         
		$('#state').val(''); 
		$('#suburb').val('');
		$('#postal_code').val('');
		$('input[name="latitude"]').val('');
                $('input[name="longitude"]').val('');
		if(place!='undefined')
		{
                        $('input[name="latitude"]').val(lati);
                        $('input[name="longitude"]').val(longi);
                       
			for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			
                        
			if (componentForm[addressType]) {
					
					var val = place.address_components[i][componentForm[addressType]];
                                         
                                         
                                        if(addressType=='sublocality_level_1')
                                        {
                                          $('#suburb').val(val);  
                                        }    
					
					else if(addressType=='administrative_area_level_1')
					{
						$('#state').val(val); 
					}
					else if(addressType=='postal_code')
					{
						$('#postal_code').val(val);  
					}
					
				}
			} // end for
		} // end if
    });

})

