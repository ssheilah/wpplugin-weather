$(document).ready(function() {

  getLocation();

  function getLocation() {
    $.get("http://ipinfo.io", function(location) {
      $('#location').append(location.city.toUpperCase() + ", ").append(location.region.toUpperCase());
      getWeather(location.loc);
    }, 'jsonp');

    function getWeather(loc) {
      $("#loc").text(loc);
      $("#lat").text(loc.split(",")[0]);
      $("#lon").text(loc.split(",")[1]);
      var lat1 = loc.split(",")[0];
      var lon1 = loc.split(",")[1];
      var urlWea = "http://api.openweathermap.org/data/2.5/weather?lat=" + lat1 + "&lon=" + lon1 + "&APPID=fa5e2b173c7d0cb3395d49eca149a553";
      var urlForec = "http://api.openweathermap.org/data/2.5/forecast?lat=" + lat1 + "&lon=" + lon1 + "&APPID=fa5e2b173c7d0cb3395d49eca149a553";
      

      $.get(urlWea, function(weather) {
        var temperature = weather.main.temp;
        temperature = temperature.toFixed(0);
        var conditions = weather.weather[0].description.toUpperCase();
        $("#conditions").text(conditions);
        var temperatureF = (temperature * 9 / 5 - 459.67).toFixed(0);
        var temperatureC = (temperature - 273).toFixed(0);
        var rainx = conditions.toLowerCase().match(/rain/g);
        if (conditions === "MIST" || conditions === "FOG") {
          $("body").addClass('mist');
         } else if (conditions === "SUN" || conditions === "CLEAR SKY") {
          $("body").addClass('sun');
        } else if (conditions === "SNOW") {
          $("body").addClass('snow'); 
        } else if (conditions === "CLOUDS" || conditions === "OVERCAST CLOUDS") {
          $("body").addClass('clouds');
        } else if (conditions === "SCATTERED CLOUDS" || conditions === "FEW CLOUDS" || conditions === "BROKEN CLOUDS") {   
          $("body").addClass('scattered-clouds');
        } else if (rainx !== "") {
          $("body").addClass('rain');       
        } else {
          $("body").addClass('no-photo');
        }
        $('#k-button').click(function() {
          $("#temperatureF").hide();
          $("#temperatureC").hide();
          $("#temperatureK").show();
          $("#temperatureK").text(temperature + "\u00B0K");
        });

        $('#c-button').click(function() {
          $("#temperatureF").hide();
          $("#temperatureK").hide();
          $("#temperatureC").show();
          $("#temperatureC").text(temperatureC + "\u00B0C");
        });
        $('#f-button').click(function() {
          $("#temperatureK").hide();
          $("#temperatureC").hide();
          $("#temperatureF").show();
          $("#temperatureF").text(temperatureF + "\u00B0F");
        });
      }, 'jsonp');
      
       $.get(urlForec, function(weather) {
        var foreca = weather.list[1].weather[0].main.toUpperCase();
        $("#foreca").text(foreca);
        }, 'jsonp');

    }
  }
});