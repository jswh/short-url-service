<?php
require('./lib.php');
$code = ltrim($_SERVER['REQUEST_URI'], '/');
if ($code) {
    $conn = linkDb();
    $id = codeRevert($code, $chars);
    $sql = "select origin from {$table} where id = {$id}";
    $result = mysql_query($sql, $conn);
    $data = mysql_fetch_assoc($result);
    if (!$data) abort(404);
    else header('Location:' . $data['origin'], true, 302);
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>j-service:short url</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        #url {
            display: block;
            width: 50%;
            margin: auto;
            height: 34px;
            padding: 0px 1em;
            font-size: 14px;
            line-height: 1.42857143;
            color: #222;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }

        button {
            width:30%;
            margin: 2em auto 0 auto;
            color: #333;
            background-color: #fff;
            display: block;
            padding: 6px 1em;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button:hover{
            background-color: #e6e6e6;
            border-color: #adadad;
        }
        h1{
            text-align: center;
            margin: 1em 0 2em 0;
        }
    </style>
</head>

<body>
<a href="https://github.com/jswh/short-url-service"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/52760788cde945287fbb584134c4cbc2bc36f904/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f77686974655f6666666666662e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png"></a>
    <h1>Get A Short Url</h1>
    <form action="_s" method="POST">
        <input type="text" id="url" name="origin" value="" placeholder="origin url">
        <button type="submit">get</button>
    </form>
</body>

</html>
