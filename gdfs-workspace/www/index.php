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

    $cidades = $db->query($sql_cidade)->fetchAll(PDO::FETCH_ASSOC);

    $sql_categoria = "select * from categoria";

    $categorias = $db->query($sql_categoria)->fetchAll(PDO::FETCH_ASSOC);

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
    </div>
    <div style="width: 80%; margin: auto;">
        <div style="width: 50%;float: left;">
            <table style="border: 1px solid;">
                <tbody>
                    <tr>
                        <td>
                            Cidade: 
                            <select>
                                <?php  
                                    foreach ($cidades as $cidade) {
                                        echo "<option value=\"{$cidade['id']}\">{$cidade['nome']}</option>";
                                 }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Categoria: 
                            <select>
                                <?php  
                                    foreach ($categorias as $categoria) {
                                        echo "<option value=\"{$categoria['id']}\">{$categoria['nome']}</option>";
                                 }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Endereço de Origem: <input type="text" name="endereco_origem">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Endereço de Destino: <input type="text" name="endereco_destino">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button>Efetuar estivativa</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="width: 50%;float: right;">
            <table style="border: 1px solid;">
                <tbody>
                    <tr style="border: 1px solid;">
                        <td style="border: 1px solid;">
                            <p>Em Rio de Janeiro, carro executivo, de Rua da Assembléia, 10 para Rua Barata Ribeiro, 30, às 10:34: <b>R$ 23,15</b>.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
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