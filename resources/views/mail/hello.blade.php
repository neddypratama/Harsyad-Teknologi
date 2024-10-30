<!-- resources/views/mail/hello.blade.php -->
<h1>New Form Submission</h1>
<p><strong>Name:</strong> {{ $formData['form_name'] }}</p>
<p><strong>Email:</strong> {{ $formData['email'] }}</p>
<p><strong>Phone:</strong> {{ $formData['no_telp'] }}</p>
<p><strong>Description:</strong> {{ $formData['form_description'] }}</p>
