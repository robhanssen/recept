<?php

class DataBase
{
    var $dbhost;
    var $dbname;
    var $dbuser;
    var $dbpass;
    var $linkid;
    var $query;
    var $queryresult;
    var $queryobject;
    var $numrows;

    function DataBase($host, $name, $user, $passwd)
    {
        $this->dbhost = $host;
        $this->dbname = $name;
        $this->dbuser = $user;
        $this->dbpass = $passwd;
        $this->DBConnect();
    }

    function DBConnect()
    {
        $this->linkid = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die("Unable to connect to SQL server: $this->dbhost");
        $db_up = mysql_select_db($this->dbname,$this->linkid) or die("Unable to select database: $this->dbname");      
    }

    function DBQuery($query="")
    {

        if ($query) $this->query = $query;
        $this->queryresult = mysql_query($this->query,$this->linkid) or die("QUERY Failed!".$this->query);
        //if (!empty($this->queryresult) $this->numrows = mysql_num_rows($this->queryresult);
    }

    function DBResult()
    {
        $this->queryobject = mysql_fetch_object($this->queryresult);
        return $this->queryobject;
    }

    function DBClose()
    {
        mysql_close($this->linkid);
    }
    
    function DBNumRows()
    {
        $this->numrows = mysql_num_rows($this->queryresult);
        return $this->numrows;
    }
   
    function Getid()
    {
       return mysql_insert_id();
    }
    
    function DBFetchRow()
    {
            return mysql_fetch_row($this->queryresult);
    }
    
}


?>
