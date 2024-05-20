<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim Escolar</title>
    <link rel="stylesheet" href="boletim.css">
    <style>
         body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                margin: 0;
                padding: 0;
                background-color: #316aa0;
            }

            .container {
                width: 80%;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }

            tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            img{
                width: 90px;
                height: 60px;
            }
            .info{
                display: flex;
            }
            .texto{
                margin-left:50px;
                margin-bottom:12px;
            }
    </style>
</head>
<body>
    <div class="container">
        <h1>Boletim Escolar</h1>

        <!-- Formulário de pesquisa -->
        <form action="boletim.php" method="get">
            <div class="info">
                <div class="image">
                <img src="./assets/img/institucional/logo_senac.png"  alt="">
                </div>
               <div class="texto">
                <p><strong>
                SERVIÇO NACIONAL DE APRENDIZAGEM COMERCIAL<br>
 DEPARTAMENTO REGIONAL DE PERNAMBUCO<br>
 UNIDADE EDUCAÇÃO PROFISSIONAL DO PAULISTA<br>
 CURSO TÉCNICO EM INFORMÁTICA INTEGRADO AO ENSINO MÉDIO<br>
 CURSO TÉCNICO EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS INTEGRADO AO ENSINO MÉDIO<br>
        </strong>
               </p>
               </div>
            </div>
            <label for="nome_aluno">Pesquisar Aluno: </label>
            <input type="text" id="nome_aluno" name="nome_aluno" required>
            <button type="submit">Buscar Boletim</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th rowspan="2">Disciplina</th>
                    <th colspan="4">Unidade 1</th>
                    <th colspan="4">Unidade 2</th>
                    <th colspan="4">Unidade 3</th>
                </tr>
                <tr>
                    <th>AV1</th>
                    <th>AV2</th>
                    <th>Menção</th>
                    <th>Pós NOA</th>
                    <th>AV1</th>
                    <th>AV2</th>
                    <th>Menção</th>
                    <th>Pós NOA</th>
                    <th>AV1</th>
                    <th>AV2</th>
                    <th>Menção</th>
                    <th>Pós NOA</th>
                </tr>
            </thead>
            <?php
            
            // Se o nome do aluno foi enviado via GET
            if (isset($_GET['nome_aluno'])) {
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

                // Obtém o nome do aluno da requisição GET
                $nome_aluno = $_GET['nome_aluno'];

                // Consulta SQL para buscar o boletim do aluno
                $sql = "SELECT * FROM alunos WHERE nome = '$nome_aluno'";
                $result = $conn->query($sql);

                // Se houver resultados, exibe o boletim
                if ($result->num_rows > 0) {
                   
                // Consulta SQL para recuperar as disciplinas
                $sql_disciplinas = "SELECT * FROM disciplinas";
                $result_disciplinas = $conn->query($sql_disciplinas);

                // Se houver disciplinas, exibe o boletim
                if ($result_disciplinas->num_rows > 0) {
                    // Início da tabela de boletim
                    echo "<tbody>";
                    

                    // Exibir os dados de cada disciplina
                    
                    while ($row_disciplina = $result_disciplinas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row_disciplina["nome"] . "</td>";
                        
                        // Consulta SQL para recuperar as notas da disciplina
                        $sql_notas = "SELECT * FROM notas WHERE id_disciplina = " . $row_disciplina["id_disciplina"];
                        $result_notas = $conn->query($sql_notas);
                        
                        // Inicializa arrays para armazenar as notas
                        $notas = [];
                        
                        // Se houver notas, armazena-as no array
                        if ($result_notas->num_rows > 0) {
                            
                            while ($row_nota = $result_notas->fetch_assoc()) {
                                $notas[$row_nota["unidade"]] = [
                                    "av1" => $row_nota["av1"],
                                    "av2" => $row_nota["av2"],
                                    "mencao" => $row_nota["mencao_unidade"],
                                    "pos_noa" => $row_nota["pos_noa"]
                                ];
                            }
                        }
                        
                        // Exibir as notas na tabela
                        for ($i = 1; $i <= 3; $i++) {
                            echo "<td>" . ($notas[$i]["av1"] ?? "") . "</td>";
                            echo "<td>" . ($notas[$i]["av2"] ?? "") . "</td>";
                            echo "<td>" . ($notas[$i]["mencao"] ?? "") . "</td>";
                            echo "<td>" . ($notas[$i]["pos_noa"] ?? "") . "</td>";
                        }
                        
                        echo "</tr>";
                    }
                    
                    // Fim da tabela de boletim
                    echo "</tbody>";
                } else {
                    echo "Nenhuma disciplina encontrada";
                }

                } else {
                    echo "<tr><td colspan='13'>Nenhum aluno encontrado com o nome '$nome_aluno'.</td></tr>";
                }

                $conn->close();
            }
            ?>
        </table>
        <button onclick="window.print()">Imprimir</button>
    </div>
</body>
</html>
