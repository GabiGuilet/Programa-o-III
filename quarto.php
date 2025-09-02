<?php
class Quarto {
    protected $numero;
    protected $preco;

    public function __construct($num) {
        $this->numero = $num;
    }

    public function getNumero() {
        return $this->numero;
    }
}

class Standard extends Quarto {
    public function getPreco() {
        return $this->preco = 300.00;
    }
}

class Deluxe extends Quarto {
    public function getPreco($hospedes) {
        if ($hospedes > 2) {
            return $this->preco = (300.00 * 1.2) * 1.1;
        } else {
            return $this->preco = 300.00 * 1.2;
        }
    }
}

class Suite extends Quarto {
    public function getPreco($dia) {
        if ($dia >= 2 && $dia <= 6) {
            return $this->preco = 300.00 * 1.5;
        } else {
            return $this->preco = (300.00 * 1.5) * 1.5;
        }
    }
}

$std = new Standard(11);
echo "Hospede - quarto: " . $std->getNumero() . " Valor: R$ " . $std->getPreco() . "<br>";

$duplo = new Deluxe(41);
echo "Hospede - quarto: " . $duplo->getNumero() . " Valor: R$ " . $duplo->getPreco(2) . "<br>";

$suite = new Suite(101);
echo "Hospede - quarto: " . $suite->getNumero() . " Valor: R$ " . $suite->getPreco(1) . "<br>";
?>