<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/template/style.css') }}">
  </head>
  <style>
    .img-regis{
      max-width: 50%;
    }
    .opt{
        width: 50%;
        position: relative;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    .opt > label {
        width: 80%;
    }
    .opt > input {
        width: 20%;
        transform: translateX(55px) translateY(-2px);
    }
    .opt-border-l {
        height: 40px;
        border: 1px solid #79bfe5;
        text-align: center;
        border-radius: 10px 0px 0px 10px;
    }
    .opt-border-r {
        height: 40px;
        border: 1px solid #79bfe5;
        text-align: center;
        border-radius: 0px 10px 10px 0px;
    }
  </style>
<body>
<div class="main">
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" action="{{ url('/register') }}" id="register-form">
                      {{csrf_field()}}
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" required/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" class="form-submit"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('/images/logo-EPSI.png') }}" class="img-regis"></figure>
                    <a href="{{ url('/login') }}" class="signup-image-link"><u>I am already member</u></a>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="{{ asset('/js/sweetalert2.all.js') }}"></script>
<script src="{{ asset('/js/template/main.js') }}"></script>
<script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script>
@if(session()->has('error'))

swal({
  position: 'top-end',
  type: 'error',
  title: "{{session()->get('error')}}",
  showConfirmButton: false,
  timer: 1500
})
@endif

$('#opt1').click(function() {
    $('#role1').prop('checked', true);
    $('#role2').prop('checked', false);

});

$('#opt2').click(function() {
    $('#role2').prop('checked', true);
    $('#role1').prop('checked', false);

});
</script>
</body>
</html>
