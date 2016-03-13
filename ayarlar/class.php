<?php

namespace ana;
	class ayhan {
		
		private $deger = "sistem";
		// dataguvenliği  (strip_tags()  "s" ) veya ( htmlentities "h" ) 
		public $yontem = "s" ,$head = array(),$class;
               protected static $data , $post;
               
               function head(){
                   
                   
                   return (OBJECT)$this->head;
               }


               /*
		
		olamayana sayfaya veya sfonksiyona ulasılmaya calısıldıgında ekrana hata basacaktır.
		
		bunu engellemek ıcın kontrol etttırecegız
		///////////////////////////////////////////////////////
		 1 ncı asama dosyanın varlıgını kontrol etmek 
		 2 nci aşama fonksıyonun varlıgını kontrol etmek .
		///////////////////////////////////////////////////// 
		 
		 if (file_exists("dosya.txt")){
		   echo "Dosya Mevcut";
	}else{
		   echo "Dosya Bulunamadı";
	}
		
		
		
		data yok ve sadece url parametresı olarak gonderılen sayfalar direk yonlendırılır
		
		sayfaya ne yapacagı gıbı bılgıler gonderılmıyorsa degerlendırmeye alacagı verı de yoktur kı dırek yonlendırmek  en mantıklısıdır
		
		ıslem klosorunde ısleme alıp gondermek gereksızdır varsayılan olarak gonderılır
		
		dıyelınkı ıletısım sayfası sabıt verıler vardır 
		
		vt den cekemek zorunda
		*/
	
	/*
	
		$time = new DateTime($data['b_t']);
$newtime = $time->modify('+1 year')->format('Y-m-d');

*/
	
		function datetime(){
			
			$objDateTime = new DateTime('NOW');
			return
			 $objDateTime->format('Y-m-d H:i:s');	
			
		}
			
			
		function datetimescren($date=""){
				
			$objDateTime = new DateTime($date);
			return
			$objDateTime->format('d-m-Y H:i:s');	
				
				}
			
		
             function link($link){
                    
                    
                    
                    
	/*
			if(!$_SESSION["user_id"] ){
			include_once  TEMP ."/login.php"   ;
				exit();
			}
		*/	
			
			
			$link = trim($link);
			$r = explode(" ",$link);
			$adet = count($r);
				if($r[0]=="") {
                                    
                                   $page = str_replace("\\", "", VARSAYILANSAYFA) ;
				
				include_once FCPATH .ISLEM . VARSAYILANSAYFA .EXT ;
                                $d = $page."::ayhan();";
					// eval string ifadeyi php kodu na dönüştürür.
					
                                         
                                        
					//set error handler
					@eval($d);
                              
				}
				/*
						else if(isset($r[0]) and !isset($r[1]) and (empty($_POST) and empty($_GET) ) ) { 
							$sayfa = $r[0];
							$data = "";
							// bu kısın sadece sayfaya yonlendirmek için
							// sayfa sayfa.php dosyası için işlem sql den bu sayfa için veri çekilip 
							// tema daki sayfa php ne gönderilip işlenir.
							//#################################
							// SADECE SAYFA ÇA�?RILIRSA İ�?LEME GİRECEK
							//#################################	
										
							$data = $this->yukle("sql",$sayfa.".php","");	
							$this->yukle("tema",$sayfa.".php",$data);
							exit();	
					}
					*/
					
					else  {
						$sayfa = $r[0];
						 
						//dizinin ilk  elamanını siliyoruz........... */
						array_shift($r);
						if(isset($r[0])):
						//dizinin ilk  elamanını siliyoruz........... */
						$fonksiyon =  $r[0];
						array_shift($r);
						$data["fonksiyon"] = $fonksiyon ;
						unset($fonksiyon);
						else:
							  $data["fonksiyon"] = "ayhan" ;
						endif;
						//#################################
						//  SAYFA ÇA�?RILIRSA VE DATA GÖNDERİLİRSE İ�?LEME GİRECEK
						//#################################			
							if (file_exists(FCPATH .ISLEM ."/" .$sayfa .EXT)){
								$sayi = @count($r);
									if($sayi > 0){
											$deger = $r;
											$c = 0;
												for($i=1; $sayi > $i;$i+=2){
													if($this->yontem == "h"){
															$data[$deger[$c]] = htmlentities($deger[$i], ENT_QUOTES, 'UTF-8') ;
														}
													else if($this->yontem == "s"){
														$data[$deger[$c]] = strip_tags($deger[$i]) ; 
													}
											else {
												$data[$deger[$c]] = $deger[$i] ;	
												}
												
												$c += 2;
											}
										}			
	
							if(!empty($_POST)){
								foreach($_POST as $key => $value){
									if($this->yontem == "h"){
										$p[$key] = $data[$key] = htmlentities($value, ENT_QUOTES, 'UTF-8') ;
									}
									else if($this->yontem == "s"){
										$p[$key] = $data[$key] = strip_tags($value) ;
									}
									else {
										$p[$key] = $data[$key] = $value ;
									}
								}
							}
							if(!empty($_GET)){
								foreach($_GET as $key => $value){
									if($this->yontem == "h"){
										 $data[$key] = htmlentities($value, ENT_QUOTES, 'UTF-8') ;
									}
									else if($this->yontem == "s"){
										$data[$key] = strip_tags($value) ;
									}
									else {
										$data[$key] = $value ;
									}
											
								}
							}
		
			if(isset($data)){
					$post = $data ; 
					unset($post['fonksiyon']); 
                                        $p = (OBJECT)$p;
					$data = (object)$data;
				//global $data;
				}
			
					include_once FCPATH .ISLEM ."/" .$sayfa .EXT  ;
					$sinif = explode(".",$sayfa);
					$sinif = str_replace("-","_",$sinif[0]);
					$fonksiyon = $data->fonksiyon;
					
					$d = $sinif."::".$fonksiyon."();";
					// eval string ifadeyi php kodu na dönüştürür.
					 
					 $this->post = $p;
                                         $this->data = $data;
                                         
                                        
					//set error handler
					@eval($d);
					//set_error_handler('xhandler',E_ALL);	
					//call_user_func(array($sinif, $fonksiyon)); ise sinif i çağıtrır ve içindeki fonksiyonu çalıştırır.
					//call_user_func(array($sinif, $fonksiyon));
				}
				else{
					include_once ERROR ."\\404.php"  ;
					 /* hata sayfasına yonlendır */
					exit();
					}
				}	
			}
	
	
	
	
		
	
	
	
		function __construct(){
			
			if ( ! isset($_SERVER['REQUEST_URI']) OR ! isset($_SERVER['SCRIPT_NAME'])){
				return '';
			}
				//REQUEST_URI  ——— Çalıştırılan ve çağrılan dosyanın yolu.
						$uri = $_SERVER['REQUEST_URI'];
				// SCRIPT_NAME çalıştırlan dosyanın ismini verir.
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0){
				$uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}
			elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0){
				$uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
				//get yontemi ilemi veri gonderilmiş
			if (strncmp($uri, '?/', 2) === 0){
				$uri = substr($uri, 2);
			}
				$parts = preg_split('#\?#i', $uri, 2);
				$uri = $parts[0];
			if (isset($parts[1])){
				// QUERY_STRING ——— Formdaki GET metodu ile gönderilen bilgileri tutar.
				$_SERVER['QUERY_STRING'] = $parts[1];
				parse_str($_SERVER['QUERY_STRING'], $_GET);
			}
			else{
				$_SERVER['QUERY_STRING'] = '';
				$_GET = array();
			}
			if ($uri == '/' || empty($uri) || $uri == '//' || $uri == '///' || $uri == '////'){
				$this->link("");	
				return '/';
			}
				$uri = parse_url($uri, PHP_URL_PATH);
				$url = trim($uri);
				$url = str_replace('/', ' ', $url);
				$this->link($url);
				
		}
	
	// kutupkaneler de calıstırılacak olan sayfalar
        function sistem($istek){
                   
                   
            if (file_exists(FCPATH .SISTEM ."\\".$istek.EXT)){

              
                 include_once FCPATH .SISTEM ."\\".$istek.EXT  ;
                 
                 $XxX = new $istek($this->data);
				return $XxX ;
                  
               // return $istek; 
            }
            else{
                include_once TEMP ."\\error\error.php"  ;
                                /* eroor sayfasına yonlendırexit();*/
                exit();

            }
                   
        } 
        
        function go($adres){
            
            echo URL.$adres;
        }
                
        function dt(){
            return $this->data;
            
        }
        
         function View($page,$data=""){
              if (file_exists(TEMP. "\\" .$page.EXT)){
                    foreach($data as $key => $veri){
                        $$key = $veri;
                    }
                    $head = $this->head();
                    //  file_get_contents(TEMP. "/" .$page, FILE_USE_INCLUDE_PATH);
                    
                    
                    
                   include_once TEMP. "\\" .$page.EXT  ;
                     
                    
                }
                else{
                    include_once ERROR ."/404.php"  ;
                        /* eroor sayfasına yonlendır exit();*/
                    exit();
                }
            
        }
        
        
        function Model($page,$data=""){
            
            if (file_exists(DATA. "/" .$page.EXT)){
                    include_once DATA. "/" .$page.EXT ;
                    return $this->sql($page,$data);
                }
                else{
                    include_once ERROR ."\\404.php"  ;
                    /* eroor sayfasına yonlendır exit();*/
                     exit();
                }
        }
                
    function yukle($klosor,$page,$data=""){
            if($klosor == "tema"){
                if (file_exists(TEMP. "\\" .$page)){
                    foreach($data as $key => $veri){
                        $$key = $veri;
                    }
                    
                    //  file_get_contents(TEMP. "/" .$page, FILE_USE_INCLUDE_PATH);
                   include_once TEMP. "\\" .$page  ;
                     
                    
                }
                else{
                    include_once ERROR ."\\404.php"  ;
                        /* eroor sayfasına yonlendır exit();*/
                    exit();
                }
            }


            /// BU kISIM YARDIMCI SINIF İÇİN KULLANILACAK DB DAHİL OLARAK SINIFTA KULLANILACAK		

            else if($klosor == "help"){

                if (file_exists(HELP."\\" .$page)){
                    
                    include_once HELP. "\\" .$page ;
                    
                    return $this->help($page);
                }
                else{
                    include_once ERROR ."\\404.php"  ;
                    /* eroor sayfasına yonlendır
                     exit();*/
                     exit();
                }

            }		

            else if($klosor == "sql"){
                if (file_exists(DATA. "/" .$page)){
                    include_once DATA. "/" .$page ;
                    return $this->sql($page,$data);
                }
                else{
                    include_once ERROR ."\\404.php"  ;
                    /* eroor sayfasına yonlendır exit();*/
                     exit();
                }

            }
            else if($klosor == "islem"){
                if (file_exists(ISLEM. "/" .$page)){
                    include_once ISLEM. "/" .$page ;
                    return $data;

                }
            else{
                    include_once ERROR ."\\404.php"  ;
                    /* eroor sayfasına yonlendırexit();*/
                    exit();
            }
        } 
    }
	
		function sql($page,$data=''){
				
				$sinif = $page."_sql";
                                if($data == "p")
				$sql = new $sinif($this->post);
                                else 
                                $sql = new $sinif($this->data);
				return $sql ;
			}
			
			
		function help($page,$deger=''){
                    
                    if (file_exists(HELP."\\" .$page.EXT)){
                        include_once HELP. "\\" .$page.EXT ;
                    }
                    else{
                      include_once ERROR ."\\404.php"  ;
                        /* eroor sayfasına yonlendır
                         exit();*/
                         exit();
                    }

                    
                    if(!$deger):
                       $sinif = $page."_help";
                    else:
                        $sinif = $page."_help(".$deger.")";
                    endif;
				
                    return new $sinif;
                               
	}		
			
		function sinif($deger = ""){
			// $this->deger sistem olarak tanımlıdır.
			if ($deger){
                            
                         return new $deger;
                             
				}
			else {
				return new $this->deger;
				}
			}
	
	
				
		function kutuphaneyukle($kutuphane=""){
			include_once  FCPATH ."/kutuphane/" .$kutuphane .".php";
			$ayh = new $kutuphane;
                        
			return $ayh;
			/* kütükhane yüklendikten sonraki çalışma şekli  kutuphane klosorunden çağrı, sayfa ile sınıf aynı olacak sınıf dahıl edıldıkten sonra funcsiyonmlara ulaşılacak. 
				$mail = $this->kutuphaneyukle("mail");   $mail->deneme(); 
			*/	
		}
				
		function fnctn($name,$parametre=array()){
			// fonksiyonlar olarak eklenen fonksiyonlarda yazımda mutlaka degerler dizi olarak gonderilecektir.
			if(file_exists(FCPATH ."/fonksiyonlar/" .$name .".php")):
				include_once  FCPATH ."/fonksiyonlar/" .$name .".php";
				/*attach('ssss');*/
				$sayi = count($parametre);
					foreach($parametre as $deger):
						$i++;
						$dg .= "'".$deger."'";
							if($sayi > $i):$dg .= ", "; endif;
					endforeach; 
						$fnctn = $name."(".$dg.");";
						eval($fnctn);
						//print_r($fnctn);
				endif;
				
				}	
				
				
				
		
				
				
				
			function insert($tablo,$data){
				$adet = count($data);
					foreach($data as $key => $value){
						$i++;
						$alan .= $key;
							if($adet>$i){
								$alan .= ", ";
									}
								$veri .= "'".$value."'";
							if($adet>$i){
								$veri .= ", ";
								}
						} 
						return "INSERT INTO $tablo  ($alan) VALUES ($veri)";
					}	
					

			function update($tablo,$data,$sql=""){
				$adet = count($data);
					foreach($data as $key => $value){
						$i++;
						
						$veri .= $key ." = '". $value ."' " ; 
						
							if($adet>$i){
								$veri .= ", ";
									}
						} 
					if($sql) $sql = "WHERE ".$sql ;
						return "UPDATE  $tablo SET  $veri  $sql;";
					}						
       
                                        // END CLASS AYHAN	
		}

