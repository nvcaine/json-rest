<?php
class DBWrapper
{
	static protected $host = "";
	static protected $user = "";
	static protected $pass = "";
	static protected $dbName = "";

	static protected $instace;

	private $pdo;
	private $affectedRows = 0;

	protected function DBWrapper()
	{
		if($this->configured())
			$this->open();
	}

	static public function configure($dbHost, $username, $password, $databaseName)
	{
		DBWrapper::$host = $dbHost;
		DBWrapper::$user = $username;
		DBWrapper::$pass = $password;
		DBWrapper::$dbName = $databaseName;
	}

	static public function cloneInstance()
	{
		if(!DBWrapper::$instace)
			DBWrapper::$instace = new DBWrapper();

		return clone DBWrapper::$instace;
	}

	public function query($queryTemplate, $params = null, $class = null, $fetch = true, $limit = 0, $offset = 0)
	{
		$query = $this->pdo->prepare($queryTemplate);

		if($limit > 0)
			$query->bindValue(':limit', (int) $limit, PDO::PARAM_INT);

		if($offset > 0)
			$query->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

		if($limit > 0 || $offset > 0) {
			foreach($params as $key => $value)
				$query->bindValue(':' . $key, $value);
			$query->execute();
		}
		else
			$query->execute($params);

		//$query->debugDumpParams();
		$this->affectedRows = $query->rowCount();

		if(!$fetch)
			return true;

		if(isset($class))
			return $query->fetchAll(PDO::FETCH_CLASS, $class);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function lastInsertID() {

		return $this->pdo->lastInsertId();
	}

	public function affectedRowsCount() {

		return $this->affectedRows;
	}

	private function open()
	{
		try
		{
			$this->pdo = new PDO("mysql:host=".DBWrapper::$host.";dbname=".DBWrapper::$dbName.";charset=utf8mb4", DBWrapper::$user, DBWrapper::$pass);
    		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}
    	catch(PDOException $e)
    	{
    		echo "PDO Error:" . $e->getMessage();
    	}

    	DBWrapper::$instace = $this;

	}

	private function configured()
	{
		return (isset(DBWrapper::$host) && isset(DBWrapper::$user) && isset(DBWrapper::$pass) && isset(DBWrapper::$dbName));
	}
}
?>