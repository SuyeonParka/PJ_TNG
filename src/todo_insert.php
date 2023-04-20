<?php

include_once( "common/fnc_park.php" );

$http_method = $_SERVER["REQUEST_METHOD"];

if( $http_method === "POST")
{
    $arr_post = $_POST;

    $result_cnt = todo_insert_recom_routine( $arr_post );

    header( "Location: todo_list.php" );
    exit();
}

$hour = range(0, 23);
foreach ($hour as $val) 
    {
        if ($val <= 9)
        {
            $val = "0".$val;
        }
        else
        {
            $val = $val;
        }
    }
$min = array("00", "10", "20", "30", "40", "50");


$arr_1 = todo_select_recom_routine();
$rand_no = rand(0,count($arr_1)-1);
// var_dump($arr_1);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert page</title>
    <link rel="stylesheet" href="./css/todo_insert.css">
    <link rel="icon" href="common/img/favi.png">
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
                    <input type="text" name="recom_no" placeholder="<? echo $arr_1[$rand_no]["recom_title"]?>" required></input>
                </div>
                
                <div class="clock">
                    <img id="clock" src="./common/img/clock.png" alt="clock">
                    <input type="text" placeholder="21:00">
                </div>
                <div class="clip">
                    <img id="clip" src="./common/img/clip.png" alt="clip">
                    <input type="text" name ="clip" placeholder="<? echo $arr_1[$rand_no]["recom_contents"]?>" required></input>
                </div>

                <div class="but">
                    <button type="submit">
                        <a id="but1" href="todo_detail.php">
                            완료
                        </a>
                    </button>
                    <button type="button">
                        <a id="but2" href= "todo_routine_list.php?list_no">    
                            취소
                        </a>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
