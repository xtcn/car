<?php
function xtcn_sql_quoto_process($src){
    return str_replace("'", "''", $src);
}

function xtcn_show_input_select($array, $selected_value, $value_index, $show_index, $input_name, $show_all = false){
    echo "<select name='{$input_name}'>";
    if($show_all){
        echo "<option value=''>所有</option>";
    }
    foreach ($array as $item){
        echo "<option value='";
        echo $item[$value_index];
        echo "'";
        if($item[$value_index] == $selected_value){
            echo " selected";
        }
        echo ">";
        echo $item[$show_index];
        echo "</option>";
    }
    echo "</select>";
}

function xtcn_show_text_in_array($array, $show_index_value, $value_index, $show_index){
    foreach($array as $item){
        if($item[$value_index] == $show_index_value){
            echo $item[$show_index];
            break;
        }
    }
}