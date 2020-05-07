<?php
class Banco{
	private static $Host = "localhost";
	private static $dbName = "teste";
	private static $dbUsuario = "root";
	private static $dbSenha = "";

	private static $cont = null;

	public function __contruct(){
		die("A função Init não é permitida!");
	}

	public static function conectar(){
		if(self::$cont == null){
			try{

				self::$cont = new PDO("mysql:host=".self::$Host.";"."dbname=".self::$dbName,self::$dbUsuario,self::$dbSenha);

			}catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}

		return self::$cont;
	}

	public static function desconectar(){
		self::$cont = null;
	}
}
?>
