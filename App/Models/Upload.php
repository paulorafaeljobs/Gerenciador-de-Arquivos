<?php

abstract class ClassConexao{
    public function Conectar()
        {
            try
            {   
                //Conexão com o Mysql
                //$Con = new PDO('mysql:host=localhost;dbname=manager;charset=utf8', 'root','');
                //$sql = "CREATE TABLE IF NOT EXISTS Files (id INT NOT NULL AUTO_INCREMENT ,NewName  text,Name  text,Exten text,Tamanho text,Size text,Type text,Dir text,Date text,Time text,qt integer,Ip text,Dev text , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

                //Conexão com o Sqlite
                $Con=new PDO("sqlite:".__DIR__."/database.db");
                $sql = "CREATE TABLE IF NOT EXISTS Files (id integer primary key autoincrement,NewName  text,Name  text,Exten text,Tamanho text,Size text,Type text,Dir text,Date text,Time text,qt integer,Ip text,Dev text)";
                
                $stmt = $Con->prepare($sql);
                $stmt->execute();
                return $Con;
            }
            catch (PDOException $ex){
                echo 'Erro ao Conectar com o Banco de Dados: '.$ex->getMessage();
            }
        }
}

class Upload  extends ClassConexao
{
    public $id;
    public $NewName;
    public $Name;
    public $Exten;
    public $Tamanho;
    public $Size;
    public $Type;
    public $Dir;
    public $Date;
    public $Time;
    public $qt;
    public $Ip;
    public $Dev; 

    public function __construct()
    {
        $this->id;
        $this->NewName;
        $this->Name;
        $this->Exten;
        $this->Tamanho;
        $this->Size;
        $this->Type;
        $this->Dir;
        $this->Date;
        $this->Time;
        $this->qt;
        $this->Ip;
        $this->Dev;
    }

    public function Create(){
        $Select=$this->Conectar()->prepare("INSERT INTO Files (NewName,Name,Exten,Tamanho,Size,Type,Dir,Date,Time,qt,Ip,Dev) VALUES (:NewName,:Name,:Exten,:Tamanho,:Size,:Type,:Dir,:Date,:Time,:qt,:Ip,:Dev)");
        $Select->bindParam(":NewName",$this->NewName,PDO::PARAM_STR);
        $Select->bindParam(":Name",$this->Name,PDO::PARAM_STR);
        $Select->bindParam(":Exten",$this->Exten,PDO::PARAM_STR);
        $Select->bindParam(":Tamanho",$this->Tamanho,PDO::PARAM_STR);
        $Select->bindParam(":Size",$this->Size,PDO::PARAM_STR);
        $Select->bindParam(":Type",$this->Type,PDO::PARAM_STR);
        $Select->bindParam(":Dir",$this->Dir,PDO::PARAM_STR);
        $Select->bindParam(":Date",$this->Date,PDO::PARAM_STR);
        $Select->bindParam(":Time",$this->Time,PDO::PARAM_STR);
        $Select->bindParam(":qt",$this->qt,PDO::PARAM_STR);
        $Select->bindParam(":Ip",$this->Ip,PDO::PARAM_STR);
        $Select->bindParam(":Dev",$this->Dev,PDO::PARAM_STR);
        $Select->execute();
        return $Select;//Retorna 
    }

    public function Delete(){
        $Select=$this->Conectar()->prepare("DELETE FROM Files WHERE id = :id ");
        $Select->bindParam(":id",$this->id,PDO::PARAM_STR);
        $Select->execute();
        return $Select;//Retorna 
    }

    public function Read(){
        $Select=$this->Conectar()->prepare("SELECT * FROM Files");
        $Select->execute();
        return $Select;//Retorna 
    }
}
