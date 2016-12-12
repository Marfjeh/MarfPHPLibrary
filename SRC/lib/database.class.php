<?php
/**
 * PHP PDO Wrapper by MegaXLR.
 *
 *
 * @author MegaXLR
 * @url https://github.com/megaxlr
 * @param array('host' => 'localhost', 'database' = 'db_name','username' => 'root','password' => 'root');
 */
class Database {
  // Database Connection settings
  private $host;
  private $database;
  private $username;
  private $password;
  private $debug = false;
  private $fetch_method = PDO::FETCH_OBJ;
  /**
   * Automagic SQL binder.
   *
   * Automatically binds all arguments from an array in the SQL query.
   *
   * @param $sql Unbound SQL query.
   * @param $arguments Parameters for binding
   * @return Bound SQL query.
   */
  private function bind($sql, $arguments) {
    // Bind all variables and return
    for ($i=0; $i < count($arguments); $i++) {
      $argument = $arguments[$i];
      switch (true) {
        case is_bool($argument):
        $sql->bindParam($i, $argument, PDO::PARAM_BOOL);
        break;
        case is_int($argument):
        $sql->bindParam($i, $argument, PDO::PARAM_INT);
        break;
        case is_null($argument):
        $sql->bindParam($i, $argument, PDO::PARAM_NULL);
        break;
        default:
        $sql->bindParam($i, $argument, PDO::PARAM_STR);
      }
    }
    // Return bound SQL query
    return $sql;
  }
  /**
   * SQL-Query function.
   *
   * Binds the query parameters and returns Object
   *
   * @param $sql PDO SQL statement with tokens
   * @param $arguments Array of data to be inserted at the tokens
   * @return anonymous object with the column names as methods
   */
  public function query($sql='', $arguments=array()) {
    // Prepare the statement
    $sql = $this->conn->prepare($sql);
    // Execute and return if successful
    if($sql->execute($arguments)) {
      return $sql->fetchAll($this->fetch_method);
    } else {
      return null;
    }
  }
  function __construct($settings = array()) {
    // IF PDO is not loaded.
    if(!class_exists('PDO')) {
      throw new Exception("PDO must be loaded for this wrapper to work.", 1);
    }
    // If Database settings are not set.
    if(empty($settings) && !file_exists("db_config.ini")) {
      if(empty($settings)) {
        $settings = parse_ini_file("db_config.ini");
      }
      // Set DB settings
      $this->host = isset($settings['host']) ? $settings['host'] : 'localhost';
      $this->database = isset($settings['database']) ? $settings['database'] : 'db_name';
      $this->username = isset($settings['username']) ? $settings['username'] : 'root';
      $this->password = isset($settings['password']) ? $settings['password'] : 'root';
      $this->debug = isset($settings['debug']) ? $settings['debug'] : false;
      
      $fetch_methods = array(
        'class' => PDO::FETCH_CLASS,
        'assoc' => PDO::FETCH_ASSOC,
        'both' => PDO::FETCH_BOTH,
        'into' => PDO::FETCH_INTO,
        'lazy' => PDO::FETCH_LAZY,
        'named' => PDO::FETCH_NAMED,
        'num' => PDO::FETCH_NUM,
        'object' => PDO::FETCH_OBJ
      );
      if(in_array(strtolower($settings['fetch_method']))) {
        $this->fetch_method = $fetch_methods[$settings['fetch_method']];
      }
      $this->fetch_method = isset($settings['fetch_method']) ? $settings['fetch_method'] : PDO::FETCH_OBJ;
      // Try-catch statement for connecting using the PDO Extension
      try {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
      } catch (PDOException $e) {
        if ($this->debug) {
          var_dump($e);
        } else {
          echo "Cannot connect to Database. Check again in a few minutes.";
        }
      }
    } 
  }
}
?>
