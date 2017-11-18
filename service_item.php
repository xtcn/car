<?php
$new = $_REQUEST['new'];
$new_name = $_REQUEST['new_name'];
$new_note = $_REQUEST['new_note'];
$edit = $_REQUEST['edit'];
$edit_id = $_REQUEST['edit_id'];
$edit_name = $_REQUEST['edit_name'];
$edit_note = $_REQUEST['edit_note'];
$del_ids = $_REQUEST['del_ids'];
?><!DOCTYPE html>
<html lang="zh-cn">
<?php
$nav_index = 4;
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
$list_query = "SELECT id,name,note FROM service_item";
$db = new DB();
if($new_name){
    $new_name = xtcn_sql_quoto_process(trim($new_name));
    $new_note = xtcn_sql_quoto_process(trim($new_note));
    if(strlen($new_name) > 0){
        $new_query = "INSERT INTO service_item(name,note) VALUES('{$new_name}','{$new_note}')";
        $db->update_query($new_query);
    }
}
if($edit_id && $edit_name){
    $edit_name = xtcn_sql_quoto_process(trim($edit_name));
    $edit_note = xtcn_sql_quoto_process(trim($edit_note));
    if(strlen($edit_name) > 0){
        $update_query = "UPDATE service_item SET name='{$edit_name}',note='{$edit_note}' WHERE id = '{$edit_id}'";
        $db->update_query($update_query);
    }
}
if($edit){
    $service_items = $db->query("SELECT name,note FROM service_item WHERE id = '{$edit}'");
    if($service_items && sizeof($service_items) == 1){
        $service_item = $service_items[0];
    }
}
if($del_ids && sizeof($del_ids) > 0){
    foreach ($del_ids as $del_id){
        if($del_id){
            $del_sql = "DELETE FROM service_item WHERE id = '{$del_id}'";
            $db->update_query($del_sql);
        }
    }
}
$service_items = $db->query($list_query);
?>
    		<div class="main-index">
    		<?php
    		if($edit && $service_item){
    		    ?>
    		    <h4>修改项目</h4>
    		    <form action="service_item.php" method="post">
    		    名称：<input type="text" name="edit_name" value="<?php echo htmlspecialchars($service_item['name']);?>"/><br/>
    		    备注：<input type="text" name="edit_note" value="<?php echo htmlspecialchars($service_item['note']);?>"/><br/>
    		    <input type="hidden" name="edit_id" value="<?php echo $edit;?>"/>
    		    <input type="submit" value="保存"/>
    		    <input type="reset" value="重填"/>
    		    </form>
    		    <?php
    		}else{
    		  if($new && $new == "1"){
    		    ?>
    		    <h4>添加新项目</h4>
    		    <form action="service_item.php" method="post">
    		    名称：<input type="text" name="new_name"/><br/>
    		    备注：<input type="text" name="new_note"/><br/>
    		    <input type="submit" value="保存"/>
    		    <input type="reset" value="重填"/>
    		    </form>
    		    <?php
    		  }else{
    		?>
    		<h4><a href="service_item.php?new=1">添加新项目</a></h4>
    		<?php
    		  }
    		}
    		?>
    		<div align="left">
    		<form action="service_item.php">
    		<?php
    		if($service_items && sizeof($service_items) > 0){
    		    foreach ($service_items as $service_item){
    		        ?>
        		<h4>
        		<input type="checkbox" name="del_ids[]" value="<?php echo $service_item["id"];?>"/>
        		<?php echo $service_item["name"];?>
        		<?php if($service_item["note"]){echo "(" . $service_item["note"] . ")";}?>
        		<a href="service_item.php?edit=<?php echo $service_item["id"];?>">修改</a>
        		</h4>
    		        <?php
    		    }
    		}else{
    		    ?>
        		<h4>暂无维护项目</h4>
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
