<?php require_once "templates/include/header.php"; ?>
	<div>
		<h2>Новости Администратора</h2>
		<p>Вы вошли в систему как <?php echo htmlspecialchars($_SESSION["username"]) ?>. <a href="./admin.php?action=logout">Выйти</a></p>
	</div>

	<h1><?php echo $results["pageTitle"] ?></h1>

	<form action="admin.php?action=<?php echo $results["formAction"] ?>" method="post">
		<input type="hidden" name="articleId" value="<?php echo $results["article"]->id ?>">
		<ul>
			<li>
				<label for="title">Название статьи</label>
				<div><input type="text" name="title" id="title" maxlength="255" value="<?php echo htmlspecialchars($results["article"]->title) ?>"></div>
			</li>
			<li>
				<label for="summary">Обзор статьи</label>
				<div><textarea name="summary" id="summary" maxlength="1000"><?php echo htmlspecialchars($results["article"]->summary) ?></textarea></div>
			</li>
			<li>
				<label for="content">Содержание статьи</label>
				<div><textarea name="content" id="content" maxlength="100000"><?php echo htmlspecialchars($results["article"]->content) ?></textarea></div>
			</li>
			<li>
				<label for="publicationDate">Дата публикации</label>
				<div><input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" maxlength="10" value="<?php echo $results["article"]->publicationDate ? date("Y-m-d", $results["article"]->publicationDate) : "" ?>"></div>
			</li>
		</ul>
		<div>
			<input class="button" type="submit" name="saveChanges" value="Сохранить изменения">
			<input class="button" type="submit" name="cancel" value="Отмена">
		</div>
	</form>
	<?php if ($results["article"]->id) : ?>
		<p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results["article"]->id ?>" onclick="return confirm('Удалить эту статью?')">Удалить эту статью</a></p>
	<?php endif; ?>
<?php require_once "templates/include/footer.php"; ?>