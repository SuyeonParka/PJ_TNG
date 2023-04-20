<?php

define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
define( "URL_DB", DOC_ROOT."src/common/db_common.php" );

include_once( URL_DB );

$http_method = $_SERVER["REQUEST_METHOD"];

if( $http_method === "POST")
{
    $arr_post = $_POST;

    $result_cnt = todo_insert_recom_routine( $arr_post );

    header( "Location: todo_list.php" );
    exit();
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert page</title>
    <link rel="stylesheet" href="./css/todo_insert.css">
</head>
<body>
    <div class="container">
            <div class="logo">
                <img id="logo" src="./common/img/logo.png" alt="logo">
            </div>

            <div class = "phase">
                <p>What do </p> 
                <p>you want to do?</p>
            </div>

        <form action="todo_insert.php" method="post">
            <div class="contents">
                <div class="line">
                    <img id="line" src="./common/img/line.png" alt="line">
                    <input type="text" name ="line" placeholder="<? echo $result_cnt["recom_title"] ?>"></input>
                </div>
                
                <div class="clock">
                    <img id="clock" src="./common/img/clock.png" alt="clock">
                    <input type="text" name ="clock" placeholder="<? echo $result_cnt["recom_contents"] ?>"></input>
                </div>

                <div class="clip">
                    <img id="clip" src="./common/img/clip.png" alt="clip">
                    <input type="text" name ="clip" placeholder="21:00"></input>
                </div>

                <div class="but">
                    <button type="submit">
                        <a href="todo_detail.php">
                        완료
                        </a>
                    </button>
                    <button>
                        <a href= "todo_list.php?list_no<? echo $result_info["list_no"]?>">    
                            취소
                        </a>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>