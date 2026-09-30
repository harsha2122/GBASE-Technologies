<!DOCTYPE html>
<html dir="ltr" lang="zxx">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta name="description" content="{{ $page->meta_description }}" />
  <meta name="author" content="GBASE Technologies" />

  <title>{{ $page->meta_title }}</title>

  <link rel="icon" type="image/png" href="/images/logo/favicon.png" />
  <link rel="apple-touch-icon" href="/images/logo/apple-touch-icon.png" />
  <link rel="apple-touch-icon" sizes="57x57" href="/images/logo/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="/images/logo/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="/images/logo/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="/images/logo/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="/images/logo/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="/images/logo/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="/images/logo/apple-touch-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="/images/logo/apple-touch-icon-180x180.png" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&family=Questrial:wght@400;500;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/fontawesome.min.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <link rel="stylesheet" href="css/slick.min.css" />
  <link rel="stylesheet" href="css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="css/meanmenu.min.css" />
  <link rel="stylesheet" href="css/nice-select.min.css" />
  <link rel="stylesheet" href="css/animate.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="css/search.css" />
</head>
<body>
  @include('partials.header')

  @yield('content')

  @include('partials.footer')
</body>

</html>
