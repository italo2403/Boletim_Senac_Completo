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

        .menu {
            display: flex;
            justify-content: center; /* Alinha os itens horizontalmente ao centro */
            align-items: center; /* Alinha os itens verticalmente ao centro */
            gap: 20px; /* Espaço entre os itens do menu */
            padding-top: 20px; /* ou */
            border-top: 1px solid transparent;
        }

        a {
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s, color 0.3s;
            margin-top: -20px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <h1>Inserir Notas</h1>

    <div class="menu">
        <nav><a href="index.html" class="centro">Início</a></nav>
        <!-- <nav><a href="1A.html" class="centro">Voltar</a></nav> -->
    </div>
    <div class="container">
    <form action="salvar_nota.php" method="POST">
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
        while ($row_aluno = $result_alunos->fetch_assoc()) {
            echo '<div class="student-card">';
            echo '<div class="student-card-body">';
            echo '<h2 class="student-card-title">' . $row_aluno["nome"] . '</h2>';
            echo '<p class="student-card-text">';
            echo '<strong>Email:</strong> ' . $row_aluno["email"] . '<br>';
            echo '<strong>Responsável:</strong> ' . $row_aluno["tele_respon"] . '</p>';
            echo '<input type="hidden" name="id_aluno[]" value="' . $row_aluno["id_alu"] . '">'; // Adiciona campo oculto para o ID do aluno

            // Adicionar campo para selecionar a disciplina
echo '<div class="form-group">';
echo '<label for="disciplina_' . $row_aluno["id_alu"] . '">Disciplina:</label>';
echo '<select id="disciplina_' . $row_aluno["id_alu"] . '" name="disciplina[]" required>';
echo '<option value="1">LÍNGUA PORTUGUESA</option>';
echo '<option value="2">LITERATURA</option>';
echo '<option value="3">PRODUÇÃO TEXTUAL</option>';
echo '<option value="4">MATEMÁTICA</option>';
echo '<option value="5">GEOGRAFIA</option>';
echo '<option value="6">HISTÓRIA</option>';
echo '<option value="7">INGLÊS</option>';
echo '<option value="8">FORMAÇÃO PROFISSIONAL</option>';
echo '<option value="9">PROJETO DE VIDA</option>';
echo '<option value="10">PROGRAMAÊ</option>';
echo '<option value="11">FILOSOFIA</option>';
echo '<option value="12">QUÍMICA</option>';
echo '<option value="13">ARTES</option>';
echo '<option value="14">FÍSICA</option>';
echo '<option value="15">BIOLOGIA</option>';
echo '</select>';
echo '</div>';


            // Adicionar campo para selecionar a unidade
            echo '<div class="form-group">';
            echo '<label for="unidade_' . $row_aluno["id_alu"] . '">Unidade:</label>';
            echo '<select id="unidade_' . $row_aluno["id_alu"] . '" name="unidade[]" required>';
            echo '<option value="1">Unidade 1</option>';
            echo '<option value="2">Unidade 2</option>';
            echo '<option value="3">Unidade 3</option>';
            echo '</select>';
            echo '</div>';

            // Adicionar inputs de notas
            echo '<div class="form-group">';
            echo '<label for="nota1_' . $row_aluno["id_alu"] . '">Nota AV1:</label>';
            echo '<input type="text" id="nota1_' . $row_aluno["id_alu"] . '" name="nota1[]" placeholder="Digite a nota da AV1" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="nota2_' . $row_aluno["id_alu"] . '">Nota AV2:</label>';
            echo '<input type="text" id="nota2_' . $row_aluno["id_alu"] . '" name="nota2[]" placeholder="Digite a nota da AV2" required>';
            echo '</div>';

            

            // Adicionar input de conceito
            echo '<div class="form-group">';
            echo '<label for="conceito_' . $row_aluno["id_alu"] . '">Conceito:</label>';
            echo '<select id="conceito_' . $row_aluno["id_alu"] . '" name="conceito[]" required>';
            echo '<option value="A">A</option>';
            echo '<option value="B">B</option>';
            echo '</select>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Nenhum aluno encontrado";
    }

    $conn->close();
    ?>
    <button type="submit" class="btn">Salvar Notas</button>
</form>



    </div>
    <button class="btn-scroll-top" arial-label="Voltar ao topo">
      <img
        src="./assets/img/institucional/subir.png"
        alt="Voltar ao topo"
        width="70"
        height="50"
      />
    </button>

    <script>
        const btnScrollTop = document.querySelector(".btn-scroll-top");

window.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    btnScrollTop.classList.add("show-btn-scroll-top");
  } else {
    btnScrollTop.classList.remove("show-btn-scroll-top");
  }
});

btnScrollTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});
    </script>
</body>
</html>
