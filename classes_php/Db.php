<?php

	class Db {
		private $host = 'localhost';
		private $db = 'bestdb';
		private $user = 'root';
		private $pass = '';
		private $charset = 'utf8';
		private $pdo;

		function __construct() {
			try {
				$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
				$opt = array(
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				);
				$this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
			} catch(PDOException $e) {
				echo 'Не удалось подключиться к бд: ' . $e->getMessage();
			}
		}

		public function update($id, $arr) {
			try {
				$this->clearArr($arr);
				$sql = "UPDATE `users` SET " . $this->keyValueSet($arr, $values) . " WHERE `id` = ?";
				$values[] = $id;
				$smtp = $this->pdo->prepare($sql);
				$this->bindValue($smtp, $values);
				$smtp->execute();
			} catch(PDOException $e) {
				echo 'Не удалось обновить значение полей: ' . $e->getMessage();
			}
		}

		public function insert($arr) {
			try {
				$this->clearArr($arr);
				$sql = "INSERT INTO `users` SET " . $this->keyValueSet($arr, $values);
				$smtp = $this->pdo->prepare($sql);
				$this->bindValue($smtp, $values);
				$smtp->execute();
			} catch(PDOException $e) {
				echo 'Не удалось вставить данные в бд: ' . $e->getMessage();
			}
		}

		public function delete($id) {
			try {
				$this->clearString($id);
				$smtp = $this->pdo->prepare('DELETE FROM `users` WHERE `id` = ?');
				$smtp->bindValue(1, $id, PDO::PARAM_INT);
				$smtp->execute();
			} catch(PDOException $e) {
				echo 'Не удалось удалить строку из бд: ' . $e->getMessage();
			}
		}

		public function select($arr = null, $offset = null, $limit = null) {
			if ($arr) {
				$this->clearArr($arr);
				$strWhere = substr(str_repeat('?, ', count($arr)), 0, -2);
				$sql = "SELECT * FROM `users` WHERE " . $this->keyValueSet($arr, $values, true);
			} elseif (!isset($arr)) {
				$sql = "SELECT * FROM `users`";
			}

			if (isset($offset) && isset($limit)) {
				$sql .= " LIMIT ?, ?";
				$values[] = $offset;
				$values[] = $limit;
			}
			if (!isset($offset) && isset($limit)) {
				$sql .= " LIMIT ?";
				$values[] = $limit;
			}

			try {
				$smtp = $this->pdo->prepare($sql);
				$this->bindValue($smtp, $values);
				$smtp->execute();
			} catch(PDOException $e) {
				echo 'Ошибка при поиске данных: ' . $e->getMessage();
			}
			
			while ($row = $smtp->fetch()) {
				$result[] = $row;
			}
			return $result;
		}

		private function bindValue(&$smtp, $values) {
			for ($i = 0; $i < count($values); $i++) {
				if (preg_match('/^[\d]*$/', $values[$i])) {
					$val = (int) $values[$i];
					$smtp->bindValue($i + 1, $val, PDO::PARAM_INT);
				} elseif (is_string($values[$i])) {
					$smtp->bindValue($i + 1, $values[$i], PDO::PARAM_STR);
				}
			}
		}

		private function keyValueSet($keyVal, &$arrExecute, $string = false) {
			$result = '';
			foreach ($keyVal as $key => $val) {
				$result .= $string ? "`$key` = ? AND " : "`$key` = ?, ";
				$arrExecute[] = $val;
			}
			return $string ? substr($result, 0, -5) : substr($result, 0, -2);
		}

		private function clearArr(&$arr) {
			$arr = array_map(function($el) {
				return strip_tags(trim($el));
			}, $arr);
		}

		private function clearString(&$str) {
			$str = strip_tags(trim($str));
		}
		
	}