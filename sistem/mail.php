<?php 
class mail {
    public $class ;
        function __construct($yol){
            include $yol.'\\mail\class.phpmailer.php';
           
        }
                
        function Loadclass() {
            $this->class = new PHPMailer();

        }
         
        function sendmail($alicilar,$subject,$text,$ek=""){
            
            $this->Loadclass();
            $mail = $this->class;
                    
            $mail->IsSMTP(); // telling the class to use SMTP

            //$mail->Host       = "mail.basalanpatent.com.tr"; // SMTP server
            $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)

            $mail->SMTPAuth = true;
             $mail->Host = 'smtp.mail.yahoo.com';
            $mail->Port = '465';
            $mail->SMTPSecure = 'ssl';
            $mail->Username = 'XxxXxX@yahoo.com';
            $mail->Password = 'XxxXXXx';   

            $body  = eregi_replace("[\]",'',$text);



            $mail->SetFrom('ayhan_811@yahoo.com','ayhan Sahin');
            $mail->AddReplyTo('ayhan_811@yahoo.com','ayhan Sahin');



            foreach($alicilar as $alici){

            $mail->AddAddress($alici);

            }

            if($ek){
            foreach($ek as $ekler){

             $mail->AddAttachment($ekler); // attachment	

                    }
            }


            $mail->Subject    = $subject;
            $mail->AltBody    = "Mail sağlayıcınız html format desteklememektedir!"; // optional, comment out and test
            $mail->MsgHTML($body);
            //$mail->AddAttachment("images/phpmailer.gif");      // attachment
            //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
            $mail->CharSet="UTF-8";
            if(!$mail->Send()) {
              //$mail->ErrorInfo;
            return false;

              } else {
              return true;
            }


            }                
                
                
	
    }
        
$this->mail = new mail($yol);


