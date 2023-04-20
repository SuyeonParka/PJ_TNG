<?php
include_once( "db_common.php" );

/*---------------------------------------------
함수명 : todo_insert_recom_routine
기능   : 게시글 작성
파라미터 : Arr      &$param_arr
리턴값  :  int/array     $result_cnt/ERRMSG
-----------------------------------------------*/
function todo_insert_recom_routine( &$param_arr )
{
    $sql =
        " INSERT INTO "
        ." recom_routine "
        ." ( "
        ." recom_title "
        ." ,recom_contents "
        ." ) "
        ." VALUES "
        ." ( "
        ." :recom_title "
        ." ,:recom_contents"
        ." ) "
        ;

    $arr_prepare =
        array(
            ":recom_title" => $param_arr["recom_title"]
            ,":recom_contents" => $param_arr["recom_contents"]
        );

    $conn = null;
    
    try 
    {
        db_conn( $conn );
        $conn->befigTransaction();
        $stmt = $conn -> prepare( $sql ); 
        $stmt -> execute( $arr_prepare ); 
        $result_cnt = $stmt->rowCount();
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage(); 
    }
    finally 
    {
        $conn = null;
    }

    return $result_cnt;

}


/*---------------------------------------------
함수명 : todo_select_todo_detail
기능   : 게시글 정보
파라미터 : int      &$param_no
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/

function todo_select_todo_detail( &$param_no )
{
    $sql =
        " SELECT "
        ." list_no "
        ." ,list_title "
        ." ,list_contents "
        ." ,list_due_time "
        ." ,list_done_flg "
        ." ,list_now_date "
        ." FROM "
        ." routine_list "
        ." WHERE "
        ." list_no = :list_no "
        ;

    $arr_prepare =
        array
        (
            ":list_no"=>$param_no
        );

    $conn = null;

    try 
    {
        db_conn( $conn );
        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e) 
    {
        return $e->getMessage();
    }
    finally 
    {
        $conn = null;
    }

    return $result[0];

}

/*---------------------------------------------
함수명 : todo_update_flg
기능   : 게시글 정보
파라미터 : int      &$param_arr
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/
function todo_update_flg( &$param_arr )
{
    $sql =
        " UPDATE "
        ." routine_info "
        ." SET "
        ." routine_del_flg = :routine_del_flg"
        ." WHERE "
        ." routine_no = :routine_no "
        ;
    
    $arr_prepare =
        array (
            " routine_no " => $param_arr["routine_no"]
            ," routine_del_flg " => $param_arr["routine_del_flg"]
        );

    $conn = null;

    try 
    {
        db_conn( $conn );
        $conn->beginTransaction();
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount(); 
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage();
    }
    finally 
    {
        $conn = null;
    }

    return $result_cnt;

}

function select_routine_info_cnt()
{
    $sql = 
        " SELECT "
        ."      COUNT(*) cnt"
        ." FROM "
        ."      routine_info "
        ." WHERE "
        ."      routine_del_flg = '0' "
        ;

    $arr_prepare = array ();

    $conn = null; 
    try 
    {
        db_conn( $conn );
        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e ) 
    {
        return $e->getMessage(); 
    }
    finally
    {
        $conn = null; 
    }

    return $result;
}

//todo 실행
// $a=1;
// var_dump(todo_select_todo_detail($a));
//todo 종료


// ---------------------------------------
// 함수명      : update_check_flg
// 기능        : 체크리스트 update
// 파라미터    : &$param_arr
// 리턴값      : 없음
// ---------------------------------------

function update_check_flg(&$param_arr)
{
    $sql=
    " UPDATE "
    ." routine_list "
    ." SET "
    ." list_done_flg = :list_done_flg "
    ." WHERE "
    ." list_no = :list_no "
    ;

    $arr_prepare =
    array(
        ":list_no" => $param_arr["list_no"]
        ,":list_done_flg" => $param_arr["list_done_flg"]
    );
    
    $conn = null;
    
    try {
        db_conn($conn);
        $conn->beginTransaction();
        $stmt = $conn ->prepare($sql);
        $stmt->execute($arr_prepare);
        
        $result_count = $stmt->rowCount();
        $conn->commit();
    } 
    catch (Exception $e) {
        $conn->rollBack();
        return $e->getMessage();
    }
    finally{
        $conn =null;
    }
    
    return $result_count;
}

/*---------------------------------------------
함수명 : todo_select_recom_routine
기능   : 삽입 페이지 할일 랜덤 추천
파라미터 : int      &$param_no
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/
function todo_select_recom_routine()
{
    $sql =
        " SELECT "
        ." recom_no "
        ." ,recom_title "
        ." ,recom_contents "
        ." FROM "
        ." recom_routine "
        ;

    $arr_prepare = array();

    $conn = null;

    try 
    {
        db_conn( $conn );
        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e) 
    {
        return $e->getMessage();
    }
    finally 
    {
        $conn = null;
    }

    return $result;
}

// var_dump(todo_select_recom_routine());
?>