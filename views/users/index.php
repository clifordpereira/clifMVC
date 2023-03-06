<p>Here is a list of all users:</p>

<?php foreach($users as $user) { ?>
  <p>
    <?php echo $user->username; ?>
    <?php 
    // echo " " . $user->getLastName(); 
    ?>
    <a href='users/show/<?php echo $user->id; ?>'>See content</a>

  </p>
<?php } ?>