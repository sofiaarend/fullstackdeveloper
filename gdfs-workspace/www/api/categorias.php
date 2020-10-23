<?php  
$dsn = 'mysql:host=gd-fs-docker-mysql;port=3306;dbname=gdfs';
$user = 'gdfs';
$password = 'gdsecret';

try
{
	if ($_GET['ref_cidade']) 
	{
		$cidade = $_GET['ref_cidade'];

		$db = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		$sql_categorias = "select * from categoria where id in (select ref_categoria from cidade_categoria where ref_cidade = {$cidade}) order by nome";

		$query = $db->query($sql_categorias);
		
		if ($query) 
		{
			$categorias = $query->fetchAll(PDO::FETCH_ASSOC);

			if ($categorias) 
			{
				echo json_encode($categorias);
			}
		}
		else
		{
			throw new Exception("A cidade escolhida nao existe ou nao possui categorias");
		}
	}
}
catch(Exception $e)
{
	echo json_encode(['erro'=>$e->getMessage()]);
}

?>