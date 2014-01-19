Date . "
\n" ; echo "Driver: " . $check->Driver . "
\n" ; echo "Mailbox: " . $check->Mailbox . "
\n" ; echo "Messages: " . $check->Nmsgs . "
\n" ; echo "Recent: " . $check->Recent . "
\n" ; echo "Unread: " . $check->Unread . "
\n" ; echo "Deleted: " . $check->Deleted . "
\n" ; echo "Size: " . $check->Size . "
\n" ; } else { echo "imap_check() failed: " . imap_last_error() . "
\n"; }   echo "
Headers in INBOX
\n"; $headers = imap_headers($mbox);   if ($headers == false) { echo "Call failed (or no messages)
\n"; } else { foreach ($headers as $val) { echo $val . "
\n"; } } $FirstMessageArray = implode('', array(imap_fetchbody($mbox, 1, ""))); echo $FirstMessageArray; $subject = ""; $message = ""; $to = substr ( $FirstMessageArray , 0, 10 ); $from = "";       $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql'); mysql_select_db($dbname); $query = "INSERT INTO `DatabaseTable` (`id`, `to`, `from`, `subject`, `message`) VALUES (NULL, '{$to}', '{$from}', '{$subject}', '{$message}');"; $result = mysql_query($query); mysql_close($conn);   imap_delete($mbox, 1); imap_close($mbox); ?>