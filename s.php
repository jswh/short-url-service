<?php
require('./lib.php');
$conn = linkDb();
$origin = $_POST['origin'];
$sql = "insert into {$table} (`origin`) values ('{$origin}')";
if (!mysql_query($sql, $conn)) {
    abort(500, "insert failed: $sql");
}
$id = mysql_insert_id();
$code = codeTrans($id, $chars);
$url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $code;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $url;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            h1{text-align:center;color:#333;}
            a{text-decoration:none;color:#5ab1f3;margin-left:5px;}
        </style>
    </head>
    <body>
        <h1>Short Url: <a href="<?php echo $url; ?>"><?php echo $url; ?></a></h1>
    </body>
</html>

