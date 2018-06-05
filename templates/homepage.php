<?php 
	function cut_text($text, $num_letters)
	{
		$num = strlen($text);

		if ($num > $num_letters) {
			$text = mb_substr($text, 0, $num_letters);
			$text .= "...";
		}

		return $text;
	}
?>
<?php require_once "templates/include/header.php"; ?>			
			<h2>Мой Первый Блог</h2>
			<div><a href="./admin.php">Админ</a></div>
			<div>
				<?php foreach ($results["articles"] as $article): ?>
				<div class="article">
					<a href=".?action=viewArticle&amp;articleId=<?php echo $article->id ?>"><h3><?php echo cut_text($article->title, 34); ?></h3></a>
					<em>Опубликовано: <?php echo date("d-m-Y", $article->publicationDate) ?></em>
					<p><?php echo cut_text($article->content, 224); ?></p>
					<!-- $article->summary -->
				</div>
				<?php endforeach; ?>
			</div> 
<?php require_once "templates/include/footer.php"; ?>