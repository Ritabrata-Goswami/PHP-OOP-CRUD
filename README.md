# PHP-OOP-CRUD
The function.php file contains all the crud function inside crud_api class object. That class contains four public property of db connection i.e. host,username,password and db_name.
In each of the file where DML operations are taking place the crud_api class object has to be declare using 'new' keyword and all those 4 connection property as argument i.e. (host,username,password and db_name).
Once the connection has established you can call those DML function into this DML scripts. Only have to do is call the Store Procedure with argument's inside that finction and pass it to function.php. The result will be comback as return statement from those function. Here function.php is acting as a controller file just we use in MVC frameworks such as Laravel.
