<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>contact form</title>
    <!--css style sheet-->
    <link rel="stylesheet" href="style.css" />
  
    <!---------------------------Font awesome icons-------------------------->
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>/css/all.css" media="all" />

</head>

<body>
<div class="container">
<h1>Email Form</h1>
<p>Feel free to email us and we will get back to you soon as we can</p>

<form action="email.php" method="POST">

<label for="name">Name:</label>
<input type="text" name="name" id="name" value="" />

<label for="email">Email:</label>
<input type="text" name="email" id="email" value="" />

<label for="subject">Subject:</label>
<input type="text" name="subject" id="subject" value="" />

<label for="message">Message:</label>
<textarea type="text" name="message" cols="30" rows="10"></textarea>

<input type="submit" value="Send" name="submit"/ >
</form>
</div>

</body>
</html>