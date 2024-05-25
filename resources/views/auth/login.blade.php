<html>
  <head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-21YBHJZTW5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'G-21YBHJZTW5');
    </script>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/template/style.css') }}">
  </head>
  <style>
    .img-login{
      max-width: 55%;
    }
  </style>
<body>
<div class="main">
      <!-- Sing in  Form -->
      <section class="sign-in">
          <div class="container">
              <div class="signin-content">
                  <div class="signin-image">
                      <figure><img src="{{ asset('/images/logo-EPSI.png') }}" class="img-login"></figure>
                      <a href="{{ url('/register') }}" class="signup-image-link"><u>Create an account</u></a>
                  </div>

                  <div class="signin-form">
                      <h2 class="form-title">Sign i</h2>
                      <form method="POST" class="register-form" action="{{ url('/login') }}" id="login">
                      {{csrf_field()}}
                          <div class="form-group">
                              <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                              <input type="email" name="email" id="email" placeholder="Your Email"/>
                          </div>
                          <div class="form-group">
                              <label for="password"><i class="zmdi zmdi-lock"></i></label>
                              <input type="password" name="password" id="password" placeholder="Password"/>
                          </div>
                          <div class="form-group form-button">
                              <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                          </div>
                      </form>
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
@if(session()->has('success'))
swal({
  position: 'top-end',
  type: 'success',
  title: "{{session()->get('success')}}",
  showConfirmButton: false,
  timer: 1500
})
@endif
</script>
</body>
</html>
