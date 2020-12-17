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
        <link rel="shortcut icon" href="/images/favicon/favicon.ico">
        <link rel="icon" sizes="16x16 32x32 64x64" href="/images/favicon/favicon.ico">
        <link rel="icon" type="image/png" sizes="196x196" href="/images/favicon/favicon-192.png">
        <link rel="icon" type="image/png" sizes="160x160" href="/images/favicon/favicon-160.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96.png">
        <link rel="icon" type="image/png" sizes="64x64" href="/images/favicon/favicon-64.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16.png">
        <link rel="apple-touch-icon" href="/images/favicon/favicon-57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/favicon-114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/favicon-72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/favicon-144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/favicon-60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/favicon-120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/favicon-76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/favicon-152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/favicon-180.png">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="/images/favicon/favicon-144.png">
        <meta name="msapplication-config" content="/browserconfig.xml">

        <!-- CSS/JS -->
        <script src="/js/adblocker.js"></script>
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