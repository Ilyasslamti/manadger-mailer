<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/PHPMailer/PHPMailer.php';
require 'libs/PHPMailer/SMTP.php';
require 'libs/PHPMailer/Exception.php';

$subject       = $_POST['subject'] ?? '';
$message       = $_POST['message'] ?? '';
$from_name     = $_POST['from_name'] ?? 'الماندجر';
$manual_emails = explode("\n", trim($_POST['manual_emails'] ?? ''));

$smtp_host     = $_POST['smtp_host'] ?? '';
$smtp_port     = $_POST['smtp_port'] ?? 465;
$smtp_secure   = $_POST['smtp_secure'] ?? 'ssl';
$smtp_user     = $_POST['smtp_user'] ?? '';
$smtp_pass     = $_POST['smtp_pass'] ?? '';

$uploaded_emails = [];
if (!empty($_FILES['email_file']['tmp_name'])) {
    $lines = file($_FILES['email_file']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $uploaded_emails = $lines ?: [];
}

$all_emails = array_merge($manual_emails, $uploaded_emails);
$all_emails = array_unique(array_filter(array_map('trim', $all_emails)));
$valid_emails = [];

foreach ($all_emails as $email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid_emails[] = $email;
    }
}

$results = [];

foreach ($valid_emails as $email) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_user;
        $mail->Password   = $smtp_pass;
        $mail->SMTPSecure = $smtp_secure;
        $mail->Port       = $smtp_port;

        $mail->setFrom($smtp_user, $from_name);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $results[] = ['email' => $email, 'status' => '✅ تم الإرسال'];
    } catch (Exception $e) {
        $results[] = ['email' => $email, 'status' => '❌ فشل: ' . $mail->ErrorInfo];
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>نتائج الإرسال - Manadger Mailer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="text-center mb-4">📤 نتائج إرسال الرسائل - Manadger Mailer</h3>
  <ul class="list-group">
    <?php foreach ($results as $res): ?>
      <li class="list-group-item d-flex justify-content-between">
        <span><?= htmlspecialchars($res['email']) ?></span>
        <span><?= $res['status'] ?></span>
      </li>
    <?php endforeach; ?>
  </ul>
  <a href="index.php" class="btn btn-secondary mt-4">🔙 العودة</a>
</div>
</body>
</html>
