<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-tasks"></i></a>
            <div class="header-left">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"  title="生產管理">
                        <i class="fa fa-wrench"></i>
                        <span class="count bg-primary tip">{{$count}}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="message" style="width:252px;">
                        <p class="red">您有 <span class="tip">{{$count}}</span> 個 未處理的維修單</p>
                            @foreach($tip as $kk=>$val)
                            <a class="dropdown-item media bg-flat-color-3" onclick="tipFun({{$val->id}})">
                                <span class="message media-body">
                                    <span class="name float-left">客戶名稱 : {{$val->customer}}</span>
                                    <p>上次維修日期:{{$val->createDate}}</p>
                                </span>
                            </a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <div class="d-flex align-items-center dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h5 class="mr-3 text-black-50">{{Session::get('adminUserName')}}</h5>
                    <a href="#">
                      @if(Session::get('adminUserPic')!='5be2b51b26999.png')
                        <img class="user-avatar rounded-circle" src="{{ url('/uploads') }}/{{Session::get('adminUserPic')}}" alt="User Avatar">
                      @else
                        <img class="user-avatar rounded-circle" src="{{asset('/admin/images/admin.jpg')}}" alt="User Avatar">
                      @endif
                    </a>
                </div>


                <div class="user-menu dropdown-menu">

                    <a class="nav-link" href="{{ url('/generalInformation') }}"><i class="fa fa-user mr-1"></i>基本資料</a>

                    <!-- <a class="nav-link" href="{{ url('/changePassword') }}"><i class="fa fa-cog mr-1"></i>變更密碼</a> -->

                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-power-off mr-1"></i> 登出</a>
                </div>
            </div>

            <div class="language-select dropdown" id="language-select">

                <div class="dropdown-menu" aria-labelledby="language">
                    <div class="dropdown-item">
                        <span class="flag-icon flag-icon-fr"></span>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-es"></i>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-us"></i>
                    </div>
                    <div class="dropdown-item">
                        <i class="flag-icon flag-icon-it"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

</header>
