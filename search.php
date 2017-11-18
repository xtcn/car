<?php
$search_car_id = $_REQUEST['search_car_id'];
$search_service_date = $_REQUEST['search_service_date'];
$search_service_id = $_REQUEST['search_service_id'];
?><!DOCTYPE html>
<html lang="zh-cn">
<?php
$nav_index = 2;
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
$car_list_query = "SELECT id,name,note FROM car";
$db = new DB();
$cars = $db->query($car_list_query);
if($search_car_id){
    $search_car_id = xtcn_sql_quoto_process($search_car_id);
    $where_sql = "car_id='{$search_car_id}'";
    if($search_service_date){
        $search_service_date = xtcn_sql_quoto_process($search_service_date);
        $where_sql .= " AND service_date = '{$search_service_date}'";
    }
    if($search_service_id){
        $search_service_id = xtcn_sql_quoto_process($search_service_id);
        $where_sql .= " AND service_id = '{$search_service_id}'";
    }
    $car_list_query = "SELECT id,name,note FROM car";
    $list_sql = "SELECT car_id,service_id,service_date,note FROM service_record WHERE {$where_sql} ORDER BY service_date";
    $cars = $db->query($car_list_query);
    $records = $db->query($list_sql);
}
$service_item_list_query = "SELECT id,name,note FROM service_item";
$service_items = $db->query($service_item_list_query);
?>
    		<div class="main-index">
    			<form action="search.php" method="post">
        		<h4>搜索过滤：
        		车辆<?php xtcn_show_input_select($cars,$search_car_id,"id","name","search_car_id");?>
        		项目<?php xtcn_show_input_select($service_items, $search_service_id, "id", "name", "search_service_id", true)?>
        		日期<input type="date" name="search_service_date" value="<?php echo $search_service_date;?>"/>
        		<input type="submit" value="搜索"/>
        		</h4>
    			</form>
    			<div align="left">
    			<?php
    			if($records && sizeof($records) > 0){
    			    foreach ($records as $record){
    			        ?>
        		<h4>
        		<?php echo $record['service_date'];?>
        		<?php xtcn_show_text_in_array($cars, $record["car_id"], "id", "name");?>
        		<?php xtcn_show_text_in_array($service_items, $record["service_id"], "id", "name");?>
        		<?php if($record["note"]){echo "(" . $record["note"] . ")";}?>
        		</h4>
    			        <?php
    			    }
    			}else{
    			?>
    			<h4>暂无记录</h4>
    			<?php
    			}?>
    			</div>
    		</div>
    </div><!-- /.container -->
<?php
include "common/footer.php";
?>
</body>
</html>

