<?php

namespace app\tests\unit\faker\providers;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    protected static $formats = [
        '+7 (922) ###-####'
    ];
}
