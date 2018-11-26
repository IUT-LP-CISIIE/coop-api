<?php
include 'include/main.inc.php';
$hash=false;
if($_POST['email']) {
	$email = $_POST['email'];
	$hash = ajouterCle($_POST['email']);
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Coop - API KEY</title>
	<link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<!-- Bulma Version 0.7.2-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/landing.css">
</head>

<body>
	<section class="hero is-info is-fullheight">
		<div class="hero-head">
			<nav class="navbar">
				<div class="container">
					<div class="navbar-brand">
						<a class="navbar-item" href="key.php">
							COOP
						</a>
					</div>
				</div>
			</nav>
		</div>

		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="column is-6 is-offset-3">
					<h1 class="title">
						API KEY
					</h1>
					<?php if($hash) {?>
						<h2 class="subtitle">
							Voici votre API KEY
						</h2>
						<div class="box has-text-left">
								<div class="field">
									<label class="label">Email</label>
									<div class="control">
										<input class="input" type="email" value="<?php echo htmlspecialchars($email);?>" readonly>
									</div>
								</div>
								<div class="field">
									<label class="label">API KEY</label>
									<div class="control">
										<input class="input" type="text" value="<?php echo htmlspecialchars($hash);?>" onfocus="this.select()" readonly>
									</div>
								</div>
						</div>
						<div class="card box has-text-left">
							Pour faire des appels API autorisés, envoyez le header suivant :
							<p>
								<code>Authorization: Bearer <?php echo htmlspecialchars($hash);?></code>
							</p>

							<br>Exemple avec Axios :
							<p>
								<pre>let config = {
	headers: {'Authorization': "bearer <?php echo htmlspecialchars($hash);?>"}
}
Axios.post(api_route,params,config).then(() => { ... });
</pre>
							</p>
						</div>
					<?php } else {?>
						<h2 class="subtitle">
							Entrez votre adresse mail pour obtenir votre API KEY.
						</h2>
						<div class="box">
							<form method="post" action="key.php">
								<div class="field is-grouped">
									<p class="control is-expanded">
										<input class="input" type="email" name="email" placeholder="Adresse email">
									</p>
									<p class="control">
										<button class="button is-info">
											Valider
										</button>
									</p>
								</div>
							</form>
						</div>
					<?php }?>
				</div>
			</div>
		</div>

	</section>
	<script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>