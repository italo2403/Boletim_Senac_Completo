<?php
// Conexão com o banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boletim";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta SQL para recuperar os dados das disciplinas, incluindo o nome do aluno
$sql = "SELECT d.nome_disc, d.turma, a.nome
        FROM disciplinas d
        INNER JOIN alunos a ON d.id_alu = a.id_alu";

$result = $conn->query($sql);

// Se houver dados, exibe-os na tabela HTML
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Turma</th>";
    echo "<th>Disciplinas</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    // Exibir os dados de cada disciplina, incluindo o nome do aluno
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["turma"] . "</td>";
        echo "<td>" . $row["nome_disc"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Nenhuma disciplina encontrada";
}

$conn->close();
?>
