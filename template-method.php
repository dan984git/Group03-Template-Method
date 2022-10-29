<?php

abstract class Libro {

	var $tituto;
	var $autor;
	var $precio;
	var $tienda;
	protected $tipo;

	public function __construct($tituto, $autor, $precio) {
		$this->tituto = $tituto;
		$this->autor = $autor;
		$this->precio = $precio;
	}

	function precioTotal() {
		$precio = $this->precio +
			$this->comision() +
			$this->adicionales();
		return $precio;
	}

	abstract function comision();

	abstract function adicionales();

	function info() {
		$info = "Titulo: $this->tituto, Autor: $this->autor, Precio: \$$this->precio\n";
		$info .= "Edicion: " . $this->tipo;
		if ($this->tienda)
			$info .= "\nTienda: " . $this->tienda;
		return $info;
	}

}

class LibroDigital extends Libro {
	protected $tipo = 'Digital';

	function comision() {
		return 1.5;
	}

	function adicionales() {
		return 0;
	}
}

class LibroImpreso extends Libro {
	protected $tipo = 'Impreso';

	function comision() {
		return $this->precio * 0.20;
	}

	function adicionales() {
		return 20;
	}
}

// cliente

$lotr = new LibroImpreso("The Lord Of The Rings", 'JRR Tolkien', 50);
$lotr->tienda = "Mr Books";
$patterns = new LibroDigital("Patterns of Distributed Systems", 'Martin Fowler', 60);
$patterns->tienda = "Amazon";

echo $lotr->info() . "\n";
echo "Precio final: $" . $lotr->precioTotal() . "\n";

echo "\n";
echo $patterns->info() . "\n";
echo "Precio final: $" . $patterns->precioTotal() . "\n";