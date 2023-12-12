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
	    }  else {
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

<!-- Message for success -->
<div class="alert alert-warning alert-success fs-5" role="alert" style="display: none;">
  <b>Success: </b> Your data has been updated,  please check at read page at navbar.
</div>

<!-- Message for error -->
<div class="alert alert-danger alert-error fs-5" role="alert" style="display: none;">
  <b>Failed: </b> Sorry, you have an problem: <br><br><code><span class='alert-error-data'>Oops! Something went wrong. Please try again later.</span></code>
</div>

<form>
  <div class="form-group">
    <label for="readID">ID</label>
    <input type="text" name="id" class="form-control disabled" id="readID" aria-describedby="idHelp" value="<?= $data['id']; ?>" readonly>
    <small id="idHelp" class="form-text text-muted">Random data persons, only for update.</small>
  </div>
  <div class="form-row">
    <div class="col">
      <div class="form-group">
        <label for="inputFirstName">Firts Name</label>
        <input type="text" name="first_name" class="form-control" id="inputFirstName" <?= ($data === NULL) ? 'disabled' : 'value="'.$data['first_name'].'"'; ?> required>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="inputLastName">Last Name</label>
        <input type="text" name="last_name" class="form-control" id="inputLastName" <?= ($data === NULL) ? 'disabled' : 'value="'.$data['last_name'].'"'; ?> required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" <?= ($data === NULL) ? 'disabled' : 'value="'.$data['email'].'"'; ?> required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

	<div class="custom-control custom-switch mb-3">
	  <input type="checkbox" class="custom-control-input" id="checkActive" <?php if($data === NULL){ echo 'disabled="disabled"'; } else { echo ($data['active']) ? 'checked' : ''; } ?>>
	  <label class="custom-control-label" for="checkActive">Active</label>
	</div>

  <button type="button" class="btn btn-block btn-warning <?= ($data === NULL) ? 'disabled" disabled' : 'id="delete"' ?> id="update">Update</button>
</form>


<script>
  $('#update').click(function(){

   var isValid = true;
    // dataForm
    var first_name = $('#inputFirstName').val();
    var last_name  = $('#inputLastName').val();
    var email      = $('#inputEmail').val();
    var active     = $('#checkActive').is(':checked');

    // Email validation
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (first_name == '') {
      $('#inputFirstName').addClass('is-invalid'); isValid = false;
    }
    if (last_name == '') {
      $('#inputLastName').addClass('is-invalid'); isValid = false;
    }
    if (email == '' || regex.test(email) !== true) {
      $('#inputEmail').addClass('is-invalid'); isValid = false;
    }

    if (isValid) {

      // AJAX Method
      $.post("config/functions/update.php", {
        id: $('#readID').val(),
        first_name: first_name,
        last_name: last_name,
        email: email,
        active: active
      }, function(data, status){
        if (data == 'Records were updated successfully'){
          $('.alert-error').hide();
          $('.alert-success').fadeIn().delay(2500).fadeOut();
        } else {
          $('.alert-error-data').text(data);
          $('.alert-error').fadeIn();
        }
      });

    }

  });

  // Clear warning
  $('.form-control').click(function(){
    $(this).removeClass('is-invalid');
  })

</script>