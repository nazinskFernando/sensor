<?php
 header('Content-type: text/html; charset=iso-8859-1');
class conexao {

  
      /*Método construtor do banco de dados*/
      public function __construct(){}
     
    /*Evita que a classe seja clonada*/
    private function __clone(){}
     
    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
     
 
  /*
    private static $dbtype   = "mysql";
    private static $host     = "localhost";
    private static $port     = "3306";
    private static $user     = "tedsu687_hidro";
    private static $password = "RE51VxDdo}wi";
    private static $db       = "tedsu687_hidrometro";
     */
    private static $dbtype   = "mysql";
    private static $host     = "localhost";
    private static $port     = "3306";
    private static $user     = "root";
    private static $password = "";
    private static $db       = "sensor";
     public static $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
     
    /*Metodos que trazem o conteudo da variavel desejada
    @return   $xxx = conteudo da variavel solicitada*/
    private function getDBType()  {return self::$dbtype;}
    private function getHost()    {return self::$host;}
    private function getPort()    {return self::$port;}
    private function getUser()    {return self::$user;}
    private function getPassword(){return self::$password;}
    private function getDB()      {return self::$db;}
    private function getoptions()      {return self::$options;}
     
    private function connect(){
        try
        {
            $this->conexao = new PDO($this->getDBType().":host=".$this->getHost().";port=".$this->getPort().";dbname=".$this->getDB(), $this->getUser(), $this->getPassword(), $this->getoptions());
         

        }
        catch (PDOException $i)
        {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }
         
        return ($this->conexao);
    }
     
    private function disconnect(){
        $this->conexao = null;
    }
     
    /*Método select que retorna um VO ou um array de objetos*/
    public function selectDB($sql,$params=null,$class=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
         
        if(isset($class)){
            $rs = $query->fetchAll(PDO::FETCH_CLASS,$class) or $rs="vazio";//die(print_r($query->errorInfo(), true));
        }else{
            $rs = $query->fetchAll(PDO::FETCH_OBJ) or $rs="vazio";//die(print_r($query->errorInfo(), true));
        }
        self::__destruct();
        return $rs;
    }
     
    /*Método insert que insere valores no banco de dados e retorna o último id inserido*/
    public function insertDB($sql,$params=null){
        $conexao=$this->connect();
        $query=$conexao->prepare($sql);
        $query->execute($params);
        $rs = $conexao->lastInsertId() or /* $rs="erro"; */die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }
     
    /*Método update que altera valores do banco de dados e retorna o número de linhas afetadas*/
    public function updateDB($sql,$params=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or $rs="erro";// die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }
     
    /*Método delete que excluí valores do banco de dados retorna o número de linhas afetadas*/
    public function deleteDB($sql,$params=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or $rs="erro"; //die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }


//Read more: http://www.linhadecodigo.com.br/artigo/3461/pdo-em-php-orientado-a-objetos.aspx#ixzz4o1SJar5u
}
