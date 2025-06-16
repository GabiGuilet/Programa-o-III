<?php
class Livro {
    private $titulo;
    private $autor;
    private $anoPublicacao;
    private $disponivel;
    protected $leitorAtual;

    public function __construct($titulo, $autor, $ano) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $ano;
        $this->disponivel = true;
        $this->leitorAtual = null;
    }

    // Getters e Setters
    public function getTitulo() { return $this->titulo; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }

    public function getAutor() { return $this->autor; }
    public function setAutor($autor) { $this->autor = $autor; }

    public function getAnoPublicacao() { return $this->anoPublicacao; }
    public function setAnoPublicacao($ano) { $this->anoPublicacao = $ano; }

    public function isDisponivel() { return $this->disponivel; }
    public function setDisponivel($estado) { $this->disponivel = $estado; }

    public function exibirInformacoes() {
        echo "📚 <strong>{$this->titulo}</strong>, de {$this->autor} ({$this->anoPublicacao})<br>";
        echo "Disponível: " . ($this->disponivel ? "Sim" : "Não") . "<br>";
        if ($this->leitorAtual) {
            echo "Emprestado para: {$this->leitorAtual}<br>";
        }
        echo "<hr>";
    }

    public function emprestar($nomeLeitor) {
        if ($this->disponivel) {
            $this->disponivel = false;
            $this->leitorAtual = $nomeLeitor;
            return "Livro emprestado para $nomeLeitor.";
        }
        return "Livro indisponível para empréstimo.";
    }

    public function devolver() {
        if (!$this->disponivel) {
            $this->disponivel = true;
            $this->leitorAtual = null;
            return "Livro devolvido com sucesso.";
        }
        return "Este livro já está disponível.";
    }

    public function estaDisponivel() {
        return $this->disponivel ? "Livro disponível para empréstimo." : "Livro emprestado.";
    }

    public function quemPegou() {
        return $this->leitorAtual ?: "Ninguém.";
    }
}

class Leitor {
    private $nome;
    private $email;
    private $telefone;

    public function __construct($nome, $email, $telefone) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }

    public function exibirLeitor() {
        echo "👤 <strong>{$this->nome}</strong><br>Email: {$this->email}<br>Telefone: {$this->telefone}<br><hr>";
    }
}

class Biblioteca {
    public $nomeBiblioteca;
    private $livros = [];
    private $leitores = [];

    public function __construct($nome) {
        $this->nomeBiblioteca = $nome;
    }

    public function adicionarLivro(Livro $livro) {
        $this->livros[] = $livro;
    }

    public function adicionarLeitor(Leitor $leitor) {
        $this->leitores[] = $leitor;
    }

    public function listarLivros() {
        echo "<h3>Livros disponíveis na biblioteca:</h3>";
        foreach ($this->livros as $livro) {
            $livro->exibirInformacoes();
        }
    }

    public function listarLeitores() {
        echo "<h3>Leitores cadastrados:</h3>";
        foreach ($this->leitores as $leitor) {
            $leitor->exibirLeitor();
        }
    }
}

// ==== CENÁRIO DE TESTE ====

echo "<h2>📚 Biblioteca Central</h2>";

$livro1 = new Livro("1984", "George Orwell", 1949);
$livro2 = new Livro("Capitães da Areia", "Jorge Amado", 1937);

$leitor1 = new Leitor("Ana Paula", "ana@example.com", "99999-1234");
$leitor2 = new Leitor("Carlos Silva", "carlos@example.com", "98888-4567");

$biblioteca = new Biblioteca("Biblioteca Central");
$biblioteca->adicionarLivro($livro1);
$biblioteca->adicionarLivro($livro2);
$biblioteca->adicionarLeitor($leitor1);
$biblioteca->adicionarLeitor($leitor2);

$biblioteca->listarLivros();
$biblioteca->listarLeitores();

// Empréstimo
echo "<p><strong>Empréstimo:</strong> " . $livro1->emprestar($leitor1->getNome()) . "</p>";

// Status
echo "<p>" . $livro1->estaDisponivel() . "</p>";
echo "<p>Quem está com o livro: " . $livro1->quemPegou() . "</p>";

// Devolução
echo "<p><strong>Devolução:</strong> " . $livro1->devolver() . "</p>";
echo "<p>" . $livro1->estaDisponivel() . "</p>";
?>
