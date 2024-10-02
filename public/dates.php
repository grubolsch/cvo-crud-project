<?php

$date = new DateTimeImmutable();
$tomorrow = $date->add(new DateInterval('P1D'));

echo $date->format('Y-m-d');
echo '<br>';
echo $tomorrow->format('Y-m-d');
