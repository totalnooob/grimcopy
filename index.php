<?php
if (isset($_POST["submit"])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $human = intval($_POST['human']);
  $from = 'Demo Contact Form'; 
  $to = 'tomikr7@gmail.com'; 
  $subject = 'Message from Contact Demo ';
  
  $body ="From: $name\n E-Mail: $email\n Message:\n $message";

  // Check if name has been entered
  if (!$_POST['name']) {
    $errName = 'Please enter your name';
  }
  
  // Check if email has been entered and is valid
  if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errEmail = 'Please enter a valid email address';
  }
  
  //Check if message has been entered
  if (!$_POST['message']) {
    $errMessage = 'Please enter your message';
  }
  //Check if simple anti-bot test is correct
  if ($human !== 5) {
    $errHuman = 'Your anti-spam is incorrect';
  }

// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
if (mail ($to, $subject, $body, $from)) {
  $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
} else {
  $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
}
}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>Grim Dawn Shrine Map</title>
    <meta charset="utf-8">
    <meta name="description" content="Location of all shrines in game Grim Dawn ">
    <meta name="keywords" content="Grim dawn,shrines,grim dawn shrine map,grim dawn shrine location">
    <meta name="author" content="Richard Tomik">
    <link rel="shortcut icon" href="img/favicon2.ico"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <link rel="stylesheet" type="text/css"  href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script/jquery.bpopup.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <meta name="msvalidate.01" content="34C0B322304EEB9C13255BF61686B443" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86799552-2', 'auto');
  ga('send', 'pageview');
</script>
  </head>
<body>
  <div id="image-map" class="map"></div>
  <script>
  //custom leaflet button code from http://www.coffeegnome.net/control-button-leaflet/
var customControl =  L.Control.extend({

  options: {
    position: 'topleft'
  },

  onAdd: function (map) {
    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
    container.style.backgroundColor = 'white';     
    container.style.backgroundImage = "url(img/houseicon.png)";
    container.style.backgroundSize = "60px 60px";
    container.style.width = '60px';
    container.style.height = '60px';

    container.onclick = function(){
        map.setMaxBounds(bounds);
      console.log('buttonClicked');
    }

    return container;
  }
  
});

var customControl2 =  L.Control.extend({

  options: {
    position: 'topleft'
  },

  onAdd: function (map) {
    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
    container.style.backgroundColor = 'white';     
    container.style.backgroundImage = "url(img/mail.png)";
    container.style.backgroundSize = "60px 60px";
    container.style.width = '60px';
    container.style.height = '60px';

    container.onclick = function(){
      $('#mail_popup').bPopup();
      console.log('buttonMailClicked');
    }

    return container;
  }
  
});


var readyState = function(e){
  map = new L.Map('map').setView([48.935, 18.14], 14);
  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  map.addControl(new customControl());
}

window.addEventListener('DOMContentLoaded', readyState); 

//---------------------------------------------------------------------------//

// Using leaflet.js to pan and zoom a big image.
// code from http://kempe.net/blog/2014/06/14/leaflet-pan-zoom-image.html
// create the slippy map

var map = L.map('image-map',{
  minZoom: 1,
  maxZoom: 4,
  center: [-87, 132],
  zoom: 1.5,
  crs: L.CRS.Simple
});

// dimensions of the image
var w = 2000,
    h = 1500,
    url = 'img/main.jpg';

// calculate the edges of the image, in coordinate space
var southWest = map.unproject([0, h], map.getMaxZoom()-1);
var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
var bounds = new L.LatLngBounds(southWest, northEast);

var stringData = $.ajax({
    url: "a.txt",
    async: false
}).responseText;
//Split values of string data                                                                    
var stringArray = stringData.split("\n");
var arrayLength = stringArray.length;

function changeImage(imgName)
{
  $('#element_to_pop_up').bPopup();
image = document.getElementById('img').src=imgName;

}

var layerGroup1 = L.layerGroup().addTo(map);
var layerGroup2 = L.layerGroup().addTo(map);
var layerGroup3 = L.layerGroup().addTo(map);
    
for(var i = 0; i < arrayLength; i++) {
    var x = $.trim(stringArray[i].split(",")[0]);
    var y = $.trim(stringArray[i].split(",")[1]);
    var img2 = $.trim(stringArray[i].split(",")[2]);
 
    var circle = L.circle([x,y], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.3,
        radius: 2,
    }).addTo(map).addTo(layerGroup1);
    circle.url = img2
    circle.on('click', function(){
        changeImage(this.url);
  });


  

  if((img2 === "img/burial.png")||(img2 === "img/marsh.png")||(img2 === "img/burrwitchestates.png")||(img2 === "img/warden.png")||(img2 === "img/foggybank.png")||(img2 === "img/arkovian.png")||(img2 === "img/steps.png")||(img2 === "img/rocky.png")||(img2 === "img/Cronley.png")||(img2 === "img/old arkovia.png")||(img2 === "img/tyrants.png")||(img2 === "img/denofthelost.png")||(img2 === "img/darkvale.png")||(img2 === "img/valley.png")||(img2 === "img/losttomb.png")||(img2 === "img/BlackSepulcher.png")||(img2 === "img/bastion.png")){
       var circle2 = L.circle([x,y], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 2,
    }).addTo(map).addTo(layerGroup2);
    circle2.url = img2
    circle2.on('click', function(){
      changeImage(this.url);
  });
  }

  if((img2 === "img/warden.png")||(img2 === "img/marsh.png")||(img2 === "img/foggybank.png")||(img2 === "img/Cronley.png")||(img2 === "img/undercity.png")||(img2 === "img/steps.png")||(img2 === "img/tyrants.png")||(img2 === "img/denofthelost.png")||(img2 === "img/darkvale.png")||(img2 === "img/valley.png")||(img2 === "img/losttomb.png")||(img2 === "img/BlackSepulcher.png")||(img2 === "img/bastion.png")||(img2 === "img/BlackSepulcher.png")){
       var circle3 = L.circle([x,y], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.2,
        radius: 2,
    }).addTo(map).addTo(layerGroup3);
    circle3.url = img2
    circle3.on('click', function(){
      changeImage(this.url);
  });
  }

}
var overlayMaps = {
    "Normal": layerGroup1,
    "Elite": layerGroup2,
    "Ultimate": layerGroup3
};
L.control.layers(overlayMaps, null).addTo(map);

// add the image overlay, 
// so that it covers the entire map
L.imageOverlay(url, bounds).addTo(map);
map.addControl(new customControl());
map.addControl(new customControl2());
</script>

<!-- Element to pop up -->
<div id="element_to_pop_up">
  <span class="b-close">x<a/>
      <img id="img" src=""/></div>
</div>

<div id="mail_popup">
  <span class="close">x<a/>
    
    <div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center">Contact Form Example</h1>
				<form class="form-horizontal" role="form" method="post" action="index.php">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
							<?php echo "<p class='text-danger'>$errMessage</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
							<?php echo "<p class='text-danger'>$errHuman</p>";?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>	
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>   					
</div>

<div class="hidden">
	<script type="text/javascript">
			var images = new Array()
			function preload() {
				for (i = 0; i < preload.arguments.length; i++) {
					images[i] = new Image()
					images[i].src = preload.arguments[i]
				}
			}
			preload(
				"img/arkovian.png",
				"img/warden.png",
        "img/burrwitchestates.png",
        "img/asterkarn.png",
        "img/barren.png",
        "img/bastion.png",
        "img/burrwitchestates.png"
			)
		//--><!]]>
	</script>
</div>

</body>
</html>