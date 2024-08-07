<?php

    //variable for sending data back to webpage
    $info = (Object)[];

    //generating data for binding
    $data = false;
    

    //user is logged in
    $data['userid'] = $_SESSION['userid'];
    
    
    //validations
    if($Error == ""){
        $query = "select * from users where user_id = :userid limit 1 ";
        $result = $DB ->read($query, $data);
        
        if(is_array($result)){
            $result = $result[0];
            $result->data_type = "user_info";

            // check if image exists
            $image = ($result->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
            if(file_exists($result->image)){
                $image = $result->image;
            }
            $result->image = $image;
            echo json_encode($result);
        }else{
            
            $info->message = "User does not exist. Incorrect email id !";
            $info->data_type = "error";
            echo json_encode($info);
        }
    }else{
        
        $info->message = $Error;
        $info->data_type = "error";
        echo json_encode($info);
    }