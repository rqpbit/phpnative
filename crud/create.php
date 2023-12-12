<!-- Message for success -->
<div class="alert alert-warning alert-success fs-5" role="alert" style="display: none;">
  <b>Success: </b> Your data has been created,  please check at read page at navbar.
</div>
<!-- Message for error -->
<div class="alert alert-danger alert-error fs-5" role="alert" style="display: none;">
  <b>Failed: </b> Sorry, you have an problem: <br><br><code><span class='alert-error-data'>Oops! Something went wrong. Please try again later.</span></code>
</div>

<form>
  <div class="form-row">
    <div class="col">
      <div class="form-group">
        <label for="inputFirstName">Firts Name</label>
        <input type="text" name="first_name" class="form-control" id="inputFirstName" required>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="inputLastName">Last Name</label>
        <input type="text" name="last_name" class="form-control" id="inputLastName" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="custom-control custom-switch mb-3">
    <input type="checkbox" class="custom-control-input" id="checkActive" checked>
    <label class="custom-control-label" for="checkActive">Active</label>
  </div>
  <button type="button" class="btn btn-block btn-success" id="create">Create</button>
</form>


<script>

  // Validation
  $('#create').click(function(){

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
      $.post("config/functions/create.php", {
        first_name: first_name,
        last_name: last_name,
        email: email,
        active: active
      }, function(data, status){
        if (data == 'Records inserted successfully.'){
          $('.alert-success').fadeIn().delay(2500).fadeOut();
          $('.form-control').val('');
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