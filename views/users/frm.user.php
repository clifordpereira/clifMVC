<?php echo @$success_message; ?>

<div class="page-header">
  <h2><?php echo @$subtitle; ?> </h2>
</div>

 <?php $action_url = "users/save" ?>			
<form method="post" action="<?= $action_url; ?>" >
	<div class="form-group">
		<label for="username">* Username </label>
		<input class="form-control" type="text" name="username" value="<?= @$user->username; ?>" >
	</div>

	<div class="form-group">
		<label for="md5_pw">* Md5Pw </label>
		<input class="form-control" type="text" name="md5_pw" value="<?= @$user->md5_pw; ?>" >
	</div>

	<div class="form-group">
		<label for="first_name">* FirstName </label>
		<input class="form-control" type="text" name="first_name" value="<?= @$user->first_name; ?>" >
	</div>

	<div class="form-group">
		<label for="last_name">* LastName </label>
		<input class="form-control" type="text" name="last_name" value="<?= @$user->last_name; ?>" >
	</div>

	<div class="form-group">
		<label for="category">* Category </label>
		<input class="form-control" type="text" name="category" value="<?= @$user->category; ?>" >
	</div>

	<div class="form-group">
		<label for="registered_on">* RegisteredOn </label>
		<input class="form-control" type="text" name="registered_on" value="<?= @$user->registered_on; ?>" >
	</div>
	

	<input type="hidden" name="child_id" value="<?= @$user->id; ?>" >

	<button type="submit" class="btn btn-primary" name="action" value="SaveUser">Submit</button>
</form>