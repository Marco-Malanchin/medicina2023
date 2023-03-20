<?php
class Piano
{
    protected $conn;
    protected $table_name = "piano_di_studi";

    protected $name;
    protected $id_creator;
    protected $id_user;
    protected $id_legue;

    public function __construct($db)
    {
        $this->conn = $db; 
   }

    function getArchivePiano(){
        $query = "SELECT * FROM  $this->table_name";
    
                $stmt = $this->conn->query($query);
    
                return $stmt;
    }
}
?>