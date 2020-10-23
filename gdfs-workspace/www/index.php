<?php

$dsn = 'mysql:host=gd-fs-docker-mysql;port=3306;dbname=gdfs';
$user = 'gdfs';
$password = 'gdsecret';

$ok = true;

try {
    $db = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $sql = "select curdate() from dual";

    $statement = $db->prepare($sql);

    $statement->execute();

    $now = $statement->fetchColumn();

    $ok = ($now !== FALSE);

    $sql_cidade = "select * from cidade";

    $cidade = $db->query($sql_cidade)->fetchObject();

} catch (PDOException $e) {
    $ok = false;
}
?>
<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Gaudium Software - Prova Desenvolvedor Full Stack</title>
</head>
<body>
<main role="main">
    <div class="container mx-auto">
        <div class="row">
            <h1 class="mx-auto"><img src="assets/gaudium-logo.png" alt="Gaudium logo" width=100/> Gaudium Software</h1>
        </div>
        <div class="row">
            <h2 class="mx-auto">Prova Desenvolvedor Full Stack</h2>
        </div>
        <div class="row pt-5">
            <div class="jumbotron mx-auto">
                <?php if ($ok) { ?>
                    <div class="alert alert-success mx-auto" role="alert">
                        Ambiente instalado com sucesso!
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger mx-auto" role="alert">
                        Não foi possível conectar ao banco de dados.
                    </div>
                <?php } ?>
                    <div style="text-align: center;"><b><?php echo "Rodando da cidade: {$cidade->nome}"; ?></b></div>
            </div>
        </div>
    </div> <!-- /container -->
</main>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>