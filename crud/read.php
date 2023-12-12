<table id="example" class="table table-bordered mb-5 table-hover" style="width:100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th class="text-center">Status</th>
    </tr>
  </thead>
  <tbody>

    <?php  
    // Connection 
    $link = mysqli_connect('localhost','root','', 'phpnative'); 

    // Attempt select query execution
    $sql = "SELECT * FROM persons";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    if ($row['active'] == 1) {
                      echo '<td style="font-size: 12px; padding-top: 10px;" class="text-center text-success"><i class="fa fa-circle"></i></td>';
                    } elseif ($row['active'] == 0) {
                      echo '<td style="font-size: 12px; padding-top: 10px;" class="text-center text-danger"><i class="fa fa-circle"></i></td>';
                    }
                echo "</tr>";
            }
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
     
    // Close connection
    mysqli_close($link);
    ?>

  </tbody>
</table>

<script>
$('#example').DataTable({
  "dom": '<"wrapper"flipt>'
}); // Read page only
</script>

