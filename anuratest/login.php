<?php 
  session_start();
  $url = explode('/', $_SERVER['PHP_SELF']);
  //check if logged in
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
    echo '<script>window.location.replace("/'.$url[1].'/");</script>';
    exit;
  }

  $un = '';
  $incorrectPass = false;
  if(isset($_POST['username'], $_POST['password']) && $_POST['username'] != '' && $_POST['password'] != '') {
    $un = $_POST['username'];
    if($_POST['username'] == 'anuraadmin' && $_POST['password'] == 'le@mE*1IN') {
      $_SESSION['logged_in'] = 1;
      echo '<script>window.location.replace("/'.$url[1].'/");</script>';
      exit;
    }else $incorrectPass = true;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anura Statistics</title>

    <!-- Bootstrap -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .error_label{color: #a94442;}
      .error_field{border:1px solid #a94442;}
      table td { word-wrap: break-word; }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-md-4" style="margin: 0 auto;float: none;">
        <div class="panel panel-default" style="margin-top: 70px;">
          <div class="panel-heading">Anura Statistics</div>
          <div class="panel-body">
            <form method="post" action="">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="username" class="form-control" name="username" placeholder="Username" value="<?= $un?>" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              </div>
              <?php 
              if($incorrectPass) :
              ?>
                <p class="bg-danger text-danger text-right" style="padding: 10px;">
                  <em>
                    <strong>Login Error!</strong> Incorrect Credentials
                  </em>
                </p>
              <?php endif; ?>
              <button type="submit" class="btn btn-default pull-right">Log In</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="../js/jquery-1.11.1.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>