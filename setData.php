<?php

    // header("Content-Type:application/json");

    include("./config.php");

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data["id"];
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $gender = $data["gender"];

    $query = "insert into employee values($id,'$first_name','$last_name','$gender')";
    
    if (mysqli_query($connect,$query))
    {                
        echo json_encode(array(
            'status' => 1,
            'message' => 'data inserted successfully!',
            'data' => mysqli_affected_rows($connect)
        ), JSON_PRETTY_PRINT);
    }
    else
    {
        echo json_encode(array(
            'status' => 0,
            'message' => 'data inserted failed!',
            'data' => null
        ), JSON_PRETTY_PRINT);
    }
    mysqli_close($connect);

?>