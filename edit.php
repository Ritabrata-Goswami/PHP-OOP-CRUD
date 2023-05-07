<?php
include('function.php');

$declare_obj = new crud_api('127.0.0.1:3310','root','','e-commerce');

if(isset($_GET['edit_id']))
{
    $edit_id=$_GET['edit_id'];
    $fetch_edit_data = $declare_obj->get_edit("CALL edit_fetch_oops('$edit_id')");
    $edit_res = mysqli_fetch_array($fetch_edit_data);
}

if(isset($_POST['submit']))
{
    $name = $_POST['enter_name'];
    $loc = $_POST['enter_loc'];
    $loc_str = implode(',',$loc);
    $photo = basename($_FILES['enter_photo']['name']);
    $save_edit_id = $_POST['get_id'];
    $default_photo = $_POST['get_default_photo'];

    if($photo == '')
    {
        $edit_save_data_without_upload = $declare_obj->save_edit("CALL edit_save_oops('$save_edit_id','$name','$loc_str','$default_photo')");
        if($edit_save_data_without_upload)
        {
            echo "<h3 style='text-align:center; color:green;'>Update Successful!</h3>";
            exit();
        }
        else
        {
            echo "<h3 style='text-align:center; color:red;'>Update unsuccessfully!</h3> ".mysqli_error($this->conn);
            exit();
        }
    }
    else
    {
        $target_upload_path = 'upload-photo/'.$photo;
        move_uploaded_file($_FILES['enter_photo']['tmp_name'],$target_upload_path);

        $edit_save_data_with_upload = $declare_obj->save_edit("CALL edit_save_oops('$save_edit_id','$name','$loc_str','$photo')");
        if($edit_save_data_with_upload)
        {
            echo "<h3 style='text-align:center; color:green;'>Update Successful!</h3>";
            exit();
        }
        else
        {
            echo "<h3 style='text-align:center; color:red;'>Update unsuccessfully!</h3> ".mysqli_error($this->conn);
            exit();
        }
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
                <input type='text' name='enter_name' placeholder='Enter your name' value="<?=$edit_res[1]?>"/>
            </div>
            <div style='margin-top:15px;'>
                Enter Location:
                <input type='checkbox' name='enter_loc[]' value='New York' <?=(in_array('New York',explode(',',$edit_res[2])))?"checked":""?>> New York
                <input type='checkbox' name='enter_loc[]' value='London' <?=(in_array('London',explode(',',$edit_res[2])))?"checked":""?>> London
                <input type='checkbox' name='enter_loc[]' value='Paris' <?=(in_array('Paris',explode(',',$edit_res[2])))?"checked":""?>> Paris
                <input type='checkbox' name='enter_loc[]' value='Tokyo' <?=(in_array('Tokyo',explode(',',$edit_res[2])))?"checked":""?>> Tokyo
            </div>
            <div style='margin-top:15px;'>
                Upload Photo:
                <input type='file' name='enter_photo'/>
                <input type="text" name="get_id" value="<?=$edit_res[0]?>" hidden/>
                <input type="text" name="get_default_photo" value="<?=$edit_res[3]?>" hidden/>
            </div>
            <div style='margin-top:20px;'>
                <input type='submit' name='submit' value='submit' style='cursor:pointer;'/>
            </div>
        </form>
    </body>
</html>