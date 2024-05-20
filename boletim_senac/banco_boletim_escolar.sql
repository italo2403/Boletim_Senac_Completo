-- Criação do banco de dados
CREATE DATABASE boletim_escolar;

-- Excluir o banco
-- drop database boletim_escolar;

-- Seleciona o banco de dados
USE boletim_escolar;

-- Tabela para armazenar as disciplinas
CREATE TABLE disciplinas (
    id_disciplina INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);
-- Disciplinas inseridas na Tabela para retorno do Banco
insert into disciplinas(nome) values("LÍNGUA PORTUGUSESA");
insert into disciplinas(nome) values("LITERATURA");
insert into disciplinas(nome) values("PRODUÇÃO TEXTUAL");
insert into disciplinas(nome) values("MATEMÁTICA");
insert into disciplinas(nome) values("GEOGRAFIA");
insert into disciplinas(nome) values("HISTÓRIA");
insert into disciplinas(nome) values("INGLÊS");
insert into disciplinas(nome) values("FORMAÇÃO PROFIS.");
insert into disciplinas(nome) values("PROJETO DE VIDA");
insert into disciplinas(nome) values("PROGRAMAÊ");
insert into disciplinas(nome) values("FILOSOFIA");														
insert into disciplinas(nome) values("QUÍMICA");													
insert into disciplinas(nome) values("ARTES");													
insert into disciplinas(nome) values("FÍSICA");												
insert into disciplinas(nome) values("BIOLOGIA");	

-- Tabela Alunos, onde devem ser cadastrado os alunos
create table alunos(
id_alu int primary key auto_increment,
nome varchar(255) not null,
email varchar(255) not null, 
tele_respon varchar(50) not null 
);
-- Inserindo os alunos na tabela
INSERT INTO alunos (nome, email, tele_respon)
VALUES ('ADRÍCIA NAINE COSTA BANDEIA FERREIRA
', 'adriciaferreira629439@alunosenac.com', '97106-3200
');
INSERT INTO alunos (nome, email, tele_respon)
VALUES ('Geovana', 'adricia@email.com', '0000000000'),
('AIRTON  SAMUEL RODRIGUES COSTA
', 'adricia@email.com', '0000000000');
INSERT INTO alunos (nome, email, tele_respon)
VALUES 
 ('AIRTON SAMUEL RODRIGUES COSTA', 'airtoncosta639408@alunosenac.com', '983377811'),
 ('ALICE GABRIELLE DE OLIVEIRA ALMEIDA', 'alicealmeida226473@alunosenac.com', '983377811'),
('BRUNO RAFAEL SILVA COSTA', 'brunocosta538476@alunosenac.com', '(81) 99670-2599'),
('CAIO CESAR SILVA', 'caiomelo049474@alunosenac.com', '(81) 98715-9399'),
('CAIO MULLER SILVA DA ROCHA', 'caiorocha562460@alunosenac.com', '987775350'),
('DANIEL HENRIQUE JOSÉ DOS SANTOS', 'daniehenri333@gmail.com', '993838094'),
('DAVI FELIX MARINHO', 'davi1103felix@gmail.com', '(81) 98760-5491'),
('DAVI NEVES GALVÃO', 'davinevesgalvao@gmail.com', '(81) 98620-6318'),
('DIOGENES LUIZ FREITAS BATISTA', 'diogenesluiz2028@gmail.com', '(81) 99786-5657'),
('EDUARDO PASSOS DE ANDRADE', 'edupassosa18@gmail.com', '987892145'),
('GABRIELA LIMA ALEXANDRINA', 'gabrielalimafg0102@gmail.com', '(81) 98689-1037'),
('GEOVANA NOEMI FERREIRA', 'geovananoemi2009moura@gmail.com', '(81) 98665-2964'),
('GUILHERME JOSÉ RODRIGUES DE FREITAS', 'jailsonrodriguesdesouza62@gmail.com', '991432039'),
('ÍCARO GABRIEL BRAGA DOS ANJOS', 'caroanjos332404@alunosenac.com', '999702111'),
('JOÃO HENRIQUE SANTANA CUNHA', 'joao1809.18@gmail', '0000000000'),
('LAYZA CRISTINA MELO SANTOS', 'layza.melo.santos@gmail.com', '98213-1305'),
('LIGIA VITÓRIA LINHARES DO NASCIMENTO', 'ligianascimento843485@alunosenac.com', '0000000000'),
('LUCAS MIGUEL BARBOSA DA SILVA', 'layza.melo.santos@gmail.com', '98213-1305'),
('LUIZ HENRIQUE DOS SANTOS', 'lucasmiguelbsilva@gmail.com', '996580922'),
('MARCOS VASCONCELOS DENCKER BELTRÃO', 'marcosvdencker@gmail.com', '99791-5135'),
('MARIA CAROLINA FRANCO DE LIMA LEITE', 'mariacarolinafrancodelimaleite@gmail.com', '99555-4304'),
('MARIA MANOELA HELENA DA SILVA', 'mariamanuela9206@gmail.com', '98697-4152'),
('MATHEUS DE ANDRADE CORDEIRO MALAFAIA GOMES', 'matheusacmg@gmail.com', '(81) 98864-9730');


-- Tabela para armazenar as notas dos alunos
CREATE TABLE notas (
    id_nota INT PRIMARY KEY AUTO_INCREMENT,
    id_disciplina INT,
    id_aluno INT,
    unidade INT,
    av1 VARCHAR(10),
    av2 VARCHAR(10),
    conceito VARCHAR(10),
    pos_noa VARCHAR(10),
    FOREIGN KEY (id_disciplina) REFERENCES disciplinas(id_disciplina),
    FOREIGN KEY (id_aluno) REFERENCES alunos(id_alu)
   
);

-- Tabela para armazenar as turmas dos alunos
CREATE TABLE turmas (
    id_turma INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(15) NOT NULL
);

-- Tabela para relacionar alunos com turmas
CREATE TABLE alunos_turmas (
    id_aluno INT,
    id_turma INT,
    FOREIGN KEY (id_aluno) REFERENCES alunos(id_alu),
    FOREIGN KEY (id_turma) REFERENCES turmas(id_turma)
);
