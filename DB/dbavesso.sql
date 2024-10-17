-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2024 às 22:07
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
-- Banco de dados: `dbavesso`
--
CREATE DATABASE IF NOT EXISTS `dbavesso` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbavesso`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbhashtags`
--

CREATE TABLE `tbhashtags` (
  `idUsuario` int(11) NOT NULL,
  `tituloHashtag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblikes`
--

CREATE TABLE `tblikes` (
  `idUsuario` int(11) NOT NULL,
  `idUsuarioLike` int(11) NOT NULL,
  `dataLike` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmatches`
--

CREATE TABLE `tbmatches` (
  `idMatche` int(11) NOT NULL,
  `idUsuario1` int(11) NOT NULL,
  `idUsuario2` int(11) NOT NULL,
  `dataMatche` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmensagens`
--

CREATE TABLE `tbmensagens` (
  `idRemetente` int(11) NOT NULL,
  `idDestinatario` int(11) NOT NULL,
  `conteudoMsg` text NOT NULL,
  `msgVisualizada` tinyint(4) NOT NULL DEFAULT 0,
  `dataMsg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpaises`
--

CREATE TABLE `tbpaises` (
  `idPais` int(11) NOT NULL,
  `nomePais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbperguntas`
--

CREATE TABLE `tbperguntas` (
  `idPergunta` int(11) NOT NULL,
  `tituloPergunta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `idUsuario` int(11) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `telefoneUsuario` varchar(50) DEFAULT NULL,
  `senhaUsuario` varchar(64) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `sobrenomeUsuario` varchar(100) NOT NULL,
  `dataNascUsuario` date DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `bioUsuario` text DEFAULT NULL,
  `sexualidadeUsuario` enum('Hétero','Homossexual','Bissexual','Outro','Prefiro não informar') NOT NULL,
  `generoUsuario` enum('Masculino','Feminino','Outro','Prefiro não informar') NOT NULL,
  `preferenciaUsuario` enum('Homem','Mulher','Todos') NOT NULL,
  `fotoPerfilUsuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario_responde_pergunta`
--

CREATE TABLE `tbusuario_responde_pergunta` (
  `idUsuario` int(11) NOT NULL,
  `idPergunta` int(11) NOT NULL,
  `respostaUsuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbhashtags`
--
ALTER TABLE `tbhashtags`
  ADD KEY `usuario_id_fk` (`idUsuario`);

--
-- Índices para tabela `tblikes`
--
ALTER TABLE `tblikes`
  ADD KEY `usuarioLike_id_fk` (`idUsuario`);

--
-- Índices para tabela `tbmatches`
--
ALTER TABLE `tbmatches`
  ADD PRIMARY KEY (`idMatche`),
  ADD KEY `usuario_id4_fk` (`idUsuario1`),
  ADD KEY `usuario_id5_fk` (`idUsuario2`);

--
-- Índices para tabela `tbmensagens`
--
ALTER TABLE `tbmensagens`
  ADD KEY `remetente_id_fk` (`idRemetente`),
  ADD KEY `destinatario_id_fk` (`idDestinatario`);

--
-- Índices para tabela `tbpaises`
--
ALTER TABLE `tbpaises`
  ADD PRIMARY KEY (`idPais`);

--
-- Índices para tabela `tbperguntas`
--
ALTER TABLE `tbperguntas`
  ADD PRIMARY KEY (`idPergunta`);

--
-- Índices para tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `pais_id_fk` (`idPais`);

--
-- Índices para tabela `tbusuario_responde_pergunta`
--
ALTER TABLE `tbusuario_responde_pergunta`
  ADD KEY `usuario2_id_fk` (`idUsuario`),
  ADD KEY `pergunta_id_fk` (`idPergunta`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbmatches`
--
ALTER TABLE `tbmatches`
  MODIFY `idMatche` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbpaises`
--
ALTER TABLE `tbpaises`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbperguntas`
--
ALTER TABLE `tbperguntas`
  MODIFY `idPergunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbhashtags`
--
ALTER TABLE `tbhashtags`
  ADD CONSTRAINT `usuario_id_fk` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tblikes`
--
ALTER TABLE `tblikes`
  ADD CONSTRAINT `usuarioLike_id_fk` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_id3_fk` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbmatches`
--
ALTER TABLE `tbmatches`
  ADD CONSTRAINT `usuario_id4_fk` FOREIGN KEY (`idUsuario1`) REFERENCES `tbusuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_id5_fk` FOREIGN KEY (`idUsuario2`) REFERENCES `tbusuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tbmensagens`
--
ALTER TABLE `tbmensagens`
  ADD CONSTRAINT `destinatario_id_fk` FOREIGN KEY (`idDestinatario`) REFERENCES `tbusuarios` (`idUsuario`),
  ADD CONSTRAINT `remetente_id_fk` FOREIGN KEY (`idRemetente`) REFERENCES `tbusuarios` (`idUsuario`);

--
-- Limitadores para a tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD CONSTRAINT `pais_id_fk` FOREIGN KEY (`idPais`) REFERENCES `tbpaises` (`idPais`);

--
-- Limitadores para a tabela `tbusuario_responde_pergunta`
--
ALTER TABLE `tbusuario_responde_pergunta`
  ADD CONSTRAINT `pergunta_id_fk` FOREIGN KEY (`idPergunta`) REFERENCES `tbperguntas` (`idPergunta`),
  ADD CONSTRAINT `usuario2_id_fk` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
