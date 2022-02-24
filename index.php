<?php
include 'App/View.php';
$Controller = new View();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Gerenciador de Arquivos</title>
</head>
<style>
    .conteiner{width: 90%;margin: auto;margin-top: 50px;}
</style>
<body>

<div class="conteiner">
    <h1>Gerenciador de Arquivos</h1>
    <form action="App/Controller.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input class="form-control" required name="arquivo" type="file" id="formFile">
        </div>
        <div class="col-auto">
            <button name="upload" type="submit" class="btn btn-primary mb-3">Fazer Upload</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome do Arquivo</td>
                <td></td>
                <td>Extensão</td>
                <td>Tamanho</td>
                <td></td>
                <td>Tipo</td>
                <td>Diretório</td>
                <td>Novo Nome</td>
                <td>Data</td>
                <td>Hora</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($Controller->index() as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>  
                    <td><?= $value['Name'] ?></td>  
                    <td><a href='App/Controller.php?id=<?= $value['id'] ?>&&img=<?= $value['NewName'] ?>&dir=<?= $value['Dir'] ?>'><button type="button" class="btn btn-danger">Deletar</button></a></td>                     
                    <td><?= $value['Exten'] ?></td>           
                    <td><?= $value['Tamanho'] ?></td>           
                    <td> <img style="width: 40px;" src="App/<?= $value['Dir'] ?><?= $value['NewName'] ?>" alt=""> </td>           
                    <td><?= $value['Type'] ?></td>           
                    <td>App/<?= $value['Dir'] ?></td>
                    <td><?= $value['NewName'] ?></td>
                    <td><?= $value['Date'] ?></td>           
                    <td><?= $value['Time'] ?></td>   
                </tr>
            <?php endforeach ?>  
            </tbody>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

