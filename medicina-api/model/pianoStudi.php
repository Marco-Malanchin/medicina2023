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

    function addPiano($codice,$nome, $cfu, $settore, $n_settore, $taf_ambito, $ore_lezione, $ore_laboratorio, $ore_tirocinio, $tipo_insegnamento, $semestre, $descrizione_semestre, $anno1, $anno2){
        $query = "INSERT INTO $this->table_name   (codice, nome, cfu, settore, n_settore, taf_Ambito, ore_lezione, ore_laboratorio, ore_tirocinio, tipo_insegnamento, semestre, descrizione_semestre, anno1, anno2)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
        $stmt = $this->conn->prepare($query);
    
            $stmt->bind_param('isisisiiisisii', $codice,$nome, $cfu, $settore, $n_settore, $taf_ambito, $ore_lezione, $ore_laboratorio, $ore_tirocinio, $tipo_insegnamento, $semestre, $descrizione_semestre, $anno1, $anno2);
            $stmt->execute();
            
            return $this->conn->affected_rows;
    }
}


?>