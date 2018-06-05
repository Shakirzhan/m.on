<?php require_once "templates/include/header.php"; ?>		
			<h2>Мой Первый Блог</h2>
			<div>
				<div class="article">
					<h3><?php echo $results["article"]->title ?></h3>
					<em>Опубликовано: <?php echo date("d-m-Y", $results["article"]->publicationDate) ?></em>
					<p><?php echo $results["article"]->content ?></p>
				</div>
				<a href="./">Назад</a>
			</div> 
<?php require_once "templates/include/footer.php"; ?>