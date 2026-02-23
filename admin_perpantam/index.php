<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Griyailmu | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="favicon.ico">
  <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="
    background: #737986;
">
<div class="login-box">
  <div class="login-logo">
    <img src="logo.png" width="100" />
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form action="cek_login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="userid" name="userid">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
 <br>
    <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <!-- <a href="#"  data-toggle='modal' data-target='#exampleModal' data-whatever='@mdo' >I forgot my password</a> -->
        </div>
        <div class="col-xs-6 ">
          <!-- <a href="operator" style="float: right;">Page Operator</a> -->
        </div>
        <!-- /.col -->
      </div>
    <!-- /.social-auth-links -->
    <br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div class="modal fade bs-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Lupa Password</h4>
      </div>
      <div class="modal-body">
              <form class='form-horizontal' method='POST' enctype='multipart/form-data' action='aksi.php?act=lupaaksi' autocomplete='off'>      
        <div class='col-sm-8'>
                <div class="form-group has-feedback" >
        <input type="text" class="form-control" name="userid" placeholder="Masukan userid">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" >
      <img src='captcha.php'>
      </div>
      <div class="form-group has-feedback">
      <input type="text" class="form-control" name="kode" placeholder="Masukan 6 Kode Diatas">
      </div>  
      </div>
                <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>                
               </form>
               </div>
               </div>
  </div>
</div>
<!-- jQuery 2.1.4 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
