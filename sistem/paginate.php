<?php

use sistem\load as load ;

class paginate extends load {
    
    static $css ,$db ,$dt,$url;
    public  $toplam, $adet = 10 , $sonraki , $onceki , $data ; 
     
    function __construct($dt="") {
        $this->dt = $dt;
        $this->db = $this->yukle('db');      
    }
    
    function paginate($url,$sql){
        
        
      if($url != "NULL"){
        
             self::$url =  $url;
        }
        else {
           
            exit('Error : URL ');
        }
        
        
        if($sql['tablo'] != "NULL"){
        
           $tablo =  $sql['tablo'];
        }
        else {
           
            exit('Error : Tablo ');
        }
        
        if($sql['colum'] != "NULL"){
        
            $colum =  $sql['colum'];
        }
        else {
           
           $colum =  "*";
        }
        
        if(isset($sql['limit'])){
        
            $this->adet  =  $sql['limit'];
        }
      
           if(isset($this->dt->Ss)){
            $active = $this->dt->Ss;
           $ilk = ($this->adet *  ($this->dt->Ss -1 ));
        }
        
        else {
            $active = 1;
            $ilk = 0;

       }
        if(isset($sql['kosul'])){
           
             $this->toplam = ceil($this->db->get_var("SELECT count(*)  FROM  {$tablo} WHERE  {$sql['kosul']} ") /  $this->adet);
           
            $kosul =  "WHERE  {$sql['kosul']} LIMIT {$ilk} , {$this->adet}";
        }
        else {
            
            $this->toplam = ceil($this->db->get_var("SELECT count(*)  FROM  {$tablo} ") /  $this->adet);
            $kosul =  " LIMIT {$ilk} , {$this->adet} ";
            
        }  
      
   
        
        $data["veri"] = $this->db->get_results("SELECT {$colum} FROM  {$tablo}  {$kosul} ");
        
        $js_css = $this->loadcss(URL.'sistem/paginate/css/style.css');
        $js_css .= $this->loadjs(URL.'sistem/paginate/jquery-1.3.2.js');
        $js_css .= $this->loadjs(URL.'sistem/paginate/jquery.paginate.js');
        $data["css"] =  $this->css();
        $data["js_css"] = $js_css ;
           
    

        
         $data["count"] =  $this->toplam ;
         $data["start"] =  $active ;
         
         $data = (object)$data;
    
        
        return $data;
        
    }
   
    function loadcss($path) {

        $sc = "<link rel='stylesheet' type='text/csst' href='$path'>"; 
        return $sc;

    }
    
    function loadjs($path) {

        $sc = "<script type='text/javascript' src='$path'></script>"; 
        return $sc;
    }
            
    function css(){
       $this->css =  '
        <style>
          .demo{
                width:580px;
                bottom:0;
                padding:10px;
                margin:10px auto;
                border: 1px solid #fff;
                background-color:#f7f7f7;
            }
        </style>';
       
        return $this->css;
    }

}

