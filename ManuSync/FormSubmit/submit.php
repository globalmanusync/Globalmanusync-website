<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "mevinodgupta39@gmail.com";
    $subject = "New Manufacturing Requirement Submitted";

    $message = "Company Name: " . $_POST["company_name"] . "\n";
    $message .= "Project/Part Name: " . $_POST["project_name"] . "\n";
    $message .= "Existing Supplier: " . $_POST["existing_supplier"] . "\n";
    $message .= "Reason: " . $_POST["reason"] . "\n";
    $message .= "Email: " . $_POST["email"] . "\n";
    $message .= "Contact Name: " . $_POST["contact_name"] . "\n";
    $message .= "Contact Number: " . $_POST["contact_number"] . "\n";

    // Handle file upload
    $file = $_FILES['drawing'];
    $filePath = $file['tmp_name'];
    $fileName = $file['name'];

    $boundary = md5(time());
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
    $body .= $message . "\r\n";

    if (is_uploaded_file($filePath)) {
        $fileContent = chunk_split(base64_encode(file_get_contents($filePath)));
        $body .= "--{$boundary}\r\n";
        $body .= "Content-Type: application/octet-stream; name=\"{$fileName}\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"{$fileName}\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= $fileContent . "\r\n";
        $body .= "--{$boundary}--";
    }

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your requirement has been submitted.";
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>
