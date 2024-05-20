<?php
// Verifica se os dados do formulário foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST["id_aluno"]) && isset($_POST["unidade"]) && isset($_POST["nota1"]) && isset($_POST["nota2"]) && isset($_POST["conceito"]) && isset($_POST["disciplina"])) {
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "boletim_escolar";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica se a conexão foi bem sucedida
        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        // Prepara a declaração SQL para inserir as notas no banco de dados
        $sql_insert_notas = "INSERT INTO notas (id_aluno, id_disciplina, unidade, av1, av2, conceito) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepara a declaração SQL
        $stmt = $conn->prepare($sql_insert_notas);

        // Verifica se a preparação da declaração foi bem sucedida
        if ($stmt) {
            // Vincula parâmetros à declaração preparada
            $stmt->bind_param("iiisss", $id_aluno, $id_disciplina, $unidade, $nota1, $nota2, $conceito);

            // Itera sobre os dados recebidos do formulário
            for ($i = 0; $i < count($_POST["id_aluno"]); $i++) {
                $id_aluno = $_POST["id_aluno"][$i];
                $id_disciplina = $_POST["disciplina"][$i];
                $unidade = $_POST["unidade"][$i];
                $nota1 = $_POST["nota1"][$i];
                $nota2 = $_POST["nota2"][$i];
                $conceito = $_POST["conceito"][$i];

                // Executa a declaração preparada
                if (!$stmt->execute()) {
                    echo "Erro ao inserir notas para o aluno ID $id_aluno: " . $stmt->error;
                }
            }

            // Consulta para obter o nome do aluno
            $sql = "SELECT id_aluno FROM alunos WHERE nome = '$nome_aluno'";
            // $sql_select_nome = "SELECT nome FROM alunos WHERE id_aluno = ?";
            $stmt_nome = $conn->prepare($sql_select_nome);
            $stmt_nome->bind_param("i", $id_aluno);
            $stmt_nome->execute();
            $stmt_nome->bind_result($nome_aluno);
            $stmt_nome->fetch();
            $stmt_nome->close();

            echo "Notas inseridas com sucesso.";

            // Fecha a declaração preparada
            $stmt->close();
        } else {
            echo "Erro na preparação da declaração: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Se algum campo estiver faltando, exibe uma mensagem de erro
        echo "Todos os campos são obrigatórios!";
    }
} else {
    // Se o método de requisição não for POST, redireciona para a página anterior ou exibe uma mensagem de erro
    echo "Acesso não autorizado!";
}
?>
