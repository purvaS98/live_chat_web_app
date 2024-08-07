<?php

    //variable for sending data back to webpage
    $info = (Object)[];

    //generating data for binding
    $data = false;
    


    $data['email'] = $DATA_OBJ->email;
    
    if(empty($DATA_OBJ->email)){
        $Error = "Please enter a valid email address. <br>";
    }

    if(empty($DATA_OBJ->password)){
        $Error .= "Please enter a valid password. <br>";
    }



    //validations
    if($Error == ""){
        $query = "select * from users where email = :email limit 1 ";
        $result = $DB ->read($query, $data);
        
        if(is_array($result)){
            $result = $result[0];
            if($result->password == $DATA_OBJ->password){
                $_SESSION['userid'] = $result->user_id;
                $info->message = "Successfully logged in";
                $info->data_type = "info";
                echo json_encode($info);

            }else{
                $info->message = "Incorrect password";
                $info->data_type = "error";
                echo json_encode($info);
            }

           

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