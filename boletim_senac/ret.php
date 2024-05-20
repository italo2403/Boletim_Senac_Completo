<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inserir Notas</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding-top: 50px;
            }

            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 0 20px;
            }

            h1 {
                text-align: center;
                color: #343a40;
                margin-bottom: 40px;
            }

            .student-card {
                margin-bottom: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .student-card img {
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                width: 100%;
                height: 200px;
                object-fit: cover;
            }

            .student-card-body {
                padding: 20px;
            }

            .student-card-title {
                font-size: 1.5rem;
                color: #007bff;
                margin-bottom: 10px;
            }

            .student-card-text {
                font-size: 1rem;
                color: #555;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                font-weight: bold;
            }

            .form-group select,
            .form-group input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ced4da;
                border-radius: 5px;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                border-radius: 5px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                transition: background-color 0.3s, color 0.3s;
            }

            .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <h1>Inserir Notas</h1>

        <div class="container">
            <?php
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

            // Consulta SQL para recuperar os alunos
            $sql_alunos = "SELECT * FROM alunos";
            $result_alunos = $conn->query($sql_alunos);

            // Se houver alunos, exibe o formulário para inserção de notas
            if ($result_alunos->num_rows > 0) {
                // Exibir os dados de cada aluno em um card
                if ($row_aluno = $result_alunos->fetch_assoc()) {
                    echo '<div class="student-card">';
                    echo '<div class="student-card-body">';
                    echo '<h2 class="student-card-title">' . $row_aluno["nome"] . '</h2>';
                    echo '<p class="student-card-text">';
                    echo '<strong>Email:</strong> ' . $row_aluno["email"] . '<br>';
                    echo '<strong>Responsável:</strong> ' . $row_aluno["tele_respon"] . '</p>';
                    echo '<form action="salvar_nota.php" method="POST">';
                    echo '<input type="hidden" name="id_aluno" value="' . $row_aluno["id_alu"] . '">'; // Adiciona campo oculto para o ID do aluno
                    echo '<div class="form-group">';
                    echo '<label for="disciplina">Disciplina:</label>';
                    echo '<select id="disciplina" name="disciplina" required>';
                    
                    // Consulta SQL para recuperar as disciplinas
                    $sql_disciplinas = "SELECT * FROM disciplinas";
                    $result_disciplinas = $conn->query($sql_disciplinas);
                    
                    // Exibir as disciplinas em opções do select
                    if ($result_disciplinas->num_rows > 0) {
                        while ($row_disciplina = $result_disciplinas->fetch_assoc()) {
                            echo '<option value="' . $row_disciplina["id_disciplina"] . '">' . $row_disciplina["nome"] . '</option>';
                        }
                    }
                    
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="nota1">Nota 1:</label>';
                    echo '<input type="text" id="nota1" name="nota1" placeholder="Digite a nota 1" required>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="nota2">Nota 2:</label>';
                    echo '<input type="text" id="nota2" name="nota2" placeholder="Digite a nota 2" required>';
                    echo '</div>';
                    // Novo campo para selecionar o conceito
                    echo '<div class="form-group">';
                    echo '<label for="conceito">Conceito:</label>';
                    echo '<select id="conceito" name="conceito" required>';
                    echo '<option value="A">A</option>';
                    echo '<option value="B">B</option>';
                    echo '<option value="C">C</option>';
                    // Adicione mais opções conforme necessário
                    echo '</select>';
                    echo '</div>';
                    echo '<button type="submit" class="btn">Salvar Notas</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nenhum aluno encontrado";
            }

            $conn->close();
            ?>
        </div>
    </body>
    </html>