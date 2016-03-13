<?php
if(!isset($sysguvenlik)) exit("Ulaşmak istediğiniz sayfa BU değil !");
error_reporting(1);
 $database = "sql";
	$system_path = 'ayarlar';
$dbaglanti = "driver";

	$application_folder = 'islemler';
	$kutuphane = 'kutuphane';
	$sistem = 'sistem';
	

	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	
	$system_path = rtrim($system_path, '/').'/';


	if ( ! is_dir($system_path))
	{
		exit("sistem: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}


	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	
	define('EXT', '.php');
	
		define('ISLEM', str_replace("\\", "/", $application_folder));
	//URL
	define('SITE',"http://localhost/trans/");

	define('KUTUPHANE', str_replace("\\", "/", $kutuphane));
	
	define('SISTEM', str_replace("\\", "/", $sistem));
	
	
	define('BASEPATH', str_replace("\\", "/", $system_path));
	
	define('FCPATH', str_replace(SELF, '', __FILE__));
	
	 $exp =  explode(",", $_SERVER[HTTP_ACCEPT_LANGUAGE]);  
	 if ("tr-TR" == $exp[0]){
	//	 include include_once FCPATH ."lang/tr.php";
		 }

		
	
	define('ANADIZIN', FCPATH .str_replace("/", "\\", $application_folder));
	
	define('DATA', FCPATH .str_replace("/", "\\", $database));
	
	define('DATABAGLANTI', DATA ."\\".str_replace("/", "\\", $dbaglanti));


	
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '\\'), '\\'), '\\'));
define('VARSAYILANSAYFA', '\index');

	define('SQL', str_replace("ayarlar\\", "sql\\", BASEPATH));

	
	
	if (is_dir($application_folder))
	{
		define('APPPATH', $application_folder.'\\');
	}
	else
	{
		if ( ! is_dir(BASEPATH.$application_folder.'\\'))
		{
			exit("Uygulama klos�r olu�tur: ".SELF);
		}

		define('APPPATH', BASEPATH.$application_folder.'\\');
	}
		//TEMA

  	if($_SESSION["level"]){
                
                define('TEMA',"/ayhan");
                
            }
          
            elseif($_SESSION["location"] == "tr"){
                
                define('TEMA',"/tr");
                
            }
            elseif($_SESSION["location"] == "tr"){
                
                define('TEMA',"/tr");
                
            }
            elseif($_SESSION["location"] == "tr"){
                
               define('TEMA',"/tr");;
            }
            else {
                
                  define('TEMA',"/web");
                
                
            }
		define('VARSAYILANSAYFA','index');
		  
		//  define('TEMA',"\\Template");
		define('TEMP',FCPATH ."tema".TEMA);
		//html için 
		define('U_TEMA',str_replace("\\", "/", TEMA));
		
		define('HELP', FCPATH .'help');
		define('ERROR',FCPATH ."tema"."/error");
                $site = 'http://localhost/trans/';
		
		define('URL',$site);
		define("RESIMYOK","onerror=\"src='".URL."/resim/no.jpg'");
		define('UPLOAD', FCPATH.'upload\\');
                define(SITE, $site);
                
		define('ADMIN', SITE.'index/');
		define('TEMADIZIN', TEMP);
		$skin = $site."skin". TEMA."/" ;
               define('SKIN',$skin);
               
               $skin = ANASITE ."skin/error/" ;
               define('SKIN_E',$skin);
               
		define('KTPHN',FCPATH.$kutuphane);
		
		//################DATABASE 
		
		//ini_set("display_errors", 0);  
		
		// db baglantısı için vt seçimi
		/*
		mysql
		mysqli
		mssql
		sqlite
		pdo
		oracle
		postgresql
	
		
		*/
		//define('DB_DRIVER','pdo'); pdo kullanilacaksa bu sekilde
                define('DB_DRIVER','mysqli');
		define('DB_SET','UTF8');
		define('DB_HOST','localhost');
		define('DB_USER','root');
		define('DB_PASS','');
		define('DB_NAME','ornek');
		define('CACHE', SISTEM.'/database/cache'); // cache dosyasi nin olusturalacagi klosor adi
                define('CAHE_TIMEOUT', 1);  // cache dosyasi kullanimin suresi dakika cinsinden 
			
		/*
	
		// gelen post get veya dataları iki yontemle guvenlik kontrolu yapılır.
		// strip_tags() ve htmlentities($data, ENT_QUOTES, 'UTF-8'); 
		// iki yontem rasındaki fark strip_tags() tum html tagları temızler
		// htmlentities ise html taglarını encode ederek zararsız hale donusrturur.
		// bunlardsan hangisinin kullanılacağı
		// dataguvenliği  (strip_tags()  "s" ) veya ( htmlentities "h" ) 
		
		// class.php private $yontem = "h";
		*/
                
                


?>
