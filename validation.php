<?php
if(isset($_FILES["fileToUpload"])){
    $arr_array = $_FILES["fileToUpload"];
    //print_r($arr_array);
    $name_Arr=$arr_array['name'];
    $type_Arr=$arr_array['type'];
    $size_Arr=$arr_array['size'];
    $tmo_arr=$arr_array['tmp_name'];
    
    for($a=0; $a<count($name_Arr); $a++){
        if(validateImageSize($size_Arr[$a])){

            if(validateImageType($type_Arr[$a])){

                if(validateImageFIleExist($name_Arr[$a])){
                    upload($name_Arr[$a],$tmo_arr[$a] );
                    $image= $_FILES["fileToUpload"]["name"]; 
                    
                }
                else{
                   
                    echo "Sorry, file already exists.".'<br>';
                }
            }
            else{
                echo "Invalid Type".'<br>';
            }
        }
            else{
            echo 'Image should not more than 10mb to upload'.'<br>';
        }
    }
}



// validates the image size
function validateImageSize($arr){
    return $arr> 1000000? false:true;

}

//validates the image type
function validateImageType($arr){
    $allowed = array(
        'jpeg', 'png'
    );
    $strArray = explode("/", $arr);
    return in_array(end($strArray), $allowed)? true: false;
}

function validateImageFIleExist($arr){
        $destination = "uploads/".basename($arr);
        return (file_exists($destination))? false: true;
}

function upload($name, $tmp){
        $destination = "uploads/".basename($name);
        move_uploaded_file($tmp, $destination);
    }
    $folder = "uploads/";
    $results = scandir('uploads/');
    foreach($results as $result){
        if ($result === '.' or $result === '..') continue;
    
        if (is_file($folder . '/' . $result)){
            echo '<br>
                <div class="col-md-3">
                    <img src= "'.$folder . '/' .$result.'" alt"..." style="width:200px; height:auto;">
                </div>';
        }
    }

?>