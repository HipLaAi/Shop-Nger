<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nger Shop | Login</title>
    <link rel="shortcut icon" href="images/icon.png" style="filter: hue-rotate(262deg) brightness(110%);">
    <link rel="stylesheet" href="sign/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container" id="container">
    <!-- Start Content -->
        @yield('content')
    <!-- End Content -->
</div>
</body>
</html>
@if (session('success'))
  <div class="alert alert-success">
    <script>
      alert("{{ session('success') }}");
    </script>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-success">
    <script>
      alert("{{ session('error') }}");
    </script>
  </div>
@endif



