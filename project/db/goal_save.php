<?php
    include "dbconn.php";
    session_start();
    if(isset($_SESSION['userid'])) $userid = $_SESSION['userid'];
    $goal_name = $_POST['goal_name'];
    $term = $_POST['term'];
    $time = time();
    $term_s_date = date("Y-m-d", $time);
    if($term == "select"){
        $term_s_date = $_POST['term_s_date'];
        $term_e_date = $_POST['term_e_date'];
    }
    else if($term == "a-month"){
        $term_e_date = date("Y-m-d", strtotime("+1 month", $time));
    }  
    else if($term == "3-month"){
        $term_e_date = date("Y-m-d", strtotime("+3 month", $time));
    }
    else if($term == "year"){
        $term_e_date = date("Y-m-d", strtotime("+1 year", $time));
    }

    $sql = "INSERT INTO goal(goalName, startTerm, endTerm, achievement, userID) VALUES('$goal_name', '$term_s_date', '$term_e_date', '0', '$userid')";
    
    $result = $conn->query($sql);
    if($result){
        echo "등록완료";
    }
    else{ echo "FAIL"; }

    $goal = "SELECT * FROM goal WHERE goalName = '$goal_name'";
    $result2 = mysqli_query($conn, $goal);
    $row = mysqli_fetch_array($result2);
    $goalID = $row['goalID'];
    $Interval = "";
    $arr = array("0", "0", "0", "0", "0", "0", "0");
    
    $routineNum = $_POST['routineNum'];
    
    for($i=0;$i<$routineNum; $i++) {
        $name = "routine_name".$i;
        $week = "routine".$i;
        $color = "colors".$i;
        $routine_name[$i] = $_POST[$name];
        $repeats = $_POST[$week];
        $colors = $_POST[$color];

        
    echo $goal_name.", ".$term_s_date.", ".$term_e_date.", ".$routine_name[$i].", ";
    foreach($repeats as $repeat){
        echo $repeat.", ";
        
        if($repeat == "mon"){ 
            $arr[0] = "1"; 
        }
        else if($repeat == "tue"){ 
            $arr[1] = "1"; 
        }
        else if($repeat == "wed"){ 
            $arr[2] = "1"; 
        }
        else if($repeat == "thu"){ 
            $arr[3] = "1"; 
        }
        else if($repeat == "fri"){ 
            $arr[4] = "1"; 
        }
        else if($repeat == "sat"){ 
            $arr[5] = "1"; 
        }
        else if($repeat == "sun"){
            $arr[6] = "1"; 
        }
        
    }
    $Interval = implode(";", $arr);
        
          $sql3 = "INSERT INTO routine(routineName, color, rInterval, habbitTracker, goalID) VALUES('$routine_name[$i]', '$colors', '$Interval', '0', '$goalID')";
        
        $result3 = $conn->query($sql3);
        if($result3){ echo "루틴 등록완료"; }
        else{ echo "실패 ! "; }
        
        $arr = array("0", "0", "0", "0", "0", "0", "0");
    }
?>