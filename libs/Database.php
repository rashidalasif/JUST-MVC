<?php
class Database extends PDO{
    public function __construct($DB_TYPE,$DB_HOST,$DB_NAME,$DB_USER,$DB_PASS)
    {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME,$DB_USER,$DB_PASS);
        //parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

/*
 * this is for remove
 */

    function array_sanitize(&$item)
    {
       //$item=htmlentities(strip_tags(mysql_real_escape_string($item)));
        $allowed = "/[^a-zA-Z0-9]/";
        $item = mysql_real_escape_string($item);
        $item = preg_replace($allowed, " ", $item);
    }
    /**
     * insert
     * @param string $table A name of the table insert into
     * @param string $data An Associative Array
     */
    public function insert($table,$data)
    {
        array_walk($data,array(&$this,'array_sanitize')); //OOP system
        //insert into table_name('','','')values('','',')
        $fields = '`' . implode('`,`', array_keys($data)) . '`';
        $data = '\'' . implode('\',\'', $data) . '\'';
        $q=$this->prepare("insert into $table ($fields) values ($data)");
        return $q->execute();
    }


       /*
        *
        */
    public function update($table,$data,$id)
    {

    }


}