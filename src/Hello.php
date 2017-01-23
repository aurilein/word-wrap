<?php

class Greeter {

    const GREETING = "Hello";

    public function greet($name) {
        return self::GREETING . " " . trim($name);
    }
}
