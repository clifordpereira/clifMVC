<div class="page-header">
  <h2><?php echo @$subtitle; ?> </h2>
</div>

<div class="card">

	<div class="card-header">
	    <a href="users/add" class="btn btn-primary"> + Add New </a>
	</div>
	<!-- /.card-header -->

	<div class="card-body">
	  <table id="datatable" class="table table-bordered table-striped">

	    <thead>
	      <tr>
     			<th> Username </th> 
     			<th> Md5Pw </th> 
     			<th> FirstName </th> 
     			<th> LastName </th> 
     			<th> Category </th> 
     			<th> RegisteredOn </th> 
	     		<th> Edit </th>
	     		<th> Delete </th>
	    	</tr>
	    </thead>

	    <tbody>
	      <?php
	      if (!empty($users)) {
	        foreach ($users as $row) {        
	            echo "<tr>";
            	echo "<td>". $row->username . "</td>";
            	echo "<td>". $row->md5_pw . "</td>";
            	echo "<td>". $row->first_name . "</td>";
            	echo "<td>". $row->last_name . "</td>";
            	echo "<td>". $row->category . "</td>";
            	echo "<td>". $row->registered_on . "</td>";
	            echo '<td><a href="users/edit/' . $row->id . '" class="btn btn-warning btn-xs" role="button">Edit</a></td>';
	            echo '<td><a href="users/delete/' . $row->id . '" class="btn btn-danger btn-xs" role="button" onclick="return confirm(\'Do you really want to delete it?\')">X</a></td>';
	            echo "</tr>";     
	        }//endof while
	      } else {
	        // echo "objStatement is null";
	      }
	    	?>
      </tbody>

      <tfoot>
      	<tr>
     		<th> Username </th> 
     		<th> Md5Pw </th> 
     		<th> FirstName </th> 
     		<th> LastName </th> 
     		<th> Category </th> 
     		<th> RegisteredOn </th> 
     		<th> Edit </th>
     		<th> Delete </th>
      	</tr>
      </tfoot>

    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->