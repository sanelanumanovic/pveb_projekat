<!doctype html>
<html lang="en">
	<head>
		<title>Najmanji problem</title>

		   
		{{HTML::style('bootstrap/css/signin.css')}}
		{{HTML::style('css/common.css')}}
	    {{HTML::style('bootstrap/css/bootstrap.min.css')}}
	    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	</head>

	<body>

		<div class="container">

	    	{{Form::open(array('url'=>'users/signin', 'class' => 'form-signin'))}}
	        	<h2 class="form-signin-heading">
	        		<span> <i class="fa fa-cutlery form-control-feedback default-color"></i> </span>
	        		Najmanji problem
        		</h2>
	        	<div class="form-group has-feedback has-feedback-left">
		        	{{Form::text('username', '', array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'korisničko ime'))}}
	        		
	        	</div>

	        	<div class="form-group has-feedback has-feedback-left">
		        	<!-- </i> -->
		        	{{Form::password('password', array('class' => 'form-control', 'placeholder' => 'šifra'))}}
	        		
	        	</div>
		        <button class="btn btn-lg btn-success btn-block" type="submit">Prijavi se</button>
	      	{{Form::close()}}

    	</div>
  </body>
</body>