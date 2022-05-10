<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Sentinel Homepage</title>
</head>
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="search_position">
<form class="search" action="action_page.php">
    <input type="text" id="search" placeholder="Search..." name="search">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>
</div>
<div class="sidebar">
    <img src="coop-logo.png" alt="Avatar" class="avatar">
    <a href="Funeral Arrangments" class="button">Funeral Arrangments</a>
    <a href="Care and Preperation" class="button">Care and Preperation</a>
    <a href="fleet.php" class="button">Fleet Managment</a>
    <a href="Stock Managment" class="button">Stock Managment</a>
    <a href="Timetables" class="button">Timetable</a>

    <div class="logout">
        <a href="logOut.php" class="button">Logout</a>
    </div>
</div>
<br><br><br><br><br><br>
<a href="fleetservice.php">
<button id="service" style="margin-left:40%;"> Service View </button>
</a>
<div class="row">
  <div class="column">
    <img src="fleet/hearse-1.webp" alt="Snow" style="width:100%">
    <a>Number of available Standard Hearse:</a> <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="hearse"> <br>
    <button id="hearsebutton"> Book Standard Hearse </button>
  </div>
  <div class="column">
    <img src="fleet/limousine-1.webp" alt="Forest" style="width:100%">
    <a>Number of available limusine:</a> <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="limusine"> <br>
    <button id="limusinebutton"> Book Standard limusine </button>
  </div>
  <div class="column">
    <img src="fleet/executive-car-1.webp" alt="Mountains" style="width:100%">
    <a>Number of available executive car:</a> <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="executive"> <br>
    <button id="executivebutton"> Book executive car </button>
  </div>
</div>

<div class="row">
  <div class="column">
    <img src="fleet/horse-drawn-glass-hearse-2.webp" alt="Snow" style="width:100%">
    <a>Number of available horse drawn glass hearse:</a> <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="horse"> <br>
    <button id="horsebutton"> Book horse drawn glass hearse </button>
  </div>
  <div class="column">
    <img src="fleet/land-rover-hearse-2.webp" alt="Forest" style="width:100%">
    <a>Number of available land rover hearse:</a> <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="rover"> <br>
    <button id="roverbutton"> Book land rover hearse </button>
  </div>
  <div class="column">
    <img src="fleet/butterfly-hearse.webp" alt="Mountains" style="width:100%">
    <a>Number of available butterfly hearse:</a>    <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="butterfly"> <br>
    <button id="butterflybutton"> Book butterfly hearse </button>
  </div>
</div>

<div class="row">
  <div class="column">
    <img src="fleet/contemporary-vehicle-wrap-1.webp" alt="Snow" style="width:100%">
    <a>Number of available vehicle wrap:</a>    <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="wrap"> <br>
    <button id="wrapbutton"> Book vehicle wrap </button>
  </div>
  <div class="column">
    <img src="fleet/poppy-hearse-1.webp" alt="Forest" style="width:100%">
    <a>Number of available poppy hearse:</a>    <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="poppy"> <br>
    <button id="poppybutton"> Book poppy hearse </button>
  </div>
  <div class="column">
    <img src="fleet/bicycle-hearse-1.webp" alt="Mountains" style="width:100%">
    <a>Number of available bicycle hearse:</a>  <br>
    <input type="date" id="start" name="trip-start"
       value="">
    <input type="time" id="appt" name="appt">
    <input type="text" id="booknum" name="bicycle"> <br>
    <button id="bicyclebutton"> Book bicycle hearse </button>
  </div>
</div>
  
  





</body>
</html>