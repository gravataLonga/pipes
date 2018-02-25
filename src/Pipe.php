<?php

namespace gravatalonga;

class Pipe
{
    protected $goThrough;

    protected $pipes = [];

    public function __construct($goThrough = null)
    {
        $this->goThrough = $goThrough;
    }

    public function given($goThrough)
    {
        return new self($goThrough);
    }

    public function pipe(\Closure $args)
    {
        $this->pipes[] = $args;
        return $this;
    }

    public function end()
    {
        foreach ($this->pipes as $pipe) {
            $this->goThrough = $pipe($this->goThrough);
        }
        return $this->goThrough;
    }
}