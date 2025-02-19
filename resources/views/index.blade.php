<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel with Vue</title>
    <!-- Load CSS and JS using Vite -->
    @vite(['resources/js/app.js'])
</head>
<body>
<div id="app">

{{--    <product-list-component></product-list-component>--}}
    <product-index-component></product-index-component>
</div>
</body>
</html>
