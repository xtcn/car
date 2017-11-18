<?php
class MyClass {
    function __construct() {
        echo "__construct\n";
    }
    function __destruct() {
        echo "__destruct\n";
    }
}
echo "start\n";
$myclass = new MyClass();
echo "end\n";
