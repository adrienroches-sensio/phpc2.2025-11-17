<?php

interface Writing
{
    public function write(string $what): string;
}

class Pen implements Writing
{
    public function write(string $what): string
    {
        return $what;
    }
}

class InutilePen implements Writing
{
    public function __construct(private Writing $pen)
    {
    }

    public function write(string $what): string
    {
        // log before

        $result = $this->pen->write($what);

        // log after

        return $result;
    }
}

class ItalicPen implements Writing
{
    public function __construct(private Writing $pen)
    {
    }

    public function write(string $what): string
    {
        return "<i>{$this->pen->write($what)}</i>";
    }
}

class BoldPen implements Writing
{
    public function __construct(private Writing $pen)
    {
    }

    public function write(string $what): string
    {
        return "<b>{$this->pen->write($what)}</b>";
    }
}

$pen = new BoldPen(new ItalicPen(new Pen()));

function write(Writing $pen, string $what): void
{
    echo $pen->write($what) . PHP_EOL;
}

write($pen, 'hello world');
