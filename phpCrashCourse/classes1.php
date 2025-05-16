<?php

// Class -> Car Y
// Object -> My car Y or your Car Y

class Person {
    // public string $name;
    // public int $age;

    public function __construct(
        public string $name, public int $age
        )
    {
        // $this->name = $name;
        // $this->age = $age;
    }

    public function introduce(): string {
        return "Hi, I'm {$this->name} and I'm {$this->age} years old.";
    }
}

$person = new Person("Joao", "23");
echo $person->introduce();
$person2 = new Person("Teste", "20");
echo $person2->introduce();