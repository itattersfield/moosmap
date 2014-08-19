console.log('Welcome to the McGill Office of Sustainability.')
console.log('Created by Ian Tattersfield, 2014. All Rights Reserved.')

var map;
var layers = [];


//==========================================================================================
// $('#' + id).hide()
function wipe_visibility(id) {
   var e = document.getElementById(id);
   if(e.style.display == 'block')
      e.style.display = 'none';
   else
      e.style.display = 'none';
}


//==========================================================================================

 function toggle_visibility(id) {
   var e = document.getElementById(id);
   if(e.style.display == 'block')
      e.style.display = 'none';
   else
      e.style.display = 'block';
}


//==========================================================================================
function initialize() {
    var myLatLng = new google.maps.LatLng(45.504093, -73.576428);
    var myOptions = {
      zoom: 15,
      zoomControl: true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.RIGHT_TOP
      },
      panControl: true,
      panControlOptions: {
        position: google.maps.ControlPosition.RIGHT_TOP
      },
      mapTypeControl: false,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    layers[0] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/gjyr.kml',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[1] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/dtlive.php',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[2] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/dt_spf_proj.kml',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[3] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/greenfeatures.kml',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[4] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/bikeracks.kml',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[5] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/bikeroutes.kml',
      {preserveViewport: false, suppressInfoWindows: false})
    layers[6] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/bixi.kml',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[7] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/msp.php',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[8] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/nodata.kml',
      {preserveViewport: false, suppressInfoWindows: false});

    layers[20] = new google.maps.KmlLayer('http://www.moosmap.com/layers/mac/mac.kml',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[21] = new google.maps.KmlLayer('http://www.moosmap.com/layers/mac/maclive.php',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[22] = new google.maps.KmlLayer('http://www.moosmap.com/layers/mac/mac_area.kmz',
      {preserveViewport: false, suppressInfoWindows: false});
    layers[23] = new google.maps.KmlLayer('http://www.moosmap.com/layers/mac/mac_spf2.php',
      {preserveViewport: false, suppressInfoWindows: false});

    layers[30] = new google.maps.KmlLayer('http://www.moosmap.com/layers/dt/msp.php',
      {preserveViewport: false, suppressInfoWindows: false});

  var livelegend = document.getElementById('dtlivelegend'); 
  var livesteam = document.getElementById('maclivelegend'); 

  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(dtlivelegend);    
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(maclivelegend);
    
  var html = $('#jst-map-form').html();
  console.log(html)
  infowindow = new google.maps.InfoWindow({
    content: html
  });

}  



//==========================================================================================
function toggleLayer(i) {
  if (layers[i].getMap()) {
    layers[i].setMap(null)
  } else {
    layers[i].setMap(map)
  }
}



//==========================================================================================
function wipe(){
  layers[0].setMap(null);
  layers[1].setMap(null);
  layers[2].setMap(null);
  layers[3].setMap(null);
  layers[4].setMap(null);
  layers[5].setMap(null);
  layers[6].setMap(null);
  layers[7].setMap(null);
  layers[8].setMap(null);
  layers[20].setMap(null);
  layers[21].setMap(null);
  layers[22].setMap(null);
  layers[23].setMap(null);
  wipe_visibility('kwhlegend');
  wipe_visibility('dtlivelegend');
  wipe_visibility('maclivelegend');
}



//==========================================================================================

function toggleMsp() {
    google.maps.event.addListener(map, 'click', function (event) {
        marker = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
        infowindow.open(map, marker);
    });
}

//=========================================================================================
function saveData() {
  var name = escape(document.getElementById("name").value);
  var current = escape(document.getElementById("current").value);
  var suggestions = escape(document.getElementById("suggestions").value);
  var photo = escape(document.getElementById("photo").value);
  var user = escape(document.getElementById("user").value);
  var type = escape(document.getElementById("type").value);
  var latlng = marker.getPosition();

  var url = 'http://www.moosmap.com/msp/msp_db_connect.php'
  url += '?name=' + name
  url += '&current=' + current
  url += '&suggestions=' + suggestions + "&photo=" + photo + "&user=" + user + "&type=" + type + "&lat=" + latlng.lat() + "&lng=" + latlng.lng();

  var params = $.param({
    name: name,
    current: current,
    suggestions: suggestions,
    photo: photo,
    user: user,
    type: type,
    lat: latlng.lat(),
    lng: latlng.lng()
  })
  console.log(params)

  downloadUrl(url, function(data, responseCode) {
    if (responseCode == 200 && data.length >= 1) {
      infowindow.close();
      document.getElementById("message").innerHTML = "Location added.";
    }
  });

  infowindow.close();
  google.maps.event.clearListeners(map, 'click');
}


//=========================================================================================
function downloadUrl(url, callback) {
  // USE JQUERY PLEASE -- look up $.get()

  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request.responseText, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}


//==========================================================================================
function doNothing() {}

$(function () {
  initialize()
})
