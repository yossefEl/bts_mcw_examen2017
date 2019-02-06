<?php
$link=mysqli_connect("localhost","root",'','zizolivebd');
if(!$link)
{
    die("error while trying to connect to database ".mysqli_connect_error($link));
}

