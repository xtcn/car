<?php
if(!$nav_index){
    $nav_index = 1;
}
?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">车辆维护信息</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li<?php
            if($nav_index == 1){
                echo " class=\"active\"";
            }
            ?>><a href="<?php
            if($nav_index == 1){
                echo "#";
            }else{
                echo "index.php";
            }
            ?>">首页</a></li>
            <li<?php
            if($nav_index == 2){
                echo " class=\"active\"";
            }
            ?>><a href="<?php
            if($nav_index == 2){
                echo "#";
            }else{
                echo "search.php";
            }
            ?>">搜索信息</a></li>
            <li<?php
            if($nav_index == 3){
                echo " class=\"active\"";
            }
            ?>><a href="<?php
            if($nav_index == 3){
                echo "#";
            }else{
                echo "update.php";
            }
            ?>">维护信息</a></li>
            <li<?php
            if($nav_index == 4){
                echo " class=\"active\"";
            }
            ?>><a href="<?php
            if($nav_index == 4){
                echo "#";
            }else{
                echo "service_item.php";
            }
            ?>">维护项目</a></li>
            <li<?php
            if($nav_index == 5){
                echo " class=\"active\"";
            }
            ?>><a href="<?php
            if($nav_index == 5){
                echo "#";
            }else{
                echo "about.php";
            }
            ?>">关于</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
