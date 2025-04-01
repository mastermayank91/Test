<?php

$old_file_name = "data.json";

$json_data = file_get_contents($old_file_name);

$array_data = json_decode($json_data,true);

$new_data = [
    'good' => 'hell',
    'bad' => 'body'
];

$array_data[] = $new_data;

$new_file_name = "data-" . date('d-m-Y_H-i-s') . ".json";

$new_json_data = json_encode($array_data, JSON_PRETTY_PRINT);

file_put_contents($new_file_name , $new_json_data);

echo "<pre>";
print_r($array_data);
echo "</pre>";

?>