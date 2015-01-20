<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/**Clase utilizada para accesar a la base de datos
 */
class DataBase{
	private $Str_Servidor;//Variable que almacena el nombre del servidor
	private $Str_Usuario;//Variable que almacena el nombre de usuario
	private $Str_Clave;//Variable que almacena la clave de usuario
	private $Str_BaseDatos;//Variable que almacena el nombre de la base de datos
		
	/**
	 * @return Nombre del servidor
	 */
	public function Servidor() {
		return $this->Str_Servidor;
	}
	/**
	 * @return Nombre del usuario
	 */
	public function Usuario() {
		return $this->Str_Usuario;
	}
	/**
	 * @return Clave del usuario
	 */
	public function Clave() {
		return $this->Str_Clave;
	}
	/**
	 * @return Nombre de la base de datos
	 */
	public function BaseDatos() {
		return $this->Str_BaseDatos;
	}
	/**
	 * @param $Str_Servidor = Nombre del servidor
	 */
	public function setServidor($Str_Servidor) {
		$this->Str_Servidor = $Str_Servidor;
	}
	/**
	 * @param $Str_Usuario = Nombre del usuario
	 */
	public function setUsuario($Str_Usuario) {
		$this->Str_Usuario = $Str_Usuario;
	}
	/**
	 * @param $Str_Clave = Clave del usuario
	 */
	public function setClave($Str_Clave) {
		$this->Str_Clave = $Str_Clave;
	}
	/**
	 * @param $Str_BaseDatos = Nombre de la base de datos
	 */
	public function setBaseDatos($Str_BaseDatos) {
		$this->Str_BaseDatos = $Str_BaseDatos;
	}
	
	/** Metodo utilizado como constructor de la clase*/
	public function BaseDatos_AD() {	
		//include('shareboardINI.php');//Incluye el archivo de inicio con los parametros de conexion
		//Setea los atributos de la clase con los datos contenidos en el archivo de inicio
		/*$this->setServidor($Servidor);
		$this->setUsuario($Usuario);
		$this->setClave($Clave);
		$this->setBaseDatos($BaseDatos);*/
	}
	
	/** Metodo utilizado para establecer la conexion con el servidor*/
	public function Conectar(){
		try{
			//return mysqli_connect($this->Str_Servidor,$this->Str_Usuario,$this->Str_Clave,$this->Str_BaseDatos);		
			$conexion = mysql_connect('127.0.0.1','root','root')
	or die("no se puede seleccionar la base de datos");
	//mysqli_select_db($conexion,"bdshareboard")
	mysql_select_db("bdshareboard",$conexion)
	or die ("No conecto esa base de datos");
		return $conexion;
		
		}
		catch(Exception $ERROR){
			throw new Exception('No se puedo establecer la conexión con el servidor.');
		}
	}
	
	
	/** Metodo que se encarga de ejecutar la sentencia SQL o procedimiento almacenado en la base de datos*/
	public function SQLQuery($Obj_Conexion,$Str_QUERY){
		try{
			//$this->EnlaceBD();//Establece la base de datos
			//return mysqli_query($Obj_Conexion,$Str_QUERY);//Retorna el resultado de la consulta
			return mysql_query($Str_QUERY,$Obj_Conexion);//Retorna el resultado de la consulta
		}
		catch(Exception $ERROR){
			throw new Exception('No se pudo realizar la operación en la base de datos.');
		}
	}
	
	/** Metodo utilizado para liberar la memoria*/
	public function FreeMem($Obj_resultado){
		try{
			//mysql_free_result($Obj_resultado);//Libera la memoria utilizada por la consulta
		}
		catch(Exception $ERROR){
			throw new Exception('No se pudo cerrar correctamente la conexión con el servidor.');
		}
	}
	
	/** Metodo utilizado para cerrar la conexion con el servidor*/
	public function Cerrar($Obj_conexion){
		try{
			mysql_close($Obj_conexion);
		}
		catch(Exception $ERROR){
			throw new Exception('No se pudo cerrar correctamente la conexión con el servidor.');
		}
	}
}
?>