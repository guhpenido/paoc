-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Dez-2023 às 18:33
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `paoc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `usuario`, `email`, `senha`, `permissao`) VALUES
(4, 'adminGeral', 'admin', 'N/A', 'olimpiadas2023', '2'),
(5, 'adminSuporte', 'suporte', 'gugupenido@gmail.com', 'suporte2023', '1'),
(6, 'Gustavo Penido', 'guspenido', 'gugupenidop@gmail.com', 'gugucanal123', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `nome_responsavel` varchar(255) DEFAULT NULL,
  `email_responsavel` varchar(255) DEFAULT NULL,
  `nome_capitao` varchar(255) DEFAULT NULL,
  `email_capitao` varchar(255) DEFAULT NULL,
  `matricula_capitao` varchar(255) DEFAULT NULL,
  `nome_int1` varchar(255) DEFAULT NULL,
  `email_int1` varchar(255) DEFAULT NULL,
  `matricula_int1` varchar(255) DEFAULT NULL,
  `nome_int2` varchar(255) DEFAULT NULL,
  `email_int2` varchar(255) DEFAULT NULL,
  `matricula_int2` varchar(255) DEFAULT NULL,
  `nome_int3` varchar(255) DEFAULT NULL,
  `email_int3` varchar(255) DEFAULT NULL,
  `matricula_int3` varchar(255) DEFAULT NULL,
  `nome_int4` varchar(255) DEFAULT NULL,
  `email_int4` varchar(255) DEFAULT NULL,
  `matricula_int4` varchar(255) DEFAULT NULL,
  `nome_int5` varchar(255) DEFAULT NULL,
  `email_int5` varchar(255) DEFAULT NULL,
  `matricula_int5` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id`, `nome`, `curso`, `nome_responsavel`, `email_responsavel`, `nome_capitao`, `email_capitao`, `matricula_capitao`, `nome_int1`, `email_int1`, `matricula_int1`, `nome_int2`, `email_int2`, `matricula_int2`, `nome_int3`, `email_int3`, `matricula_int3`, `nome_int4`, `email_int4`, `matricula_int4`, `nome_int5`, `email_int5`, `matricula_int5`, `status`) VALUES
(1, 'Equipe de Teste', 'Ciência da Computação', 'Responsável Teste', 'responsavel@teste.com', 'Capitão Teste', 'capitao@teste.com', '123456', 'Integrante1', 'int1@teste.com', '654321', 'Integrante2', 'int2@teste.com', '987654', 'Integrante3', 'int3@teste.com', '321654', 'Integrante4', 'int4@teste.com', '456123', 'Integrante5', 'int5@teste.com', '789321', 'Em andamento'),
(18, 'Matkingos', 'Informática', 'Luiz Gustavo', 'asdasdas@cefetmg.br', 'Gustavo Marcelo Penido Pereira', 'gugupenido@gmail.com', '11111111111', 'Isabela', 'gugupenidop@gmail.com', '22222222222', 'Stella', 'gugupenidopp@gmail.com', '33333333333', 'Davi', 'gugupenidoppp@gmail.com', '44444444444', 'Lucas', 'gugupenidopppp@gmail.com', '55555555555', 'Sofia', 'gugupenidoppppp@gmail.com', '66666666666', 'Aprovada'),
(19, 'Ninguem tá puro', 'Eletrônica', 'Fernanda Aparecida', 'asdaos@cefetmg.br', 'Sávio Soares', 'asdsdnlgkn@gmail.com', '12345678911', 'Caio', 'caieteeeeeee@gmail.com', '22345678911', 'Luisa', 'luasdfsdf@gmail.com', '32345678911', 'Pedro', 'ophbrabodasd@gmail.com', '42345678911', 'Luxaaasss', 'lusdflbds@guamil.com', '52345678911', 'sadflsfg', 'sdndfgdsdbj@gmail.com', '62345678911', 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `id` int(11) NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `tempo` int(11) DEFAULT NULL,
  `corpo_questao` mediumtext DEFAULT NULL,
  `alternativa1` varchar(255) DEFAULT NULL,
  `alternativa2` varchar(255) DEFAULT NULL,
  `alternativa3` varchar(255) DEFAULT NULL,
  `alternativa4` varchar(255) DEFAULT NULL,
  `alternativa_correta` varchar(255) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`id`, `area`, `nivel`, `tempo`, `corpo_questao`, `alternativa1`, `alternativa2`, `alternativa3`, `alternativa4`, `alternativa_correta`, `autor`) VALUES
(12, 'Linguagem e suas Tecnologias', 'Médio', 120, 'https://cdn.discordapp.com/attachments/871728576972615680/1184644735600701440/Screenshot_1.png?ex=658cb962&is=657a4462&hm=2976b4977800207d3e616e6bbd60af56692b274b54466fb0a3327b2dbb85f2da&', '1/96', '1/4', '1/64', '1/3', '1/96', 'Gustavo Penido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `simulados`
--

CREATE TABLE `simulados` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `criador` varchar(255) NOT NULL,
  `numLinguagem` int(11) NOT NULL,
  `numMatematica` int(11) NOT NULL,
  `numCienNatu` int(11) NOT NULL,
  `numCienHum` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `termino` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `simulados`
--

INSERT INTO `simulados` (`id`, `titulo`, `criador`, `numLinguagem`, `numMatematica`, `numCienNatu`, `numCienHum`, `inicio`, `termino`) VALUES
(2, '1ª Olimpíada do CEFET-MG', 'Gustavo Penido', 5, 5, 5, 5, '2023-12-15 12:00:00', '2023-12-16 13:00:00'),
(4, '2ª Olimpíada do CEFET-MG', 'Gustavo Penido', 10, 10, 10, 10, '2023-12-12 12:00:00', '2023-12-15 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices para tabela `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `simulados`
--
ALTER TABLE `simulados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `simulados`
--
ALTER TABLE `simulados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
