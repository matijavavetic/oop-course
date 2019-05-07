<?php


// Pokazuje putanju file-a
echo __FILE__ . "<br>";

// Pokazuje red u kojem se kod nalazi
echo __LINE__ . "<br>";

// Pokazuje path file-a
echo __DIR__ . "<br>";


if (file_exists(__DIR__)) {
    echo "yes <br>";
}

if (is_file(__FILE__)) {
    echo "yes <br>";
} else {
    echo "no <br>";
}

if (is_dir(__FILE__)) {
    echo "yes <br>";
} else {
    echo "no <br>";
}

echo file_exists (__FILE__) ? "yes" : "no";

