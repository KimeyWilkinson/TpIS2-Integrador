<?php

class EmpleadoEventualTest extends \PHPUnit\Framework\TestCase
{

    public function crearEventual($nombre = "Kimey", $apellido = "Wilkinson", $dni = "44333222", $salario = "4000", $montos = [400, 400])
    {
        $t = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
        return $t;
    }
    public function crearPermanente($fingreso = null, $nombre = "Kimey", $apellido = "Wilkinson", $dni = "44333222", $salario = "4000")
    {
        $t = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fingreso);
        return $t;
    }

    public function testRecibirNombreApellido()
    {
        $e = $this->crearEventual("Kimey", "Wilkinson");
        $this->assertEquals("Kimey Wilkinson", $e->getNombreApellido());
        $p = $this->crearPermanente(new DateTime(), "Benjamin", "Blas");
        $this->assertEquals("Benjamin Blas", $p->getNombreApellido());
    }
}

?>