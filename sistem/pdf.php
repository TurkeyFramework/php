<?php 

class pdf {
    public $class ;
        function __construct($yol){
            include $yol.'\\pdf\dompdf_config.inc.php';
            $this->class = new DOMPDF();
        }
        
}

$this->pdf = new pdf($yol);
