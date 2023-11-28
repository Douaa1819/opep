-- les commandes SQL --

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `catégorie` (
  `id_catégorie` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `catégorie` (`id_catégorie`, `nom`) VALUES
(2, 'plantes d exterieur'),
(3, 'Plantes dintérieur'),
(4, 'Tulips'),
(5, 'Plantes à fleurs');



CREATE TABLE `plante` (
  `id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `id_catégorie` int(11) DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `plante` (`id`, `description`, `image`, `prix`, `id_catégorie`, `Nom`) VALUES
(1, 'Beautiful Flower', 'image/Plantes à fleurs/Plantes à fleurs1.jpg', 20, 1, 'fleur'),
(2, 'Beaut', 'image/Plantes à fleurs/Plantes à fleurs2.jpg', 30, NULL, 'Rose');



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `lastName`, `password`, `email`, `firstName`) VALUES
(1, 'test', '123@io', '123@io', 'douaa');


ALTER TABLE `catégorie`
  ADD PRIMARY KEY (`id_catégorie`);


ALTER TABLE `plante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_catégorie` (`id_catégorie`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `catégorie`
  MODIFY `id_catégorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `plante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `plante`
  ADD CONSTRAINT `plante_ibfk_1` FOREIGN KEY (`id_catégorie`) REFERENCES `categories` (`id`);
COMMIT;

