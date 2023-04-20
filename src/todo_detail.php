<?php

define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
define( "URL_DB", DOC_ROOT."src/common/db_common.php" );
include_once( URL_DB );

$arr_get = $_GET;

$result_info = todo_select_todo_detail( $arr_get["list_no"] );

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="./css/todo_detail.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img id="logo" src="./common/img/logo.png" alt="logo">
        </div>
        <form action="" method=""></form>
        <div class = "phase">
            <p class="text">안녕하세요.</p>
            <p>오늘은 <?echo date("m")?>월 <?echo date("d")?>일입니다.</p>
        </div>

        <div class="line">
            <img id="line" src="./common/img/line.png" alt="line">
            <input id="line_text" ><? echo $result_info["list_title"]?></input>
        </div>

        <div class="clock">
            <img id="clock" src="./common/img/clock.png" alt="clock">
            <input id="clock_text" ><? echo $result_info["list_due_time"]?></input>
        </div>

        <div class="clip">
            <img id="clip" src="./common/img/clip.png" alt="clip">
            <input id="clip_text" maxlength="11"><? echo $result_info["list_contents"]?></input>
        </div>

        <div class="done_but">
            <?
            if ( todo_update_flg() === 1) 
            {
            ?>
                <a href="todo_list.php">
                    <img id="done" src="./common/img/done_button.png" alt="완료버튼">
                </a>
            <?
            }
            else
            {
            ?>
                <img id="not_done"src="./common/img/circle.png" alt="미완료">
            <?
            }
            ?>
        </div>
        
        <div class="but">
            <button type="button" onclick="location.href='todo_list.php'">
                목록
            </button>
            <button type="button" onclick='location.href="todo_update.php?list_no<? echo $result_info["list_no"] ?>"'>
                수정
            </button>
        </div>
</div>
</body>
</html>