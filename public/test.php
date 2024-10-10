<?php

class Carbrand
{
    private string $name;
    private string $color;
    private string $logo;
    private int $numberOfCars;

    public function __construct(string $name, string $color, string $logo, int $numberOfCars)
    {
        $this->name = $name;
        $this->color = $color;
        $this->logo = $logo;
        $this->numberOfCars = $numberOfCars;
        $this->date = date('Y-m-d');
    }

    public function getName()
    {
        return $this->name;
    }

    public function whoAmI()
    {
        $this->date = date('Y-m-d');
        echo "I am a carbrand named " . $this->name . "<br>";
        echo $this->color;
    }
}
$peugot = new Carbrand('peugot', 'red', 'a.png', 5);
$peugot->date = 'gisteren';
$peugot->numberOfCars = -10000;

class Car
{
    public $color;

    public function whatColor()
    {
        return $this->color;
    }
}

$car = new Car();
$car->color = "ik weet ";
echo $car->color;
$car2 = new Car();
$car2->color = "blue";
echo $car->whatColor();
