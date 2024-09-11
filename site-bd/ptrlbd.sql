-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jun-2023 às 05:09
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ptrlbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `access_time` date DEFAULT NULL,
  `country` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `sigla` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `access_logs`
--

INSERT INTO `access_logs` (`id`, `id_user`, `access_time`, `country`, `sigla`, `latitude`, `longitude`) VALUES
(99, 32, '2023-05-29', 'Portugal', 'PT', 38.7788, -9.257),
(100, 43, '2023-05-29', 'Portugal', 'PT', 38.7788, -9.257),
(101, 32, '2023-05-29', 'Portugal', 'PT', 38.7788, -9.257),
(102, 43, '2023-05-29', 'Portugal', 'PT', 38.7788, -9.257),
(103, 43, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(104, 33, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(105, 43, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(106, 36, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(107, 43, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(108, 32, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(109, 43, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(110, 32, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(111, 32, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(112, 32, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(113, 43, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(114, 32, '2023-05-30', 'Portugal', 'PT', 38.7788, -9.257),
(115, 43, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(116, 32, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(117, 43, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(118, 32, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(119, 43, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(120, 32, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(121, 32, '2023-05-31', 'Portugal', 'PT', 38.7788, -9.257),
(122, 43, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(123, 43, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(124, 32, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(125, 43, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(126, 33, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(127, 32, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(128, 32, '2023-06-01', 'Portugal', 'PT', 38.7788, -9.257),
(129, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(130, 43, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(131, 41, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(132, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(133, 41, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(134, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(135, 41, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(136, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(137, 37, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(138, 43, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(139, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(140, 41, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(141, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(142, 38, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(143, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(144, 43, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(145, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(146, 32, '2023-06-04', 'Portugal', 'PT', 38.7788, -9.257),
(147, 32, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257),
(148, 39, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257),
(149, 32, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257),
(150, 39, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257),
(151, 32, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257),
(152, 43, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257),
(153, 32, '2023-06-05', 'Portugal', 'PT', 38.7788, -9.257);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidaturaspiloto`
--

CREATE TABLE `candidaturaspiloto` (
  `IDUser` int NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Pergunta1` varchar(50) NOT NULL,
  `Pergunta2` varchar(50) NOT NULL,
  `Pergunta3` varchar(50) NOT NULL,
  `Pergunta4` varchar(50) NOT NULL,
  `Pergunta5` varchar(50) DEFAULT NULL,
  `Pergunta6` varchar(50) NOT NULL,
  `Pergunta7` int NOT NULL,
  `Pergunta8` text,
  `DataCandidatura` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidaturaspiloto`
--

INSERT INTO `candidaturaspiloto` (`IDUser`, `Username`, `Pergunta1`, `Pergunta2`, `Pergunta3`, `Pergunta4`, `Pergunta5`, `Pergunta6`, `Pergunta7`, `Pergunta8`, `DataCandidatura`) VALUES
(39, 'anfil', '81893723127931', 'anfil82949030', 'LightsOut SimRacing', 'Portugal', 'https://www.speedtest.net/result/14824420716', 'Nenhuma', 1, 'Olá,\r\nO meu nome é João Ricardo , mais conhecido no mundo do gaming  como Anfil , eu quero entrar na PTRL porque acredito ter ritmo para disputar os lugares da frente na liga Ultimate da PTRL.\r\nMuito obrigado pela atenção,\r\nJoão Ricardo.\r\n', '2023-06-04 23:56:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `corrida`
--

CREATE TABLE `corrida` (
  `id_corrida` int NOT NULL,
  `id_temporada` int DEFAULT NULL,
  `id_divisao` int DEFAULT NULL,
  `id_pista` int NOT NULL,
  `data_corrida` datetime NOT NULL,
  `estado_corrida` enum('agendada','decorrer','revisao','concluida','cancelada') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'agendada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `corrida`
--

INSERT INTO `corrida` (`id_corrida`, `id_temporada`, `id_divisao`, `id_pista`, `data_corrida`, `estado_corrida`) VALUES
(1, 1, 1, 1, '2023-05-17 11:09:00', 'concluida'),
(2, 1, 1, 1, '2023-05-17 11:10:00', 'concluida'),
(3, 1, 2, 1, '2023-05-23 11:11:00', 'concluida'),
(4, 2, 1, 1, '2023-05-18 11:56:00', 'concluida'),
(5, 2, 2, 2, '2023-05-17 11:56:00', 'concluida'),
(6, 2, 1, 9, '2023-05-17 12:31:00', 'cancelada'),
(7, 2, 1, 3, '2023-05-11 10:53:00', 'cancelada'),
(8, 2, 1, 4, '2023-05-18 10:54:00', 'cancelada'),
(9, 2, 1, 5, '2023-05-24 10:54:00', 'cancelada'),
(10, 2, 1, 6, '2023-05-19 10:54:00', 'cancelada'),
(11, 2, 1, 7, '2023-05-05 10:55:00', 'cancelada'),
(12, 2, 1, 8, '2023-05-09 10:55:00', 'cancelada'),
(13, 2, 1, 10, '2023-05-11 10:55:00', 'cancelada'),
(14, 2, 1, 11, '2023-05-12 10:56:00', 'cancelada'),
(15, 3, 1, 3, '2023-05-19 12:34:00', 'concluida'),
(16, 3, 1, 5, '2023-05-24 15:11:00', 'concluida'),
(17, 3, 1, 17, '2023-06-02 20:16:00', 'concluida'),
(18, 3, 1, 6, '2023-06-04 22:00:00', 'concluida');

-- --------------------------------------------------------

--
-- Estrutura da tabela `divisao`
--

CREATE TABLE `divisao` (
  `id_divisao` int NOT NULL,
  `nome_divisao` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `divisao`
--

INSERT INTO `divisao` (`id_divisao`, `nome_divisao`) VALUES
(1, 'Ultimate'),
(2, 'Pro'),
(3, 'Challenger'),
(4, 'Rookie'),
(5, 'Reserva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipa`
--

CREATE TABLE `equipa` (
  `id_equipa` int NOT NULL,
  `nome_equipa` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `equipa`
--

INSERT INTO `equipa` (`id_equipa`, `nome_equipa`) VALUES
(1, 'Mercedes'),
(2, 'Red Bull Racing'),
(3, 'Ferrari'),
(4, 'Alpine'),
(5, 'McLaren'),
(6, 'Alfa Romeo'),
(7, 'Aston Martin'),
(8, 'Hass F1 Team'),
(9, 'AlphaTauri'),
(10, 'Williams'),
(22, 'NaoTemEquipa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `caminho_imagem` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DataNoticia` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `descricao`, `caminho_imagem`, `DataNoticia`) VALUES
(34, 'Com duas jornadas por disputar, Nalves já garantiu o troféu da décima temporada da Liga Ultimate PC.', 'Nalves tinha possibilidade de se sagrar campeão já à oitava etapa e não deixou fugir essa chance. O piloto tinha várias formas de vencer o campeonato, sendo que a mais tranquila seria vencer a etapa e esperar que SouL ficasse colocado em terceiro lugar ou inferior.\r\n\r\nNa qualificação a sorte já lhe sorriu, garantindo uma partida da primeira posição da grid, com o seu rival a partir da 7ª posição, a terminar desta forma, o piloto da Mercedes seria campeão. Durante a corrida, que nem sempre foi fácil, Nalves esteve ainda em dúvida sobre a sua conquista mas acabou por “acordar” após um safety car e conseguiu finalmente impor o seu ritmo para conquistar a primeira posição somando ainda o ponto da volta mais rápida.\r\n\r\nSouL acabou mesmo por terminar como começou, no sétimo lugar ao cruzar da meta. Nelson Alves sagrou-se assim campeão com duas etapas por disputar na Liga Ultimate PC.\r\n\r\nA fechar o pódio desta etapa apareceram ainda FTW Santozz e FTW Furabolzz que se aproximaram de SouL e Mendes, respetivamente, e sonham ambos com o segundo lugar da competição. FTW Marques conquistou o prémio de piloto do dia.\r\n\r\nA Mercedes, de Nalves, ainda não garantiu a conquista da competição de construtores, apesar dos 154 pontos somados pelo novo campeão. A Williams entra para as duas últimas etapas a apenas 20 pontos da liderança. Já a AlphaTauri, não chegará à segunda posição mas tem de defender a sua medalha de bronze contra Red Bull, McLaren e Ferrari.', 'imagens\\noticias/647628d2dd767_podio-italia-pc-t10-860x507-1.webp', '2023-05-30 17:48:18'),
(36, 'Lofetin vence etapa da Grã-Bretanha na Liga Ultimate PC', 'Lofetin garante a segunda vitória na temporada e está mais perto do pódio da liga com apenas uma corrida por disputar.\r\n\r\nLofetin conseguiu conquistar a sua segunda medalha de ouro na temporada e continua a discutir um lugar no pódio da Liga Ultimate PC. As contas para a entrega do título de campeão já estão fechadas, com a conquista de Nalves na etapa passada, mas a prata e o bronze ainda não estão fechadas.\r\n\r\nO piloto da Lights Out teve uma corrida tranquila no traçado da Grã-Bretanha e garantiu uma pontuação importante na sua escalada até ao top 3. Lofetin encontra-se agora na 5ª posição e está em boas condições de garantir mais uma subida em caso de nova vitória na Catalunha.\r\n\r\nA segunda posição pertenceu a LO Mendes que entrou novamente no top 3, passando FTW Santozz. A fechar o pódio, ficou o atual campeão da liga, Nelson Alves que tem a sua posição garantida no topo da tabela classificativa.\r\n\r\nNos construtores, a Williams é agora a nova líder da competição passando a Mercedes por dois pontos. Só se conhecerá a campeã na última corrida. A mesma situação acontece na terceira posição, onde AlphaTauri, Red Bull, McLaren e Ferrari têm a oportunidade de conseguir a medalha de bronze.', 'imagens\\noticias/647701a10ac58_podio-gb-pc-t10-860x507-1.webp', '2023-05-31 09:13:21'),
(37, 'Tyramisso vence na Liga Ultimate PS e tem uma mão no título', 'Depois de uma vitória difícil no Reino Unido, JAX Tyramisso está a poucos pontos de se sagrar campeão.\r\n\r\nTyramisso garantiu a vitória na nona e penúltima etapa da Liga Ultimate PS. O piloto da Williams partiu da segunda posição após ficar atrás de GTZ Cortez na qualificação mas conseguiu recuperar a tempo de garantir os 26 pontos (1º lugar + volta mais rápida).\r\n\r\nA tabela de pilotos podia ter ficado hoje resolvida com a combinação certa de resultados entre WOR DiogoSilva e Tyramisso. A vitória de Tyra e uma sétima posição de Diogo dariam o campeonato ao primeiro, mas tal não aconteceu. DiogoSilva esteve muito perto de terminar na tal 7ª posição mas conseguiu recuperar nas últimas voltas e terminou no 5º lugar, mantendo-se matematicamente na corrida pelo título com apenas uma jornada para disputar.\r\n\r\nNuma corrida com alguns pequenos incidentes, o pódio fechou com GTZ Maladictis e JAX Infamous. Os pilotos aproveitaram bem a queda de Cortez da liderança para conseguirem garantir pontos importantes que os deixam tranquilos no top 5 do campeonato.\r\n\r\nRodazz, ex-QRT e agora piloto da WOR, conseguiu mais um prémio de piloto do dia depois de saltar cinco posições para terminar num bom 5º lugar.\r\n\r\nNos construtores, o pódio está praticamente fechado com a vitória da Williams, podendo matematicamente cair para a Mercedes na última corrida. O 3º lugar já não deve fugir à Ferrari que ainda sonha com o roubo da medalha de prata à marca alemã.\r\n\r\nFora de pista, a JAX Esports anunciou hoje um blackout geral dos seus pilotos na liga. Os membros da organização não apareceram nas entrevistas de hoje, situação que deverá continuar até ao fim da liga.', 'imagens\\noticias/647701c89b85a_podio-uk-ps-t10-860x507-1.webp', '2023-05-31 09:14:00'),
(38, 'JAX Esports Club entra em blackout na PTRL', 'A JAX Esports anunciou hoje o início de um silêncio generalizado dos seus pilotos na Portugal Racing League.\r\n\r\nA Liga Ultimate PS da Portugal Racing League está a aproximar-se do fim, mas um incidente na 8ª etapa está a levantar os ânimos no campeonato. Durante a corrida de Itália, no Autódromo Enzo e Dino Ferrari, uma defesa mais agressiva de um piloto da GTZ Esports, Cortez, foi alvo de análise pelos stewards.\r\n\r\nEsta defesa levou a uma queda dramática do piloto da JAX Esports, e atual líder do campeonato, Tyramisso. Após análise pela arbitragem, Cortez levou 5 segundos de penalização neste incidente mais 5 devido a outra penalização com DavidF, algo que não foi bem recebido pela equipa de F1 virtual da JAX.\r\n\r\nA equipa pedia medidas mais duras para o piloto que causou uma perda pesada de pontos numa altura decisiva da liga. A corrida terminou com a vitória de WOR DiogoSilva e com Tyramisso a cruzar a linha da meta na 12ª posição, depois de abrir a pista no primeiro posto, ficando fora dos lugares pontuáveis.\r\n\r\nComo medida de defesa e proteção da honra dos seus pilotos, a JAX tomou a decisão de implementar uma estratégia de silêncio por parte da estrutura e atletas ligados à competição.\r\n\r\nNeste momento JAX Tyramisso lidera o campeonato com uma vantagem de oito pontos para o segundo classificado DiogoSilva. À escrita deste artigo ainda decorre a nona etapa da competição que pode dar o troféu ao piloto da JAX.', 'imagens\\noticias/64771ace54e59_f1-22-screen-860x507-1.webp', '2023-06-05 02:20:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias_likes`
--

CREATE TABLE `noticias_likes` (
  `id_user` int NOT NULL,
  `id_noticia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `noticias_likes`
--

INSERT INTO `noticias_likes` (`id_user`, `id_noticia`) VALUES
(43, 38),
(33, 37),
(33, 38),
(33, 34),
(33, 36),
(32, 34),
(38, 38),
(38, 36),
(32, 38);

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizacao`
--

CREATE TABLE `organizacao` (
  `id_organizacao` int NOT NULL,
  `nome_organizacao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_imagem` varchar(60) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `organizacao`
--

INSERT INTO `organizacao` (`id_organizacao`, `nome_organizacao`, `caminho_imagem`) VALUES
(1, 'Lights Out SimRacing', ''),
(2, 'For The Win', 'imagens/organizacoes/ftwlogo.png.png'),
(3, 'Tempus', 'imagens/organizacoes/647701a10ac58_podio-gb-pc-t10-860x507-1'),
(4, 'Shazoo', ''),
(5, 'Over Power', ''),
(6, 'JAX', ''),
(7, 'Invicta', 'imagens/organizacoes/ftw.webp.webp'),
(8, 'Nenhuma', ''),
(9, 'dasdas', 'imagens/organizacoes/647628d2dd767_podio-italia-pc-t10-860x5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `piloto`
--

CREATE TABLE `piloto` (
  `id_piloto` int NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `estado_piloto` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `piloto`
--

INSERT INTO `piloto` (`id_piloto`, `nome`, `estado_piloto`) VALUES
(1, 'rafamartins', 1),
(2, 'soul', 1),
(3, 'mendes', 1),
(4, 'monteiro', 1),
(5, 'gurla', 1),
(6, 'itsmedavid', 1),
(7, 'vicente', 1),
(8, 'pato', 1),
(9, 'marques', 1),
(10, 'anfil', 1),
(11, 'nogueira', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pilotopontostemporada`
--

CREATE TABLE `pilotopontostemporada` (
  `id_piloto` int NOT NULL,
  `id_temporada` int NOT NULL,
  `id_equipa` int DEFAULT NULL,
  `id_organizacao` int DEFAULT NULL,
  `id_divisao` int DEFAULT NULL,
  `pontos` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pilotopontostemporada`
--

INSERT INTO `pilotopontostemporada` (`id_piloto`, `id_temporada`, `id_equipa`, `id_organizacao`, `id_divisao`, `pontos`) VALUES
(1, 1, 1, 1, 1, 44),
(1, 2, 1, 1, 1, 26),
(1, 3, 2, 4, 1, 88),
(2, 1, 3, 1, 1, 12),
(2, 2, 2, 3, 1, 18),
(2, 3, 10, 1, 1, 62),
(3, 1, 3, 2, 1, 26),
(3, 2, 1, 3, 1, 18),
(3, 3, 3, 4, 1, 51),
(4, 1, 4, 3, 1, 15),
(4, 2, 2, 4, 1, 26),
(4, 3, 2, 7, 1, 53),
(5, 2, 10, 1, 2, 40),
(5, 3, 2, 3, 2, 0),
(6, 3, 9, 1, 1, 60),
(7, 3, 5, 2, 1, 16),
(8, 3, 3, 3, 1, 6),
(9, 3, 7, 4, 1, 4),
(10, 3, 6, 8, 1, 26),
(11, 3, 5, 4, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pista`
--

CREATE TABLE `pista` (
  `id_pista` int NOT NULL,
  `nome_pista` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pista`
--

INSERT INTO `pista` (`id_pista`, `nome_pista`) VALUES
(1, 'Bahrain International Circuit'),
(2, 'Algarve International Circuit'),
(3, 'Jeddah Corniche Circuit'),
(4, 'Albert Park Circuit'),
(5, 'Imola Circuit'),
(6, 'Miami International Autodrome'),
(7, 'Circuit de Barcelona-Catalunya'),
(8, 'Circuit de Monaco'),
(9, 'Baku City Circuit'),
(10, 'Circuit Gilles Villeneuve'),
(11, 'Silverstone Circuit'),
(12, 'Red Bull Ring'),
(13, 'Circuit Paul Ricard'),
(14, 'Hungaroring'),
(15, 'Circuit de Spa-Francorchamps'),
(16, 'Circuit Sandvoort'),
(17, 'Monza Circuit'),
(18, 'Marina Bay Street Circuit'),
(19, 'Suzuka International Racing Course'),
(20, 'Circuit of the Americas'),
(21, 'Autodromo Hermanos Rodriguez'),
(22, 'Interlagos Circuit'),
(23, 'Yas Marina Circuit'),
(24, 'Shanghai International Circuit');

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE `resultado` (
  `id_resultado` int NOT NULL,
  `id_corrida` int NOT NULL,
  `id_piloto` int NOT NULL,
  `posicao` int NOT NULL,
  `volta_mais_rapida` tinyint(1) DEFAULT '0',
  `Estado_Resultado` enum('Terminou','NaoTerminou','Desqualificado','Faltou') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `resultado`
--

INSERT INTO `resultado` (`id_resultado`, `id_corrida`, `id_piloto`, `posicao`, `volta_mais_rapida`, `Estado_Resultado`) VALUES
(1, 1, 1, 1, 1, 'Terminou'),
(2, 3, 2, 1, 1, 'Terminou'),
(3, 3, 3, 2, 0, 'Terminou'),
(4, 3, 4, 3, 0, 'Terminou'),
(5, 2, 3, 1, 1, 'Terminou'),
(6, 2, 1, 2, 0, 'Terminou'),
(7, 2, 4, 3, 0, 'Terminou'),
(8, 2, 2, 4, 0, 'Terminou'),
(9, 4, 1, 1, 1, 'Terminou'),
(10, 4, 2, 2, 0, 'Terminou'),
(11, 5, 4, 1, 1, 'Terminou'),
(12, 5, 3, 2, 0, 'Terminou'),
(13, 15, 1, 1, 1, 'Terminou'),
(14, 15, 2, 2, 0, 'Terminou'),
(15, 15, 6, 3, 0, 'Terminou'),
(16, 15, 3, 4, 0, 'Terminou'),
(17, 16, 6, 1, 0, 'Terminou'),
(18, 16, 1, 2, 0, 'Terminou'),
(19, 16, 4, 3, 0, 'Terminou'),
(20, 16, 3, 4, 0, 'Terminou'),
(21, 16, 2, 5, 1, 'Terminou'),
(22, 17, 1, 1, 1, 'Terminou'),
(23, 17, 2, 2, 0, 'Terminou'),
(24, 17, 3, 3, 0, 'Terminou'),
(25, 17, 4, 4, 0, 'Terminou'),
(26, 17, 6, 5, 0, 'Terminou'),
(27, 17, 7, 6, 0, 'Terminou'),
(28, 18, 10, 1, 1, 'Terminou'),
(29, 18, 1, 2, 0, 'Terminou'),
(30, 18, 2, 3, 0, 'Terminou'),
(31, 18, 3, 4, 0, 'Terminou'),
(32, 18, 6, 5, 0, 'Terminou'),
(33, 18, 7, 6, 0, 'Terminou'),
(34, 18, 8, 7, 0, 'Terminou'),
(35, 18, 9, 8, 0, 'Terminou'),
(36, 18, 11, 9, 0, 'Terminou'),
(37, 18, 4, 10, 0, 'Terminou');

-- --------------------------------------------------------

--
-- Estrutura da tabela `temporada`
--

CREATE TABLE `temporada` (
  `id_temporada` int NOT NULL,
  `nome_temporada` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `temporada`
--

INSERT INTO `temporada` (`id_temporada`, `nome_temporada`) VALUES
(1, 'Temporada 1'),
(2, 'Temporada 2'),
(3, 'Temporada 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `IdUser` int NOT NULL,
  `Nome` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Sobrenome` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `PasswordUser` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `EmailUser` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CargoUser` enum('User','Piloto','Moderador','Admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `SteamIDUser` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DiscordUser` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `DataNascimentoUser` date NOT NULL,
  `GeneroUser` enum('Masculino','Femenino','Outros','Prefiro não dizer') COLLATE utf8mb4_general_ci NOT NULL,
  `PistaFavoritaUser` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Não tenho'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`IdUser`, `Nome`, `Sobrenome`, `Username`, `PasswordUser`, `EmailUser`, `CargoUser`, `SteamIDUser`, `DiscordUser`, `DataNascimentoUser`, `GeneroUser`, `PistaFavoritaUser`) VALUES
(32, 'Joana', 'Brito', 'Gaunt', 'c52f373f3bbc4a5992e9611c04a4763d', 'admin@gmail.com', 'Admin', '12341231232131', 'Gaunt#1323', '2020-02-02', 'Femenino', 'Não tenho'),
(33, 'rafamartins', 'rafamartins', 'rafamartins', '6d2b336facbbaa07a88ca2a46695f294', 'rafamartins@gmail.com', 'Piloto', '20492890482390', 'rafamartins234342', '2023-05-24', 'Masculino', 'Não tenho'),
(34, 'soul', 'soul', 'soul', '765ae843192a0f1b071f4446ee4c5fa3', 'soul@gmail.com', 'Piloto', '7892478932789472389', 'soul23123', '2020-06-18', 'Masculino', 'Não tenho'),
(35, 'mendes', 'mendes', 'mendes', 'af5caae019a33d603444b7492a436b7f', 'mendes@gmail.com', 'Piloto', '2334789217902', 'mendes347893', '2000-02-09', 'Masculino', 'Não tenho'),
(36, 'monteiro', 'monteiro', 'monteiro', 'a1d34eb2299ccb62256f19c070ed7ef8', 'monteiro@gmail.com', 'Piloto', '3284893742389473894', 'monteiro23423', '2000-02-18', 'Masculino', 'Não tenho'),
(37, 'gurla', 'gurla', 'gurla', '223e5f11174a0d3791ddaca73e2e3988', 'gurla@gmail.com', 'Piloto', '87490384038984902', 'gurla37489', '2000-02-08', 'Masculino', 'Não tenho'),
(38, 'pato', 'pato', 'pato', '259823af837e251e560ca1158a4e77c7', 'pato@gmail.com', 'Piloto', '83748923743892', 'pato 1273891273', '1212-12-12', 'Masculino', 'Não tenho'),
(39, 'anfil', 'anfil', 'anfil', 'afa287b5a4707ce82ddf9ed38b9fd7f4', 'anfil@gmail.com', 'Piloto', '81893723127931', 'anfil82949030', '1212-12-12', 'Masculino', 'Não tenho'),
(40, 'nogueira', 'nogueira', 'nogueira', 'b4183fcebf7dcd116f9b7438922bf45e', 'nogueira@gmail.com', 'Piloto', '238948937892439', 'nogueira2138902', '1212-12-12', 'Masculino', 'Não tenho'),
(41, 'vicente', 'vicente', 'vicente', '71562974cb3965dbc5102a73e6d84dd5', 'vicente@gmail.com', 'Piloto', '83290482390', 'vicente902389', '1212-12-12', 'Masculino', 'Não tenho'),
(42, 'marques', 'marques', 'marques', '9518fcbed21ea1baa2552302e13c66fe', 'marques@gmail.com', 'Piloto', '382738921738912', 'marques28932', '1212-12-12', 'Masculino', 'Não tenho'),
(43, 'David', 'Rodrigues', 'itsmedavid', 'd71a048942d5b5f7550429955e3a556a', 'itsmedavid@gmail.com', 'Piloto', '8372947893', 'itsmedavid2328', '0005-02-23', 'Masculino', 'Não tenho');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `candidaturaspiloto`
--
ALTER TABLE `candidaturaspiloto`
  ADD PRIMARY KEY (`IDUser`);

--
-- Índices para tabela `corrida`
--
ALTER TABLE `corrida`
  ADD PRIMARY KEY (`id_corrida`),
  ADD KEY `id_divisao` (`id_divisao`),
  ADD KEY `id_pista` (`id_pista`),
  ADD KEY `fk_corrida_temporada` (`id_temporada`);

--
-- Índices para tabela `divisao`
--
ALTER TABLE `divisao`
  ADD PRIMARY KEY (`id_divisao`);

--
-- Índices para tabela `equipa`
--
ALTER TABLE `equipa`
  ADD PRIMARY KEY (`id_equipa`);

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Índices para tabela `noticias_likes`
--
ALTER TABLE `noticias_likes`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Índices para tabela `organizacao`
--
ALTER TABLE `organizacao`
  ADD PRIMARY KEY (`id_organizacao`);

--
-- Índices para tabela `piloto`
--
ALTER TABLE `piloto`
  ADD PRIMARY KEY (`id_piloto`);

--
-- Índices para tabela `pilotopontostemporada`
--
ALTER TABLE `pilotopontostemporada`
  ADD PRIMARY KEY (`id_piloto`,`id_temporada`),
  ADD KEY `id_temporada` (`id_temporada`),
  ADD KEY `id_equipa` (`id_equipa`,`id_organizacao`,`id_divisao`),
  ADD KEY `pilotopontostemporada_organizacao` (`id_organizacao`),
  ADD KEY `fk_divisao` (`id_divisao`);

--
-- Índices para tabela `pista`
--
ALTER TABLE `pista`
  ADD PRIMARY KEY (`id_pista`);

--
-- Índices para tabela `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `id_piloto` (`id_piloto`),
  ADD KEY `id_corrida` (`id_corrida`);

--
-- Índices para tabela `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`id_temporada`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `EmailUser` (`EmailUser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de tabela `corrida`
--
ALTER TABLE `corrida`
  MODIFY `id_corrida` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `divisao`
--
ALTER TABLE `divisao`
  MODIFY `id_divisao` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `equipa`
--
ALTER TABLE `equipa`
  MODIFY `id_equipa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `organizacao`
--
ALTER TABLE `organizacao`
  MODIFY `id_organizacao` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `piloto`
--
ALTER TABLE `piloto`
  MODIFY `id_piloto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pista`
--
ALTER TABLE `pista`
  MODIFY `id_pista` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id_resultado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id_temporada` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `access_logs`
--
ALTER TABLE `access_logs`
  ADD CONSTRAINT `access_logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`IdUser`);

--
-- Limitadores para a tabela `candidaturaspiloto`
--
ALTER TABLE `candidaturaspiloto`
  ADD CONSTRAINT `candidaturaspiloto_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `users` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `corrida`
--
ALTER TABLE `corrida`
  ADD CONSTRAINT `corrida_ibfk_1` FOREIGN KEY (`id_divisao`) REFERENCES `divisao` (`id_divisao`),
  ADD CONSTRAINT `corrida_ibfk_2` FOREIGN KEY (`id_pista`) REFERENCES `pista` (`id_pista`),
  ADD CONSTRAINT `fk_corrida_temporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporada` (`id_temporada`);

--
-- Limitadores para a tabela `noticias_likes`
--
ALTER TABLE `noticias_likes`
  ADD CONSTRAINT `noticias_likes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `noticias_likes_ibfk_2` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`);

--
-- Limitadores para a tabela `pilotopontostemporada`
--
ALTER TABLE `pilotopontostemporada`
  ADD CONSTRAINT `fk_divisao` FOREIGN KEY (`id_divisao`) REFERENCES `divisao` (`id_divisao`),
  ADD CONSTRAINT `fk_pilotopontostemporada_equipa` FOREIGN KEY (`id_equipa`) REFERENCES `equipa` (`id_equipa`),
  ADD CONSTRAINT `PilotopontosTemporada_ibfk_1` FOREIGN KEY (`id_piloto`) REFERENCES `piloto` (`id_piloto`),
  ADD CONSTRAINT `PilotopontosTemporada_ibfk_2` FOREIGN KEY (`id_temporada`) REFERENCES `temporada` (`id_temporada`),
  ADD CONSTRAINT `pilotopontostemporada_organizacao` FOREIGN KEY (`id_organizacao`) REFERENCES `organizacao` (`id_organizacao`);

--
-- Limitadores para a tabela `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `fk_pilotopontostemporada_piloto` FOREIGN KEY (`id_piloto`) REFERENCES `pilotopontostemporada` (`id_piloto`),
  ADD CONSTRAINT `resultado_ibfk_3` FOREIGN KEY (`id_corrida`) REFERENCES `corrida` (`id_corrida`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
