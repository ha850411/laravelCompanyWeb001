<header class="header ">
    <div class="header-white ">

        <div class=" container d-flex justify-content-between">

            <div class="company d-flex align-items-center">
                <img src="{{ url('/images/logo.png') }}" alt="">
                <span class="chinese"><span class="company-name"></span><span class="company-name-r"></span></span>
                <span class="english"><span class="company-name">Benson Energy Saving Technology</span><span class="company-name-r">BEST</span></span>
            </div>

            <div class="sign d-flex align-items-center">

                <a class="admin d-flex align-items-center"><img class="svg" src="{{ asset('/images/svg/user.svg') }}"
                        alt=""><span class="d-none d-md-block">Adimn</span>
                </a>
                <a href="{{ url('/signin') }}" class="sign-in admin d-flex align-items-center">
                    <div class="d-md-none">
                        <img class="svg" src="{{ asset('/images/svg/sign-in.svg') }}" alt=""></div><span class="d-none d-md-block"><span
                            class="chinese">登出</span><span class="english">Sign out</span>
                    </span>
                </a>

                <a class=" d-flex align-items-center">
                    <span class="d-none d-lg-block">
                        <span class="chinese" id="english">EN</span>
                        <span class="english" id="chinese">中文</span>
                    </span>
                </a>
            </div>

        </div>

    </div>

    <nav class="nav ">
        <div class="container  d-flex justify-content-between">
            <ul class="menu d-flex flex-column flex-lg-row">
                <li>
                    <a class="d-flex align-items-center  justify-content-center justify-content-md-start " href="{{ url('/') }}">
                        <img class="svg" src="{{ url('/images/svg/icon.svg') }}" alt=""><span class="chinese">首頁</span><span
                            class="english">Index</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center  justify-content-center justify-content-md-start " href="{{ url('/product-login') }}">
                        <img class="svg" src="{{ url('/images/svg/briefcase-with-tick-inside.svg') }}" alt=""><span
                            class="chinese">產品登錄</span><span class="english">Product login</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center  justify-content-center justify-content-md-start " href="{{ url('/product-login-record') }}">
                        <img class="svg" src="{{ url('/images/svg/post-it.svg') }}" alt=""><span class="chinese">登錄紀錄</span><span
                            class="english">Product login record</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-items-center  justify-content-center justify-content-md-start " href="{{ url('/user-details') }}">
                        <img class="svg" src="{{ url('/images/svg/id-card.svg') }}" alt=""><span class="chinese">個人資料</span><span
                            class="english">Personal information</span>
                    </a>
                </li>
            </ul>
            <!-- <span class="d-flex align-items-center mr-0 mr-lg-5 ml-1 ml-sm-3 ml-lg-0" id="today">12月27日2018星期五</span> -->
            <div class="nav-menu-burgermenu">
                <a class="burgermenu-icon" href="#">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
            </div>
            <a class=" d-flex align-items-center">
                    <span class="d-lg-none">
                        <span class="chinese" id="english_r">EN</span>
                        <span class="english" id="chinese_r">中文</span>
                    </span>
                </a>

        </div>

    </nav>
</header>
