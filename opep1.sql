


CREATE TABLE `catégorie` (
  `id_catégorie` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
);

--
-- Dumping data for table `catégorie`
--

INSERT INTO `catégorie` (`id_catégorie`, `nom`) VALUES
(1, 'Plantes à fleurs'),
(2, 'plantes d exterieur'),
(3, 'Plantes dintérieur'),
(4, 'Tulips');



CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_plante` int(11) DEFAULT NULL
);



INSERT INTO `panier` (`id_panier`, `id_user`, `id_plante`) VALUES
(4, 6, 50),
(5, 6, 50),
(6, 6, 50),
(7, 6, 50),
(8, 6, 50),
(9, 6, 50),
(10, 6, 50),
(11, 7, 50),
(12, 7, 50),
(13, 7, 50),
(14, 7, 50),
(15, 7, 50),
(16, 7, 50),
(17, 7, 50),
(18, 7, 50),
(19, 7, 50),
(20, 7, 50),
(21, 7, 50),
(22, 7, 50);


CREATE TABLE `plante` (
  `id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `id_catégorie` int(11) DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL
) 



INSERT INTO `plante` (`id`, `description`, `image`, `prix`, `id_catégorie`, `Nom`) VALUES
(1, 'Beautiful Flower', 'image/Plantes à fleurs/Plantes à fleurs1.jpg', 20, 1, 'fleur'),
(50, NULL, 'image/Tulips1.jpg', 20, 4, 'Tulip');



CREATE TABLE `roles` (
  `idrole` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) 



INSERT INTO `roles` (`idrole`, `name`, `user_id`) VALUES
(1, 'admin', 2),
(2, 'client', 3),
(3, 'client', 4),
(4, 'admin', 5),
(5, 'client', 6),
(6, 'admin', 7);



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL
) 



INSERT INTO `users` (`id`, `lastName`, `password`, `email`, `firstName`) VALUES
(1, 'test', '123@io', '123@io', 'douaa'),
(2, 'test', 'nnbb@uiu', 'nnbb@uiu', 'admin'),
(3, 'ndhd', 'tytyty@oiu', 'tytyty@oiu', 'rabi'),
(4, 'sss', '1234', 'testa@io', 'sss'),
(5, 'douaa', 'douaaaa@rt', 'douaaaa@rt', 'douaa'),
(6, 'rabii', 'rabii', 'rabii@gmail.com', 'rabii'),
(7, 'whd kniya', 'yuyu@hh', 'yuyu@hh', 'whd test');


ALTER TABLE `catégorie`
  ADD PRIMARY KEY (`id_catégorie`);


ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_plante` (`id_plante`);


ALTER TABLE `plante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_catégorie` (`id_catégorie`);


ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrole`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);



-
ALTER TABLE `catégorie`
  MODIFY `id_catégorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;


ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;


ALTER TABLE `plante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;


ALTER TABLE `roles`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_plante`) REFERENCES `plante` (`id`);


ALTER TABLE `plante`
  ADD CONSTRAINT `cat` FOREIGN KEY (`id_catégorie`) REFERENCES `catégorie` (`id_catégorie`);
COMMIT;


--table commande--
CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `nomCommande` varchar(100) DEFAULT NULL,
  `id_plante` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) 


ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `id_plante` (`id_plante`),
  ADD KEY `id_user` (`id_user`);



ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_plante`) REFERENCES `plante` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;