namespace sistem;
    class load{
        public $mail , $pdf;
        private $mysql = "database/mysql/index";
        private $mysqli = "database/mysqli/demo";
        private $mssql = "database/mssql/demo";
        private $sqlite = "database/sqlite/demo";
        private $pdo = "database/pdo/demo";
        private $oracle = "database/oracle8_9/demo";
        private $postgresql = "database/postgresql/demo";
        private $deger = DB_DRIVER;
        private $guvenlik = "guvenlik/guvenlik";
			
    //sistem için clasları çağırmak
    function yukle($istek,$parametre=""){
            if($istek == "db"){
                if($this->deger=="mysql"){
                    include_once FCPATH .SISTEM ."/" .$this->mysql .EXT  ;
                }
                if($this->deger=="mysqli"){
                    include_once FCPATH .SISTEM ."/" .$this->mysqli .EXT  ;
                }
                if($this->deger=="mssql"){
                    include_once FCPATH .SISTEM ."/" .$this->mssql .EXT  ;
                }
                if($this->deger=="sqlite"){
                    include_once FCPATH .SISTEM ."/" .$this->sqlite .EXT  ;
                }
                if($this->deger=="pdo"){
                    include_once FCPATH .SISTEM ."/" .$this->pdo .EXT  ;
                }
                if($this->deger=="oracle"){
                    include_once FCPATH .SISTEM ."/" .$this->oracle .EXT  ;
                }
                if($this->deger=="postgresql"){
                    include_once FCPATH .SISTEM ."/" .$this->postgresql .EXT  ;
                }   
                if($parametre=='cache'):

                    // Cache süresi ne zaman dolacak?
                    $db->cache_timeout = CAHE_TIMEOUT; // Verilen değer Dakika cinsinden!
                    // CACHE sabit sys.php de tanımlandı 
                    // Cache dizini
                    $db->cache_dir = CACHE;
                    //Disk önbellekleme özelliğini aç
                    // $db->cache_queries query işlemlerini önbellekler select vb
                    // $db->cache_inserts insert işlemlerini önbellekler. 		
                    $db->cache_queries    = true;
                    $db->cache_inserts    = true;
                    $db->use_disk_cache = true;
                endif;
            return $db;

            }
				
            if($istek == "guvenlik"){

                include_once FCPATH .SISTEM ."/" .$this->guvenlik .EXT  ;
                return $guvenlik; 

            }

            else{
                include_once ERROR ."\\404.php"  ;
                /* eroor sayfasına yonlendır exit();*/
                exit();

            }

        }
        
        function sistem($verí){
           
            
             if (file_exists(FCPATH .SISTEM ."\\" .$verí .EXT)){
                 
                 $yol = FCPATH .SISTEM ;
                    include_once FCPATH .SISTEM ."\\" .$verí .EXT  ;
                    
                 

                }
            else{
                    
                    exit("cagrilan sistem dosyasi hatali");
            }
            
            
            
        }
					
		 
    }  
			
	
			

			
