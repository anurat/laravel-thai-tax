<?php

return [
    ['min' => 0, 'max' => 150000, 'percentage' => 0],
    ['min' => 150001, 'max' => 500000, 'percentage' => 10],
    ['min' => 500001, 'max' => 1000000, 'percentage' => 20],
    ['min' => 1000001, 'max' => 4000000, 'percentage' => 30],
    ['min' => 4000001, 'max' => PHP_INT_MAX, 'percentage' => 37],
];
