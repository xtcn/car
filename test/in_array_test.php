<?php
$ext_list = array("txt","mobi","epub","jpg","pdf","azw3","pdg","zip","rar","html","chm","doc","xml","mp3","htm","shtml","lrc","umd","docx","mp4","gif","ebk3","ppt","wma","prc","png","svg","jpeg","mht","djvu","rmvb");
if(in_array("pdf", $ext_list)){
    echo "pdf is in ext_list\n";
}
if(in_array("unknow", $ext_list)){
    echo "unknow is in ext_list\n";
}
