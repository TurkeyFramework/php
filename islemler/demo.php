<?php 

  //  use sistem\load as cagri ;
    class demo {
	
//#################################################
	//###############################################
	//################---------------------#################


        function pdf(){
	
	
            $html = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//tr" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Başlıksız Belge</title>
                <style>
                  body { font-family: DejaVu Sans, sans-serif; }
                  table {
                          margin-left:auto;
                          margin-right:auto;
                        font: 11px/24px DejaVu Sans,DejaVu  Arial, DejaVu Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 820px;
                        }

                th {
                        padding: 0 0.5em;
                        text-align: left;

                        }

                 tr td {
                        border-bottom: 1px solid #4567DA;
                        text-align: left;

                        }

                .sol{
                        text-align:left;}

                #footer {
                  bottom: 0;
                  border-top: 0.1pt solid #aaa;
                    position: fixed;
                  left: 0;
                        right: 0;
                        color: #888;
                        font-size: 0.5em;
                }
                #header {
                        float:left;
                        padding:0 0 0 20px;	
                }


                </style>
                </head>
                <body>
                <table width="95%"><thead><tr><th>Dosya No</th><th>Arşiv</th></trd><tbody>
                </tbody></table></body></html> ';
 
        
            
            sistem\load::sistem('pdf');
           
          
            
            $this->pdf->class->load_html($html);
            $this->pdf->class->set_paper('a4', 'portrait');
            $this->pdf->class->render();
            $this->pdf->class->stream("file.pdf");	
    
	
	}
	
	


	
        function cikis(){
                session_destroy();
                        echo "<script> setTimeout(function(){location.replace()},1000);</script>";	
        }

                        
                        
                        
        function maildeneme(){
            sistem\load::sistem('mail');
            
          
            
            // $mail =   $this->mail->Loadclass();  
            
            // https://github.com/PHPMailer/PHPMailer/blob/master/class.phpmailer.php
            //  phpmailer sinifi cagrilir,
            // mail ayarlamalari help klosorundeki mail.php sayfasindan yapilir. (sendmail fonksiyonu kullanilacaksa)
           // olusturulmus olan sendmail fonksiyonu kullanimi  
            // alici lar dizi olarak gonderilir.  ek varsa onlarda dizi seklinde gonderilir
            // normal phpmailer kullanilacaksa $mail =  $this->mail->Loadclass(); seklinde kullanabilirsiniz

            $ek[0] = "help/img-shop-2.jpg";
            $alici[0] = "ayhan.811@gmail.com";

            $subject = "deneme. ";
            $text =  '<p >Sayın :  ayhan</p>';

            if($this->mail->sendmail($alici,$subject,$text,$ek)){
                 TRUE;
            }
            else  FALSE;
        }
                    
                    
        function resim(){
            $this->View("image");
        }
        function kur(){
            $kur = $this->help("kur");
            $kur->kur_dolar();
   
            echo "<p>Dolar Alis : {$kur->DolarAlis} </p>";
        }
                
        function yukle_isle() {
           
            // $this->data ile gonderilen get , post ve url / ile ayrilmis key value seklinde degerler cekilir 
            // ornek text name isim olan degere ulasmak icin $this->data->isim; sekllinde ulasilir
            $ek = "fileToUpload";
            // fileToUpload , gonderilen file name ismidir
                try {
                    $dosya = $this->help("upload");
                
                      
                      //var_dump($dosya->yukle($ek,"deneme\\"));
                    // upload sinifi yuklenir
                    // upload sinifi yukle fonksiyonu ilk parametre yuklenecek dosyanin file name ismi, 
                    // 2 nci parametre ise yuklenecek  klosor ismidir
                    $file = $dosya->yukle($ek,"deneme\\");
                    // yukeleme isleminden donen dosyanin konumu ve ismidir.
                     $image =  UPLOAD.$file;
                }
                catch (Exception $e) {
                    echo '<script>alert("'.$e->getMessage().'")</script>';
                }
                
                // buradaki fonksiyonlar SimpleImage sinifi fonksiyonlaridir.
                // https://github.com/claviska/SimpleImage/blob/master/src/abeautifulsite/SimpleImage.php
                $dosya->load($image)->blur('selective', 50)->save(UPLOAD.$dosya->isim);
                //$dosya->load($image)->flip('x')->rotate(90)->best_fit(320, 200)->sepia()->save(UPLOAD."bn.jpg");


        }
        function paginate(){
            
            //paginate kullanimi 
            /*
             * $sql = array(
             * "tablo" => "ulkeler",
             * "colum" => "ulke , kod", // (*)
             * "kosul" => "kod != '' ",
             * "limit" => 12
             * )
             * 
             */
            
           $sql = array(
              "tablo" => "ulkeler",
              "colum" => "ulke , kod", // varsayilan (*)
              "kosul" => "kod != '' ",
              "limit" => 10 //sayfada gosterilecek veri adeti
              );
           $url = URL ."demo/paginate";
           $data["url"] = $url;
           //  $url = ANASITE ."sayfa adi/fonksiyon adi";
           
           
           $data["data"] = $this->sistem("paginate")->paginate($url,$sql);
           
           $this->head = array(
                "title"=>"paginate",
                "keywords"=>"Sayfa Siralama , paginate");
          
           
           $this->View("header"); 
           $this->View("paginate",$data);
           $this->View("footer");
           
           
           
        }
                
        function update(){
            $this->yukle("sql","firma.php")->update();
        }   
            
         function update2(){
            $this->Model("firma")->update();
        }   
        
        function about(){
            
              $this->head = array(
                "title"=>"about",
                "keywords"=>"");
          
           
           $this->View("header"); 
           $this->View("about");
           $this->View("footer");
        }

        function blog(){
            
              $this->head = array(
                "title"=>"blog",
                "keywords"=>"");
          
           
           $this->View("header"); 
           $this->View("blog");
           $this->View("footer");
        }
        function codes(){
            
              $this->head = array(
                "title"=>"codes",
                "keywords"=>"codes");
          
           
           $this->View("header"); 
           $this->View("codes");
           $this->View("footer");
        }
        
        function gallery1(){
            
              $this->head = array(
                "title"=>"gallery1",
                "keywords"=>"gallery1");
          
           
           $this->View("header"); 
           $this->View("gallery1");
           $this->View("footer");
        }
        
        function gallery2(){
            
              $this->head = array(
                "title"=>"gallery2",
                "keywords"=>"gallery2");
          
           
           $this->View("header"); 
           $this->View("gallery2");
           $this->View("footer");
        }
        
        function contact(){
            
              $this->head = array(
                "title"=>"contact",
                "keywords"=>"contact");
          
           
           $this->View("header"); 
           $this->View("contact");
           $this->View("footer");
        }

}
?>