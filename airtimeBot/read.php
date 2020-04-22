<?php
    $myfile = fopen("arduino1.text", "r") or die("Unable to open file!");
    echo fread($myfile, filesize("arduino1.text"));
    fclose($myfile);