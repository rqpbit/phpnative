 <?php  
	// Connection and Helper
	$link = mysqli_connect('localhost','root','', 'phpnative'); 
  require_once('../config/helper.php');


	// Attempt select query execution
	$sql = "SELECT * FROM persons";
	if($result = mysqli_query($link, $sql)){
	    if(mysqli_num_rows($result) > 0){
	        while($row = mysqli_fetch_assoc($result)){
	            $data[] = $row;
	        }
	        // Free result set
	        mysqli_free_result($result);
	    } else {
          $data = NULL;
	    }
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
	 
	// Close connection
	mysqli_close($link);

  if ($data != NULL) {
	 
    $data = $data[array_rand($data)];

  } else {
?>

      <div class="alert alert-info fs-5" role="alert">
        <b>Warning: </b> Belum ada data untuk saat ini, silahkan masukan pada menu create.
      </div>

<?php  
	}
?>

<!-- Message for error -->
<div class="alert alert-danger alert-error fs-5" role="alert" style="display: none;">
  <b>Failed: </b> Sorry, you have an problem: <br><br><code><span class='alert-error-data'>Oops! Something went wrong. Please try again later.</span></code>
</div>

<form>
  <div class="form-group">
    <label for="readID">ID</label>
    <input type="text" name="id" class="form-control" id="readID" aria-describedby="idHelp" value="<?= $data['id']; ?>" readonly>
    <small id="idHelp" class="form-text text-muted">Random data persons, only for delete.</small>
  </div>
  <div class="form-row">
    <div class="col">
      <div class="form-group">
        <label for="inputFirstName">Firts Name</label>
        <input type="text" class="form-control" id="inputFirstName" value="<?= $data['first_name']; ?>" readonly>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="inputLastName">Last Name</label>
        <input type="text" class="form-control" id="inputLastName" value="<?= $data['last_name']; ?>" readonly>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" value="<?= $data['email']; ?>" readonly>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
	<div class="custom-control custom-switch mb-3">
	  <input type="checkbox" class="custom-control-input" id="checkActive" <?= ($data['active']) ? 'checked' : ''; ?> disabled="disabled">
	  <label class="custom-control-label" for="checkActive">Active</label>
	</div>

  <button type="button" class="btn btn-block btn-danger <?= ($data === NULL) ? 'disabled" disabled' : '" id="delete"'; ?>>Delete</button>
</form>


<script>
  $('#delete').click(function(){

  	var ask = confirm('Are you sure you want to delete this data?');

    if (ask) {
      // AJAX Method
      $.post("config/functions/delete.php", {
        id: $('#readID').val(),
      }, function(data, status){
        if (data == 'Records were deleted successfully'){
          $('.nav-link[page="delete"]').removeClass('active');
          $('.nav-link[page="read"]').addClass('active');
          $.get("crud/read.php", function(html_string){
            $('#content').html(html_string);
          },'html'); 
        }
      });
    }
    

  });
</script>