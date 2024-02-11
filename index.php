<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mailer</title>
</head>

<body>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message = $_POST["message"];
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $headers = "From: $to\r\n";
    $headers .= "Reply-To: $to\r\n";


    if (mail($to, $subject, $message, $headers)) {
      echo '<script type="text/javascript">';
      echo 'alert("Your message was sent!");';
      echo 'window.location.href = "index.html";';
      echo '</script>';
    } else {
      echo '<script type="text/javascript">';
      echo 'alert("Failed to send your message!");';
      echo 'window.location.href = "index.html";';
      echo '</script>';
    }
  }
  ?>
  <h1>Send Email</h1>
  <form action="send_email.php" method="post">
    <label for="to">To:</label>
    <input type="email" name="to" required>
    <br>
    <label for="subject">Subject:</label>
    <input type="text" name="subject" required>
    <br>
    <label for="message">Message:</label>
    <textarea name="message" required></textarea>
    <br>
    <input type="submit" value="Submit" name="submit">
  </form>
</body>

</html>