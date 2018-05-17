<?php
        if ((!($_GET['loadtime']))||($_GET['loadtime']<5)){
            
    echo "<br/>Load time not recorded.";
            die;
        }
        if (file_exists("files/perflog.txt")) {
            $logfile = fopen("files/perflog.txt","r");
            $allLoadTimes = fread($logfile,99999);
            fclose($logfile);
            
            $loadTimes = explode(';',$allLoadTimes);
            array_pop($loadTimes);
            if(count($loadTimes) >= 12){
                array_shift($loadTimes);
            }
            //print_r($loadTimes);
            $loadTimes[count($loadTimes)] = $_GET['loadtime'];
            $allLoadTimes = implode(";", $loadTimes);
                
            $logfilew = fopen("files/perflog.txt","w");
            $success = fwrite($logfilew, $allLoadTimes);
            fclose($logfilew);
        }else{
            $loadTimes[] = $_GET['loadtime'];
            $allLoadTimes = implode(";", $loadTimes);
            $logfilew = fopen("files/perflog.txt","w");
            $success = fwrite($logfilew, $allLoadTimes);
            fclose($logfilew);
        }
    echo "<br/>Successfully logged load time!";
?>