<?php
  function send_mail($title, $username, $content, $pswrd) {
    ## $mailer = substr(__FILE__, 0, -3);
    ## $mailCommand = $mailer . "sh 'Confirm Email' '" . $username . "' '" . $content . "'";
    ## shell_exec($mailCommand);
    ## $absolute_path = realpath("mail.php");
    ## print($mailCommand);
    ## print("<br/><br/>");

    $user="denanu.pandovah@gmail.com";
    $rcpt='julian.wandhoven@gmail.com';

    $email_content = "From: '" . $title . "' <'" . $user . "'>\n"
    . "To: 'Gmail' <'" . $rcpt . "'>\n"
    . "Subject: from '" .$user . "' to Gmail\n"
    . "\n"
    . "Dear '" . $username . "'"
    . "\n"
    . $content
    . "\n"
    . "Regards,\n"
    . "Denanu-Login";
  
    $command = 'echo "' . $email_content . '" | curl -s --ssl-reqd --url "smtps://smtp.gmail.com:465" --user "' . $user . ':"' . $pswrd . '"" --mail-from "' . $user . '" --mail-rcpt "' . $rcpt . '" --upload-file -';

    print($command);
    print("<br/><br/>");
  }
?>

