<?php

class EmpleadosTests extends \PHPUnit\Framework\TestCase
{

    public function crearEventual($nombre = "Kimey", $apellido = "Wilkinson", $dni = "44333222", $salario = "4000", $montos = [400, 400])
    {
        $t = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
        return $t;
    }
    public function crearPermanente($fingreso = null, $nombre = "Benjamin", $apellido = "Blas", $dni = "33444222", $salario = "7000")
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

    public function testRecibirDNI()
    {
        $e = $this->crearEventual();
        $this->assertEquals("44333222", $e->getDNI());
        $p = $this->crearPermanente();
        $this->assertEquals("33444222", $p->getDNI());
    }

    public function testRecibirSalario()
    {
        $e = $this->crearEventual();
        $this->assertEquals("4000", $e->getSalario());
        $p = $this->crearPermanente();
        $this->assertEquals("7000", $p->getSalario());
    }


    public function testSectorMethods()
    {
        $e = $this->crearEventual();
        $e->setSector("A");
        $this->assertEquals("A", $e->getSector());
        $e->setSector("B");
        $this->assertEquals("B", $e->getSector());
        $p = $this->crearPermanente();
        $p->setSector("C");
        $this->assertEquals("C", $p->getSector());
        $p->setSector("D");
        $this->assertEquals("D", $p->getSector());
    }

    public function testToString()
    {
        $e = $this->crearEventual();
        $this->assertEquals("Kimey Wilkinson 44333222 4000", $e->__toString());
        $p = $this->crearPermanente();
        $this->assertEquals("Benjamin Blas 33444222 7000", $p->__toString());
    }

    // Empleado con nombre vacio, lanza una excepción.
    public function testCrearSinNombreEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("");
    }
    public function testCrearSinNombrePermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "");
    }

    // Empleado con apellido vacio, lanza una excepción.
    public function testCrearSinApellidoEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Kimey", "");
    }
    public function testCrearSinApellidoPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Benjamin", "");
    }

    // Empleado DNI vacio, lanza una excepción.
    public function testCrearSinDNIEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Kimey", "Wilkinson", "");
    }
    public function testCrearSinDNIPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Benjamin", "Blas", "");
    }

    // Empleado salario vacio, lanza una excepción.
    public function testCrearSinSalarioEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Kimey", "Wilkinson", "44333222", "");
    }
    public function testCrearSinSalarioPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Benjamin", "Blas", "33444222", "");
    }

    // Empleado cuyo DNI contiene letras o caracteres no numericos, lanza una excepción.
    public function testCrearSinDNICharsEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Kimey", "Wilkinson", "44KKK22&");
    }
    public function testCrearSinDNICharsPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Benjamin", "Blas", "33BBB22&");
    }

    //El empleado no especifica el sector, el método (getSector) debe devolver la cadena “No especificado”.
    public function testInitGetSector()
    {
        $e = $this->crearEventual();
        $this->assertEquals("No especificado", $e->getSector());
        $p = $this->crearPermanente();
        $this->assertEquals("No especificado", $p->getSector());
    }
}

?>