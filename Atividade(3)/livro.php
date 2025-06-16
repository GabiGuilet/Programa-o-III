<?php
// === INICIAR SESSÃO E CLASSES ===
session_start();

class Livro {
    public $titulo;
    public $autor;
    private $preco;
    protected $estoque;

    public function __construct($titulo, $autor, $preco, $estoque = 0) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->preco = $preco;
        $this->estoque = $estoque;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($valor) {
        if ($valor >= 0) $this->preco = $valor;
    }

    protected function adicionarEstoque($quantidade) {
        if ($quantidade > 0) $this->estoque += $quantidade;
    }

    public function verEstoque() {
        return $this->estoque;
    }
}

class LivroFisico extends Livro {
    public function reporEstoque($quantidade) {
        $this->adicionarEstoque($quantidade);
    }
}

class ContaBancaria {
    public $titular;
    protected $saldo;
    private $senha;

    public function __construct($titular, $senha, $saldo = 0) {
        $this->titular = $titular;
        $this->senha = $senha;
        $this->saldo = $saldo;
    }

    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            return "Depósito de R$ $valor realizado com sucesso.";
        }
        return "Valor inválido para depósito.";
    }

    public function sacar($valor, $senha) {
        if ($senha !== $this->senha) return "Senha incorreta! Saque não autorizado.";
        if ($valor <= $this->saldo) {
            $this->saldo -= $valor;
            return "Saque de R$ $valor realizado com sucesso.";
        }
        return "Saldo insuficiente para saque.";
    }

    public function verSaldo($senha) {
        return ($senha === $this->senha)
            ? "Saldo atual: R$ " . number_format($this->saldo, 2, ',', '.')
            : "Senha incorreta! Acesso negado.";
    }
}

// === CRIAÇÃO DOS OBJETOS NA SESSÃO ===
if (!isset($_SESSION['livro'])) {
    $_SESSION['livro'] = serialize(new LivroFisico("Dom Casmurro", "Machado de Assis", 45.90, 10));
}
if (!isset($_SESSION['conta'])) {
    $_SESSION['conta'] = serialize(new ContaBancaria("Maria Silva", "1234", 1000));
}

$livro = unserialize($_SESSION['livro']);
$conta = unserialize($_SESSION['conta']);

// === PROCESSAMENTO DE FORMULÁRIOS ===
$msgLivro = '';
$msgConta = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ações do Livro
    if ($_POST['acao_livro'] ?? null) {
        if ($_POST['acao_livro'] === 'alterar_preco') {
            $novoPreco = floatval(str_replace(',', '.', $_POST['preco']));
            $livro->setPreco($novoPreco);
            $msgLivro = "Preço alterado para R$ " . number_format($livro->getPreco(), 2, ',', '.');
        } elseif ($_POST['acao_livro'] === 'repor_estoque') {
            $qtd = intval($_POST['quantidade']);
            $livro->reporEstoque($qtd);
            $msgLivro = "Estoque aumentado em $qtd unidades.";
        }
    }

    // Ações da Conta
    if ($_POST['acao_conta'] ?? null) {
        if ($_POST['acao_conta'] === 'depositar') {
            $valor = floatval(str_replace(',', '.', $_POST['valor_deposito']));
            $msgConta = $conta->depositar($valor);
        } elseif ($_POST['acao_conta'] === 'sacar') {
            $valor = floatval(str_replace(',', '.', $_POST['valor_saque']));
            $senha = $_POST['senha_saque'];
            $msgConta = $conta->sacar($valor, $senha);
        } elseif ($_POST['acao_conta'] === 'ver_saldo') {
            $senha = $_POST['senha_saldo'];
            $msgConta = $conta->verSaldo($senha);
        }
    }

    // Atualiza objetos na sessão
    $_SESSION['livro'] = serialize($livro);
    $_SESSION['conta'] = serialize($conta);
}
?>