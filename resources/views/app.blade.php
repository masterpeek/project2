<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <meta charset="UTF-8">
    <title>App Name</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">NMsurvival</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="">หน้าแรก</a>
                <a class="mdl-navigation__link" href="">แผนที่คุณภาพเสียงและอากาศ</a>
                <a class="mdl-navigation__link" href="">เกี่ยวกับ</a>
                <a class="mdl-navigation__link" href="">ติดต่อ</a>
            </nav>
        </div>
    </header>

    @yield('content')

</div>
</body>
</html>