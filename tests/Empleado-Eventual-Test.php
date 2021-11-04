<?php

class EmpleadoEventualTests extends \PHPUnit\Framework\TestCase
{

    public function crear($nombre = "Kimey", $apellido = "Wilkinson", $dni = "44333222", $salario = "4000", $montos = [400, 700])
    {
        $t = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
        return $t;
    }

    public function testCalcularComision()
    {
        $e = $this->crear();
        $this->assertEquals 0.05 * ((1300/2), $e->calcularComision());
    }

    public function testCalcularIngresoTotal()
    {
        $e = $this->crear();
        $this->assertEquals($e->getSalario() + $e->calcularComision(), $e->calcularIngresoTotal());
    }

    public function testCalcularConstructConVenta0()
    {
        $this->expectException(\Exception::class);
        $e = $this->crear("Kimey", "Wilkinson", "44333222", "4000", [400, 0]);
    }

    public function testCalcularConstructConVentaNeg()
    {
        $this->expectException(\Exception::class);
        $e = $this->crear("Kimey", "Wilkinson", "44333222", "4000", [-40, 100]);
    }
}

?>