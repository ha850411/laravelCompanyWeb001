@extends('admin.layout.layoutForSign')

@section('style')
@endsection


@section('content')
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo mt-5">
                <a href="{{url('/login')}}">
                    <!-- <img class="align-content" src="{{ asset('/admin/images/logo.png')}}" alt=""> -->
                    <h2 class="font-weight-bold">東原堆高機</h2>
                </a>
            </div>
            <div class="login-form">

                <form action="./login" method="POST" id="loginform">
                  {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" id="account" name="account" class="form-control" placeholder="帳號">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="密碼">
                        </div>
                    </div>
                    <!-- {!!  Captcha::display() !!} -->
                    {{--<div class="verification_code" style="background-image:url('{{url('/')}}/images/features/robot.png')"></div>--}}

                </form>
                <button onclick="checkform()" class="btn btn-success btn-flat m-b-30 m-t-30">登入</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    function checkform() {

        var chksubmit = false;

        var account = $('#account').val();
        if (account == '') {
            alert("請輸入帳號!");
            return false;
        }
        var password =  $('#password').val();
        if (password == '') {
            alert("請輸入密碼!");
            return false;
        }

        // var response = grecaptcha.getResponse();
        // if (response.length == 0) {
        //     alert("請驗證!");
        //     return false;
        // } else {
        //     chksubmit = true;
        // }
        chksubmit = true;

        if(chksubmit==true)
        {
          $('#loginform').submit();
        }
        // $('#loginform').submit();

    }
</script>
@endsection
