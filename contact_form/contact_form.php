<?php

// configure
$from = 'danivanee_170@hotmail.com'; // Replace it with Your Hosting Admin email. REQUIRED!
$sendTo = 'your@mail.com'; // Replace it with Your email. REQUIRED!
$subject = 'New message from contact form';
$fields = array('name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'message' => 'Message'); // array variable name => Text to appear in the email. If you added or deleted a field in the contact form, edit this array.
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

$url = 'https://captcheck.netsyms.com/api.php';
$data = [
    'session_id' => $_POST['captcheck_session_code'],
    'answer_id' => $_POST['captcheck_selected_answer'],
    'action' => "verify"
];
$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$resp = json_decode($result, TRUE);
if (!$resp['result']) {
    // Replace with error-handling code
    exit("CAPTCHA did not verify:" . $resp['msg']);
} else {
    // The CAPTCHA is valid.
    exit("CAPTCHA verified!");
}