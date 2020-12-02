<?php
class Manager 
{
	protected function dbConnect()
	{
		try
		{
			$db = new PDO('mysql:host=aymerictklayme.mysql.db;dbname=aymerictklayme;charset=utf8', 'aymerictklayme', 'Discjockey11150');
			return $db;
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
}