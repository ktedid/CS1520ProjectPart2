<?php
  function submitRequest() {
    require 'connect.php';
    $conn = Connect();
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['comment']);
    $query = "INSERT into dbTable (u_name, u_email, message) VALUES('" . $name . "','" . $email . "','" . $message . "')";
    $success = $conn->query($query);

    if (!$success) {
        die("Couldn't enter data: ".$conn->error);
    }


    // alert("Thank you for contacting me!");
    //
    // function alert($msg) {
    //     echo "<script type='text/javascript'>alert('$msg');</script>";
    // }
    echo "Thank You For Contacting Me!<br>";

    $conn->close();
  }
?>
