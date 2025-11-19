<?php

class PlopController
{
    public function listAll() { }

    public function getOne() { }

    #[AddTrace(context: 'controller')]
    public function saveOne(
        #[SensitiveParameter]
        string $coucou
    ) {
        throw new Exception($coucou);
    }
}

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class AddTrace
{
    public function __construct(
        public string $context = 'default',
    ) {
    }
}

$reflectionClass = new ReflectionClass(PlopController::class);

foreach ($reflectionClass->getMethods() as $method) {
    $addTraceAttributes = $method->getAttributes(AddTrace::class);
    if ($addTraceAttributes === []) {
        continue;
    }

    $addTraceAttribute = $addTraceAttributes[0];

    $addTrace = $addTraceAttribute->newInstance();
    var_dump($addTrace);
}

$controller = new PlopController();
$controller->saveOne('secret');
