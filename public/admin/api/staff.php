<?php
  Header("Content-Type: application/json");
  Header("Access-Control-Allow-Origin: *");

  $staff = [
    "ba4161c03a42496c8ae07d13372f3371" => [
      "name" => "james090500",
    ],
    "617687afc8a846978e5c3ed53b7a335f" => [
      "name" => "DylanDaily",
    ],
    "bf8b08a5714c46678f49efce56cb7dc5" => [
      "name" => "Mov51",
    ],
    "58f1a83b425d4844823ffa04a201facd" => [
      "name" => "MiniPixie",
    ],
    "1c1e62b7fec14effa4dc9d3b97f6ded6" => [
      "name" => "sxk",
    ]
  ];

  echo json_encode($staff);
