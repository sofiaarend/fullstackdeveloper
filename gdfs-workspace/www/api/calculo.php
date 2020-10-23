<?php  
$dsn = 'mysql:host=gd-fs-docker-mysql;port=3306;dbname=gdfs';
$user = 'gdfs';
$password = 'gdsecret';

try
{
	if ($_POST['ref_cidade'] AND $_POST['ref_categoria'] AND $_POST['endereco_origem']  AND $_POST['endereco_destino'] ) 
	{
		$cidade     = $_POST['ref_cidade'];
		$categoria = $_POST['ref_categoria'];
		$origem     = $_POST['endereco_origem'];
		$destino    = $_POST['endereco_destino'];

		$db = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		$distancia = number_format(rand(0,100),2);
		$duracao = number_format(rand(0,60)/60,2);
		
		$sql_cid_cat = "select * 
						  from cidade_categoria 
						 where ref_cidade = {$cidade} 
						   and ref_categoria = {$categoria}";
		$cidade_categoria = $db->query($sql_cid_cat)->fetchAll(PDO::FETCH_ASSOC)[0];

		if ($cidade_categoria) 
		{
			$tarifa = $cidade_categoria['bandeira'] + $cidade_categoria['valorHora'] * $duracao + $cidade_categoria['valorKm'] * $distancia;
			
			$sql_tarifa = "insert into historico_viagem(ref_cidade,ref_categoria,endereco_origem,
														endereco_destino,distancia,duracao,valor_tarifa)
												values({$cidade},{$categoria},\"{$origem}\",\"{$destino}\",{$distancia},{$duracao},{$tarifa})";

			$statement = $db->prepare($sql_tarifa);

			$statement->execute();

			$return = array(
				'distancia' => $distancia,
				'duracao' => $duracao*60,
				'bandeirada' => $cidade_categoria['bandeira'],
				'valorHora' => $cidade_categoria['valorHora'],
				'valorKm' => $cidade_categoria['valorKm'],
				'tarifa' => number_format($tarifa,2,',','.')
			);
			
			echo json_encode($return);
		}
		else
		{
			throw new Exception("A cidade escolhida nao possui a categoria escolhida");
		}
	}
	else
	{
		throw new Exception("Todos os campos sao obrigatorios");
	}
}
catch(Exception $e)
{
	echo json_encode(['erro'=>$e->getMessage()]);
}

?>