<?php
    $sql ="select * from users where user_id = :user_id limit 1";
    $id = $_SESSION['userid'];
    $data = $DB->read($sql,['user_id'=>$id]);
    $mydata = "";
    if(is_array($data)){
        $data = $data[0];

        // check if image exists in db
        $image = ($data->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
            if(file_exists($data->image)){
                $image = $data->image;
            }
        

            //gender logic
            $gender_female = "";
            $gender_male ="";

            if($data ->gender == "Male"){
                $gender_male ="checked";
            }
            else{
                $gender_female ="checked";
            }
        $mydata = 
        ' 
        

            <style type="text/css">
                
              
                @keyframes appear{

				0%{opacity:0;transform: translateY(50px) rotate(5deg);transform-origin:100% 100%;}
				100%{opacity:1;transform: translateY(0px) rotate(0deg);transform-origin:100% 100%;}
	 		}

           

                form{
                    text-align: left;
                    margin: auto;
                    padding: 10px;
                    width:100%;
                    max-width: 400px;
                }

                input[type=text],input[type=password],input[type=button]{

                    padding:10px;
                    margin: 10px;
                    width:200px;
                    border-radius: 5px;
                    border:solid 1px grey;
                }

                input[type=button]{
                    padding:10px;
                    width: 220px;
                    cursor: pointer;
                    background-color: #2b5488;
                    color: white;
                }

                input[type=radio]{

                    transform: scale(1.2);
                    cursor: pointer;
                }

                
                
                #error{

                    text-align: center;
                    padding: 0.5em;
                    background-color: #ecaf91;
                    color: white;
                    display: none;
                }

                .dragging{
                    border: dashed 2px #aaa;
                }

            </style>


                
            
                    
                    <div id="error" style="">Error message display div</div>
                    <div style="display: flex;animation: appear 1s ease">
                        <div>
                        Darg and drop to change image<br>
                            <img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" class="dragging" src="'.$image.'" style="width:200px;height: 200px;margin:10px;"/>
                            
                            <label for="change_image_input" id="change_image_button" style="background-color:#9b9a80;display:inline-block;padding:1em;border-radius:5px;cursor:pointer;">
                                Change Image 
                            </label>
                            <input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="background-color: orange; display:none;"><br>

                        </div>
                        <form id="myform">
                            <input type="text" name="username" placeholder="Username" value="'.$data->username.'"><br>
                            <input type="text" name="email" placeholder="Email" value="'.$data->email.'"><br>
                            <div style="padding: 10px;">
                                <br>Gender:<br>
                                <input type="radio" value="Male" name="gender" '.$gender_male.'> Male<br>
                                <input type="radio" value="Female" name="gender" '.$gender_female.'> Female<br>
                            </div>
                            <input type="password" name="password" placeholder="Password"><br>
                            <input type="password" name="password2" placeholder="Retype Password"><br>
                            <input type="button" value="Save changes" id="save_settings_button"  onclick="collect_data(event)"><br>

                            <br>
                        
                    </div>
                    </form>
                


            

    
    
    ';


    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info);

    
}else{


    $info->message = "No Contacts were found";
    $info->data_type = "error";
    echo json_encode($info);
}
?>


