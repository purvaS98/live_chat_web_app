<?php

    //variable for sending data back to webpage
    $info = (Object)[];
    
    //generating data for binding
    $data = false;
    $data['user_id'] = $_SESSION['userid'];
   

    //validate username 
    $data['username'] = $DATA_OBJ->username;
    if(empty($DATA_OBJ->username)){
        $Error .= "Please enter a valid username. <br>";
    }else{
        if(strlen($DATA_OBJ->username) < 5){
            $Error .= "Username must be 5 characters long. <br>";
        }
        if(!preg_match("/^[A-Z a-z]*$/", $DATA_OBJ->username)){
            $Error .= "Please enter a valid username (Only characters). <br>";
        }
    }


    $data['email'] = $DATA_OBJ->email;
    //validate email 

    if(empty($DATA_OBJ->email)){
        $Error .= "Please enter a valid email address. <br>";
    }else{
        if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)){
            $Error .= "Please enter a valid email address. <br>";
        }
    }


    $data['password'] = $DATA_OBJ->password;
    $password = $DATA_OBJ->password2;
    //validate password 
    if(empty($DATA_OBJ->password)){
        $Error .= "Please enter a password (required). <br>";
    }else{
        if($DATA_OBJ->password != $password){
            $Error .= "Passwords must match. <br>";
        }
        if(strlen($DATA_OBJ->password) < 8){
            $Error .= "Password must be 8 characters long. <br>";
        }
        
    }



    //validations
    if($Error == ""){
        $query = "update users set username = :username, email = :email, password = :password where user_id = :user_id limit 1";
        $result = $DB ->write($query, $data);
        
        if($result){
            $info->message = "Your profile was updated";
            $info->data_type = "save_settings";
            echo json_encode($info);

        }else{
            
            $info->message = "Your profile was not updated due to unexpected errors !";
            $info->data_type = "save_settings";
            echo json_encode($info);
        }
    }else{
        
        $info->message = $Error;
        $info->data_type = "save_settings";
        echo json_encode($info);
    }