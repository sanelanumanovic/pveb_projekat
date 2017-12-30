<!doctype html>
<html lang="en">
	<head>
	<title>Najmanji problem</title>

	   
	{{HTML::style('bootstrap/css/offcanvas.css')}}
	{{HTML::style('css/common.css')}}
    {{HTML::style('bootstrap/css/bootstrap.min.css')}}
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	</head>

	<body>

		<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
			<a class="navbar-brand bold" href="#">
				<span> <i class="fa fa-cutlery default-color"></i> </span>
				<span class="default-color">Najmanji problem</span>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	        	<span class="navbar-toggler-icon"></span>
	        </button>

	        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	        	<ul class="navbar-nav mr-auto">
	          		<li class="nav-item active">
	          			<a class="nav-link" href="#">Početna <span class="sr-only">(current)</span></a>
			        </li>
			        <li class="nav-item active">
	          			<a class="nav-link" href="#">Jelovnik</a>
			        </li>
			        <li class="nav-item active">
	          			<a class="nav-link" href="#">Rezervacije </a>
			        </li>
			        <li class="nav-item active">
	          			<a class="nav-link" href="#">Kontakt</a>
			        </li>
	        	</ul>
	        	<ul class="navbar-nav navbar-right">
			         <li class="nav-item active" style="float: right;">
	          			<a class="nav-link" href="/users/signout" title="Odjavi se">
	          				<span> <i class="fa fa-sign-out default-color"></i> </span>
          				</a>
			        </li>
	        	</ul>
	        </div>
	    </nav>

	    <main role="main" class="container">
	    	<div class="row row-offcanvas row-offcanvas-right">

		    	<div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
		        	<div class="list-group">
			            <a href="#" class="list-group-item text-dark">Porudžbine</a>
			            <a href="#" class="list-group-item text-dark">Rezervacije</a>
			            <a href="#" class="list-group-item text-dark">Namirnice</a>
			            <a href="#" class="list-group-item text-dark">Jelovnik</a>
			            <a href="#" class="list-group-item text-dark">Inventar</a>
			            <a href="#" class="list-group-item active">Finansije</a>
			            <a href="#" class="list-group-item text-dark">Ljudski resursi</a>
		            </div>
		        </div>

		        <div class="col-12 col-md-9">
		        	<p class="float-right d-md-none">
		        		<button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Menu</button>
		            </p>
			        <div class="jumbotron">
			        	<h1>@yield('page-title')</h1>
			            <div>
			            	@yield('content')
			            </div>
			        </div>
		        </div>
	        </div>
		</main>

		{{HTML::script('bootstrap/js/bootstrap.min.js')}}
		{{HTML::script('bootstrap/js/popper.min.js')}}
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	</body>


</html>