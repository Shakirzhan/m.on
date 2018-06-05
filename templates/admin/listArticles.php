<?php require_once "templates/include/header.php"; ?>
	<div>
		<h2>Новости Администратора</h2>
		<p>Вы вошли в систему как <?php echo htmlspecialchars($_SESSION["username"]) ?>. <a href="./admin.php?action=logout">Выйти</a></p>
	</div>
	<h1>Все статьи</h1>
	<table class="table">
		<tr>
			<th>Дата публикации</th>
			<th>Статья</th>
		</tr>
		<?php foreach ($results["articles"] as $article) : ?>
		<tr onclick="location = 'admin.php?action=editArticle&amp;articleId=<?php echo $article->id ?>'">
			<td><?php echo date("d.m.Y", $article->publicationDate) ?></td>
			<td><?php echo cut_text($article->title, 34) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p><a href="./admin.php?action=newArticle">Добавить новую статью</a></p>
<?php require_once "templates/include/footer.php"; ?>