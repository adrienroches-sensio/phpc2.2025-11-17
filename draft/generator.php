<?php

function generate(): \Generator
{
    echo 'Start'.PHP_EOL;

    yield 'coucou';
    sleep(5);

    echo 'After yield'.PHP_EOL;

    yield 'hello';
    sleep(5);

    echo 'after hello'.PHP_EOL;

    return 'value';
}

function generateArray(): array
{
    $result = [];

    $result[] = 'coucou';
    sleep(5);

    $result[] = 'hello';
    sleep(5);

    return $result;
}

echo 'before generate'.PHP_EOL;
$plop = generate();
var_dump($plop);
echo 'after generate'.PHP_EOL;

foreach($plop as $value) {
    echo $value.PHP_EOL;
    break;
}
