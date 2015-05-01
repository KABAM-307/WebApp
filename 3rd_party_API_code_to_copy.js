/*
	Add the js src tag to the html <head> portion,
	
	and add the entire else statement after the if-statement that checks whether there is a nearby weather station

*/

//<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.0.2/jquery.simpleWeather.min.js"></script>
else{
	loadWeather(lat+","+lon,'' );
function loadWeather(location, woeid) {
  $.simpleWeather({
    location: location,
    woeid: woeid,
    unit: 'f',
    success: function(data) {
      
      $("#data").html("<p>Temperature: "+data.temp+"&deg; F</p>");
			$("#data").append("<p>Humidity: "+data.humidity+"%</p>");
			$("#data").append("<p>Pressure: "+data.pressure+" mbars</p>");
			$("#data").append("<p>Light: "+data.light+" lux</p>");
			$("#data").append("<p>Wind speed: "+data.wind+" mph</p>");
			$("#data").append("<p>ZIP code: "+data.zipcode+"</p>");
			if (data.light > 20) {
				
				if(data.humidity > 60){
					/**/
				document.getElementById('rain').style.display = 'block';
				document.getElementById('sun').style.display = 'none';
				document.getElementById('moon').style.display = 'none';
				document.getElementById('cloudy').style.display = 'none';
				}
				
				else if(data.humidity > 30){
					
				document.getElementById('rain').style.display = 'none';
				document.getElementById('sun').style.display = 'none';
				document.getElementById('moon').style.display = 'none';
				document.getElementById('cloudy').style.display = 'block';
					
				}
				else{
				document.getElementById('rain').style.display = 'none';
				document.getElementById('sun').style.display = 'block';
				document.getElementById('moon').style.display = 'none';
				document.getElementById('cloudy').style.display = 'none';
				
				}
			} else {
				document.getElementById('rain').style.display = 'none';
				document.getElementById('moon').style.display = 'block';
				document.getElementById('sun').style.display = 'none';
				document.getElementById('cloudy').style.display = 'none';
			}
	  
	  
    },
    error: function(error) {
      $("#data").html('<p>'+error+'</p>');
    }
  });
}
}