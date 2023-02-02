<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title data-setting="{{$title}}" data-rightJoin="{{$titleContent}}">{{ $title }} {{$titleContent}}</title>
    <meta name="description" content="{{ $siteDescription }}">
    <meta name="keywords" content="{{ $siteKeywords }}">
    <meta name="author" content="Ohwofasa Andrew">
    <meta name="csrf-token" value="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="https://templates.iqonic.design/product/qompac-ui/html/dist/assets/images/favicon.ico">
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="/assets/css/core/libs.min.css">
    <!-- Flatpickr css -->
    <link rel="stylesheet" href="/assets/vendor/flatpickr/dist/flatpickr.min.css">
    <!-- qompac-ui Design System Css -->
    <link rel="stylesheet" href="/assets/css/qompac-ui.minf700.css?v=1.0.1">
    <!-- Custom Css -->
    <link rel="stylesheet" href="/assets/css/custom.minf700.css?v=1.0.1">
    <!-- Dark Css -->
    <link rel="stylesheet" href="/assets/css/dark.minf700.css?v=1.0.1">

    <!-- Customizer Css -->
    <link rel="stylesheet" href="/assets/css/customizer.minf700.css?v=1.0.1" >
    <!-- RTL Css -->
    <link rel="stylesheet" href="/assets/css/rtl.minf700.css?v=1.0.1">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    @stack('styles')
    @livewireStyles
</head>
