<?php

class Funcionario {
    protected $nome;
    protected $salario;

    public function __construct($nome, $salario) {
        $this->nome = $nome;
        $this->salario = $salario;
    }

    public function addAumento($valor) {
        $this->salario += $valor;
    }

    public function ganhoAnual() {
        return $this->salario * 12;
    }

    public function exibeDados() {
        echo "Nome: {$this->nome}, Salário: {$this->salario} </br> ";
    }
}

class Assistente extends Funcionario {
    private $Matricula;

    public function getMatricula() {
        return $this->Matricula;
    }

    public function setNumeroMatricula($numero) {
        $this->Matricula = $numero;
    }

    public function exibeDados() {
        parent::exibeDados();
        echo "Número de Matrícula: {$this->Matricula} </br>";
    }
}

class Tecnico extends Assistente {
    public function ganhoAnual() {
        return parent::ganhoAnual() + 1000; // Bônus salarial
    }
}

class Administrativo extends Assistente {
    private $turno;
    private $adicionalNoturno;

    public function __construct($nome, $salario, $turno, $adicionalNoturno) {
        parent::__construct($nome, $salario);
        $this->turno = $turno;
        $this->adicionalNoturno = $adicionalNoturno;
    }

    public function ganhoAnual() {
        return parent::ganhoAnual() + $this->adicionalNoturno;
    }
}

class Ingresso {
    protected $valor;

    public function __construct($valor) {
        $this->valor = $valor;
    }

    public function imprimeValor() {
        echo "Valor do Ingresso: R$ {$this->valor}<\br>";
    }
}

class VIP extends Ingresso {
    private $valorAdicional;

    public function __construct($valor, $valorAdicional) {
        parent::__construct($valor);
        $this->valorAdicional = $valorAdicional;
    }

    public function valorVIP() {
        return $this->valor + $this->valorAdicional;
    }
}

class Normal extends Ingresso {
    public function imprime() {
        echo "Ingresso Normal </br>";
    }
}

class CamaroteInferior extends VIP {
    private $localizacao;

    public function __construct($valor, $valorAdicional, $localizacao) {
        parent::__construct($valor, $valorAdicional);
        $this->localizacao = $localizacao;
    }

    public function acessaLocalizacao() {
        return $this->localizacao;
    }

    public function imprimeLocalizacao() {
        echo "Localização: {$this->localizacao} </br>";
    }
}

class CamaroteSuperior extends VIP {
    public function valorCamaroteSuperior() {
        return $this->valorVIP() + 50; 
    }
} 

class Imovel {
    protected $endereco;
    protected $preco;

    public function __construct($endereco, $preco) {
        $this->endereco = $endereco;
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }
}

class Novo extends Imovel {
    private $adicionalPreco;

    public function __construct($endereco, $preco, $adicionalPreco) {
        parent::__construct($endereco, $preco);
        $this->adicionalPreco = $adicionalPreco;
    }

    public function getPrecoFinal() {
        return $this->preco + $this->adicionalPreco;
    }
}

class Velho extends Imovel {
    private $descontoPreco;

    public function __construct($endereco, $preco, $descontoPreco) {
        parent::__construct($endereco, $preco);
        $this->descontoPreco = $descontoPreco;
    }

    public function getPrecoFinal() {
        return $this->preco - $this->descontoPreco;
    }
}

class Teste {
    public static function main() {
        $assistenteAdmin = new Administrativo("João", 3000, "dia", 500);
        $assistenteAdmin->setNumeroMatricula(123);
        $assistenteAdmin->exibeDados();

        $assistenteTec = new Tecnico("Maria", 3500);
        $assistenteTec->setNumeroMatricula(456);
        $assistenteTec->exibeDados();

        $cachorro = new class {
            public function latir() {
                echo "O cachorro late: Au Au!</br>";
            }
            public function caminhar() {
                echo "O cachorro está caminhando.</br>";
            }
        };

        $gato = new class {
            public function miar() {
                echo "O gato mia: Miau! </br>";
            }
            public function caminhar() {
                echo "O gato está caminhando. </br>";
            }
        };

        $cachorro->latir();
        $gato->miar();
        $cachorro->caminhar();
        $gato->caminhar();

        $tipoIngresso = 1; 
        if ($tipoIngresso == 1) {
            $ingresso = new Normal(50);
            $ingresso->imprime();
        } else {
            $ingressoVIP = new VIP(100, 20);
            echo "Ingresso VIP: R$ " . $ingressoVIP->valorVIP() . "\n";
        }

        $tipoImovel = 1; 
        if ($tipoImovel == 1) {
            $imovelNovo = new Novo("Rua A", 200000, 5000);
            echo "Preço final do imóvel novo: R$ " . $imovelNovo->getPrecoFinal() . "\n";
        } else {
            $imovelVelho = new Velho("Rua B", 150000, 10000);
            echo "Preço final do imóvel velho: R$ " . $imovelVelho->getPrecoFinal() . "\n";
        }
    }
}

Teste::main();

?>