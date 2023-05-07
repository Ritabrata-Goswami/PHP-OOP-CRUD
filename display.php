<?php
include('function.php');

$declare_obj = new crud_api('127.0.0.1:3310','root','','e-commerce');

if(isset($_GET['del_id']))
{
    $del_id = $_GET['del_id'];
    $delete = $declare_obj->delete("CALL delete_oops('$del_id')");
    if($delete)
    {
        echo "<h3 style='text-align:center; color:#ff3333;'>".$del_id." no id deleted successfully!</h3>";
        exit();
    }
    else
    {
        echo "<h3 style='text-align:center; color:#ff3333;'>delete unsuccessfully!</h3>";
        exit();
    }
}

if(isset($_GET['clear_all']))
{
    if($_GET['clear_all'] == 'all')
    {
        $truncate = $declare_obj->truncate("CALL truncate_oops");
        if($truncate)
        {
            header("Location: http://127.0.0.1/new_PHP_proj/PHP_crud_OOP/display.php");
        }
        else
        {
            echo "Table Truncate Failed! ".mysqli_error($this->conn);
            exit();
        }
    }
}
?>

<html>
    <head>
        <title>PHP OOP</title>
        <meta charset='utf-8'/>
        <style type='text/css'>
            table,tr,th,td{border:0.5px solid #000000;}
            th,td{
                padding:5px 5px;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <h3>OOP Display</h3>
        <a href='insert.php'>Go to insert page</a><br/><br/>
        <a href='display.php?clear_all=all'>Clear all data</a>

        <table style='margin-top:15px;'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>City</th>
                <th>Photo</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            $fetch = $declare_obj->data_fetch('CALL fetch_oops');

            if(mysqli_num_rows($fetch) > 0)
            {
                while($res = mysqli_fetch_array($fetch))
                {
            ?>

            <tr>
                <td><?=$res[0]?></td>
                <td><?=$res[1]?></td>
                <td><?=$res[2]?></td>
                <td><img src='upload-photo/<?=$res[3]?>' alt='image' title='image' style='width:100px; height:100px;'/></td>
                <td><a href="edit.php?edit_id=<?=$res[0]?>"><button style='cursor:pointer; color:white; background:#4d88ff;'>Edit</button></a></td>
                <td><a href="display.php?del_id=<?=$res[0]?>"><button style='cursor:pointer; color:white; background:#ff3333;'>Delete</button></a></td>
            </tr>

            <?php
                }
            }
            else
            {
            ?>

            <tr>
                <td colspan='6' style='font-size:17px; color:#ff3333;'>No Data Found!</td>
            </tr>

            <?php
            }
            ?>

        </table>
    </body>
</html>