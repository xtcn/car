<?php
if(!$nav_index){
    $nav_index = 1;
}
?>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
    switch ($nav_index){
        case 1:
            echo "车辆维护信息";
            break;
        case 2:
            echo "信息搜索";
            break;
        case 3:
            echo "信息维护";
            break;
        case 4:
            echo "维护项目";
            break;
        case 5:
            echo "关于";
            break;
    }
    ?></title>
    <link rel="stylesheet" href="bootstrap/3.3.0/css/bootstrap.min.css"/>
    <link href="css/main.css" rel="stylesheet">
  </head>
