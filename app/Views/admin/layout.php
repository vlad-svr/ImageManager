<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="/images/logo.png">
  <link href="https://fonts.googleapis.com/css?family=Spectral+SC&display=swap" rel="stylesheet">
  <title>ImageResource</title>
  <link rel="stylesheet" href="/css/bootstrap.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="wrap h-100 d-flex">
        <div class="container-fluid h-100 p-0 d-flex flex-column">
            <?=$this->insert('admin/template/header')?>
            <?=$this->insert('admin/template/aside')?>
            <?=$this->section('content')?>
            <?=$this->insert('admin/template/footer')?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>