<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Simplifi-k</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<style type="text/css">
		body {
			padding-top: 50px;
		}

		#map {
			width: 100%;
			height: 100%;
			top: 0px;
			left: 0px;
		}

		.navbar-inverse {
			background-color: #2D2D2D;
		}

		.navbar-brand {
			padding: 5px;
		}

		.navbar-brand img{
			height: 40px;
		}

		#wrapper {
		  padding-right: 320px;
		  transition: all 0.4s ease 0s;
		}

		#sidebar-wrapper {
		  top: 50px;
		  margin-right: -320px;
		  right: 320px;
		  width: 320px;
		  background: #112A21;
		  color: white;
		  position: fixed;
		  height: 100%;
		  overflow-y: auto;
		  z-index: 1000;
		  transition: all 0.4s ease 0s;
		}

		#page-content-wrapper {
		  width: 100%;
		  height: calc(100vh - 50px);
		  background: #112A21;
		  position: relative;
		}

		.gm-style-iw {
			background: #112A21;
			color: white;
		}

		.sidebar-action {
			font-size: 2em;
			display: none;
		}

		.readbox {
			display: inline-block;
			width: 130px;
			margin-right: 9px; 
			border: 5px solid white;
			text-align: center;
			padding-bottom: 5px;
			margin-bottom: 10px;
		}

		.readbox i{
		    font-size: 50px;
		    margin-top: 10px;
		}

		.readbox h3{
			font-size: 17px;
			margin-top: 6px;
		}

		.readbox span{
			font-size: 25px;
		}

		@media (max-width:767px) {

		    #wrapper {
		      padding-right: 0;
		    }

		    #sidebar-wrapper {
		      right: 0;
		    }

		    #wrapper.active {
		      position: relative;
		      right: 320px;
		    }

		    #wrapper.active #sidebar-wrapper {
		      right: 320px;
		      width: 320px;
		      transition: all 0.4s ease 0s;
		    }

		    .sidebar-action {
		      display: block;
		    }

		    .sidebar-action a {
		      color: white;
		    }

		}
	</style>
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#"><img src="https://i.imgur.com/Y9pFBL9.png"></a>
	    </div>

	    <!--
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	    -->
	  </div>
	</nav>


	<div id="wrapper">
	    <div id="page-content-wrapper">
	        <div id="map"></div>
	    </div>
	    <div id="sidebar-wrapper">
	    	<div class="page-content">
	    		<div class="sidebar-action">
		    		<div class="container-fluid">
		                <div class="row">
		                    <div class="col-md-12">
		    					<a href="#">
		    						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    					</a>
		    				</div>
		    			</div>
		    		</div>
	    		</div>
	        	<div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <!--Hola-->
	                        <br>
	                        <div id="lectura" style="display:none;">
	                        	
															<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
																<div class="panel panel-default">
																	<div class="panel-heading" role="tab" id="headingOne">
																		<h4 class="panel-title">
																			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																				Temperatura 1
																			</a>
																		</h4>
																	</div>
																	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
																		<div class="panel-body">							      	  
																		<div id="temperatura1_chart"></div>
																		</div>
																	</div>
																</div>
																<div class="panel panel-default">
																	<div class="panel-heading" role="tab" id="headingTwo">
																		<h4 class="panel-title">
																			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																				Temperatura 2
																			</a>
																		</h4>
																	</div>
																	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
																		<div class="panel-body">
																				<div id="temperatura2_chart"></div>
																		</div>
																	</div>
																</div>
															
																<div class="panel panel-default">
																	<div class="panel-heading" role="tab" id="headingThree">
																		<h4 class="panel-title">
																			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																				Humedad 1
																			</a>
																		</h4>
																	</div>
																	<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
																		<div class="panel-body">
																				<div id="humedad1_chart"></div>
																		</div>
																	</div>
																</div>
															</div>
																<div class="panel panel-default">
																	<div class="panel-heading" role="tab" id="headingFour">
																		<h4 class="panel-title">
																			<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
																				Humedad 2
																			</a>
																		</h4>
																	</div>
																	<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
																		<div class="panel-body">
																				<div id="humedad2_chart"></div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
		                        <br>
		                        
	                        	<div class="readbox" readbox="temperatura">
	                        		<i class="fa fa-fire" aria-hidden="true"></i>
	                        		<h3>Temperatura</h3>
	                        		<span></span>
	                        	</div>
	                        	<div class="readbox" readbox="humedad">
	                        		<i class="fa fa-tint" aria-hidden="true"></i>
	                        		<h3>Humedad</h3>
	                        		<span></span>
	                        	</div>
	                        	<br>
	                        	<p><small>Última actualización: <span id="the_timestamp"></span></small></p>
	                        </div>
	                        <div id="loading-lectura" align="center">
	                        	<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
	                    	</div>
	                    </div>
	                </div>
	        	</div>
	        </div>
	    </div>
	</div>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript">
		
		var map;
		//var infowindow
		var markers = [];

		var sensor_red = "https://i.imgur.com/1M3PmXO.png";
		var sensor_green = "https://i.imgur.com/g88LgB2.png";

		$(document).ready(function(){
			$('.sidebar-action a').click(function(e){
				e.preventDefault();
				$('#wrapper').toggleClass('active');
			});
		});

	    function timeConverter(UNIX_timestamp){
	      var a = new Date(UNIX_timestamp);
	      var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
	      var year = a.getFullYear();
	      var month = months[a.getMonth()];
	      var date = a.getDate();
	      var hour = a.getHours();
	      var min = a.getMinutes();
	      var sec = a.getSeconds();
	      var time = date + ' de ' + month + ' del ' + year + ' ' + hour + ':' + min + ':' + sec ;
	      return time;
	    }

		function initMap() {

			var chile = {lat: -32.872210, lng: -71.209331}; 

			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 18,
			    center: chile,
			    mapTypeId: google.maps.MapTypeId.SATELLITE
			});

			$.get('http://simplifik.azurewebsites.net/data/getdevices',function(data){

				data = JSON.parse(data);

				for (var i = data.length - 1; i >= 0; i--) {

					markers.push(
						new google.maps.Marker({
							position: {lat: parseFloat(data[i].lat), lng: parseFloat(data[i].lon)},
							map: map,
							icon: sensor_green,
							title: data[i].id
						})
					);

					markers[markers.length - 1].addListener('click', function() {
				  		$('#loading-lectura').show();
				  		this.setIcon(sensor_red);
				  		$.get('http://simplifik.azurewebsites.net/data/getdevices/' + this.getTitle(),function(result){
				  			$('#lectura').hide();
							$('#loading-lectura').show();
				  			
				  			result = JSON.parse(result); 
				  			
				  			$('[readbox="temperatura"] span').html(result[0].temperatura);
				  			$('[readbox="humedad"] span').html(result[0].humedad);
				  			/*
				  			for (var i = 0; i < result.length; i++) {
				  				console.log(result[i].temperatura);
				  				console.log(result[i].humedad);
				  			};
				  			*/
				  			$('#the_timestamp').html(timeConverter(parseInt(result[0].timestamp)));

				  			$('#lectura').show();
							$('#loading-lectura').hide();
				  		});
					});

					$('#lectura').hide();
					$('#loading-lectura').hide();

				};

			});
   
			/*
			marker.addListener('mouseover', function() {
			    //infowindow.setContent('<div id="infowindow_contents">1<br />test,TX</div>');
			    infowindow.open(map, marker);
			});

			marker.addListener('mouseout', function() {
			    //infowindow.close();
			});
			*/

			
		}

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPKW-3wramc7RJN6Fthmi9Y5jMDDJTHsY&signed_in=true&callback=initMap"></script>
</body>
</html>