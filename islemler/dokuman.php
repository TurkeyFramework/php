<?php
class dokuman {
	
	function yukle(){

		$data = $this->dt();
        $file = $data->dosya;
		$dz = $data->dz;
        $file = str_replace('_','/', $file);
		$dz = str_replace('_','/', $dz);
        $mimeTypes = array( 'pdf' => 'application/pdf','txt' => 'text/plain','html' => 'text/html', 'exe' => 'application/octet-stream','zip' => 'application/zip','doc' => 'application/msword','xls' => 'application/vnd.ms-excel','ppt' => 'application/vnd.ms-powerpoint','gif' => 'image/gif','png' => 'image/png','jpeg' => 'image/jpg','jpg' => 'image/jpg','php' => 'text/plain');
		$uzanti = explode('.',$file);
		$uzanti = end($uzanti);
		$file = URL .$dz ."/".$file;
		$mimeTypes = $mimeTypes[$uzanti];
		if(!$mimeTypes):
		
				$mimeTypes = "text/plain";
		
			endif;
 	
		header('Content-Type: ' . $mimeTypes); 
		header('Content-Disposition: attachment; filename="');
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		header('Cache-Control: private');
		header('Pragma: private');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		readfile($file);

	}
}
?>