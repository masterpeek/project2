<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style>
        .demo-card-square.mdl-card {
            width: 80%;
            height: 50%;
            margin-left: 10%;
            margin-right: 10%;
            margin-bottom: 3%;
            margin-top: 3%;

        }
        .demo-card-square > .mdl-card__title {
            background: url('../station.jpg');
            background-size: 100px;
            background-position: center;

        }

        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 15px;
            margin-bottom: 15px;
            z-index: 900;
        }

    </style>
    <meta charset="UTF-8">
    <title>App Name</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">NMsurvival</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="{{ url('/') }}">หน้าแรก</a>
                <a class="mdl-navigation__link" href="{{ url('/maps') }}">แผนที่คุณภาพเสียงและอากาศ</a>
                <a class="mdl-navigation__link" href="{{ url('/about') }}">เกี่ยวกับ</a>
                <a class="mdl-navigation__link" href="{{ url('/contact') }}">ติดต่อ</a>
            </nav>
        </div>

        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="{{ url('/') }}" class="mdl-layout__tab is-active">สถานีวัดคุณภาพอากาศ</a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="{{ url('/index_report_noise') }}" class="mdl-layout__tab">รายงานมลพิษทางเสียง</a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="" class="mdl-layout__tab"></a>
            <a href="{{ url('/index_report_air') }}" class="mdl-layout__tab">รายงานมลพิษทางอากาศ</a>
        </div>

    </header>

    <main class="mdl-layout__content">


        @yield('content')


        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer__left-section">
                <div class="mdl-logo">Title</div>
                <ul class="mdl-mini-footer__link-list">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Privacy & Terms</a></li>
                </ul>
            </div>
        </footer>
    </main>
</div>
</body>
</html>