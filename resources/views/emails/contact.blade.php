<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Contact Form Submission</h1>
    <p><strong>Name:</strong> {{ $contactForm->name }}</p>
    <p><strong>Email:</strong> {{ $contactForm->email }}</p>
    <p><strong>Subject:</strong> {{ $contactForm->subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contactForm->message }}</p>
</body>
</html>