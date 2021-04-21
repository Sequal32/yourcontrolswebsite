<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/icon.png" type="image/png">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" id="bootstrapCSS">
    @if (isset($pageTitle))
    <title>{{$pageTitle}} | title</title>
    @else
    <title>title</title>
    @endif
    
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <style>
      html, body {
        width: 100%;
        height: 100%;
        font-family: 'Comfortaa', cursive;
      }
      * {
        padding: 0;
        margin: 0;
      }
    </style>
  </head>
  <body>
    @inertia
  </body>
</html>