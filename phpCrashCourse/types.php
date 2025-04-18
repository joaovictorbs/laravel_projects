<?php

$isStudent = 1;
var_dump($isStudent, true, $isStudent === true);


$scores = [85, "90", (int)95.5];

$total = $scores[0] + $scores[1] + $scores[2];

var_dump($scores, $scores[0] + $scores[1] + $scores[2]);


echo "Total scores is: $total  \n";