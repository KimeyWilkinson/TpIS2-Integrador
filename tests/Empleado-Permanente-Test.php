<?php

class EmpleadoPermanenteTests extends \PHPUnit\Framework\TestCase
{

    public function crear($fingreso = null, $nombre = "Benjamin", $apellido = "Blas", $dni = "33444222", $salario = "7000")
    {
        $t = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fingreso);
        return $t;
    }

    public function testFechaIngreso()
    {
        $p = $this->crear(new DateTime('2020-10-10'));
        $this->assertEquals("2020-10-10 00:00:00", $p->getFechaIngreso()->format('Y-m-d H:i:s'));
        $p = $this->crear(new DateTime('2020-09-18'));
        $this->assertEquals("2020-09-18 00:00:00", $p->getFechaIngreso()->format('Y-m-d H:i:s'));
    }

    public function testCalcularComision()
    {
        $p = $this->crear(new DateTime('2020-10-10'));
        $this->assertEquals("1%", $p->calcularComision());
        $p = $this->crear(new DateTime('2012-10-10'));
        $this->assertEquals("9%", $p->calcularComision());
    }

    public function testCalcularIngresoTotal()
    {
        $p = $this->crear(new DateTime('2020-10-10'));
        $this->assertEquals( 7000 + (7000*1) / 100, $p->calcularIngresoTotal());

    }

    public function testCalcularAntiguedad()
    {
        $p = $this->crear(new DateTime('1998-10-10'));
        $this->assertEquals("23", $p->calcularAntiguedad());
        $p = $this->crear(new DateTime('2012-10-10'));
        $this->assertEquals("9", $p->calcularAntiguedad());
    }

    public function testObtenerFechaIngresoSinProporcionarla()
    {
        $p = $this->crear();
        $hoy = new DateTime();
        $this->assertEquals($hoy->format('Y-m-d'), $p->getFechaIngreso()->format('Y-m-d'));
        $this->assertEquals(0, $p->calcularAntiguedad());
    }

    public function testConstructConFechaFutura()
    {
        $this->expectException(\Exception::class);
        $p = $this->crear(new DateTime('2022-10-10'));
    }
}

?>