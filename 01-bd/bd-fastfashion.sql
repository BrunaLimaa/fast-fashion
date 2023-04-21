CREATE DATABASE  IF NOT EXISTS `bd-FastFashion` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd-FastFashion`;

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `document` varchar(45) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `users` (email, password) VALUES('brunarblima93@gmail.com', '1');

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `idUser` int(11) NOT NULL,
                             `street` varchar(45) NOT NULL,
                             `number` varchar(45) NOT NULL,
                             `complement` varchar(45) NOT NULL,
                             `city` varchar(45) NOT NULL,
                             `state` varchar(45) NOT NULL,
                             `zipCode` varchar(45) NOT NULL,
                             `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                             `udated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                             PRIMARY KEY (`id`),
                             KEY `fk_addresses_users_idx` (`idUser`),
                             CONSTRAINT `fk_addresses_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `question` text NOT NULL,
                        `answer` text NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `faqs` WRITE;
INSERT INTO `faqs`(question, answer) VALUES ('Uma pergunta qualquer?', "Uma resposta qualquer."),('Uma pergunta qualquer?', "Uma resposta qualquer."),('Uma pergunta qualquer?', "Uma resposta qualquer.");
UNLOCK TABLES;

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `idUser` int(11) NOT NULL,
                        `name` text NOT NULL,
                        `email` text NOT NULL,
                        `message` text NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`),
                         KEY `fk_contact_users_idx` (`idUser`),
                             CONSTRAINT `fk_contact_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `category` varchar(255) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Masculino'),(2,'Feminino');
UNLOCK TABLES;

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `type` varchar(255) NULL, 
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_products_category1_idx` (`idCategory`),
  CONSTRAINT `fk_products_category1` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
`idCart` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`idUser` int(11) NOT NULL,
`idProduct` int(11) NOT NULL,
KEY `fk_cart_user1_idx` (`idUser`),
CONSTRAINT `fk_cart_user1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
KEY `fk_cart_products1_idx` (`idProduct`),
CONSTRAINT `fk_cart_products1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;;

LOCK TABLES `cart` WRITE;


LOCK TABLES `products` WRITE;
INSERT INTO `products` (name, price, photo, idCategory, type) VALUES
 ('Suéter', 129.90, 'https://i.ibb.co/S3jbGQ0/produto24.webp', 1, "Normal"),
('Jaqueta de Couro', 129.90, 'https://i.ibb.co/RjLgP08/produto23.webp', 2, "Normal"),
('Camisa de Basebol', 89.90, 'https://i.ibb.co/M1KVrw6/produto22.webp', 1, "Normal"),
('T-shirt preta', 69.90, 'https://i.ibb.co/h9yyj0N/produto21.webp', 1, "Normal"),
('Camisa Button-up', 89.90, 'https://i.ibb.co/xGDDDGw/produto20.webp', 1, "Normal"),
('Calça Social Cinza', 129.90, 'https://i.ibb.co/zsPHmSq/produto19.webp', 1, "Normal"),
('Regata laranja', 79.90, 'https://i.ibb.co/wShy2vw/produto18.webp', 1, "Normal"),
('Camisa verde', 69.90, 'https://i.ibb.co/RQBT46L/produto17.webp', 1, "Normal"),
('Cropped lã', 79.90, 'https://i.ibb.co/8xLZr1y/produto16.webp', 2, "Normal"),
('Vestido Longo Vermelho', 129.90, 'https://i.ibb.co/T4pj0gD/produto15.webp', 2, "Normal"),
('Blusa Turtle Neck Preta', 69.90, 'https://i.ibb.co/F7Gvy2s/produto14.webp', 2, "Normal"),
('Vestido Florido', 159.90, 'https://i.ibb.co/TBCqC0m/produto13.webp', 2, "Normal"),
('Camisa Floral', 69.90, 'https://i.ibb.co/x1bvxsk/produto12.webp', 1, "Normal"),
('Camisa See-Through', 89.90, 'https://i.ibb.co/w65R2F1/produto11.webp', 1, "Normal"),
('Bermuda Bege', 129.90, 'https://i.ibb.co/Z8PCRFB/produto10.webp', 1, "Normal"),
('Calça Casual Bege', 129.90, 'https://i.ibb.co/BwDWxn6/produto9.webp', 1, "Normal"),
('Jaqueta Jeans', 129.90, 'https://i.ibb.co/Z243zK9/produto8.webp', 1, "Normal"),
('Suéter de lã', 129.90, 'https://i.ibb.co/3yHj7hz/produto6.webp', 2, "Normal"),
('Camisa Verão', 59.90, 'https://i.ibb.co/CnnhRXq/produto7.webp', 1, "Normal"),
('Vestido Floral Preto', 119.90, 'https://i.ibb.co/2Z3x26r/produto5.webp', 2, "Normal"),
('Camisa Button-up Vermelha', 79.90, 'https://i.ibb.co/Gp504VC/produto4.webp', 2, "Normal"),
('Regata de lã', 69.90, 'https://i.ibb.co/sP4BhCy/produto3.webp', 2, "Normal"),
('Vestido de Festa Preto', 169.90, 'https://i.ibb.co/w0hVxt8/produto2.webp', 2, "Normal"),
('Blazer Rosa', 169.90, 'https://i.ibb.co/873shDt/produto1.webp', 2, "Normal");


UNLOCK TABLES;
