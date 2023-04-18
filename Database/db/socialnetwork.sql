-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2023 a las 19:06:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follow_users`
--

CREATE TABLE `follow_users` (
  `id_user_follow` int(11) NOT NULL,
  `id_user_following` int(11) NOT NULL,
  `id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `follow_users`
--

INSERT INTO `follow_users` (`id_user_follow`, `id_user_following`, `id_follow`) VALUES
(16, 16, 2),
(16, 18, 4),
(16, 19, 5),
(16, 20, 6),
(16, 20, 7),
(16, 17, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historicfriends_user`
--

CREATE TABLE `historicfriends_user` (
  `id_friends` int(11) NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `like_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_user`, `id_post`, `like_status`) VALUES
(16, 2, 1),
(16, 1, 1),
(16, 4, 1),
(16, 3, 1),
(16, 3, 1),
(16, 2, 1),
(16, 3, 1),
(16, 4, 1),
(16, 0, 1),
(16, 5, 1),
(17, 5, 1),
(17, 5, 1);

--
-- Disparadores `likes`
--
DELIMITER $$
CREATE TRIGGER `Sumar_like` AFTER INSERT ON `likes` FOR EACH ROW BEGIN
UPDATE posts SET likes_users = likes_users+1 WHERE id_post LIKE new.id_post;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_post_user` int(11) NOT NULL,
  `title_post` varchar(100) NOT NULL,
  `description_post` varchar(250) NOT NULL,
  `likes_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id_post`, `id_post_user`, `title_post`, `description_post`, `likes_users`) VALUES
(1, 16, '', '', 0),
(2, 16, 'Alejandro Alvarez', 'Brayanmonroy98@hotmail.com', 1),
(3, 16, 'Un lindo día para ex', 'Hoy es un día genial para ser feliz', 1),
(4, 16, 'Un lindo día para ex', 'Hoy es un día genial para ser feliz', 1),
(5, 17, 'Hoy me disculpe con Alejo', 'Es el día mas feliz de mi vida', 3),
(6, 17, 'Hoy me disculpe con Alejo', 'Es el día mas feliz de mi vida', 0),
(7, 17, 'Hoy me disculpe con Alejo', 'Es el día mas feliz de mi vida', 0),
(8, 17, 'Hoy me disculpe con Alejo', 'Es el día mas feliz de mi vida', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(30) NOT NULL,
  `mail_user` varchar(25) NOT NULL,
  `username_user` varchar(15) NOT NULL,
  `description_user` varchar(500) NOT NULL,
  `cel_user` int(10) NOT NULL,
  `password_user` varchar(15) NOT NULL DEFAULT 'Kunnashi2829.',
  `jwt_token` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `mail_user`, `username_user`, `description_user`, `cel_user`, `password_user`, `jwt_token`) VALUES
(1, 'Juan', 'juan@mail.com', 'juancito', 'Este es el perfil de Juan', 1234567890, 'Kunnashi2829.', ''),
(12, 'Alejandro Alvarez', 'Brayanmonroy98@gmail.com', 'Kunnashi28', 'Hola, Busco amigos', 2147483647, 'Kunnashi2829.', ''),
(14, 'Alejandro Alvarez', 'Brayanmonroy98@hotmail.co', 'Kunnashi2829', 'Hola, Busco amigos', 2147483647, 'Kunnashi2829.', ''),
(16, 'Alejandro Alvarez', 'Brayanmonroy94@gmail.com', 'Kunnashi', 'Hola, Busco amigos', 2147483647, 'Kunnashi2829.', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2LCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6IkFsZWphbmRybzI4MjkuIiwiZXhwIjoxNjgxNzUwMTQ3fQ.9XF7ZKcd2KKDhYfNn0cRICHlcjp3IqUQwGWfAHgYy7c'),
(17, 'Felipe Pava', 'Felipe.pava@icloud.com', 'FelipeP', 'Hola, soy muy alegre', 2147483647, 'FelipeP2023', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE3LCJuYW1lIjoiRmVsaXBlIFBhdmEiLCJ1c2VybmFtZSI6IkZlbGlwZVAiLCJleHAiOjE2ODE3ODYzMDR9.9KDYS_cn5G3NftDHa1hLgjmofQAXl04xn7ckF3ZMPu4'),
(18, 'Carlos Molanis', 'carlos.molanito@dollarcit', 'CarlosMolanis', 'Me gusta el fifa y mi novia venus', 2147483647, 'CarlosM2023', ''),
(19, 'Brian Ospina', 'bxe1518@gmail.com', 'Brian.Ospina24', 'Fotografo de bodas\nTunja', 2147483647, 'IPhotoDeep2023', ''),
(20, 'Venus Cordoba', 'Venus.cordoba@gmail.com', 'NikolC', 'Novia de carlos\nEsoterismo', 2147483647, 'VenusEsoC', ''),
(21, 'Venus Cordoba', 'Venus.cordoba30@gmail.com', 'NikolC2', 'Novia de carlos\r\nEsoterismo', 2147483647, 'VenusEsoC', ''),
(22, 'Venus Cordoba', 'Alejandro@pruebas.com', 'PruebasUNIT', 'descUserPruebas', 2147483647, 'Kunnashi2829.', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `follow_users`
--
ALTER TABLE `follow_users`
  ADD PRIMARY KEY (`id_follow`);

--
-- Indices de la tabla `historicfriends_user`
--
ALTER TABLE `historicfriends_user`
  ADD PRIMARY KEY (`id_friends`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_user` (`username_user`),
  ADD UNIQUE KEY `mail_user` (`mail_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `follow_users`
--
ALTER TABLE `follow_users`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historicfriends_user`
--
ALTER TABLE `historicfriends_user`
  MODIFY `id_friends` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
