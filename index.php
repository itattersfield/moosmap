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

  <!-- vendor scripts -->
  <script src="vendor/modernizr.js"></script>
  <script src="vendor/jquery.js"></script>
  <script src="vendor/fastclick.js"></script>
  <script src="vendor/foundation.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> 
</head>
<body>
  <nav class="top-bar" data-topbar data-options="is_hover: true"> 
  <ul class="title-area"> 
  <li class="name"> 
  <h1><a href="#">Downtown Campus Use: </a></h1> 
  </li> 
  <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> 
  </ul> 
  <section class="top-bar-section"> 
  <ul class="right"> 
      <li class="name"> 
       <h1><a href="#">Select Campus Data: </a></h1> 
      </li> 
      <li class="has-dropdown"><a href="#">Downtown:</a>
      <ul class="dropdown">
          <li>&nbsp <input type="checkbox" id="layer0" onClick="wipe(); toggle_visibility('kwhlegend'); toggleLayer(0)" />kWh/year 2013</li>
          <li>&nbsp <input type="checkbox" id="layer0" onClick="wipe(); toggle_visibility('dtlivelegend'); toggleLayer(1); toggleLayer(8)" />Live Energy Usage</li>            
            <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(2)" />SPF Projects</li> <!-- 1210 -->
            <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(3)" />Green Features</li>
            <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(4)" />Bike Racks</li>
            <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(5)" />Bike Routes</li>
            <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(6)" />Bixi Stops</li>
            <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(7)" />MEP Projects</li>
        </ul>
    </li> 
    <li class="has-dropdown"><a href="#">Macdonald:</a>
      <ul class="dropdown">
          <li>&nbsp <input type="checkbox" id="layer0" onClick="wipe(); toggleLayer(20)" />Macdonald Campus</li>
          <li>&nbsp <input type="checkbox" id="layer0" onClick="wipe(); toggle_visibility('maclivelegend'); toggleLayer(21)" />Live Energy Use</li>            
          <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(22)" />Campus Area</li>
          <li>&nbsp <input type="checkbox" id="layer0" onClick="toggleLayer(23)" />SPF Projects</li>
        </ul>
    </li> 
      <li class="has-dropdown"> <a href="#">Links</a> 
        <ul class="dropdown"> 
                <li><a href="http://www.mcgil.ca/sustainability">McGill Office of Sustainability</a></li> 
          <li><a href="http://www.mcgillenergyproject.com">MEP Website</a></li> 
          <li><a href="http://mcgill-steam.herokuapp.com/">McGill Steam Predictions</a></li>
          <li><a href="https://mcgill.pulseenergy.com/">McGill Pulse Energy</a></li>
                <li><a href="#" data-reveal-id="myModal" data-reveal>Project Info</a><li>
        </ul> 
      </li> 
  </ul> 
  <ul class="left"> 
  <li class="title"> <div id="buildingStatus" style="color:#090; padding-top:10px"> <span class="energyValue"></span> in the last hour</div> </li>
  <li class="active"><a href="#">2D View</a></li> 
  <li class=><a href="file:///C|/Users/Ian/Desktop/Website/Root/MEP/earth.php">3D View</a></li>
  </ul> 
  </section> 
</nav>
<div id="map_canvas"></div>
<div id="sustainability">
  <img src="../media/map_elements/sustainability.png">
</div>
<div id="title">
  <img src="../media/map_elements/title.png">
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

<!-- 1776 -->


<div id="sidebar1">
<div class="off-canvas-wrap" data-offcanvas>  <!--3830 for width, 3933 for colour -->
 <div class="inner-wrap"> 
  <a class="left-off-canvas-toggle" href="#" ><img src="../media/icons/expand.png"> &nbsp; Select Layers</a> 
   <aside class="left-off-canvas-menu">
   <br> &nbsp;
  <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="dtlive" type="checkbox">
            <label for="dtlive" onclick="toggleLayer(0);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;">kWh 2013</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="kwh" type="checkbox" checked>
            <label for="kwh" onclick="toggle_visibility('dtlivelegend'); toggleLayer(1); toggleLayer(8)"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;">Live kWh Use</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="SPF" type="checkbox" checked>
            <label for="SPF" onclick="toggleLayer(2);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;"><img src="../media/icons/SPF3.png" width="18px" height="18px">&nbsp;SPF Projects</li>
    </ul>
    <br>
     <ul style="list-style: none outside none;">
       <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="msp" type="checkbox">
            <label for="msp" onclick="toggleMsp();"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;"><img src="../media/icons/msp2.png" width="18px" height="18px">&nbsp;Site Suggestion</li>
    </ul>
    <br>
     <ul style="list-style: none outside none;">
       <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="msp2" type="checkbox">
            <label for="msp2" onclick="toggleLayer(30);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;"><img src="../media/icons/msp.png" width="18px" height="18px">&nbsp;MSP Sites</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="greenfeat" type="checkbox">
            <label for="greenfeat" onclick="toggleLayer(3);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;">Green Features</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="bikerack" type="checkbox">
            <label for="bikerack" onclick="toggleLayer(4);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;"><img src="../media/icons/bikeracks.png" width="18px" height="18px">&nbsp;Bike Racks</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="bikeroute" type="checkbox">
            <label for="bikeroute" onclick="toggleLayer(5);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;">Bike Routes</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="bixi" type="checkbox">
            <label for="bixi" onclick="toggleLayer(6);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;"><img src="../media/icons/bixi.png" width="18px" height="18px">&nbsp;Bixi Info</li>
    </ul>
    <br>
    <ul style="list-style: none outside none;">
        <li style="float: left;display: block;width: 100px;height: 40px;">
                  <div class="switch">
                      <input id="mepasr" type="checkbox">
            <label for="mepasr" onclick="toggleLayer(7);"></label></div></li>
                <li style="float: left;display: block;width: 100px;height: 40px; font-size:12px;">MEP ASR</li>
    </ul>
   </aside> 
  <a class="exit-off-canvas"></a>
 </div> 
</div>
</div>

<div id="footer2">
&nbsp;Select Campus View: 
  <div class="button-bar">  <!-- 1986 color -->
      <ul class="button-group [radius round]">
        <li><a href="#" class="tiny button secondary" onClick="wipe(); toggle_visibility('dtlivelegend'); toggleLayer(2); toggleLayer(8); toggleLayer(1)"><img src="../media/map_elements/downtown.png"></a></li>
        <li><a href="#" class="tiny button secondary" onClick="wipe(); toggle_visibility('maclivelegend'); toggleLayer(22); toggleLayer(21); toggleLayer(23)"><img src="../media/map_elements/macdonald.png"></a></li>
      </ul>
    </div>
</div>
<!-- 1882 -->


<script>
  $(document).foundation();
</script>    
  <script src="js/index.js"></script>
</body>
</html>