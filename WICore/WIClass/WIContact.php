<?php

/**
* Database Class
* Created by Warner Infinity
* Author Jules Warner
*/

/**
* 
*/
class WIContact 
{

	private $mailer;

	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		//create new object of WIEmail class
        $this->mailer = new WIEmail();
	}

	public function Contact($data)
	{
		$cont = $data['contactData'];

		//var_dump($cont);
		$name      = $cont['name'];
		$fromEmail = $cont['email'];
		$subject   = $cont['subject'];
		$message   = $cont['message'];

		if(count($errors) == 0) {
		// put into database
		 $query = $this->WIdb->prepare('INSERT INTO `wi_contact_message` (`name`, `email`, `subject`, `message`) VALUES (:name, :email, :subject, :message)');
		    $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':email', $fromEmail, PDO::PARAM_STR);
            $query->bindParam(':subject', $subject, PDO::PARAM_STR);
            $query->bindParam(':message', $message, PDO::PARAM_STR);
            $query->execute();
		//send email
		$this->mailer->contactEmail($cont['email'], $cont['name'], $cont['subject'], $cont['message']);

		$msg = WILang::get('successfully_send_contact_message');

		 $result = array(
                "status" => "success",
                "msg"    => $msg
            );
            
            echo json_encode($result);

	}else{
		$msg = WILang::get('not sent');
		$result = array(
                "status" => "error",
                "errors" => $errors
            );
            
            //output result
            echo json_encode ($result);
	}


		
	}





}