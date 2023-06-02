<?php
  function send_mail($title, $sendername, $content, $pswrd, $sender) {
    ## $mailer = substr(__FILE__, 0, -3);
    ## $mailCommand = $mailer . "sh 'Confirm Email' '" . $sendername . "' '" . $content . "'";
    ## shell_exec($mailCommand);
    ## $absolute_path = realpath("mail.php");
    ## print($mailCommand);
    ## print("<br/><br/>");

    $rcpt='julian.wandhoven@gmail.com';

    $email_content = "From: '" . $title . "' <'" . $sender . "'>\n"
    . "To: 'Gmail' <'" . $rcpt . "'>\n"
    . "Subject: from '" .$sender . "' to Gmail\n"
    . "\n"
    . "Dear '" . $sendername . "'"
    . "\n"
    . $content
    . "\n"
    . "Regards,\n"
    . "Denanu-Login";
  
    $command = 'echo "' . $email_content . '" | curl -s --ssl-reqd --url "smtps://smtp.gmail.com:465" --sender "' . $sender . ':"' . $pswrd . '"" --mail-from "' . $sender . '" --mail-rcpt "' . $rcpt . '" --upload-file -';

    print($command);
    print("<br/><br/>");
  }
?>

