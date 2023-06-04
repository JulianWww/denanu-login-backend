<?php
    require_once 'vendor/autoload.php';
    require_once __DIR__ . "/templates/email_verification.php";

    use SendGrid\Mail\Mail;

    function sendMail($to_name, $to_mail, $from_name, $from_mail, $key, $content, $subject) {
        $email = new Mail();
        $email->setFrom($from_mail, $from_name);
        $email->setSubject($subject);
        $email->addTo($to_mail, $to_name);
        $email->addContent(
            "text/html", $content
        );
        $sendgrid = new \SendGrid($key);
        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
        echo 'Caught exception: '.  $e->getMessage(). "\n";
    }
  }  
?>