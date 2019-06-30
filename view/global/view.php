<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="./images/favicon.png" />
<meta charset="UTF-8">
<title>GeckOS</title>
<link href="https://fonts.googleapis.com/css?family=Signika"
	rel="stylesheet">

<link href="./theme.css" rel="stylesheet">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"
	src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript"
	src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet"
	href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
	integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
	crossorigin="" />
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
	integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
	crossorigin="">
	</script>

<script>

		var toggle = 0;
    	//On initialise la latitude et la longitude du désert du Namib (centre de la carte)
    	// Fonction d'initialisation de la carte
        function initMap(lat, lon, destLat, destLon) {
        	document.getElementById('app').innerHTML = "<div id='map'></div>";
            
        	var macarte = null;
        	// On initalise la latitude et la longitude de la destination (marker)	
            var markers = []; // On initialise la liste des marqueurs
        	// Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            macarte = L.map('map').setView([lat, lon], 11);
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 7,
                maxZoom: 12
            }).addTo(macarte);
            var marker = L.marker([lat, lon]).addTo(macarte);
            marker.bindPopup('Départ');
            markers.push(marker);
            var destMarker = L.marker([destLat, destLon]).addTo(macarte);
            destMarker.bindPopup('Destination');
            markers.push(destMarker);
            // On adapte le zoom pour afficher tous les marqueurs
            var group = new L.featureGroup (markers);
            macarte.fitBounds(group.getBounds().pad(0.5));
        }
     
        function getRndInteger(min, max) {
            return Math.floor(Math.random() * (max - min + 1) ) + min;
        }
        function startTime() {
            var today = new Date();
            var h = (today.getMinutes()%12);
            var m = today.getSeconds();
            if(m == getRndInteger(0, 30) || m == getRndInteger(30, 60) || m == getRndInteger(0, 30) || m == getRndInteger(30, 60)){
               eventEveryMinutes();     
           	}
           
            h = checkTime(h);
            m = checkTime(m);
            document.getElementById('clock').innerHTML = h + ":" + m;
            var t = setTimeout(startTime, 1000);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
        function eventEveryMinutes(){
            
        	$.ajax({
                type: "POST",
                url: './function/changeDisponibility.php',
                success:function(html){   
                     if(toggle == 1){
							notif();
                     }else{
                       $('#geckOOOO').attr('src', './images/geckoNotif.png');                                    
                     }
                                      },
                error:function(html) {
                  alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
                },
           });
        }
        
        function display(controller){
        	$.ajax({
                type: "POST",
                url: './function/display.php',
                data:{controller:controller},
                success:function(html){   
                	document.getElementById('app').innerHTML = html;
                	document.getElementById('app').style.display = 'block'; 
                },
                error:function(html) {
                  alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
                },
           });

        }

        function notif(){
            controller = 'Notification';
        	$.ajax({
                type: "POST",
                url: './function/display.php',
                data:{controller:controller},
                success:function(html){   
                	document.getElementById('app').innerHTML = html; 
                },
                error:function(html) {
                  alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
                },
           });
        	
        }

        function notifAndToggle(){
        	controller = 'Notification';
         	$.ajax({
                 type: "POST",
                 url: './function/display.php',
                 data:{controller:controller},
                 success:function(html){   
                 	document.getElementById('app').innerHTML = html;     
                 	if(document.getElementById('app').style.display == 'none'){
                		document.getElementById('app').style.display = 'block';
                    	toggle = 1;              	         	                   	
                        $('#geckOOOO').attr('src', './images/geckoOpen.png');                                     	                   
                	}else{
                    	toggle = 0;
                		document.getElementById('app').style.display = 'none';                    	
                        $('#geckOOOO').attr('src', './images/gecko.png');                  
                    	
                	}               	         	
                 },
                 error:function(html) {
                   alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
                 },
            });
        	 
        }
        
        function mission(){
        	$.ajax({
                type: "POST",
                url: './function/mission.php',
                success:function(html){   
            		document.getElementById('app').style.display = 'block'; 
                 	document.getElementById('app').innerHTML = html;                 		               	
                },
                error:function(html) {
                  alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
                },
           });
        }
        
        function reactivate(itemName){
        	$.ajax({
                type: "POST",
                url: './function/reactivate.php',
                data: {item:itemName},
                success:function(html){   
                	display('notification');
                },
                error:function(html) {
                  alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
                },
           });
        }


    </script>


<style type="text/css">
</style>
</head>
<body onload="startTime()">
<?php
$mission = isset($_COOKIE['mission']) ? ModelMission::getMission(unserialize($_COOKIE['mission'])[0])->get('meteo') : 1;
if ($time < '6h' && $time > '22h') {
    echo '<style>.main { background-image:linear-gradient(#292B51, #0E0F2C); }</style>'; // night background
} else if ($mission == 0) {
    echo '<style> .main { background-image:linear-gradient(#9294A6, #676871); }</style>'; // cloud background
} else {
    echo '<style> .main { background-image:linear-gradient(#3A6681, #8FB8D0);  }</style>'; // clear background
}
?>
	<main> <header>
		<?php require(File::build_path(array('view', 'global', 'header.php')))?>

	</header>
	<div id="app">
		<!-- Content of the app, refresh by ajax -->

	</div>
	<div class="foreground">
		<img src="./images/fond1.png" alt="Desert">
	</div>
	<footer>
		<!-- Contain the ChatBot -->
		<img id="geckOOOO" onclick="notifAndToggle()" src="./images/gecko.png">
	</footer> </main>
</body>
</html>

