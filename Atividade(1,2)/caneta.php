<?php
// Definindo a minha classe caneta

class Caneta {
    // Definir atributos

    public $cor;

    public $marca;

    public $ponta; 

    public $tamanho; 

    public $carga; 

    //Definir métodos

    public function escrever(){
    echo"Escrevendo...<br>";
    }

    public function rabiscar(){
        echo "Rabiscando...<br>";
    }

    public function sublinhar(){
        echo "Sublinhando...<br>";
    }

    public function pintar(){
        echo "Pintando...<br>";
    }
}
//Instanciando a classe Caneta

$caneta1 = new Caneta();
//Como os atributos da minha classe Caneta são públicos, podemos acessa-los diretamente
$caneta1->cor = "Azul";
$caneta1->ponta = "0.5";
$caneta1->marca = "Bic";
$caneta1->tamanho = "grande";
$caneta1->carga = "100";

// Exibindo os atributos da caneta
echo "Cor:" . $caneta1-> cor . "<br>";
echo "Ponta: " . $caneta1->ponta . "<br>";
echo "Marca: " . $caneta1->marca . "<br>";
echo "Tamanho: ". $caneta1->tamanho ."<br>";
echo "Carga: ". $caneta1->carga ."<br>";

//Chamnado os métodos da caneta
$caneta1->escrever();
$caneta1->rabiscar();
$caneta1->sublinhar();
$caneta1->pintar();


?>