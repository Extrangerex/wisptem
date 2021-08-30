	$(document).ready(function(){


				$("#contenido").load("home.php");

				$('#home').click(function(){
			$("#contenido").load("home.html");
										});
				
			$('#depot').click(function(){
			$("#contenido").load("depot.html");
										});
			$('#transfert').click(function(){
			$("#contenido").load("transfert.html");
										});
			$('#caissier').click(function(){
			$("#contenido").load("caissier.html");
										});
			$('#top').click(function(){
			$("#contenido").load("top.html");
												});

			$('#inventario').click(function(){
			$("#contenido").load("inventario.html");
									
										});
			$('#cambio').click(function(){
			$("#contenido").load("cambio.html");
									
										});
			$('#rapport').click(function(){
			$("#contenido").load("rapport.html");
									
										});





										});