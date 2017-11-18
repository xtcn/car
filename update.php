<?php
$new = $_REQUEST['new'];
$new_service_date = $_REQUEST['new_service_date'];
$new_car_id = $_REQUEST['new_car_id'];
$new_service_id = $_REQUEST['new_service_id'];
$new_note = $_REQUEST['new_note'];
$edit = $_REQUEST['edit'];
$edit_id = $_REQUEST['edit_id'];
$edit_service_date = $_REQUEST['edit_service_date'];
$edit_car_id = $_REQUEST['edit_car_id'];
$edit_service_id = $_REQUEST['edit_service_id'];
$edit_note = $_REQUEST['edit_note'];
$del_ids = $_REQUEST['del_ids'];
if($new_service_date){
    setcookie("default_service_date", $new_service_date);
}
if($new_car_id){
    setcookie("default_car_id", $new_car_id);
}
$default_service_date = $_COOKIE['default_service_date'];
$default_car_id = $_COOKIE['default_car_id'];
?><!DOCTYPE html>
<html lang="zh-cn">
<?php
$nav_index = 3;
include "common/head.php";
?>
<body>
<?php
include "common/nav.php";
?>
    <div class="container">
<?php
include 'common/util.php';
include 'DB.php';
$service_item_list_query = "SELECT id,name,note FROM service_item";
$car_list_query = "SELECT id,name,note FROM car";
$record_list_query = "SELECT id,car_id,service_id,service_date,note FROM service_record";
$db = new DB();
if($new_service_date && $new_car_id && $new_service_id){
    $new_note = xtcn_sql_quoto_process(trim($new_note));
    $new_query = "INSERT INTO service_record(car_id,service_id,service_date,add_time,note) VALUES('{$new_car_id}','{$new_service_id}','{$new_service_date}',NOW(),'{$new_note}')";
    $db->update_query($new_query);
}
if($edit_id && $edit_car_id && $edit_service_id){
    $edit_note = xtcn_sql_quoto_process(trim($edit_note));
    $update_query = "UPDATE service_record SET service_date='{$edit_service_date}',car_id='{$edit_car_id}',service_id='{$edit_service_id}',note='{$edit_note}',edit_time=NOW() WHERE id = '{$edit_id}'";
    $db->update_query($update_query);
}
if($edit){
    $service_records = $db->query("SELECT car_id,service_id,service_date,note FROM service_record WHERE id = '{$edit}'");
    if($service_records && sizeof($service_records) == 1){
        $service_record = $service_records[0];
    }
}
if($del_ids && sizeof($del_ids) > 0){
    foreach ($del_ids as $del_id){
        if($del_id){
            $del_sql = "DELETE FROM service_record WHERE id = '{$del_id}'";
            $db->update_query($del_sql);
        }
    }
}
$service_items = $db->query($service_item_list_query);
$cars = $db->query($car_list_query);
$records = $db->query($record_list_query);
?>
    		<div class="main-index">
    		<?php
    		if($edit && $service_record){
    		    ?>
    		    <h4>修改信息</h4>
    		    <form action="update.php" method="post">
    		    <div align="center">
    		    <table>
    		    <tr><td>日期：</td><td><input type="date" name="edit_service_date" value="<?php echo $service_record['service_date'];?>"/></td></tr>
    		    <tr><td>车辆：</td><td><?php xtcn_show_input_select($cars,$service_record['car_id'],"id","name","edit_car_id");?></td></tr>
    		    <tr><td>项目：</td><td><?php xtcn_show_input_select($service_items, $service_record['service_id'], "id", "name", "edit_service_id")?></td></tr>
    		    <tr><td>备注：</td><td><input type="text" name="edit_note" value="<?php echo htmlspecialchars($service_record['note']);?>"/></td></tr>
    		    <tr><td>&nbsp;</td><td><input type="submit" value="保存"/>
    		    <input type="reset" value="重填"/></td></tr>
    		    </table>
    		    </div>
    		    <input type="hidden" name="edit_id" value="<?php echo $edit;?>"/>
    		    </form>
    		    <?php
    		}else{
    		?>
    		<?php
    		  if($new && $new == "1"){
    		    ?>
    		    <h4>添加新信息</h4>
    		    <form action="update.php" method="post">
    		    <div align="center">
    		    <table>
    		    <tr><td>日期：</td><td><input type="date" name="new_service_date" value="<?php echo $default_service_date;?>"/></td></tr>
    		    <tr><td>车辆：</td><td><?php xtcn_show_input_select($cars,$default_car_id,"id","name","new_car_id");?></td></tr>
    		    <tr><td>项目：</td><td><?php xtcn_show_input_select($service_items, 0, "id", "name", "new_service_id")?></td></tr>
    		    <tr><td>备注：</td><td><input type="text" name="new_note"/></td></tr>
    		    <tr><td>&nbsp;</td><td><input type="submit" value="保存"/>
    		    <input type="reset" value="重填"/></td></tr>
    		    </table>
    		    </div>
    		    </form>
    		    <?php
    		  }else{
    		?>
    		<h4><a href="update.php?new=1">添加新信息</a></h4>
    		<?php
    		  }
    		}
    		?>
    		<div align="left">
    		<form action="update.php" method="post">
    		<?php
    		if($records && sizeof($records) > 0){
    		    foreach ($records as $record){
    		        ?>
        		<h4>
        		<input type="checkbox" name="del_ids[]" value="<?php echo $record["id"];?>"/>
        		<?php echo $record['service_date'];?>
        		<?php xtcn_show_text_in_array($cars, $record["car_id"], "id", "name");?>
        		<?php xtcn_show_text_in_array($service_items, $record["service_id"], "id", "name");?>
        		<?php if($record["note"]){echo "(" . $record["note"] . ")";}?>
        		<a href="update.php?edit=<?php echo $record["id"];?>">修改</a>
        		</h4>
    		        <?php
    		    }
    		}else{
    		    ?>
        		<h4>暂无记录</h4>
    		    <?php
    		}
    		?>
    			<input type="submit" value="删除"/>
    			<input type="reset" value="重选"/>
    		</form>
    		</div>
    		</div>
    </div><!-- /.container -->
<?php
include "common/footer.php";
?>
</body>
</html>
