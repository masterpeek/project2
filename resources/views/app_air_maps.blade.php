<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>App Name</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">เว็บไซต์แสดงมลพิษทางเสียงเเละอากาศ</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="{{ url('/') }}">หน้าแรก</a>
                <a class="mdl-navigation__link" href="{{ url('/about') }}">เกี่ยวกับ</a>
                <a class="mdl-navigation__link" href="{{ url('/contact') }}">ติดต่อ</a>
            </nav>
        </div>

        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="{{ url('/') }}" class="mdl-layout__tab">แผนที่คุณภาพเสียงและอากาศ</a>
            <a href="{{ url('/index_weather') }}" class="mdl-layout__tab">สถานีวัดคุณภาพอากาศ</a>
            <a href="{{ url('/index_report_noise') }}" class="mdl-layout__tab">รายงานมลพิษทางเสียง</a>
            <a href="{{ url('/index_report_air') }}" class="mdl-layout__tab is-active">รายงานมลพิษทางอากาศ</a>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">เว็บไซต์แสดงมลพิษทางเสียงเเละอากาศ</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{ url('/') }}">หน้าแรก</a>
            <a class="mdl-navigation__link" href="{{ url('/about') }}">เกี่ยวกับ</a>
            <a class="mdl-navigation__link" href="{{ url('/contact') }}">ติดต่อ</a>
        </nav>
    </div>

    <main class="mdl-layout__content">


        @yield('content')


    </main>
</div>
</body>
</html>