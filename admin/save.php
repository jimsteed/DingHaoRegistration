<?php
function safefilerewrite($filename, $dataToSave)
{
    $fp = fopen($filename,"w") or die(print_r(error_get_last(),true));
    if ($fp)
    {
        do
        {            $canWrite = flock($fp, LOCK_EX);
           // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
           if(!$canWrite) usleep(20);
        } while (!$canWrite);

        //file was locked so now we can store information
        if ($canWrite)
        {            fwrite($fp, $dataToSave);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
}

function write_php_ini($array, $file)
{
    $res = "";
    foreach($array as $key => $val)
    {
        $res .= "$key = ".(is_numeric($val) ? $val : "\"".$val."\"") . "\n";
    }
    echo $res;
    safefilerewrite($file,$res);
}

write_php_ini($_POST,"../setup");
header('Location: index.php');
?>
