<?php echo $success_message; ?>

<div class="page-header">
  <h2><?php echo $subtitle; ?> </h2>
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

  <input type="hidden" name="updateid" value="<?php echo @$updateid; ?>">
  <!-- <input type="hidden" name="deleteid" value="<?php echo @$deleteid; ?>"> -->

  <div class="form-group">
    <label for="username">* Username </label>
    <input class="form-control" type="text" name="username" value="<?= @$user->username; ?>" 
      <?php if (!empty($_GET['editid'])) echo "readonly"; ?> 
    > <!-- to display readonly in case of changing password -->
  </div>

  <div class="form-group">
    <label for="password">* Password </label>
    <input class="form-control" type="password" name="password" value="">
  </div> 

<!-- Confirm password should be handled by javascript -->
  <div class="form-group">
    <label for="confirm_passord"> Confirm Password </label>
    <input class="form-control" type="password" name="confirm_passord" value="">
  </div>

  <button type="submit" class="btn btn-primary" name="save" value="SaveUser">Submit</button>
</form>
