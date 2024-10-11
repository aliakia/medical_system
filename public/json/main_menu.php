<?php
header('Content-Type: application/json');

// Your logic to fetch data and construct the JSON response goes here
$data = [
    "draw" => 1,
    "recordsTotal" => 10,
    "recordsFiltered" => 10,
    "data" => [
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"],
        ["1432453", "Tiger Nixon", "1"]
    ]
];

echo json_encode($data);
?>
