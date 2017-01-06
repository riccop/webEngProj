-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jan-2016 às 21:11
-- Versão do servidor: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetofinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `codAluno` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`codAluno`, `email`, `nome`) VALUES
('', '', ''),
('A65221', 'Ricardo Peixoto', 'A65221@alunos.uminho.pt'),
('A65227', 'JoÃ£o Pires', 'A65227@alunos.uminho.pt'),
('A65239', 'Ivo Silva', 'A65239@alunos.uminho.pt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `codUC` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `designacao` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `curso` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ano` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codProf` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`codUC`, `designacao`, `curso`, `ano`, `codProf`) VALUES
('ENGWEB15', 'Engenharia Web', 'MIETI', '2015/2016', 'P001'),
('ETRIP15/16', 'Encaminhamento de TrÃ¡fego em Redes IP', 'MIETI', '2015/2016', 'P002'),
('OPUM1', 'Empreendedorismo e LideranÃ§a', 'MIETI, MIE', '2015/2016', 'D35294');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enunciado`
--

CREATE TABLE IF NOT EXISTS `enunciado` (
  `codEnunciado` int(10) NOT NULL,
  `codUC` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `descricao` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `enunciado`
--

INSERT INTO `enunciado` (`codEnunciado`, `codUC`, `dataInicio`, `dataFim`, `descricao`) VALUES
(1, 'OPUM1', '2015-11-01', '2015-12-18', 'Trabalho de Empreendedorismo'),
(2, 'OPUM1', '2015-12-01', '2016-01-11', 'Trabalho de LideranÃ§a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ficheiro`
--

CREATE TABLE IF NOT EXISTS `ficheiro` (
  `codFicheiro` int(10) NOT NULL,
  `codProj` int(10) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `diretoria` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ficheiro`
--

INSERT INTO `ficheiro` (`codFicheiro`, `codProj`, `descricao`, `diretoria`) VALUES
(1, 1, 'pr.xml', 'upload/1/1/pr.xml');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `codProf` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`codProf`, `nome`, `email`, `departamento`) VALUES
('D12753', 'MARIA LUISA VILLAVERDE MACHADO FERNANDES NOVAIS', 'D12753@di.uminho.pt', 'DI'),
('D14539', 'ORLANDO JORGE GONCALVES PINTO', 'D14539@dsi.uminho.pt', 'DSI'),
('D1510', 'ADEMAR FONTES DE MAGALHAES GONCALVES', 'D1510@dei.uminho.pt', 'DEI'),
('D15619', 'NUNO MIGUEL AFONSO CARVALHO DE MOURA', 'D15619@dei.uminho.pt', 'DEI'),
('D16409', 'JORGE MANUEL DE CASTRO MAIO GOMES DA COSTA', 'D16409@dei.uminho.pt', 'DEI'),
('D17855', 'JOAO PAULO DA SILVA CASTRO', 'D17855@di.uminho.pt', 'DI'),
('D18141', 'ALEXANDRE MIGUEL DA COSTA FERREIRA DOS SANTOS', 'D18141@dsi.uminho.pt', 'DSI'),
('D18770', 'ROSA ALEXANDRA AZEVEDO GUIMARAES', 'D18770@di.uminho.pt', 'DI'),
('D18938', 'JOAO PEDRO BRITO ANTUNES GUIMARAES', 'D18938@dei.uminho.pt', 'DEI'),
('D19550', 'RICARDO MANUEL RODRIGUES DE OLIVEIRA DIMAS', 'D19550@dei.uminho.pt', 'DEI'),
('D19705', 'JOSE ANTONIO PEREIRA CIBRAO', 'D19705@di.uminho.pt', 'DI'),
('D20021', 'CARLOS JOSE DA CUNHA RIBEIRO', 'D20021@di.uminho.pt', 'DI'),
('D20044', 'BRUNO DE ALMEIDA RAMOS PEREIRA', 'D20044@dei.uminho.pt', 'DEI'),
('D20464', 'JOEL TITO DA CRUZ PINTO', 'D20464@dei.uminho.pt', 'DEI'),
('D21008', 'JORGE MIGUEL SILVA MELO PEREIRA', 'D21008@dsi.uminho.pt', 'DSI'),
('D21432', 'MIGUEL MANUEL GOMES RODRIGUES', 'D21432@dei.uminho.pt', 'DEI'),
('D21711', 'PEDRO DAVID ALVES MARTINHO', 'D21711@dei.uminho.pt', 'DEI'),
('D22662', 'JOAO PAULO CARRAPATO ALMEIDA', 'D22662@dsi.uminho.pt', 'DSI'),
('D22670', 'JOSE MANUEL TEIXEIRA FERNANDES', 'D22670@dsi.uminho.pt', 'DSI'),
('D22685', 'MARCO FRANCISCO DA SILVA LIZARDO', 'D22685@dei.uminho.pt', 'DEI'),
('D22688', 'MARCO RICARDO BARBOSA COELHO', 'D22688@di.uminho.pt', 'DI'),
('D22695', 'NANCY DO SAMEIRO SILVERIO LAVANDEIRA', 'D22695@di.uminho.pt', 'DI'),
('D22701', 'NUNO MIGUEL MARTINS CASANOVA', 'D22701@di.uminho.pt', 'DI'),
('D22721', 'RICARDO NUNO MOREIRA CASTILHO FERREIRA LOPES', 'D22721@dei.uminho.pt', 'DEI'),
('D22854', 'DAVI CARNEIRO PEREIRA', 'D22854@di.uminho.pt', 'DI'),
('D23508', 'JOSE ROMEU FERNANDES PINTO', 'D23508@dsi.uminho.pt', 'DSI'),
('D23544', 'MARIO RUI ANUNCIACAO MONTEIRO', 'D23544@di.uminho.pt', 'DI'),
('D23916', 'JOSE GRACA DA NOBREGA', 'D23916@di.uminho.pt', 'DI'),
('D24654', 'CARLOS DE SOUSA CABRAL BRANDAO', 'D24654@di.uminho.pt', 'DI'),
('D24784', 'NUNO FILIPE MARQUES MOREIRA RIBEIRO', 'D24784@di.uminho.pt', 'DI'),
('D24839', 'LEONOR ISABEL FERREIRA DE MELO OSORIO ARAUJO', 'D24839@dsi.uminho.pt', 'DSI'),
('D24875', 'RUI MANUEL COUTO DA SILVA', 'D24875@dsi.uminho.pt', 'DSI'),
('D24876', 'RUI MIGUEL ESCUDEIRO DA COSTA AGUIAR', 'D24876@di.uminho.pt', 'DI'),
('D24885', 'SERGIO MANUEL RUIVO CARDOSO', 'D24885@dsi.uminho.pt', 'DSI'),
('D25073', 'ANA MARGARIDA LIMA ALEM', 'D25073@dei.uminho.pt', 'DEI'),
('D25383', 'PEDRO MIGUEL MARTINS FERNANDES', 'D25383@dsi.uminho.pt', 'DSI'),
('D25868', 'RUI MIGUEL MORAIS LOPES', 'D25868@dei.uminho.pt', 'DEI'),
('D26208', 'IGOR MURILO DE ALMEIDA', 'D26208@dsi.uminho.pt', 'DSI'),
('D26737', 'FERNANDO MIGUEL SOUSA LISBOA', 'D26737@dei.uminho.pt', 'DEI'),
('D27577', 'PAULO CESAR DE CARVALHO LOPES', 'D27577@di.uminho.pt', 'DI'),
('D27589', 'ANA MARGARIDA FIDALGO PINHEIRO', 'D27589@di.uminho.pt', 'DI'),
('D27608', 'EURICO MANUEL TELES MORAIS', 'D27608@di.uminho.pt', 'DI'),
('D27616', 'FRANCISCO JOSE PRATA DA PAZ', 'D27616@dsi.uminho.pt', 'DSI'),
('D27620', 'JOAO ANDRE FARIA LOPES', 'D27620@di.uminho.pt', 'DI'),
('D27629', 'JOSE LUIS PINTO MONTEIRO ALVES', 'D27629@dei.uminho.pt', 'DEI'),
('D27637', 'MANUEL JOSE TORRES SOUSA DA CUNHA', 'D27637@di.uminho.pt', 'DI'),
('D27645', 'NUNO MIGUEL OLIVEIRA SILVA', 'D27645@dei.uminho.pt', 'DEI'),
('D27648', 'NUNO RAMOS MATOS', 'D27648@dsi.uminho.pt', 'DSI'),
('D27658', 'PEDRO MIGUEL ARAUJO MOTA LOPES', 'D27658@dei.uminho.pt', 'DEI'),
('D27673', 'RUI MIGUEL PEREIRA OLIVEIRA', 'D27673@dsi.uminho.pt', 'DSI'),
('D28722', 'JOSE MIGUEL FERREIRA PONTES', 'D28722@di.uminho.pt', 'DI'),
('D28735', 'RUI MIGUEL NOVAIS CASTRO', 'D28735@dei.uminho.pt', 'DEI'),
('D29004', 'MARANGAZE JOAQUIM MUNHEPE MULHANGA', 'D29004@dei.uminho.pt', 'DEI'),
('D29011', 'MARCO ALEXANDRE BARREIRA MEDEIROS TEIXEIRA', 'D29011@di.uminho.pt', 'DI'),
('D29048', 'MARIO RUI RIBEIRO FIALHO DA CONCEICAO', 'D29048@di.uminho.pt', 'DI'),
('D29253', 'RUI MIGUEL FERNANDES VARELA', 'D29253@dsi.uminho.pt', 'DSI'),
('D29254', 'TITO JOSE FERREIRA DE SOUSA LOPES', 'D29254@dei.uminho.pt', 'DEI'),
('D29282', 'NUNO VIRIATO MACEDO FERREIRA DE CARVALHO', 'D29282@di.uminho.pt', 'DI'),
('D29631', 'LUIS FILIPE RIBEIRO NOVAIS', 'D29631@dei.uminho.pt', 'DEI'),
('D29871', 'ANDRE LEITE FERREIRA', 'D29871@dei.uminho.pt', 'DEI'),
('D30015', 'RENATO CESAR ALMEIDA FIGUEIREDO', 'D30015@dei.uminho.pt', 'DEI'),
('D30166', 'ANTONIO TIAGO MORGADO PEREIRA', 'D30166@di.uminho.pt', 'DI'),
('D30176', 'BRUNO RICARDO DUARTE MAGALHAES', 'D30176@di.uminho.pt', 'DI'),
('D30187', 'FERNANDO SERGIO MADALENO PEREIRA', 'D30187@di.uminho.pt', 'DI'),
('D30201', 'JOAO GUILHERME RABACA CAMPOS', 'D30201@dsi.uminho.pt', 'DSI'),
('D30209', 'JORGE MIGUEL GONCALVES DA SILVA', 'D30209@dsi.uminho.pt', 'DSI'),
('D30211', 'JOSE CARLOS CARVALHO DOS SANTOS', 'D30211@di.uminho.pt', 'DI'),
('D30212', 'JOSE CARLOS DA ROCHA MACHADO', 'D30212@dei.uminho.pt', 'DEI'),
('D30213', 'JOSE MANUEL LOUREIRO DE AZEVEDO TEIXEIRA', 'D30213@dsi.uminho.pt', 'DSI'),
('D30214', 'JOSE PEDRO SILVA DE OLIVEIRA CARVALHO', 'D30214@di.uminho.pt', 'DI'),
('D30219', 'MANUEL FERNANDO SOTO MAIOR FRANQUEIRA', 'D30219@dei.uminho.pt', 'DEI'),
('D30226', 'MIGUEL ANGELO RIBEIRO DE SOUSA E SILVA', 'D30226@dei.uminho.pt', 'DEI'),
('D30238', 'PAULO JORGE SOARES MENDES', 'D30238@di.uminho.pt', 'DI'),
('D30241', 'PEDRO HENRIQUE GONCALVES GERAZ RODRIGUES', 'D30241@dei.uminho.pt', 'DEI'),
('D30243', 'PEDRO MIGUEL VEIGA DA SILVA', 'D30243@dsi.uminho.pt', 'DSI'),
('D30254', 'ROQUE MANUEL DE CARVALHO TEIXEIRA', 'D30254@dei.uminho.pt', 'DEI'),
('D30266', 'VITOR CARLOS TEIXEIRA PIMENTEL', 'D30266@dsi.uminho.pt', 'DSI'),
('D30305', 'EMANUEL JOSE ANTUNES FERNANDES', 'D30305@dei.uminho.pt', 'DEI'),
('D32010', 'CATARINA SOFIA MARTINHO LUIS', 'D32010@dsi.uminho.pt', 'DSI'),
('D32480', 'JOSE MANUEL LIMA GANDARELA', 'D32480@dsi.uminho.pt', 'DSI'),
('D32597', 'ADERITO NELSON MIRANDA DE OLIVEIRA', 'D32597@dsi.uminho.pt', 'DSI'),
('D32608', 'MIGUEL PEDRO DE ALMEIDA FERREIRA CORREIA DOURADO', 'D32608@dei.uminho.pt', 'DEI'),
('D32648', 'DANIEL FILIPE PERES FERREIRA', 'D32648@dei.uminho.pt', 'DEI'),
('D32652', 'PEDRO DUARTE CARDOSO LOPES', 'D32652@di.uminho.pt', 'DI'),
('D32753', 'JOAO ARNALDO FREITAS DE ABREU', 'D32753@dei.uminho.pt', 'DEI'),
('D33057', 'ANTONIO RUI MIRANDA DE LEMOS', 'D33057@dei.uminho.pt', 'DEI'),
('D33082', 'PEDRO TIAGO DIAS GONCALVES', 'D33082@di.uminho.pt', 'DI'),
('D33127', 'NUNO FILIPE MAGALHAES SANTOS', 'D33127@dsi.uminho.pt', 'DSI'),
('D33140', 'AVELINO RODRIGO ARAUJO SEMELHE DE SOUSA PINTO', 'D33140@dei.uminho.pt', 'DEI'),
('D33141', 'BARBARA ALEXANDRA EUSEBIO FREITAS', 'D33141@di.uminho.pt', 'DI'),
('D33142', 'BRUNO CESAR PEREIRA DA SILVA', 'D33142@dsi.uminho.pt', 'DSI'),
('D33143', 'BRUNO MIGUEL CAMPOS RODRIGUES', 'D33143@di.uminho.pt', 'DI'),
('D33145', 'BRUNO MIGUEL FLORES DIAMANTINO', 'D33145@dei.uminho.pt', 'DEI'),
('D33146', 'BRUNO MIGUEL MAGALHAES AZEVEDO', 'D33146@dei.uminho.pt', 'DEI'),
('D33148', 'BRUNO MIGUEL TEIXEIRA PAIVA DE FARIA', 'D33148@dei.uminho.pt', 'DEI'),
('D33152', 'DANIEL RICARDO DE CASTRO MENDES', 'D33152@dei.uminho.pt', 'DEI'),
('D33155', 'DUARTE FILIPE AFONSO CHAVES', 'D33155@dei.uminho.pt', 'DEI'),
('D33157', 'EURICO MANUEL FOLGADO AFONSO', 'D33157@dsi.uminho.pt', 'DSI'),
('D33158', 'FAUSTO MIGUEL PACHECO FARIA VIANA', 'D33158@dsi.uminho.pt', 'DSI'),
('D33162', 'GONCALO LEAL MACHADO RIBEIRO PINTO', 'D33162@dsi.uminho.pt', 'DSI'),
('D33163', 'GONCALO PAULO CUNHA CARDOSO FERREIRA', 'D33163@dei.uminho.pt', 'DEI'),
('D33165', 'HELDER ARTUR PEIXOTO MAGALHAES', 'D33165@dsi.uminho.pt', 'DSI'),
('D33168', 'JOANA SOUTO DE MIRANDA GONZALEZ', 'D33168@di.uminho.pt', 'DI'),
('D33172', 'JOAO MIGUEL RAPOSO DA SILVA MARQUES', 'D33172@dsi.uminho.pt', 'DSI'),
('D33173', 'JOAO PAULO MINHAVA PEIXOTO ASSIS CARDOSO', 'D33173@dsi.uminho.pt', 'DSI'),
('D33175', 'JOAO PEDRO BACAO COELHO DE BARROS', 'D33175@di.uminho.pt', 'DI'),
('D33176', 'JOAO PEDRO GOMES FERNANDES', 'D33176@di.uminho.pt', 'DI'),
('D33182', 'JOSE MIGUEL DOS SANTOS FERRAZ', 'D33182@dei.uminho.pt', 'DEI'),
('D33186', 'LUIS FILIPE GAMA PAIS CABRAL', 'D33186@di.uminho.pt', 'DI'),
('D33188', 'LUIS PEDRO LOPES PEREIRA', 'D33188@di.uminho.pt', 'DI'),
('D33195', 'MIGUEL PINTO DE SOUSA MARQUES', 'D33195@dsi.uminho.pt', 'DSI'),
('D33196', 'NELSON FILIPE COELHO DE MOURA SOUSA', 'D33196@di.uminho.pt', 'DI'),
('D33199', 'NUNO FILIPE MENDES PEREIRA', 'D33199@dsi.uminho.pt', 'DSI'),
('D33204', 'PAULO EDUARDO MIRANDA CAMPOS', 'D33204@di.uminho.pt', 'DI'),
('D33209', 'PAULO MIGUEL SA MORAIS PIRES', 'D33209@dei.uminho.pt', 'DEI'),
('D33213', 'PEDRO GUIMARAES DE FREITAS', 'D33213@dei.uminho.pt', 'DEI'),
('D33214', 'PEDRO JORGE OSORIO MARINHO OLIVEIRA', 'D33214@dei.uminho.pt', 'DEI'),
('D33222', 'RICARDO JORGE ALMEIDA DE MAGALHAES', 'D33222@dei.uminho.pt', 'DEI'),
('D33228', 'RUI FILIPE BARROS TAVARES', 'D33228@di.uminho.pt', 'DI'),
('D33229', 'RUI MANUEL SILVA OLIVEIRA', 'D33229@dsi.uminho.pt', 'DSI'),
('D33234', 'SANDRA MARIA OLIVEIRA CARVALHO', 'D33234@dei.uminho.pt', 'DEI'),
('D33235', 'SERGIO DE ALMEIDA PAIVA', 'D33235@dei.uminho.pt', 'DEI'),
('D33238', 'SONIA ANDREA GARRIDO DE SA EIRAS', 'D33238@di.uminho.pt', 'DI'),
('D33240', 'TIAGO JORGE GOMES DA SILVA ARAUJO', 'D33240@dei.uminho.pt', 'DEI'),
('D33272', 'HUGO ANDRE PEIXOTO FREITAS PEREIRA', 'D33272@dsi.uminho.pt', 'DSI'),
('D33280', 'PAULO BRUNO DA SILVA VIDES FERNANDES', 'D33280@di.uminho.pt', 'DI'),
('D33281', 'PEDRO MIGUEL SOARES PINTO', 'D33281@dsi.uminho.pt', 'DSI'),
('D33282', 'VIRGILIO ABRANTES VINHA', 'D33282@dei.uminho.pt', 'DEI'),
('D33291', 'BARBARA SOFIA ARAUJO DA SILVA', 'D33291@di.uminho.pt', 'DI'),
('D33420', 'NELSON LEANDRO BARBOSA CARNEIRO', 'D33420@dsi.uminho.pt', 'DSI'),
('D33437', 'NUNO MIGUEL MARQUES GOMES', 'D33437@dei.uminho.pt', 'DEI'),
('D33524', 'PEDRO MIGUEL PAES MACHADO', 'D33524@di.uminho.pt', 'DI'),
('D33650', 'LUIS ANDRE DA CUNHA MARQUES', 'D33650@dei.uminho.pt', 'DEI'),
('D33689', 'CARLOS ANDRE BRITO RIBEIRO', 'D33689@dsi.uminho.pt', 'DSI'),
('D33703', 'ISABEL MARIA ROSENDO CARDOSO', 'D33703@dei.uminho.pt', 'DEI'),
('D33709', 'JORGE MANUEL VIANA RIBEIRO MARTINS FORTE', 'D33709@dei.uminho.pt', 'DEI'),
('D33727', 'NUNO FILIPE ANTUNES DA SILVA', 'D33727@dei.uminho.pt', 'DEI'),
('D33822', 'ANDRE FERNANDES MARTINS', 'D33822@di.uminho.pt', 'DI'),
('D33858', 'FERNANDO JORGE PINTO LIMA', 'D33858@dsi.uminho.pt', 'DSI'),
('D34035', 'LEONOR ISABEL CONSTANTINO CAEIRO BOGA', 'D34035@dsi.uminho.pt', 'DSI'),
('D34434', 'JOSE CARLOS MARQUES DIAS', 'D34434@dei.uminho.pt', 'DEI'),
('D34435', 'RICARDO JOSE FERREIRA DIAS DE OLIVEIRA', 'D34435@dei.uminho.pt', 'DEI'),
('D34508', 'PAULO CESAR ALMEIDA DE SA', 'D34508@dsi.uminho.pt', 'DSI'),
('D34640', 'CARLOS PRUDENCIO DO ESPIRITO CRISOSTOMO', 'D34640@di.uminho.pt', 'DI'),
('D34935', 'JOAO MANUEL DE CAMPOS GONCALVES', 'D34935@dsi.uminho.pt', 'DSI'),
('D35052', 'CESAR FILIPE DA CRUZ GOMES', 'D35052@di.uminho.pt', 'DI'),
('D35144', 'PEDRO MANUEL DE AMORIM MAGALHAES', 'D35144@di.uminho.pt', 'DI'),
('D35271', 'ALEXANDRE JORGE CAMELO FARIA', 'D35271@dsi.uminho.pt', 'DSI'),
('D35272', 'ANA LUISA PARREIRA NUNES', 'D35272@dei.uminho.pt', 'DEI'),
('D35274', 'ANDRE FILIPE OLIVEIRA MARTINS', 'D35274@dei.uminho.pt', 'DEI'),
('D35277', 'ANTONIO MANUEL MARTINS PINTO', 'D35277@dsi.uminho.pt', 'DSI'),
('D35278', 'ANTONIO MANUEL RODRIGUES FERNANDES', 'D35278@dei.uminho.pt', 'DEI'),
('D35280', 'ANTONIO RICARDO PEREIRA GONCALVES', 'D35280@dsi.uminho.pt', 'DSI'),
('D35283', 'BRUNO EDGAR BERNARDO TEIXEIRA', 'D35283@dsi.uminho.pt', 'DSI'),
('D35284', 'BRUNO EMANUEL TEIXEIRA DE CASTRO ARAUJO', 'D35284@dei.uminho.pt', 'DEI'),
('D35285', 'BRUNO GABRIEL LEAL MACHADO DOS SANTOS', 'D35285@dsi.uminho.pt', 'DSI'),
('D35291', 'CARLOS MIGUEL TAVARES LOPES', 'D35291@di.uminho.pt', 'DI'),
('D35293', 'DAVID DANIEL CARDOSO DE OLIVEIRA', 'D35293@dei.uminho.pt', 'DEI'),
('D35294', 'DIAMANTINO JOSE MADEIRA ABOBELEIRA', 'D35294@di.uminho.pt', 'DI'),
('D35298', 'DUARTE NUNO MALHEIRO DE BARREIRO', 'D35298@dsi.uminho.pt', 'DSI'),
('D35300', 'EMANUEL CERDEIRA MESQUITA', 'D35300@dei.uminho.pt', 'DEI'),
('D35302', 'FABIO ROBERTO LEITE MATOS', 'D35302@dsi.uminho.pt', 'DSI'),
('D35303', 'FILIPE ANTONIO GONCALVES DA SILVA', 'D35303@di.uminho.pt', 'DI'),
('D35308', 'FRANCISCO JOSE MAIO LEITE', 'D35308@di.uminho.pt', 'DI'),
('D35311', 'GONCALO LUIS MALHEIRO DE OLIVEIRA NOVAIS MACHADO', 'D35311@dsi.uminho.pt', 'DSI'),
('D35312', 'HELDER FILIPE DE CASTRO MARQUES', 'D35312@dei.uminho.pt', 'DEI'),
('D35315', 'HUGO EMANUEL QUEIROS TEIXEIRA DA SILVA', 'D35315@dsi.uminho.pt', 'DSI'),
('D35316', 'HUGO GUILHERME DOS SANTOS RIGOR', 'D35316@di.uminho.pt', 'DI'),
('D35318', 'JASON PETER COSTA', 'D35318@dei.uminho.pt', 'DEI'),
('D35319', 'JOAO ALEXANDRE VAZ OLIVEIRA', 'D35319@di.uminho.pt', 'DI'),
('D35320', 'JOAO ANTONIO LAVRADOR VILANOVA', 'D35320@dei.uminho.pt', 'DEI'),
('D35321', 'JOAO FILIPE FONTES MACHADO', 'D35321@dei.uminho.pt', 'DEI'),
('D35322', 'JOAO GILBERTO LAMARAO DA SILVA', 'D35322@dsi.uminho.pt', 'DSI'),
('D35323', 'JOAO MARIO MENDES DE OLIVEIRA', 'D35323@dsi.uminho.pt', 'DSI'),
('D35325', 'JOAO PAULO COELHO GOMES TEIXEIRA E OLIVEIRA', 'D35325@di.uminho.pt', 'DI'),
('D35328', 'JOEL ARAUJO ROCHA', 'D35328@dsi.uminho.pt', 'DSI'),
('D35330', 'JORGE ANDRE ALVES DE MELO', 'D35330@dsi.uminho.pt', 'DSI'),
('D35331', 'JOSE ALEXANDRE DE CARVALHO AMORIM', 'D35331@di.uminho.pt', 'DI'),
('D35332', 'JOSE DIOGO RIBEIRO LIZ DE ALMEIDA', 'D35332@dei.uminho.pt', 'DEI'),
('D35333', 'JOSE FILIPE QUEIJO FERNANDES', 'D35333@dei.uminho.pt', 'DEI'),
('D35334', 'JOSE MIGUEL SILVA PEIXOTO DE CARVALHO', 'D35334@dsi.uminho.pt', 'DSI'),
('D35335', 'JOSE PAULO CARNEIRO DE MELO MAMEDE', 'D35335@di.uminho.pt', 'DI'),
('D35337', 'JOSE PEDRO DOMINGUES', 'D35337@dei.uminho.pt', 'DEI'),
('D35339', 'LIDIA NOGUEIRA LARANJEIRA', 'D35339@dsi.uminho.pt', 'DSI'),
('D35340', 'LILIANA SOLANGE SEQUEIRA HENRIQUES DE MACEDO', 'D35340@dsi.uminho.pt', 'DSI'),
('D35342', 'LUIS CARLOS GONCALO LEONARDO', 'D35342@dsi.uminho.pt', 'DSI'),
('D35348', 'MANUEL JOSE GOMES MEIRELES', 'D35348@dei.uminho.pt', 'DEI'),
('D35349', 'MARCIA MARLENE DE ALMEIDA MARTINS', 'D35349@dsi.uminho.pt', 'DSI'),
('D35350', 'MARCIAL COELHO GOMES', 'D35350@dsi.uminho.pt', 'DSI'),
('D35352', 'MIGUEL AFONSO PIRES DA ROSA', 'D35352@dei.uminho.pt', 'DEI'),
('D35355', 'NUNO MIGUEL MACHADO ALVES COSTA', 'D35355@dsi.uminho.pt', 'DSI'),
('D35357', 'PAULO JORGE FERNANDES DE SOUSA', 'D35357@di.uminho.pt', 'DI'),
('D35360', 'PEDRO DANIEL FERREIRA DE CARVALHO', 'D35360@dei.uminho.pt', 'DEI'),
('D35363', 'PEDRO MIGUEL DA SILVA ARAUJO', 'D35363@dsi.uminho.pt', 'DSI'),
('D35364', 'PEDRO MIGUEL MEIRA DAS NEVES', 'D35364@di.uminho.pt', 'DI'),
('D35366', 'RICARDO MANUEL VIANA MAGALHAES', 'D35366@dei.uminho.pt', 'DEI'),
('D35371', 'RUI JORGE GUIMARAES MACHADO RODRIGUES VALENTE', 'D35371@dei.uminho.pt', 'DEI'),
('D35372', 'RUI PEDRO ANDIAS DUARTE', 'D35372@dei.uminho.pt', 'DEI'),
('D35374', 'SERGIO MANUEL PEREIRA BARREIRO', 'D35374@dsi.uminho.pt', 'DSI'),
('D35375', 'SERGIO RICARDO TEIXEIRA ANDIAS MIRANDA', 'D35375@di.uminho.pt', 'DI'),
('D35376', 'TELMA DE FATIMA PIRES DE SA', 'D35376@dsi.uminho.pt', 'DSI'),
('D35377', 'VITOR DA COSTA PINHEIRO', 'D35377@dei.uminho.pt', 'DEI'),
('D35378', 'VITOR HUGO PEREIRA DA SILVA MOREIRA', 'D35378@di.uminho.pt', 'DI'),
('D35395', 'HUGO JOSE FERNANDES CARVALHO', 'D35395@di.uminho.pt', 'DI'),
('D35398', 'JOSE MANUEL ESTEVES', 'D35398@dsi.uminho.pt', 'DSI'),
('D35418', 'VALTER MIGUEL OLIVEIRA VILAR', 'D35418@dsi.uminho.pt', 'DSI'),
('D35440', 'DANIEL BARBOSA ALVES', 'D35440@dei.uminho.pt', 'DEI'),
('D35443', 'FRANCISCO JOSE MARTINS GOMES', 'D35443@dsi.uminho.pt', 'DSI'),
('D35465', 'FERNANDO ANTONIO ALVES LOPES', 'D35465@dsi.uminho.pt', 'DSI'),
('D35808', 'CANDIDO MIGUEL REBELO BARROS', 'D35808@dei.uminho.pt', 'DEI'),
('D35832', 'JOAO PEDRO GONCALVES DE CARVALHO', 'D35832@dei.uminho.pt', 'DEI'),
('D35843', 'LARA SOFIA ALPOIM MIRANDA', 'D35843@dei.uminho.pt', 'DEI'),
('D35855', 'PEDRO MIGUEL PINTO RIBEIRO', 'D35855@dsi.uminho.pt', 'DSI'),
('D36422', 'BRUNO JOSE DE MACEDO SOARES AMOR', 'D36422@dei.uminho.pt', 'DEI'),
('D36424', 'FRANCISCO EURICO PINTO CORTEZ MARTINS LEITE', 'D36424@dei.uminho.pt', 'DEI'),
('D36425', 'JOAO PEDRO ROBALO ESPINHO PEREIRA DA SILVA', 'D36425@dei.uminho.pt', 'DEI'),
('D36445', 'FILIPE BARROSO DE OLIVEIRA', 'D36445@dsi.uminho.pt', 'DSI'),
('D36454', 'MICHEL FERREIRA PINTO', 'D36454@dei.uminho.pt', 'DEI'),
('D36476', 'PEDRO ALEXANDRE FERREIRA VILACA', 'D36476@dsi.uminho.pt', 'DSI'),
('D36487', 'ALI DOS REIS MOTA', 'D36487@dei.uminho.pt', 'DEI'),
('D36539', 'ADMILSON CESAR ANDRADE RODRIGUES', 'D36539@dei.uminho.pt', 'DEI'),
('D36757', 'ERNESTO MANUEL DA SILVA LOPES', 'D36757@dsi.uminho.pt', 'DSI'),
('D36758', 'HUGO ALEXANDRE PEREIRA TRIUNFANTE MARTINS', 'D36758@dei.uminho.pt', 'DEI'),
('D36761', 'JOSE EDUARDO TEIXEIRA RITO', 'D36761@dei.uminho.pt', 'DEI'),
('D36764', 'RUI ANDRE FERREIRA SILVA', 'D36764@di.uminho.pt', 'DI'),
('D36765', 'SANDRA MARIA TELES FEIO ALMEIDA FAZENDEIRO', 'D36765@dei.uminho.pt', 'DEI'),
('D36773', 'VITOR MANUEL CARVALHO RODRIGUES', 'D36773@di.uminho.pt', 'DI'),
('D36864', 'MARIA BEATRIZ ALVES DE SA CAMPOS', 'D36864@di.uminho.pt', 'DI'),
('D36960', 'JOSE CARLOS DE FREITAS FONTAO', 'D36960@di.uminho.pt', 'DI'),
('D36969', 'PEDRO EMANUEL FERNANDES LOPES', 'D36969@dei.uminho.pt', 'DEI'),
('D36971', 'AUGUSTO JORGE PEREIRA DA COSTA', 'D36971@dsi.uminho.pt', 'DSI'),
('D37029', 'RUI MANUEL DA SILVA PEREIRA NEIVA', 'D37029@di.uminho.pt', 'DI'),
('D38116', 'PEDRO JOSE MARTINS FARIA', 'D38116@dsi.uminho.pt', 'DSI'),
('D38117', 'ANTONIO ANDRE MARQUES RIBEIRO', 'D38117@dei.uminho.pt', 'DEI'),
('D38118', 'PEDRO MANUEL LOPES PATRICIO', 'D38118@dei.uminho.pt', 'DEI'),
('D38119', 'RUI MIGUEL DA SILVA ABREU', 'D38119@di.uminho.pt', 'DI'),
('D38120', 'OCTAVIO DAVID DA CONCEICAO JACINTO', 'D38120@di.uminho.pt', 'DI'),
('D38121', 'JOSE MIGUEL RODRIGUES OLIVEIRA DA SILVA', 'D38121@dei.uminho.pt', 'DEI'),
('D38122', 'PAULO JORGE ASSIS DE SOUSA', 'D38122@dei.uminho.pt', 'DEI'),
('D38123', 'JOAO MANUEL DA SILVA SANCHES', 'D38123@di.uminho.pt', 'DI'),
('D38124', 'BRUNO RICARDO CUNHA MAGALHAES', 'D38124@dsi.uminho.pt', 'DSI'),
('D38125', 'CARLOS CESAR MADUREIRA ROMANO', 'D38125@dei.uminho.pt', 'DEI'),
('D38126', 'CARLOS ALFREDO MACIEIRA DE FARIA', 'D38126@di.uminho.pt', 'DI'),
('D38127', 'VANESSA ALZIRA ABRUNHOSA CARNEIRO DE CASTRO FIDALGO', 'D38127@dei.uminho.pt', 'DEI'),
('D38128', 'JOSE PEDRO RODRIGUES MAGALHAES', 'D38128@dsi.uminho.pt', 'DSI'),
('D38129', 'RICARDO GOMES DE FARIA', 'D38129@dsi.uminho.pt', 'DSI'),
('D38130', 'RICARDO JORGE RODRIGUES SEPULVEDA MARQUES', 'D38130@dsi.uminho.pt', 'DSI'),
('D38131', 'TIAGO DANIEL CERQUEIRA BOTELHO DA SILVA', 'D38131@di.uminho.pt', 'DI'),
('D38132', 'AVELINO JOSE DA COSTA REGO', 'D38132@dsi.uminho.pt', 'DSI'),
('D38133', 'JOAO GONCALO BOTICA RIBEIRO DA SILVA', 'D38133@di.uminho.pt', 'DI'),
('D38134', 'IVO MANUEL DANTAS MONTEIRO', 'D38134@di.uminho.pt', 'DI'),
('D38135', 'RUI ANDRE LEITE RIBEIRO', 'D38135@dei.uminho.pt', 'DEI'),
('D38136', 'JOSE NUNO MARTINS PINTO FRAGA', 'D38136@di.uminho.pt', 'DI'),
('D38137', 'JOSE PEDRO RIBEIRO DA ARAUJO', 'D38137@dsi.uminho.pt', 'DSI'),
('D38138', 'ANTONIO NUNO BACELAR MARTINS BARREIRO COVAS', 'D38138@di.uminho.pt', 'DI'),
('D38139', 'JORGE ALBERTO FARIA MIRANDA', 'D38139@dsi.uminho.pt', 'DSI'),
('D38140', 'JOSE PEDRO MACHADO GOMES', 'D38140@dei.uminho.pt', 'DEI'),
('D38141', 'RUBEN FILIPE CARDOSO DA FONSECA', 'D38141@di.uminho.pt', 'DI'),
('D38142', 'JOSE PEDRO FARIA E VASCONCELOS CORREIA', 'D38142@dei.uminho.pt', 'DEI'),
('D38143', 'ANTONIO SERGIO MATOS SILVA', 'D38143@dsi.uminho.pt', 'DSI'),
('D38144', 'TIAGO LEANDRO DE CASTRO RIBEIRO', 'D38144@dsi.uminho.pt', 'DSI'),
('D38145', 'TIAGO MIGUEL SOARES FERNANDES', 'D38145@dei.uminho.pt', 'DEI'),
('D38146', 'RUI FILIPE TORRES ALEXANDRE', 'D38146@dei.uminho.pt', 'DEI'),
('D38147', 'PEDRO MIGUEL RAMOS MADEIRA', 'D38147@dei.uminho.pt', 'DEI'),
('D38148', 'RUI DOMINGOS GUIMARAES SALGADO', 'D38148@di.uminho.pt', 'DI'),
('D38149', 'PEDRO SILVESTRE MENESES MAGALHAES COELHO', 'D38149@dei.uminho.pt', 'DEI'),
('D38150', 'LEANDRO EMANUEL DA SILVA SALGADO BARBOSA', 'D38150@di.uminho.pt', 'DI'),
('D38151', 'RICARDO FERNANDO LIRA DE MESQUITA LACHADO', 'D38151@dei.uminho.pt', 'DEI'),
('D38152', 'MARCO ANTONIO SAMPAIO FREITAS DE CASTRO', 'D38152@dsi.uminho.pt', 'DSI'),
('D38153', 'RICARDO ARAUJO CARVALHO VILACA MOREIRA', 'D38153@dei.uminho.pt', 'DEI'),
('D38154', 'RAFAEL DE CASTRO CARREIRA', 'D38154@di.uminho.pt', 'DI'),
('D38155', 'JULIO ANDRE RODRIGUES ARAUJO', 'D38155@dsi.uminho.pt', 'DSI'),
('D38156', 'BRUNO FILIPE DA COSTA HERMENEGILDO', 'D38156@dei.uminho.pt', 'DEI'),
('D38157', 'JOEL HUMBERTO DA SILVA BEIRAO DO VALE CARVALHO', 'D38157@dei.uminho.pt', 'DEI'),
('D38158', 'RAUL GRACIANO OLIVEIRA RODRIGUES', 'D38158@dsi.uminho.pt', 'DSI'),
('D38159', 'PEDRO MIGUEL AZEVEDO DE OLIVEIRA', 'D38159@dsi.uminho.pt', 'DSI'),
('D38160', 'PEDRO TIAGO AMORIM DE BRITO', 'D38160@di.uminho.pt', 'DI'),
('D38161', 'MARIANA PEREIRA NEVES', 'D38161@di.uminho.pt', 'DI'),
('D38163', 'GASPAR AUGUSTO SIMOES CORREIA VIEIRA LEITE', 'D38163@di.uminho.pt', 'DI'),
('D38164', 'DIOGO PAULO DA FONTE LAPA', 'D38164@di.uminho.pt', 'DI'),
('D38165', 'AFONSO DELERUE ARRIAGA', 'D38165@dsi.uminho.pt', 'DSI'),
('D38166', 'DIOGO FILIPE DA SILVA CARDOSO', 'D38166@dei.uminho.pt', 'DEI'),
('D38167', 'DUARTE ALEXANDRE DA CUNHA ALVES', 'D38167@di.uminho.pt', 'DI'),
('D38168', 'LUIZ ALBERTO DE CASTRO SANTOS', 'D38168@dsi.uminho.pt', 'DSI'),
('D38169', 'ANDRE ABILIO NUNES ROCHA RODRIGUES', 'D38169@di.uminho.pt', 'DI'),
('D38170', 'JOAO PEDRO OLIVEIRA PEREIRA', 'D38170@di.uminho.pt', 'DI'),
('D38171', 'MARIO ANDRE PATRICIO TEIXEIRA JULIO', 'D38171@dei.uminho.pt', 'DEI'),
('D38172', 'LUIS TIAGO AFONSO MASCARENHAS', 'D38172@dsi.uminho.pt', 'DSI'),
('D38173', 'SEBASTIAO MONTEIRO SIMOES', 'D38173@dsi.uminho.pt', 'DSI'),
('D38174', 'GUILHERME REIS BARBOSA', 'D38174@di.uminho.pt', 'DI'),
('D38175', 'JOAO PAULO DA SILVA GOMES', 'D38175@dsi.uminho.pt', 'DSI'),
('D38176', 'AGOSTINHO MANUEL ALVES DA SILVA', 'D38176@dsi.uminho.pt', 'DSI'),
('D38177', 'SERGIO NUNO CLARO GOMES', 'D38177@di.uminho.pt', 'DI'),
('D38178', 'MARCO ALEXANDRE TEIXEIRA PALOS', 'D38178@dsi.uminho.pt', 'DSI'),
('D38179', 'MARCO ANTONIO TEIXEIRA MARTINS', 'D38179@dei.uminho.pt', 'DEI'),
('D38180', 'JOAO CARLOS AZEVEDO SALGADO GUIMARAES', 'D38180@dei.uminho.pt', 'DEI'),
('D38181', 'SOFIA DA CONCEICAO ALVES MENDES', 'D38181@dsi.uminho.pt', 'DSI'),
('D38182', 'VITOR MANUEL ALVES DA ROCHA', 'D38182@di.uminho.pt', 'DI'),
('D38183', 'SERGIO BRANCO AMORIM', 'D38183@dei.uminho.pt', 'DEI'),
('D38184', 'MARIA CRISTINA CARNEIRO BARREIRA', 'D38184@dei.uminho.pt', 'DEI'),
('D38185', 'HELDER JOSE FERREIRA BARBOSA RIBEIRO', 'D38185@dei.uminho.pt', 'DEI'),
('D38186', 'JOAO NUNO MARQUES DOS SANTOS', 'D38186@dsi.uminho.pt', 'DSI'),
('D38187', 'FLAVIO MIGUEL XAVIER FERREIRA', 'D38187@di.uminho.pt', 'DI'),
('D38189', 'JOSE ANTONIO DA CUNHA E SILVA', 'D38189@di.uminho.pt', 'DI'),
('D38190', 'ELISEU CARNEIRO DOS SANTOS ROCHA', 'D38190@dsi.uminho.pt', 'DSI'),
('D38191', 'JOAO MIGUEL RODRIGUES BATISTA', 'D38191@dei.uminho.pt', 'DEI'),
('D38192', 'VITOR HUGO DA SILVA NOGUEIRA', 'D38192@dsi.uminho.pt', 'DSI'),
('D38193', 'ALEXANDRE MANUEL PEREIRA DE MIRANDA PINTO', 'D38193@di.uminho.pt', 'DI'),
('D38194', 'MARIO DA FONTE LAMEIRAS', 'D38194@dsi.uminho.pt', 'DSI'),
('D38195', 'NELSON TAVARES CUNHA', 'D38195@di.uminho.pt', 'DI'),
('D38196', 'ALEXANDRE COELHO CARVALHO', 'D38196@di.uminho.pt', 'DI'),
('D38197', 'HUGO ALEXANDRE SOBREIRO DE SEIXAS', 'D38197@di.uminho.pt', 'DI'),
('D38198', 'JOAQUIM MACHADO GONCALVES SAMPAIO', 'D38198@dsi.uminho.pt', 'DSI'),
('D38199', 'JOAO RICARDO DA SILVA CAMPOS', 'D38199@dsi.uminho.pt', 'DSI'),
('D38200', 'RUI ALEXANDRE SERRANO DE MOURA', 'D38200@di.uminho.pt', 'DI'),
('D38202', 'HUGO FILIPE NASCIMENTO PEREIRA', 'D38202@di.uminho.pt', 'DI'),
('D38203', 'NUNO JORGE FERREIRA GUIMARAES', 'D38203@dsi.uminho.pt', 'DSI'),
('D38204', 'HUGO JOSE PEREIRA PACHECO', 'D38204@di.uminho.pt', 'DI'),
('D38205', 'JOSE LUIS LOPES DE ARAUJO', 'D38205@di.uminho.pt', 'DI'),
('D38206', 'JOSE MANUEL ARAUJO SOARES', 'D38206@di.uminho.pt', 'DI'),
('D38207', 'CATARINA ISABEL DE OLIVEIRA MATEUS', 'D38207@dsi.uminho.pt', 'DSI'),
('D38208', 'NUNO GONCALO BETTENCOURT DA CRUZ CORREIA', 'D38208@dsi.uminho.pt', 'DSI'),
('D38209', 'MIGUEL ANGELO PINTO MARQUES', 'D38209@di.uminho.pt', 'DI'),
('D38210', 'DANIELA CRISTINA GARCIA TEIXEIRA', 'D38210@dei.uminho.pt', 'DEI'),
('D38211', 'DANIEL TORRES GONCALVES', 'D38211@dsi.uminho.pt', 'DSI'),
('D38212', 'JOAO PEDRO SILVA ARAUJO', 'D38212@dei.uminho.pt', 'DEI'),
('D38214', 'ANDRE FILIPE DE SOUSA VIVEIROS', 'D38214@dsi.uminho.pt', 'DSI'),
('D38215', 'ANDRE RIBEIRO RODRIGUES', 'D38215@dsi.uminho.pt', 'DSI'),
('D38216', 'NELSON DE SOUSA E SILVA', 'D38216@dsi.uminho.pt', 'DSI'),
('D38217', 'MIGUEL ANGELO MARQUES DE MATOS', 'D38217@dei.uminho.pt', 'DEI'),
('D38218', 'ALEXANDRINA MARIA FERREIRA LEMOS', 'D38218@dei.uminho.pt', 'DEI'),
('D38219', 'LUIS FILIPE PEREIRA GONCALVES', 'D38219@dsi.uminho.pt', 'DSI'),
('D38220', 'JOAO RAFAEL FERREIRA VELOSO', 'D38220@di.uminho.pt', 'DI'),
('D38221', 'MIGUEL ANGELO VIVAS GOMES ALVES', 'D38221@dei.uminho.pt', 'DEI'),
('D38222', 'JOSE LUIS CARDOSO SILVA', 'D38222@dsi.uminho.pt', 'DSI'),
('D38223', 'LUIS DIOGO MONTEIRO DUARTE COUTO', 'D38223@di.uminho.pt', 'DI'),
('D38224', 'JOSE FILIPE HENRIQUES VILAS BOAS', 'D38224@di.uminho.pt', 'DI'),
('D38254', 'MANUEL DOMINGOS DE CARVALHO FELGUEIRAS DA SILVA SANTOS', 'D38254@dei.uminho.pt', 'DEI'),
('D38595', 'FILIPE GONCALO GONCALVES DA COSTA', 'D38595@di.uminho.pt', 'DI'),
('D38908', 'RUI JORGE DE OLIVEIRA PEREIRA', 'D38908@dsi.uminho.pt', 'DSI'),
('D39288', 'GENILDO SOARES NEVES', 'D39288@di.uminho.pt', 'DI'),
('D39341', 'LUIS FERNANDO ROMANEL RODRIGUES', 'D39341@dsi.uminho.pt', 'DSI'),
('D39342', 'MIGUEL PEDRO AMARAL FIGUEIREDO', 'D39342@dsi.uminho.pt', 'DSI'),
('D39343', 'SERGIO FELICIANO FERREIRA JACOME', 'D39343@dei.uminho.pt', 'DEI'),
('D39406', 'MARCO ALEXANDRE AGUIAR VAZ', 'D39406@dsi.uminho.pt', 'DSI'),
('D39407', 'PAULO MANUEL RIBEIRO NOVAIS', 'D39407@dsi.uminho.pt', 'DSI'),
('D39408', 'LUIS FILIPE FARIA MONTEIRO CAPELO', 'D39408@dei.uminho.pt', 'DEI'),
('D39410', 'SERGIO FILIPE PEREIRA DA FELICIDADE', 'D39410@dei.uminho.pt', 'DEI'),
('D39503', 'HELDER NUNO MARTINS DO VALE TOME', 'D39503@dei.uminho.pt', 'DEI'),
('D39506', 'JOSE EDUARDO CORREIA CALHEIROS', 'D39506@dsi.uminho.pt', 'DSI'),
('D39508', 'GONCALO MANUEL CORREIA CALHEIROS', 'D39508@di.uminho.pt', 'DI'),
('D39509', 'RICARDO ANDRE RODRIGUES AFONSO', 'D39509@dei.uminho.pt', 'DEI'),
('D39622', 'JOAO PAULO SILVA DE VASCONCELOS GUSMAO', 'D39622@dei.uminho.pt', 'DEI'),
('D39671', 'VITOR MANUEL PINTO LOPES', 'D39671@di.uminho.pt', 'DI'),
('D39747', 'LUIS PEDRO FERREIRA LEITE DOS SANTOS ALEIXO', 'D39747@dsi.uminho.pt', 'DSI'),
('D39750', 'JOAO PAULO BARBOSA OLIVEIRA', 'D39750@di.uminho.pt', 'DI'),
('D39938', 'PAULO CESAR ROMANEL RODRIGUES', 'D39938@di.uminho.pt', 'DI'),
('D39944', 'RUI ANTONIO PEIXOTO DE ABREU', 'D39944@di.uminho.pt', 'DI'),
('DE-907', 'Oscar Lopez Garcia', 'DE-907@dsi.uminho.pt', 'DSI'),
('DE-922', 'Brais Hernandez Facal', 'DE-922@dsi.uminho.pt', 'DSI'),
('DE-939', 'Jorge Gonzalez y Hurtado de Mendoza', 'DE-939@dei.uminho.pt', 'DEI'),
('P001', 'JosÃ© Carlos Ramalho', 'DI', 'jcr@di.uminho.pt'),
('P002', 'Maria JoÃ£o Nicolau', 'DSI', 'joao@dsi.uminho.pt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_aluno`
--

CREATE TABLE IF NOT EXISTS `projeto_aluno` (
  `codProj` int(10) NOT NULL,
  `codAluno` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto_aluno`
--

INSERT INTO `projeto_aluno` (`codProj`, `codAluno`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_submissao`
--

CREATE TABLE IF NOT EXISTS `projeto_submissao` (
  `codProj` int(10) NOT NULL,
  `codEnunciado` int(10) NOT NULL,
  `palavrachave` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datainicio` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `datafim` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `resumo` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto_submissao`
--

INSERT INTO `projeto_submissao` (`codProj`, `codEnunciado`, `palavrachave`, `titulo`, `subtitulo`, `datainicio`, `datafim`, `resumo`) VALUES
(1, 1, 'kjk', 'jkj', 'kjk', 'jk', 'm,', 'Enter text here... You can use HTML with p, b and i ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codAluno`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`codUC`),
  ADD KEY `codProf` (`codProf`);

--
-- Indexes for table `enunciado`
--
ALTER TABLE `enunciado`
  ADD PRIMARY KEY (`codEnunciado`),
  ADD KEY `codUC` (`codUC`),
  ADD KEY `codUC_2` (`codUC`);

--
-- Indexes for table `ficheiro`
--
ALTER TABLE `ficheiro`
  ADD PRIMARY KEY (`codFicheiro`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`codProf`);

--
-- Indexes for table `projeto_aluno`
--
ALTER TABLE `projeto_aluno`
  ADD PRIMARY KEY (`codProj`,`codAluno`);

--
-- Indexes for table `projeto_submissao`
--
ALTER TABLE `projeto_submissao`
  ADD PRIMARY KEY (`codProj`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enunciado`
--
ALTER TABLE `enunciado`
  MODIFY `codEnunciado` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ficheiro`
--
ALTER TABLE `ficheiro`
  MODIFY `codFicheiro` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projeto_submissao`
--
ALTER TABLE `projeto_submissao`
  MODIFY `codProj` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
