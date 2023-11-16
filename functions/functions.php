<?php 
function insertAdresse( $data,$i)
{
   global $conn;
   $query = "INSERT INTO address VALUES (NULL,?,?,?,?,?)";
   if ($stmt = mysqli_prepare($conn, $query)) {
      
       mysqli_stmt_bind_param(
           $stmt,
           "sssss",
           $data['street'.$i],
           $data['street_nb'.$i],
           $data['type'.$i],
           $data['city'.$i],
           $data['zipcode'.$i]
       );

       $result = mysqli_stmt_execute($stmt);
   }
}

?>