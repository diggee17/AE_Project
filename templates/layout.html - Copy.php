<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="ae.css"> -->
   <link rel="stylesheet" href="/CMS/css/jquery.datetimepicker.min.css">

<title><?=$title?></title>
  </head>
  <body>
  <nav>
    <header>
      <h1> Academic Excellence Database</h1>
    </header>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?controller=admin&amp;action=list">Admin List</a></li>
      <!-- <li><a href="index.php?action=edit">Add a new Admin</a></li> -->
      <li><a href="index.php?controller=admin&amp;action=edit">Add a new Admin</a></li>
      <li><a href="index.php?controller=tutor&amp;action=list">Tutor List</a></li>
      <li><a href="index.php?controller=tutor&amp;action=edit">Add a new Tutor</a></li>
    </ul>
  </nav>

  <main>
  <?=$output?>
  </main>

  <footer>
  &copy; AEDB 2023
  </footer>
  </body>
</html>