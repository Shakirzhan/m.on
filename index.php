<?php
	require_once "config.php";

	$action = (isset($_GET["action"])) ? $_GET["action"] : "";

	switch ($action) {
		case "viewArticle":
			viewArticle();
			break;
		default:
			homepage();
			break;
	}

	function viewArticle()
	{
		if (!isset($_GET["articleId"]) || !$_GET["articleId"]) {
			homepage();
			return;	
		}

		$results["article"] = Article::getById((int)$_GET["articleId"]);
		require_once TEMPLATE_PATH . "/viewArticle.php";
	}

	function homepage()
	{
		$results = array();
		$data = Article::getList();
		$results["articles"] = $data["results"];
		require_once TEMPLATE_PATH . "/homepage.php";
	}
?>