<?php
	$dbhost = 'localhost';
	$dbuser = 'DATABASE_USER';
	$dbpass = 'DATABASE_PASSWORD';
	$dbname = 'DATABASE_NAME';
        
        var_dump(get_extension_funcs('imap'));
        echo 'boom';
        echo phpinfo();
        
        
 
	$imapserverstring = 'imap.gmail.com:993/imap/ssl/novalidate-cert';
	$imapuser = 'rob.m.deakin@gmail.com';
	$imappass = 'Woof123!Woof123!';
 
 
	$mbox = imap_open("{".$imapserverstring."}INBOX", $imapuser,$imappass)	or die("can't connect: " . imap_last_error());
 
	$check = imap_mailboxmsginfo($mbox);
 
	if ($check) {
		echo "Date: "     . $check->Date    . "<br />\n" ;
		echo "Driver: "   . $check->Driver  . "<br />\n" ;
		echo "Mailbox: "  . $check->Mailbox . "<br />\n" ;
		echo "Messages: " . $check->Nmsgs   . "<br />\n" ;
		echo "Recent: "   . $check->Recent  . "<br />\n" ;
		echo "Unread: "   . $check->Unread  . "<br />\n" ;
		echo "Deleted: "  . $check->Deleted . "<br />\n" ;
		echo "Size: "     . $check->Size    . "<br />\n" ;
	} else {
		echo "imap_check() failed: " . imap_last_error() . "<br />\n";
	}
 
	echo "<h1>Headers in INBOX</h1>\n";
	$headers = imap_headers($mbox);
 
	if ($headers == false) {
		echo "Call failed (or no messages)<br />\n";
	} else {
		foreach ($headers as $val) {
			echo $val . "<br />\n";
		}
	}
	$FirstMessageArray = implode('', array(imap_fetchbody($mbox, 1, "")));
	echo $FirstMessageArray;
	$subject = "";
	$message = "";
	$to = substr  ( $FirstMessageArray ,  0,  10 );
	$from = "";
 
 
 
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	$query  = "INSERT INTO `DatabaseTable` (`id`, `to`, `from`, `subject`, `message`) VALUES (NULL, '{$to}', '{$from}', '{$subject}', '{$message}');";
	$result = mysql_query($query);
	mysql_close($conn);
 
	imap_delete($mbox, 1);
	imap_close($mbox);
        
        