<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta name="viewport" content="width=device-width" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Meta for Sending links on platforms -->
        <meta name="og:url" content="{{config('app.url')}}">
        <meta name="og:title" content="@yield('title') | CapeCraft.net">
        <meta name="twitter:title" content="@yield('title') | CapeCraft.net">
        <meta name="description" name="description" content="CapeCraft is a minecraft server focussed around having a friendly community.">
        <meta name="og:description" name="description" content="CapeCraft is a minecraft server focussed around having a friendly community.">
        <meta name="twitter:description" name="description" content="CapeCraft is a minecraft server focussed around having a friendly community.">
        <meta name="twitter:image" content="{{config('app.url')}}/images/meta.jpg">
        <meta name="og:image" content="{{config('app.url')}}/images/meta.jpg">
        <meta name="fb:app_id" content="966242223397117">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@james090500">

        <!-- Google Site Verification -->
        <meta name="google-site-verification" content="nsFumLAEmn8YANJYupL8XCnCOQGcNRwQfWlgzt5pTuc" />

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="/images/favicon/site.webmanifest">
        <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/images/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/images/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <!-- CSS/JS -->
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JRB5FL81V1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-JRB5FL81V1');
        </script>
    </head>
    <body class="with-custom-webkit-scrollbars dark-mode" data-dm-shortcut-enabled="true">
        <div id="app">
            <capecraft-app/>
        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>