<?php
include 'Models/Upload.php';
$Upload = new Upload();

//Upload de Arquivo
if (isset($_POST['upload']) && isset($_FILES['arquivo'])){
    if(isset($_FILES['arquivo'])){
        $nome = $_FILES['arquivo']['name'];
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = md5(time()) . $extensao;
        $bits = $_FILES['arquivo']['size'];
        if ($bits >= 1073741824){$bytes = number_format($bits / 1073741824, 2) . ' GB';}
        elseif ($bits >= 1048576){$bytes = number_format($bits / 1048576, 2) . ' MB';}
        elseif ($bits >= 1024){$bytes = number_format($bits / 1024, 2) . ' KB';}
        else{$bytes = $bits . ' bytes';}

        $Public = "Uploads/";
        if(!is_dir($Public)){mkdir($Public);}

        $data = date('dmY');
        $dir = $Public.$data."/";

        if(!is_dir($dir)){mkdir($dir);}

        //Upload do arquivo com o nome Criptografado
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$novo_nome); 
        $new = $novo_nome;

        //Upload do arquivo sem o nome Criptografado
        //move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$nome); 
        //$new = $nome;


        $Tamanho = $bytes;
        $Size = $_FILES['arquivo']['size'];
        $Type = $_FILES['arquivo']['type'];
        $Date = date('d/m/Y');
        $Time = date('H:i:s'); 
        $Ip=$_SERVER['REMOTE_ADDR'];
        $Dev = $_SERVER['HTTP_USER_AGENT'];

        $Upload->NewName = $new;
        $Upload->Name = $nome;
        $Upload->Exten = $extensao;
        $Upload->Tamanho = $Tamanho;
        $Upload->Size = $Size;
        $Upload->Type = $Type;
        $Upload->Dir = $dir;
        $Upload->Date = $Date;
        $Upload->Time = $Time;
        $Upload->Ip = $Ip;
        $Upload->Dev = $Dev;
        $Upload->Create();
        header('location: ./../');
    }
}
//Excluir Cadastro
else if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);    
    $img = filter_input(INPUT_GET, 'img', FILTER_SANITIZE_STRING);
    $dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING);
    $Upload->id = $id;
    //Apaga o Arquivo
    if(file_exists($dir.$img)){unlink($dir.$img);}  
    $Upload->Delete();
    header('location: ./../');
}
else{
    header('location: ./../');
}
