<?php

require 'config.php';

//expecting ?url=someurl

parse_str($_SERVER["QUERY_STRING"]);

if(isset($url) && $url) {
    $con = mysql_connect($mysql_host, $mysql_user, $mysql_pass);

    if(!$con) http_redirect($url);

    $db = mysql_select_db($mysql_db, $con);

    if(!$db) {
        mysql_close($con);
        exit;
    }

    $result = mysql_query(sprintf("INSERT INTO urls (url, created) VALUES ('%s', NOW())", mysql_real_escape_string($url)));

    $urlId = dechex(mysql_insert_id());

    mysql_close($con);

    echo $baseUrl . $urlId;
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Create URL</title>
    <style>
        body {
            font-family: Arial;
            font-size: 0.8em;
            color: #7f7f7f;
        }
        
        #form {
            width: 300px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
            border-radius: 20px;
            padding: 10px;
            box-shadow: 2px 2px 5px #888888;
            border: solid 1px #afafaf;
            text-align: center;
        }
        
        h1 {
            font-size: 1.2em;
            background-color: #afafaf;
            padding: 5px;
            margin-top: -2px;
            border-radius: 20px 20px 0px 0px;
            color: #f0f0f0;
        }
                
        input {
            border: solid 1px #afafaf;
            border-radius: 20px;
            color: #7f7f7f;
            padding: 5px;
            width: 90%;
        }
        
        button {
            border: solid 1px #afafaf;
            border-radius: 0px 0px 20px 20px;
            color: #7f7f7f;
            width: 100%;
            height: 30px;
            cursor: pointer;
        }
        
        .button {
            clear:both;
        }
    </style>
    <script>
        function submit() {
            var url = document.getElementById('url').value;
            if(url != "") window.location = window.location + "?url=" + url;
        }
    </script>
</head>
<body>
<div id="form">
    <h1>Create Short URL</h1>
    <p><input type="textbox" id="url" onkeydown="if (event.keyCode == 13) document.getElementById('submit').click()" /></p>
    <p><button id="submit" onclick="submit()">Create</button></p>
</div>
</body>
</html>