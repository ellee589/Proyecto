<?php

class DB {

    private $Host;
    private $User;
    private $Password;
    private $Port;
    private $Db;
    private $DBConn;
    private static $Instance=NULL;
    private static $InstanceCounter=0;

    /**
     * Creates new Database Connection Class
     * @global type $DB_HOST
     * @global type $DB_USER
     * @global type $DB_PASSWORD
     * @global type $DB_PORT
     * @global type $DB_SCHEMA
     */
    private function __construct() {
        global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_PORT, $DB_SCHEMA;
        $this->Host = $DB_HOST;
        $this->User = $DB_USER;
        $this->Password = $DB_PASSWORD;
        $this->Port = $DB_PORT;
        $this->Db = $DB_SCHEMA;
    }
    
    /**
     * Get Database connection Instance
     * @return DB
     */
    public static function getInstance(){
        if(DB::$Instance==NULL){
            DB::$Instance=new DB();
            DB::$Instance->Open();
            DB::$InstanceCounter=1;
        } else {
            DB::$InstanceCounter++;
        }
        return DB::$Instance;
    }
    
    /**
     * Closes the Static Database connection Instance
     */
    private static function closeInstance(){
        DB::$Instance->DBConn->close();
        DB::$Instance=NULL;
        DB::$InstanceCounter=0;
    }
    
    /**
     * Opens a Physical database connection
     */
    private function Open() {
        $this->DBConn = new mysqli($this->Host, $this->User, $this->Password, $this->Db);
        if ($this->DBConn->connect_errno) {
            error_log("Error al Conectar al servidor de MySQL en $this->Host:$this->Port / $this->Db usando $this->User / $this->Password");
            unset($this->DBConn);
        } else {
            $this->Execute("set NAMES 'utf8'");
        }
    }

    /**
     * Closes a Pool Database connection
     */
    public function Close() {
        if(DB::$InstanceCounter<=1){
            DB::closeInstance();
        } else {
            DB::$InstanceCounter--;
        }
        
    }

    /**
     * Executes a Selec statement and return the result rows
     * @param type $Query The query to execute
     * @return array Array of rows containing the resultset
     */
    public function Select($Query) {
        $Rows=Array();
        $Result=$this->DBConn->query($Query);
        if($Result){
            while($Record=$Result->fetch_assoc()){
                $Rows[]=$Record;
            }
            
        }
        return $Rows;
    }

    /**
     * Executes a SQL Statement
     * @param type $Query The Statement to execute
     * @return boolean the result of the statement execution
     */
    public function Execute($Query) {
        return $this->DBConn->query($Query);
    }
    
    /**
     * Return the number of affected rows in the most recent executed query
     * @return int number of affected rows
     */
    public function getAffectedRows(){
        return $this->DBConn->affected_rows;
    }

    /**
     * Prepares a statement
     * @param type $Query Query to prepare
     * @return mysqli_stmt
     */
    public function Prepare($Query) {
        $ps = $this->DBConn->stmt_init();
        $ps->prepare($Query);
        return $ps;
    }

    /**
     * Get the last_insert_id for this connection
     * Because the DB Object is pool oriented, you should use the 
     * statement last_insert_id attribute instead to prevent
     * statements collitions
     * @return type The last_insert_id generated in this databse connection
     */
    public function getLastInsertId() {
        return $this->DBConn->insert_id;
    }
    
    /**
     * Get the Columns for a given resultset
     * @param type $ResultSet The Result of a query from which take the columns
     * @return array Columns in the ResultSet
     */
    public function getColumns($ResultSet){
        $Columns=array();
        if($ResultSet!=NULL && count($ResultSet)>0){
            $FirstRow=reset($ResultSet);
            foreach(array_keys($FirstRow) as $Column){
                $Columns[]=$Column;
            }
        }
        return $Columns;
    }
    
    /**
     * Returns a String representing the Given ResultSet in a CSV Format
     * @param type $Rows The Resultset
     * @return string CSV String
     */
    public function RowsToCSVString($Rows){
        $CSVString="";
        if($Rows!=NULL && count($Rows)>0){
            $Columns=$this->getColumns($Rows);
            foreach($Columns as $Column){
                $CSVString.="$Column, ";
            }
            $CSVString=substr($CSVString, 0, strlen($CSVString)-2);
            $CSVString.="\n";
            foreach($Rows as $Row){
                foreach($Row as $Value){
                    $CSVString.="$Value, ";
                }
                $CSVString=substr($CSVString, 0, strlen($CSVString)-2);
                $CSVString.="\n";
            }
        }
        return $CSVString;
    }
    
    /**
     * Transpose a ResultSet with the required Transpose Indicator Columns (TRNS_ID, TRANS_COLUMN and TRANS_VALUE)
     * @param type $Rows The ResultSet to Transpose
     * @return type The Transposed ResultSet
     */
    public function TransposeResultSet($Rows){
        $Data=array();
        $Columns=array();
        if($Rows!=NULL && count($Rows)>0){
            foreach($Rows as $Row){
                $RowId=$Row["TRANS_ID"];
                foreach($Row as $ColumnName => $Value){
                    if(substr($ColumnName, 0,"6") != "TRANS_"){
                        $Data[$RowId][$ColumnName]=$Value;
                    } else if($ColumnName=="TRANS_COLUMN"){
                        $Data[$RowId][$Value]=$Row["TRANS_VALUE"];
                    }
                }
            }
        }
        return $Data;
    }

    function __destruct() {
        unset($this->DBConn);
        unset($this);
    }
    
    /**
     * Escapes a String to use it as argument in a SQL Statement
     * @param String $String The String to be escaped
     * @return String The espaced String 
     */
    public static function escape($String){
        $DB=DB::getInstance();
        $Escaped=$DB->DBConn->escape_string($String);
        $DB->Close();
        return $Escaped;
    }

}