<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . $host;

echo '<base href="' . $base_url . '/client/pages/coordenador/">'; 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DWR | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="login-logo">
          <a href="index.html"><b>Drogaria</b>WR Coordenador(a)</a>
        </div>
        <hr>

        <form action="index.html" method="post">
          <div class="input-group mb-3">
            <input type="email" id="email_usuario" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="senha_usuario" class="form-control" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <hr>
          <div class="row mb-4 col-10 mx-auto">
            <!-- /.col -->
            <div class="col-6 mx-auto">
              <button type="submit" id="btn-login" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt" id="icon-login"></i> Entrar
              </button>
            </div>
            <div class="col-6 mx-auto">
              <a type="submit" href="../" class="btn btn-danger btn-block">
                <i class="fas fa-sign-out-alt" id="icon-login"></i> Voltar
              </a>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>

  <!-- SCRIPT -->
  <script src="../../assets/js/coordenador/auth.js"></script>
  <!-- SCRIPT END -->
</body>

</html>