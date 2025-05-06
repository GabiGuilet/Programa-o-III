<?php
// Definindo a minha classe Produto

class Produto {
    // Definir atributos
    public $nome;
    public $preco;
    public $quantidade; 

    public function exibirInformacoes() {
        echo "<strong>Nome:</strong> $this->nome<br>";
        echo "<strong>Preço:</strong> R$ $this->preco<br>";
        echo "<strong>Quantidade:</strong> $this->quantidade<br><br>";
    }
}

$produto1 = new Produto();
$produto1->nome = "caneta";
$produto1->preco = 2.50;
$produto1->quantidade = 10;

$produto2 = new Produto();
$produto2->nome = "lapis";
$produto2->preco = 1.50;
$produto2->quantidade = 15;

// Exibindo os dados com formatação HTML
$produto1->exibirInformacoes();
$produto2->exibirInformacoes();

function mostrarMediaPrecos($produto1, $produto2){
    $preco1 = $produto1->preco;
    $preco2 = $produto2->preco;
    $media = ($preco1 + $preco2) / 2;
    echo "<strong>A média dos preços é:</strong> R$ $media";
}

mostrarMediaPrecos($produto1, $produto2);
?>




