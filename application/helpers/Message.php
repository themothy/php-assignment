<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message
{
    private $type;
    private $text;


    public function __construct(int $type, string $text)
    {
        $this->type = $type;
        $this->text = $text;
    }


    public function getType(): int
    {
        return $this->type;
    }


    public function setType(int $type)
    {
        $this->type = $type;
    }


    public function getText(): string
    {
        return $this->text;
    }


    public function setText(string $text)
    {
        $this->text = $text;
    }


}