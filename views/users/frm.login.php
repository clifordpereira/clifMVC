<?php echo $success_message; ?>

<div class="login-box">

  <div class="login-logo">
    User Login 
  </div>
  <!-- /.login-logo -->

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
<?php 
  $action_url = "users/login";
?>
	  <form method="post" action="<?= $action_url; ?>">

        <div class="input-group mb-3">
    	  <input class="form-control" type="text" name="username" value="" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
    	<span class="error"> <?php echo @$usernameErr; ?></span>

        <div class="input-group mb-3">
    	  <input class="form-control" type="password" name="password" value="" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
  			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="LoginUser">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>    
    <!-- /.login-card-body -->

  </div>
</div>
<!-- /.login-box -->