<?php
include('function.php');

$declare_obj = new crud_api('127.0.0.1:3310','root','','e-commerce');

if(isset($_POST['submit']))
{
    $name = $_POST['enter_name'];
    $loc = $_POST['enter_loc'];
    $loc_str = implode(',',$loc);
    $photo = basename($_FILES['enter_photo']['name']);

    $target_upload_path = 'upload-photo/'.$photo;
    move_uploaded_file($_FILES['enter_photo']['tmp_name'],$target_upload_path);

    $insert = $declare_obj->data_insert("CALL insert_oops ('$name','$loc_str','$photo')");
    if($insert)
    {
        echo "<h3 style='text-align:center; color:green;'>Data inserted successfully!</h3>";
        exit();
    }
    else
    {
        echo "<h3 style='text-align:center; color:red;'>Data inserted unsuccessfully!</h3> ".mysqli_error($this->conn);
        exit();
    }
}

?>

<html>
    <head>
        <title>PHP OOP</title>
        <meta charset='utf-8'/>
    </head>
    <body>
        <h3>Insert Data Using OOP Concept</h3>
        <a href='display.php'>Go to display page</a>

        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>" enctype='multipart/form-data'>
            <div style='margin-top:15px;'>
                Enter Name:
                <input type='text' name='enter_name' placeholder='Enter your name'/>
            </div>
            <div style='margin-top:15px;'>
                Enter Location:
                <input type='checkbox' name='enter_loc[]' value='New York'> New York
                <input type='checkbox' name='enter_loc[]' value='London'> London
                <input type='checkbox' name='enter_loc[]' value='Paris'> Paris
                <input type='checkbox' name='enter_loc[]' value='Tokyo'> Tokyo
            </div>
            <div style='margin-top:15px;'>
                Upload Photo:
                <input type='file' name='enter_photo'/>
            </div>
            <div style='margin-top:20px;'>
                <input type='submit' name='submit' value='submit' style='cursor:pointer;'/>
            </div>
        </form>
    </body>
</html>