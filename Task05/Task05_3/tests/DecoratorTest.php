<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Economy;
use App\Standard;
use App\Luxury;
use App\DedicatedInternet;
use App\AdditionalSofa;
use App\FoodDelivery;
use App\Dinner;
use App\BreakfastBuffet;

class DecoratorTest extends TestCase
{
    public function testDecorator()
    {
        $hotelRoom1 = new Luxury();
        $hotelRoom1 = new FoodDelivery($hotelRoom1);
        $hotelRoom1 = new BreakfastBuffet($hotelRoom1);
        $this -> assertSame("Класс: Люкс, доставка еды в номер, завтрак \"шведский стол\"", $hotelRoom1 -> getDescription());
        $this -> assertSame(3800, $hotelRoom1 -> getPrice());
        $hotelRoom2 = new Standard();
        $hotelRoom2 = new DedicatedInternet($hotelRoom2);
        $hotelRoom2 = new Dinner($hotelRoom2);
        $this -> assertSame("Класс: Стандарт, выделенный Интернет, ужин", $hotelRoom2 -> getDescription());
        $this -> assertSame(2900, $hotelRoom2 -> getPrice());
    }
}