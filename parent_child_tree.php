<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<?php

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);


$result = getCategoryTree();
$html=getCategoryTreeHtml($result);
echo $html;
function getCategoryTree()
{
    $category = array(
        array('id' => 1, 'parent_id' => 0, 'name' => 'electronics'),
        array('id' => 2, 'parent_id' => 1, 'name' => 'mobile'),
        array('id' => 3, 'parent_id' => 1, 'name' => 'tablets'),
        array('id' => 4, 'parent_id' => 2, 'name' => 'iphone'),
        array('id' => 5, 'parent_id' => 0, 'name' => 'books'),
        array('id' => 6, 'parent_id' => 5, 'name' => 'adult_book'),

    );

    $tree = array();
    foreach ($category as $tkey => $tval) {

        $data = array();
        // Skip element, if it is a child element or if the item is not active
        if ($category[$tkey]['parent_id'] != 0) {
            // Skip to next element
            continue;
        }
        // add the element in data if not child element
        $data['id'] = $category[$tkey]['id'];
        $data['name'] = $category[$tkey]['name'];

        //build child if element is parent
        $children = buildChild($category, $category[$tkey]['id']);
        if (!empty($children)) {
            $data['children'] = $children;
        }
        $tree[] = $data;
    }
    return $tree;
}

function buildChild($category, $parent)
{
    $branch = array();
    foreach ($category as $tkey => $tval) {
        //check whether category is active
        if ($category[$tkey]['parent_id'] == $parent) {
            $data = array();
            $data['id'] = $category[$tkey]['id'];
            $data['name'] = $category[$tkey]['name'];
            $children = buildChild($category, $category[$tkey]['id']);
            if (!empty($children)) {
                $data['children'] = $children;
            }
            $branch[] = $data;
        }
    }
    return $branch;
}

function getCategoryTreeHtml($category)
{
    $tree = "";
    $icon = '<i class="fa-li fa fa-arrow-circle-o-right"> </i>';
    foreach ($category as $row) {
        $tree = $tree . "<li> $icon" . $row['name'];
        if (isset($row['children'])) {
            $tree = buildChildHtml($row['children'], $tree);
        }
        $tree = $tree . '</li>';
    }
    return $tree;
}

function buildChildHtml($category, $tree)
{
    $tree = $tree . '<ul class=fa-ul>';
    $icon = '<i class=""> </i>';
    foreach ($category as $row) {
        $tree = $tree . "<li class=hide> $icon" . $row['name'];
        if (isset($row['children'])) {
            $tree = buildChildHtml($row['children'], $tree);
        }
        $tree = $tree . '</li>';
    }
    $tree = $tree . '</ul>';
    return $tree;
}

