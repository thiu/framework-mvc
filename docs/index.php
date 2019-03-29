<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="author" content="Thiago Rocha Soares"/>
		
		<title>Documentação - Framework TRSOARES</title>

		<!--Import Google Icon Font-->
      	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      	<!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">      

		<!-- FAV ICON -->
		<link rel="shortcut icon" href="" type="image/x-icon" />
		<link rel="icon" href="" type="image/x-icon" /> 

		<style type="text/css">
			.fonte {
			    font-family: 'Raleway', sans-serif;
			    font-weight: 100;
			    font-size: 4em;
			}
			.header {
			    font-family: 'Raleway', sans-serif;
			    font-weight: bold;
			    font-size: 2.2em;
			}
			.header2 {
				font-family: 'Raleway', sans-serif;
			    font-weight: bold;
			    font-size: 1.65em;
			    margin-left:15px;
			}
			.links > a {
			    color: #636b6f;
			    padding: 0 25px;
			    font-size: 12px;
			    font-weight: 600;
			    letter-spacing: .1rem;
			    text-decoration: none;
			    text-transform: uppercase;
			}
			blockquote{
			  border-left: 5px solid #00bcd4;
			}
			.card-content {
				font-style: 2em;
			}
			.text {
				margin-left: 15px;
				font-weight: 100;
			}
		</style>
	</head>

	<body>
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper white">
				<a href="#" data-target="mobile-demo" class="sidenav-trigger black-text"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a class="black-text" href="../">Home</a></li>
					<li><a class="black-text" href="">Documentação</a></li>
					<li><a target="_blank" class="black-text" href="https://bitbucket.org/trsoares/trsoares-simple-fw/src/master/">Github</a></li>
				</ul>
			</div>
		</nav>
	</div>

	<ul class="sidenav" id="mobile-demo">
		<li><a href="../">Home</a></li>
		<li><a href="">Documentação</a></li>
		<li><a target="_blank" href="https://bitbucket.org/trsoares/trsoares-simple-fw/src/master/">Github</a></li>
	</ul>

		<div class="container center">
			<div class="flex-center">
				<div>
					<p class="fonte">Documentação</p>
					<div class="links">
				        <a href="routes">Rotas</a>
				        <a href="models">Models</a>
				        <a href="controllers">Controllers</a>
				        <a href="banco">Banco de Dados</a>
				        <a href="auth">Auth</a>
				        <a href="config">Config</a>
				    </div>
				</div>
			</div>
      	</div>

<?php include('layout/footer.php');?>


