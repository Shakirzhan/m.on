<?php  
	/**
	* 
	*/
	class Article
	{
		public $id = null;

		public $publicationDate = null;

		public $title = null;

		public $summary = null;

		public $content = null;
		
		public function __construct($data = array())
		{
			if (isset($data["id"])) $this->id = (int) $data["id"];
			if (isset($data["publicationDate"])) $this->publicationDate = (int) $data["publicationDate"]; 
			if (isset($data["title"])) $this->title = $data["title"];
			if (isset($data["summary"])) $this->summary = $data["summary"];
			if (isset($data["content"])) $this->content = $data["content"]; 
		} 

		public function storeFormValues($params)
		{
			$this->__construct($params);
			if (isset($params["publicationDate"])) {
				$publicationDate = explode("-", $params["publicationDate"]);
				if (count($publicationDate) == 3) {
					list($y, $m, $d) = $publicationDate; 
					$this->publicationDate = mktime(0, 0, 0, $m, $d + 1, $y);
				}
			}
		}

		public static function getById($id)
		{
			$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id";
			$statments = $db->prepare($sql);
			$statments->bindValue(":id", $id, PDO::PARAM_INT);
			$statments->execute();
			$row = $statments->fetch();
			$db = null;
			if ($row) return new Article($row);
		}

		public static function getList()
		{
			$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles ORDER BY " . mysql_escape_string("publicationDate DESC");
			$statments = $db->prepare($sql);
			$statments->execute();
			$list = array();

			while($row = $statments->fetch()) {
				$article = new Article($row);
				$list[] = $article;
			}

			$sql = "SELECT FOUND_ROWS() AS totalRows";
			$totalRows = $db->query($sql)->execute();
			$db = null;
			return (array("results" => $list, "totalRows" => $totalRows[0]));
		}

		public function insert()
		{
			if (!is_null($this->id)) trigger_error("Article :: insert (): попытка вставить объект Article, у которого уже установлено его свойство ID (до $ this-> id).", E_USER_ERROR);
			$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO articles (publicationDate, title, summary, content) VALUES (FROM_UNIXTIME(:publicationDate), :title, :summary, :content)";
			$statments = $db->prepare($sql);
			$statments->bindValue(":publicationDate", $this->publicationDate, PDO::PARAM_INT);
			$statments->bindValue(":title", $this->title, PDO::PARAM_STR);
			$statments->bindValue(":summary", $this->summary, PDO::PARAM_STR);
			$statments->bindValue(":content", $this->content, PDO::PARAM_STR);
			$statments->execute();
			$this->id = $db->lastInsertId();
			$db = null;
		}

		public function update()
		{
			if (is_null($this->id)) trigger_error("Article :: update (): попытка обновить объект Article, который не имеет установленного идентификатора.", E_USER_ERROR);

			$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "UPDATE articles SET publicationDate = FROM_UNIXTIME(:publicationDate), title = :title, summary = :summary, content = :content WHERE id = :id";
			$statments = $db->prepare($sql);
			$statments->bindValue(":publicationDate", $this->publicationDate, PDO::PARAM_INT);
			$statments->bindValue(":title", $this->title, PDO::PARAM_STR);
			$statments->bindValue(":summary", $this->summary, PDO::PARAM_STR);
			$statments->bindValue(":content", $this->content, PDO::PARAM_STR);
			$statments->bindValue(":id", $this->id, PDO::PARAM_INT);
			$statments->execute();
			$db = null;
		}

		public function delete()
		{
			if (is_null($this->id)) trigger_error("Article :: delete (): попытка удалить объект Article, который не имеет установленного идентификатора.", E_USER_ERROR);

			$db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "DELETE FROM articles WHERE id = :id LIMIT 1";
			$statments = $db->prepare($sql);
			$statments->bindValue(":id", $this->id, PDO::PARAM_INT);
			$statments->execute();
			$db = null;
		}
	}

/*
	Article :: insert (): попытка вставить объект Article, у которого уже установлено его свойство ID (до $ this-> id).

	Article :: update (): попытка обновить объект Article, который не имеет установленного идентификатора.

	Article :: delete (): попытка удалить объект Article, который не имеет установленного идентификатора.
*/

?>