<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM table_nodemcu_rfidrc522_mysql where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="images/favicon.png" sizes="64x64">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">	
		<title>Editar usuario | SysmteRU BETA</title>
		<style>
		.select-css {
		font-size: 15px;
		font-family: 'Poppins', sans-serif;
		font-weight: 400;
		color: #444;
		padding: .4em 1.4em .3em .8em;
		width: 400px;
		max-width: 25%; 
		box-shadow: 0 1px 0 1px rgba(0,0,0,.03);
		border-radius: .3em;
		-moz-appearance: none;
		-webkit-appearance: none;
		appearance: none;
		background-color: #fff;
		background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
		linear-gradient(to bottom, #ffffff 0%,#f7f7f7 100%);
		background-repeat: no-repeat, repeat;
		background-position: right .7em top 50%, 0 0;
		background-size: .65em auto, 100%;
		}
		.select-css::-ms-expand {
			display: none;
		}
		.select-css:hover {
			border-color: #888;
		}
		.select-css:focus {
			border-color: #aaa;
			box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
			box-shadow: 0 0 0 3px -moz-mac-focusring;
			color: #222; 
			outline: none;
		}
		.select-css option {
			font-weight:normal;
		}


		.classOfElementToColor:hover {background-color:red; color:black}

		.select-css option[selected] {
			background-color: orange;
		}
		</style>
	</head>
	
	<body>
			<div class="center" style="margin: 0 auto; width:495px;">
				<div class="row">
				<h3 align="center">Editar datos de usuario<span class="badge bg-secondary">SysmteRU BETA</span></h3>
					<p id="defaultGender" hidden><?php echo $data['gender'];?></p>
				</div>
		 
				<form class="form-horizontal" action="user data edit tb.php?id=<?php echo $id?>" method="post">
					<div class="input-group mb-3">
  						<span class="input-group-text" id="basic-addon1">ID</span>
  						<input name="id" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $data['id'];?>" readonly>
					</div>
					
					<div class="input-group mb-3">
  						<span class="input-group-text" id="basic-addon1">Name</span>
  						<input name="name" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $data['name'];?>" required>
					</div>

					<select name="gender" id="mySelect" class="form-select" aria-label="Default select example">
  						<option selected>Selecciona una opción:</option>
  						<option value="1">Masculino</option>
  						<option value="2">Femenino</option>
  						<option value="3">Otro</option>
					</select>
					<br>

					<br>
					<div class="input-group mb-3">
  						<span class="input-group-text" id="basic-addon1">Correo electrónico</span>
  						<input name="email" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $data['email'];?>" required>
					</div>

					<div class="input-group mb-3">
  						<span class="input-group-text" id="basic-addon1">Número celular</span>
  						<input name="mobile" type="number" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $data['mobile'];?>" required>
					</div>
					<br>
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Actualizar datos</button>
						<a type="button" class="btn btn-primary" href="user data.php">Volver</a>
					</div>
				</form>
			</div>               
		
		<script>
			var g = document.getElementById("defaultGender").innerHTML;
			if(g=="Male") {
				document.getElementById("mySelect").selectedIndex = "0";
			} else {
				document.getElementById("mySelect").selectedIndex = "1";
			}
		</script>
	    <!--Scripts-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
	</body>
</html>