<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <!-- <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" height="30" alt="Logo"></a> -->
            <!-- <a class="navbar-brand hidden" href="{{ url('/') }}"><img src="{{ url('/images/logo-s.png') }}" alt="Logo"></a> -->
            <a class="navbar-brand" href="{{ url('/') }}">東原堆高機</a>
            <a class="navbar-brand hidden" href="{{ url('/') }}">Co.</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ url('/fixedManage') }}"> <i class="menu-icon fa fa-book"></i>維修單管理</a>
                </li>
                <li>
                    <a href="{{ url('/PartManage') }}"> <i class="menu-icon fa fa-wrench"></i>材料管理</a>
                </li>
                <li>
                    <a href="{{ url('/model1') }}"> <i class="menu-icon fa fa-wrench"></i>機種管理</a>
                </li>
                <li>
                    <a href="{{ url('/model2') }}"> <i class="menu-icon fa fa-wrench"></i>引擎管理</a>
                </li>
                <li>
                    <a href="{{ url('/customerManagement') }}"> <i class="menu-icon fa fa-user"></i>客戶管理</a>
                </li>
                <li>
                  <a href="{{ url('/generalInformation') }}">  <i class="menu-icon fa fa-gears"></i>帳號設置</a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}"> <i class="menu-icon fa fa-sign-out"></i>登出 </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
