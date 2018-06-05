<?php require_once "templates/include/header.php"; ?>
<?php if (isset($results["errorMessage"])) : ?>
<p class="error"><?php echo $results["errorMessage"] ?></p>
<?php endif; ?>
<div class="containerx mlogin">
	<div id="login">
		<h1>Вход</h1>
		<form action="admin.php?action=login" id="loginform" method="post" name="loginform">
			<p><label for="username">Имя опльзователя</label><br><input class="input" id="username" name="username" size="20" type="text"></p>
			<p><label for="password">Пароль</label><br><input class="input" id="password" name="password" size="20" type="password"></p> 
			<p class="submit"><input class="button" name="login" type= "submit" value="Log In"></p>
		</form>
   		<a href="./">Назад</a>
 	</div>
</div>
<?php require_once "templates/include/footer.php"; ?>