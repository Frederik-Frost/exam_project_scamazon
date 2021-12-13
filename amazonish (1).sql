-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 13, 2021 at 07:41 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amazonish`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(32) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `title_da` varchar(100) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description_en` varchar(255) NOT NULL,
  `description_da` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title_en`, `title_da`, `price`, `description_en`, `description_da`, `image_path`) VALUES
('1d6925f9f5852c4141ec4fbb014f1f63', 'Phillips hue', 'Phillips hue', '700.00', 'Phillips hue set for your home', 'Phillips hue set til hele huset', 'hue.jpg'),
('246d3d56468af572f8bd9cde8598309b', 'Uno', 'Uno', '129.00', 'UNO! Everybody knows uno.', 'UNO! Alle kender uno.', 'uno.jpg'),
('37f7acce520942bd3598dc0f635946f7', 'Airpods pro', 'Airpod pro', '1200.00', 'Wireless headphones from Apple', 'Trådløse høretelefoner fra Apple', 'airpods.jpg'),
('3a1c0866b307695a10abc8a0f050ad5d', 'Raspberry pi 4', 'Raspberry pi 4', '200.00', 'The Raspberry Pi is a tiny and affordable computer that you can use to learn programming        ', 'Raspberry pi 4 lille computer til at lære programmering', 'raspberry.jpg'),
('5c766f8a732ee10f0c0a6060c1770b44', 'Chess board', 'Skak bræt', '399.00', 'A completely normal chess board', 'Et helt almindeligt skakbræt', 'chess.jpeg'),
('61fa44bbda3828689c55a4b8411d0683', 'Iphone 12 64gb', 'Iphone 12 64gb', '7999.00', 'Brand new Iphone 12 with 64gb space. Multiple colors', 'Spritny Iphone 12 med 64gb plads. Flere farver', 'iphone12.jpeg'),
('728ade163a46bb1b8106ba18eb31c45a', 'Weber propane grill', 'Weber gas grill', '3099.00', 'Get ready for summer with a giant grill', 'Gør dig klar til sommeren med en kæmpe grill', 'grill.jpg'),
('737f8e31378f9ec8a886cf9b8fe19f72', 'Simms waders', 'Simms vaders', '3499.00', 'Stockingfoot waders from Simms', 'Åndbare waders fra Simms', 'waders.jpg'),
('7adfdc7935546fba0e5c8c2318895ec2', 'Beer', 'Fadøl', '49.00', 'An ice cold beer ', 'En iskold fadøl', 'beer.jpg'),
('7c953d2d4a23d44e6ddc6620eaa1d50b', 'Savage gear rod', 'Savage gear stang', '800.00', 'Catch that pike with your new savage gear g2 rod', 'Fang den gedde med din nye savage gear g2 fiskestang', 'fiskestang.jpg'),
('7e8421e3539bea20f4b947fdf071deaf', '21.5\" Imac 2021', '21.5\" Imac 2021', '12999.00', 'A 21.5 inch Imach. The latest model on the market', 'En 21,5 tommer Imac. Den nyeste model på markedet', 'imac.jpeg'),
('8951187e9998bb741816108c45bcacb3', 'PS5 controller', 'PS5 controller', '499.00', 'Since you cant get the console you can get the controller', 'Når du ikke kan få konsollen kan du nøjes med controlleren', 'ps5.jpg'),
('99f946eafd7f130934712180fbebdd63', 'Ninja blender', 'Ninja blender', '829.00', 'Ninja blender. blend everything you wish', 'Ninja blender. blend alt du har fantasi til', 'blender.jpg'),
('9d077900a037511812b93c7681d5c679', 'Risk', 'Risk', '499.00', 'Risk from Hasbro', 'Risk fra Hasbro', 'risk.jpeg'),
('9ec0e8b3dfdfa6c462d5e710ea56ec84', '22-inch Griddle', '22-tommer Grill', '999.00', '22-inch Electric Griddle for those who like a good brunch', 'Elektrisk grill til de brunch glade mennesker', 'griddle.jpg'),
('a6ff41ca344a0cd232db1288d0e52e9b', 'Dog cigar', 'Hunde cigar', '69.00', 'A toy cigar for your dog', 'Legetøj til din hund.', 'cigar.jpg'),
('b04fc9bae9a75f8f7a85002f83793cb0', 'LG 49\" Ultra', 'LG 49\" Ultra', '3875.00', 'Ultra quality tv from LG - 49 Inches', 'Skarpt Fjernsyn fra LG - 49 tommer', 'tv.jpeg'),
('b9a4f0f55b002de7052668dc856f87fd', 'Remote', 'Fjernbetjening', '65.00', 'In case you lost your own', 'Hvis du har mistet din egen', 'remote.jpg'),
('e992bac4aad8bcc5653cf71b9de5d739', 'Apple tv', 'Apple tv', '1500.00', 'Apple tv from Apple', 'Apple tv fra Apple', 'appletv.jpg'),
('f92c45f268ab114323b8c00b885ef14f', 'VR Goggles', 'VR briller', '3000.00', 'VR Goggles....', 'VR briller...', 'vr.jpg'),
('fde42296f53a23cc192caf234fc17bc2', 'Marble Rolling Pin', 'Marmor kage rulle', '275.00', 'Marble Rolling Pin thats crazy!', 'En kagerulle a marmor??', 'kagerulle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `phone` varchar(8) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id` varchar(32) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_key` varchar(32) NOT NULL,
  `password_reset_key` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `name`, `last_name`, `phone`, `password`, `id`, `verified`, `verification_key`, `password_reset_key`) VALUES
('codedonkeymailservice@gmail.com', 'Frede', 'Frost', '28255798', '$2y$10$XncoC9fD0Mz1V8EqU4LUx.4AFiy5SjZLtsYdQq6hIIKBo/v8J3JRC', 'dbc7cb43c57885cc015993d75cc3dd6b', 1, 'd0e5c601acf74c979a8421edf8c1cfd6', '592ad720f5eff10e79e98930f003b58f'),
('f.frostjensen@gmail.com', 'Frederik', 'Frost', '28255798', '$2y$10$IHp83YKNE/Fz/bZe78gz/umdlHb48fdvZAUqLn2xW2NPsmxLgg9La', 'e9416255afc50d5b6210ba99bee99a5d', 1, '06ac784bd5a589b3f417d14fcc56e6ff', '2309c727b266b004dd84fd2e2df70fc7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
