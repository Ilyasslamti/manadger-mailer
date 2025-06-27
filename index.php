
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>Manadger Mailer - منصة إرسال الإيميلات</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body { background-color: #f4f6f9; font-family: 'Cairo', sans-serif; }
    .container { max-width: 900px; margin-top: 40px; }
    .form-section { background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 0 15px rgba(0,0,0,0.05); }
    footer { text-align: center; margin-top: 40px; color: #777; font-size: 14px; }
    footer strong { color: #333; }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">📨 Manadger Mailer - منصة إرسال الإيميلات الجماعية</h2>

  <form action="send.php" method="POST" enctype="multipart/form-data" class="form-section">

    <div class="mb-3">
      <label for="subject" class="form-label">عنوان الرسالة</label>
      <input type="text" class="form-control" id="subject" name="subject" required>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">محتوى الرسالة (يدعم HTML)</label>
      <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
    </div>

    <hr>

    <div class="mb-3">
      <label class="form-label">📥 اختيار الإيميلات:</label>
      <ul>
        <li>🔹 رفع ملف .txt يحتوي على الإيميلات (كل إيميل في سطر)</li>
        <li>🔹 أو إدخال الإيميلات يدويًا في المربع أدناه (مفصولين بسطر)</li>
      </ul>
      <input type="file" class="form-control" name="email_file" accept=".txt">
    </div>

    <div class="mb-3">
      <label for="manual_emails" class="form-label">الإيميلات اليدوية (اختياري)</label>
      <textarea class="form-control" id="manual_emails" name="manual_emails" rows="4" placeholder="example1@gmail.com\nexample2@gmail.com"></textarea>
    </div>

    <hr>

    <h5 class="mt-4">⚙️ إعدادات SMTP</h5>
    <div class="mb-3">
      <label for="smtp_host" class="form-label">SMTP المضيف (مثلاً: smtp.gmail.com)</label>
      <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="smtp.gmail.com" required>
    </div>

    <div class="mb-3">
      <label for="smtp_port" class="form-label">رقم المنفذ (587 أو 465)</label>
      <input type="number" class="form-control" id="smtp_port" name="smtp_port" value="465" required>
    </div>

    <div class="mb-3">
      <label for="smtp_secure" class="form-label">نوع التشفير</label>
      <select class="form-control" name="smtp_secure" required>
        <option value="ssl">SSL</option>
        <option value="tls">TLS</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="smtp_user" class="form-label">البريد الإلكتروني المستخدم (SMTP Username)</label>
      <input type="email" class="form-control" id="smtp_user" name="smtp_user" required>
    </div>

    <div class="mb-3">
      <label for="smtp_pass" class="form-label">كلمة المرور (أو App Password)</label>
      <input type="password" class="form-control" id="smtp_pass" name="smtp_pass" required>
    </div>

    <div class="mb-3">
      <label for="from_name" class="form-label">اسم المرسل (يظهر في البريد)</label>
      <input type="text" class="form-control" id="from_name" name="from_name" value="الماندجر" required>
    </div>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary btn-lg">🚀 إرسال الرسائل الآن</button>
    </div>

  </form>
</div>

<footer>
  <p>جميع الحقوق محفوظة © <strong>الماندجر - إلياس للتطوير وحلول الويب</strong> <?= date('Y'); ?></p>
</footer>

</body>
</html>
