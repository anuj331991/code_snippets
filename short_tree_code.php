<?php
function firstFunction($array){ 
    echo '<ul>';
    foreach($array as $val){ 
        if($val['parent_id']==0){
            
            echo '<li>';
            echo $val['name'];
            secondFunction($array, $val['id']);
            echo '</li>';
        }
    }
    echo '</ul>';
}
function secondFunction($array, $parent){
    echo '<ul>';
      foreach($array as $val){
        if($val['parent_id']==$parent){
            echo '<li>';
            echo $val['name'];
            echo '</li>';
            secondFunction($array, $val['id']);
        }
    }
   echo '</ul>';
}
$array=array(
        array('id' => 1, 'parent_id' => 0, 'name' => 'electronics'),
        array('id' => 2, 'parent_id' => 1, 'name' => 'mobile'),
        array('id' => 3, 'parent_id' => 1, 'name' => 'tablets'),
        array('id' => 4, 'parent_id' => 2, 'name' => 'iphone'),
        array('id' => 5, 'parent_id' => 0, 'name' => 'books'),
        array('id' => 6, 'parent_id' => 5, 'name' => 'autobiography'),
        array('id' => 7, 'parent_id' => 2, 'name' => 'samsung'),
        array('id' => 8, 'parent_id' => 2, 'name' => 'nokia'),
        array('id' => 9, 'parent_id' => 3, 'name' => 'google nexus 7'),
        array('id' => 10, 'parent_id' => 5, 'name' => 'novels'),
        array('id' => 11, 'parent_id' => 10, 'name' => '2 states'),
        array('id' => 12, 'parent_id' => 10, 'name' => '3 mistakes of my life'),

    );

$response=firstFunction($array);
 ?>
