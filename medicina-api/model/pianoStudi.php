<?php
class Piano
{
    protected $conn;
    protected $table_name = "piano_di_studi";

   protected $nome;
   protected $cfu;
   protected $settore;
   protected $n_settore; 
   protected$taf_ambito;
   protected $ore_lezione;
   protected $ore_laboratorio;
   protected $ore_tirocinio;
   protected $tipo_insegnamento;
   protected $semestre;
   protected $descrizione_semestre;
   protected $anno1;
   protected $anno2;

    public function __construct($db)
    {
        $this->conn = $db; 
   }

    function getArchivePiano(){
        $query = "SELECT * FROM  $this->table_name";
    
                $stmt = $this->conn->query($query);
    
                return $stmt;
    }

    function addPiano($codice,$nome, $cfu){
        $query = "INSERT INTO $this->table_name   (codice, nome, cfu)  VALUES (?,?,?)";
    
        $stmt = $this->conn->prepare($query);
    
            $stmt->bind_param('isi', $codice,$nome, $cfu);
            $stmt->execute();
            
            return $this->conn->affected_rows;
    }
}


?>