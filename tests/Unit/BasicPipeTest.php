<?php

use gravatalonga\Pipe;
use PHPUnit\Framework\TestCase;

class BasicPipeTest extends TestCase
{
    /** @test */
    public function can_initilize_pipe ()
    {
        $pipe = new Pipe;
        $this->assertInstanceOf(Pipe::class, $pipe);
    }

    /** @test */
    public function return_new_pipe_instance ()
    {
        $pipe = new Pipe;
        $new = $pipe->given('https://jonathan.pt');
        $this->assertNotSame($pipe, $new);
    }

    /** @test */
    public function can_execute_pipes_jobs ()
    {
        $pipe = new Pipe;
        $host = $pipe->given('https://jonathan.pt')
            ->pipe(function ($item) {
                return parse_url($item, PHP_URL_HOST);
            })->end();
        $this->assertSame('jonathan.pt', $host);
    }

    /** @test */
    public function can_carry_multiple_pipes ()
    {
        $pipe = new Pipe;
        $ltd = $pipe->given('https://jonathan.pt/rascunhos')
            ->pipe(function ($item) {
                return parse_url($item, PHP_URL_HOST);
            })
            ->pipe(function ($item) {
                $last = (new Pipe($item))->pipe(function ($sub) {
                    return explode('.', $sub);
                })->pipe(function ($sub) {
                    return end($sub);
                })->end();
                return $last;
            })->end();
        $this->assertSame('pt', $ltd);
    }
}