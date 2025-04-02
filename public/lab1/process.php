<?php
echo "Hello, World!";

$string = "This is a string";
$integer = 5;
$float = 3.14;
$boolean = true;

echo "<br>$string";
echo "<br>$integer";
echo "<br>$float";
echo "<br>$boolean";

echo "<br>";
var_dump($string);
var_dump($integer);
var_dump($float);
var_dump($boolean);

$first_name = "Illia";
$last_name = "Pasichnichenko";
$full_name = $first_name . " " . $last_name;
echo "<br>$full_name";

$number = 7;
if ($number % 2 == 0) {
    echo "<br>The number is even";
} else {
    echo "<br>The number is odd";
}

echo "<br>For loop:";
for ($i = 1; $i <= 10; $i++) {
    echo "<br>$i";
}

echo "<br>While loop:";
$i = 10;
while ($i >= 1) {
    echo "<br>$i";
    $i--;
}

$student = array(
    "first_name" => "Illia",
    "last_name" => "Pasichnichenko",
    "age" => 22,
    "specialty" => "IT"
);

echo "<br>Student information:";
echo "<br>First Name: " . $student["first_name"];
echo "<br>Last Name: " . $student["last_name"];
echo "<br>Age: " . $student["age"];
echo "<br>Specialty: " . $student["specialty"];

$student["average_grade"] = 99;
echo "<br>Average grade: " . $student["average_grade"];
