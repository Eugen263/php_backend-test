<?php
//Array given in task
$itemlist = array(
    array(
        'House' => 'Baratheon',
        'Sigil' => 'A crowned stag',
        'Motto' => 'Ours is the Fury'
    ),
    array(
        'Leader' => 'Eddard Stark',
        'House' => 'Stark',
        'Motto' => 'Winter is Coming',
        'Sigil' => 'A grey direwolf'
    ),
    array(
        'House' => 'Lannister',
        'Leader' => 'Tywin Lannister',
        'Sigil' => 'A golden lion'
    ),
    array(
        'Q' => 'Z'
    )
);

//number of elements in sub arrays
$item_count = array();

//an array with the keys of each subarray
$keys = array();
$new_keys = array();

//array elements
$elements = array();

//checking that the given array
if (!is_array($itemlist)) {
    exit("Error: input data provided not as an array");
}

//get the number of elements of each subarray
foreach ($itemlist as $item) {
    $item_count[] = count($item);
}

//get the elements of each subarray
for ($i = 0; $i < count($item_count); $i++) {
    foreach ($itemlist[$i] as $arr) {
        $elements[] = $arr;
    }
}

//get the keys in the $itemlist array
for ($i = 0; $i < count($itemlist); $i++) {
    foreach ($itemlist[$i] as $key_ => $array) {
        if (!array_keys($keys, $key_)) {
            $keys[] = $key_;
        }
    }
}

//sort keys alphabetically
asort($keys, SORT_STRING);

//save sorted keys
foreach ($keys as $k) {
    $new_keys[] = $k;
}

//write the body of the table in the correct order
for ($i = 0; $i < count($itemlist); $i++) {
    for ($a = 0; $a < count($new_keys); $a++) {
        for ($b = 0; $b < 1; $b++) {
            if (isset($itemlist[$i][$new_keys[$a]])) {
                $table_body[] = $itemlist[$i][$new_keys[$a]];
            } else {
                $table_body[] = '&&EMPTY&&';
            }
        }
    }
}

//the largest number of characters in a column
$str_lenghts = array();
for ($i = 0; $i < count($new_keys); $i++) {
    foreach ($itemlist as $k) {
        if (is_string($k[$new_keys[$i]])) {
            $leng = strlen($k[$new_keys[$i]]);
            if (!isset($str_lenghts[$i])){
                $str_lenghts[$i] = $leng;
            } elseif ($str_lenghts[$i] < $leng) {
                $str_lenghts[$i] = $leng;
            }
        }
    }
}

//total table length
$all_lang = 1;
foreach ($str_lenghts as $str_leng) {
    $all_lang += $str_leng + 3;
}

//output table to console
//drawing top border
printf("%s\n", str_repeat('=', $all_lang));

//title rendering
for ($i = 0; $i < count($new_keys); $i++) {
    $ch = $str_lenghts[$i]-strlen($new_keys[$i]);
    printf("| %s ", str_repeat(' ', $ch).$new_keys[$i]);
}

printf("|\n", '');

//drawing the border between the headers and the body of the table
printf("%s\n", str_repeat('-', $all_lang));

//rendering rendering of the body of the table
$min_l = 0;
$max_l = count($str_lenghts)-1;
for ($i = 0; $i < count($table_body); $i++) {

    if ($table_body[$i] == '&&EMPTY&&') {
        $table_body[$i] = ' ';
    }
    if ($min_l <= $max_l) {
        if (strlen($table_body[$i]) == $str_lenghts[$min_l]) {
            printf("| %s ", $table_body[$i]);
        } elseif (strlen($table_body[$i]) < $str_lenghts[$min_l]) {
            $ch = $str_lenghts[$min_l]-strlen($table_body[$i]);
            printf("| %s ", str_repeat(' ', $ch).$table_body[$i]);
        }
        $min_l++;
    } else {
        $min_l = 0;
        printf("|\n", '');
        $i--;
    }
}

printf("|\n", '');

//drawing bottom border
printf("%s\n", str_repeat('=', $all_lang));
//end
?>