<!-- McGill Office of Sustainability Interactive Map -->

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>McGill Sustainability Map</title>
  <link rel="icon" type="image/png" href="../media/icons/moos.png">
  <!-- stylesheets -->
  <link rel="stylesheet" href="vendor/normalize.css">
  <link rel="stylesheet" href="vendor/foundation.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="vendor/jquery.sidr.dark.css">
  <!-- vendor scripts -->
  <script src="vendor/modernizr.js"></script>
  <script src="vendor/jquery.js"></script>
  <script src="vendor/fastclick.js"></script>
  <script src="vendor/foundation.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> 
</head>
<body>

<!-- begin top bar -->
  <nav class="top-bar" data-topbar data-options="is_hover: true">
    <ul class="title-area">
      <li class="name">
        <h1>
          <img src="img/crest.png" class="mcgill-crest">
			MOOS MAP &nbsp; &nbsp;
        </h1> 
      </li>
    </ul>
	<section class="top-bar-section">
	<!-- toggle campus section -->  
	<ul class="left"> 
	  <li class="title"> Select a Campus:</li>
	  <li class=><a id="left-menu" href="#left-menu" onClick="wipe(); toggle_visibility('dtlivelegend'); toggleLayer(2); toggleLayer(8); toggleLayer(1)"><img src="../media/map_elements/downtown.png" width="125" height="28">&nbsp;</a> </li>  
      <li class=><a id="right-menu" href="#right-menu"onClick="wipe(); toggle_visibility('maclivelegend'); toggleLayer(22); toggleLayer(21); toggleLayer(23)"><img src="../media/map_elements/macdonald.png" width="125" height="28">&nbsp;</a> </li>  
   </ul> 
  </section>
</nav>



<div id="sidr-left">
<!-- Your content -->
<ul>
<li class="active">
<a href="#"><input id="dtEnergy" type="checkbox" onclick="toggle_visibility('dtlivelegend'); toggleLayer(8); toggleLayer(1);"><label for="dtEnergy"></label><img src="../../media/icons/kwh.png" width="18px" height="18px">&nbsp; Energy Use</a>
</li>
<li class="active">
<a href="#"><input id="dtSPF" type="checkbox" onclick="toggleLayer(2);"><label for="dtSPF"></label><img src="../../media/icons/SPF3.png" width="18px" height="18px">&nbsp; SPF</a>
</li>
<li>
<a href="#"><input id="dtBikeRacks" type="checkbox" onclick="toggleLayer(4);"><label for="dtBikeRacks"></label><img src="../../media/icons/bikeracks.png" width="18px" height="18px">&nbsp; Bike Racks</a>
</li>
<li>
<a href="#"><input id="dtBikeRoutes" type="checkbox" onclick="toggleLayer(5);"><label for="dtBikeRoutes"></label><img src="../../media/icons/bikeroutes.png" width="18px" height="18px">&nbsp; Bike Routes</a>
</li>
<li>
<a href="#"><input id="dtBixi" type="checkbox" onclick="toggleLayer(6);"><label for="dtBixi"></label><img src="../../media/icons/bixi.png" width="18px" height="18px">&nbsp; Bixi Stations</a>
</li>
<li>
<a href="#"><input id="dtPOI" type="checkbox" onclick="toggleLayer(3);"><label for="dtPOI"></label><img src="../../media/icons/poi.png" width="18px" height="18px">&nbsp; Points of Interest</a>
</li>
<li>&nbsp;_</li>
<li><img src="../../media/icons/msp2.png" width="32px" height="32px">McGill Spaces Project</li>
<li><button class="button" onclick="toggleMsp();">Suggest Site Location</button></li>
<li>
<a href="#"><input id="msp" type="checkbox" onclick="toggleLayer(30);"><label for="msp"></label><img src="../../media/icons/msp.png" width="18px" height="18px">&nbsp; Locations</a>
</li>
</ul>
</div>

<div id="sidr-right">
<!-- Your content -->
<ul>
<li class="active">
<a href="#"><input id="macEnergy" type="checkbox" onclick="toggleLayer(21); toggle_visibility('maclivelegend');"><label for="macEnergy"></label><img src="../../media/icons/kwh.png" width="18px" height="18px">&nbsp; Energy Use</a>
</li>
<li class="active">
<a href="#"><input id="macSPF" type="checkbox" onclick="toggleLayer(23);"><label for="macSPF"></label><img src="../../media/icons/SPF3.png" width="18px" height="18px">&nbsp; SPF</a>
</li>
<li>
<a href="#"><input id="macCampusArea" type="checkbox" onclick="toggleLayer(4);"><label for="macCampusArea"></label><img src="../../media/icons/bikeracks.png" width="18px" height="18px">&nbsp; Campus Area</a>
</li>
<li>
<a href="#"><input id="macBikeRoutes" type="checkbox" onclick="toggleLayer(5);"><label for="macBikeRoutes"></label><img src="../../media/icons/bikeroutes.png" width="18px" height="18px">&nbsp; Bike Routes</a>
</li>
<li>
<a href="#"><input id="macBixi" type="checkbox" onclick="toggleLayer(6);"><label for="macBixi"></label><img src="../../media/icons/bixi.png" width="18px" height="18px">&nbsp; Bixi Stations</a>
</li>
<li>
<a href="#"><input id="macPOI" type="checkbox" onclick="toggleLayer(3);"><label for="macPOI"></label><img src="../../media/icons/poi.png" width="18px" height="18px">&nbsp; Points of Interest</a>
</li>
</ul>
</div>

<!-- here is the actual map div -->
<div id="map_canvas"></div>
<!-- here are the various image files that can be toggled on overlay -->
<div id="sustainability">
  <img src="../media/map_elements/sustainability.png">
</div>
<div id="kwhlegend" class="hideme">
  <img src="../media/map_elements/kwh.png">
</div>
<div id="dtlivelegend" class="hideme">
  <img src="../media/map_elements/dtlivelng.png">
</div>
<div id="maclivelegend" class="hideme">
  <img src="../media/map_elements/maclivelng.png">
</div>

<script>
$(document).ready(function() {
$('#left-menu').sidr({
name: 'sidr-left',
side: 'left' // By default
});
$('#right-menu').sidr({
name: 'sidr-right',
side: 'right'
});
});
</script>

<!-- this is the form for the MSP suggstion bubble -->
<script type="text/template" id="jst-map-form">
  <img src="http://www.moosmap.com/media/map_elements/msp.png">
  <br>
  <table>
    <tr><td><input type="text" id="name" value="Input Location Name"></td></tr>
    <tr><td><input type="text" id="current" value="Describe the location (500 words max)"></td></tr>
    <tr><td><input type="text" id="suggestions" value="Describe how you would change the space (500 words max)"></td></tr>
    <tr><td><input type="text" id="photo" value="insert a valid photo url"></td></tr>
    <tr><td><input type="text" id="user" value="Input your name"></td></tr>
    <tr><td>
      <select id="type">
        <option value="unspecified">I am a:</option>
        <option value="student">student</option>
        <option value="professor">professor</option>
        <option value="staff">staff</option>
        <option value="visitor">visitor</option>
      </select>
    </td></tr>
    <tr><td><input type="button" value="Save" onclick="saveData(); wipe(); toggleLayer(30);"/></td></tr>
  </table>
</script>

<!-- Call to navigation script -->
<script src="js/index.js"></script>
<script src="vendor/jquery.sidr.min.js"></script>
<!-- final Zurb foundation script stuff -->
<script>  $(document).foundation(); </script>    
<!-- this is the custom javascript stuff -->

</body>
</html>