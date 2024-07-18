-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 02:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nookscranny`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`order_id`, `user_id`, `item_id`, `quantity`) VALUES
(80, 17, 6, 2),
(82, 17, 25, 2),
(84, 17, 35, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `item_id` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_desc` varchar(1000) NOT NULL,
  `item_price` int(255) NOT NULL,
  `item_quantity` int(255) NOT NULL,
  `item_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`item_id`, `item_name`, `item_desc`, `item_price`, `item_quantity`, `item_type`) VALUES
(6, 'Cool Bed', 'The cool bed is a customizable houseware furniture item in Animal Crossing: New Horizons introduced in the 2.0 Free Update. It is part of the Cool Series. The player is able to lie down on this item. If inside the player\'s house, the player can use the cool bed to enter a dream island by laying down and choosing to go to sleep.\r\n\r\nThe cool bed can be obtained from either Nook\'s Cranny for  11,000 Bells or the Paradise Planning office for  9,900 Poki. The item\'s fabric color pattern can be customized either by using 4 customization kits or by Cyrus at Harv\'s Island for  3,100 Bells. The item\'s frame can only be customized by Cyrus.', 2750, 100, 'Furniture'),
(7, 'Baggy Shirt', 'The baggy shirt is a top item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nThe baggy shirt can be obtained from recycle box.\r\n\r\nNo villagers wear this item as their default outfit.\r\n\r\nIn Happy Home Paradise, no villagers or facility unlock this item for designing and changing the clothing of a villager and the player. It can only be used once the player\'s catalog is unlocked after completing the 27th vacation home.\r\n\r\n', 10, 100, 'Clothes'),
(10, 'Axe', 'The axe is a tool item in Animal Crossing: New Horizons. As an axe, the player can use this item for 100 times to hit trees for either wood, softwood, hardwood, bamboo piece, young spring bamboo, or wood egg depending on the season, or to hit a rock for items (the item will break once the rock produces no more items).', 100, 100, 'Tools'),
(13, 'Colorful Fishing Rod', 'The colorful fishing rod is a tool item in Animal Crossing: New Horizons. As a fishing rod, the player can use this item for 30 times to catch fish.\r\n\r\nThe colorful fishing rod can be obtained from the upgraded Nook\'s Cranny for  2,500 Bells. The item\'s color can be customized either by using 1 customization kit or by Cyrus at Harv\'s Island for  1,000 Bells', 2500, 100, 'Tools'),
(14, 'Hi-Fi Stereo', 'The hi-fi stereo is a houseware furniture item in Animal Crossing: New Horizons. The item acts as a stereo, allowing the player to play music they have acquired.\r\n\r\nThe hi-fi stereo can be obtained from the upgraded Nook\'s Cranny for  82,000 Bells.\r\n\r\nThis item appears as a furniture item in the homes of  Alli,  Claudia,  Fang,  Jambette,  Merry,  Pecan, and  Whitney. As a result, this item has a chance to be purchasable by the player if they were invited by any of the preceding villagers.', 82000, 100, 'Furniture'),
(15, 'Apron', 'The apron is a top item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nThe apron can be obtained from the Able Sisters for  840 Bells. The item can also be obtained from the apparel shop in Happy Home Paradise for  760 Poki if the shop\'s theme is set to sell \"simple clothes\" or \"loose clothes\", or when the store is asked to sell any clothes under the \"anything is fine\" option.\r\n\r\nNo villagers wear this item as their default outfit.', 840, 100, 'Clothes'),
(16, 'Double Sofa', 'The double sofa is a houseware furniture item in Animal Crossing: New Horizons. The player can sit on this item. The double sofa can be obtained from Nook\'s Cranny for  4,300 Bells. The item\'s color can be customized by Cyrus at Harv\'s Island for  1,700 Bells.', 4300, 100, 'Furniture'),
(17, 'Fan', 'The fan can be obtained from Nook\'s Cranny during the summer for  1,700 Bells. The item\'s color can be customized by Cyrus at Harv\'s Island for  1,000 Bells. No villagers have this item in their home.', 1700, 100, 'Furniture'),
(18, 'Pet Bed', 'The pet bed is a customizable houseware furniture item in Animal Crossing: New Horizons. It is part of the Pet Set. The player can sit on this item. The item\'s cushion pattern can be customized either by using 1 customization kit or by Cyrus at Harv\'s Island for  1,000 Bells.', 1100, 100, 'Furniture'),
(19, 'Astro Dress', 'The astro dress is a dress-up item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers. In Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Benedict and  Kevin. In addition, the item can be used to change the clothing of a villager or the player either during or after the designing process for screenshot purposes.\r\n\r\n', 2500, 100, 'Clothes'),
(20, 'Baseball Uniform', 'The baseball uniform is a dress-up item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nNo villagers wear this item as their default outfit.\r\n\r\nIn Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Tybalt. In addition, the item can be used to change the clothing of a villager or the player either during or after the designing process for screenshot purposes.\r\n\r\n ', 1760, 100, 'Clothes'),
(21, 'Camo Pants', 'The camo pants are a bottom item in Animal Crossing: New Horizons.\r\n\r\nThe camo pants can be obtained from Mabel before building Able Sisters, or from the shop once it has opened for  1,300 Bells. The item can also be obtained from the apparel shop in Happy Home Paradise for  1,200 Poki if the shop\'s theme is set to sell \"cool clothes\", or when the store is asked to sell any clothes under the \"anything is fine\" option.', 1300, 100, 'Clothes'),
(22, 'Star Net', 'The star net is a tool item in Animal Crossing: New Horizons. As a net, the player can use this item for 30 times to catch bugs.\r\n\r\nThe star net can be obtained from the upgraded Nook\'s Cranny for  2,500 Bells. The item\'s color can be customized either by using 1 customization kit or by Cyrus at Harv\'s Island for  1,000 Bells.\r\n\r\nIn Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Ace and  Timbra.\r\n\r\n', 2500, 100, 'Tools'),
(23, 'Bean-Tossing Kit', 'The bean-tossing kit is a tool item in Animal Crossing: New Horizons introduced in the 1.7.0 Free Update. When used, the player throws a handful of beans, which can scare off fish if used near water.\r\n\r\nThe bean-tossing kit can be obtained from Nook Shopping for  800 Bells from January 25 to February 3 during the Setsubun Nook Shopping seasonal event. This item can only be ordered from the catalog while its seasonal event is ongoing.', 800, 100, 'Tools'),
(24, 'Duster', '', 1100, 100, 'Tools'),
(25, 'Clay Furnace', 'The clay furnace is a houseware furniture item in Animal Crossing: New Horizons Since version 2. The player can interact with this item for cooking food items. This item is also required as one of the kitchen prep spaces for the kitchen at the restaurant.', 3300, 100, 'Furniture'),
(26, 'Double-Door Refrigerator', 'The double-door refrigerator is a houseware furniture item in Animal Crossing: New Horizons. The item\'s color can be customized by Cyrus at Harv\'s Island for  5,200 Bells. As a wardrobe, this item allows the player to change the clothing they are wearing and customize outfits they have stored on their wand.', 60000, 100, 'Furniture'),
(27, 'Compact Kitchen', 'The compact kitchen is a houseware furniture item in Animal Crossing: New Horizons. The player can interact with this item for cooking food items. The item\'s top surface can be used to place smaller items, such as miscellaneous furniture. This item appears as a furniture item in the homes of  Ione and  Petri. As a result, this item has a chance to be purchasable by the player if they were invited by any of the preceding villagers.', 3200, 100, 'Furniture'),
(28, 'Gas Range', 'The gas range is a houseware furniture item in Animal Crossing: New Horizons. The item can be unlocked when tasked by Lottie to design the restaurant. This item is unlocked for use in designing when doing a vacation home request.  Ketchup requires this item to be placed in or outside their vacation home. This item is also required as one of the kitchen prep spaces for the kitchen at the restaurant.', 3500, 100, 'Furniture'),
(29, 'Mini Fridge', 'The mini fridge is a houseware furniture item in Animal Crossing: New Horizons. In Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request.  This item appears as a furniture item in the homes of Anicotti, Apple, Bunnie, Caroline, Carrie, and Cesar.', 1300, 100, 'Furniture'),
(30, 'Baby Romper', 'The baby romper is a dress-up item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nIn Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Carrie and  Marcie. The item can also be unlocked when tasked by Lottie to design the hospital. In addition, the item can be used to change the clothing of a villager or the player either during or after the designing process for screenshot purposes.\r\n\r\n', 1920, 100, 'Clothes'),
(31, 'Ballet Outfit', 'The ballet outfit is a dress-up item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nIn Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Baabara. In addition, the item can be used to change the clothing of a villager or the player either during or after the designing process for screenshot purposes.', 2880, 100, 'Clothes'),
(32, 'Casual Kimono', 'The casual kimono is a dress-up item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nThis item is worn by  Walt as their default outfit.\r\n\r\nIn Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Dobie,  Genji,  Kabuki,  Rizzo,  Shino,  Walt,  Wart Jr., and  Zucker. In addition, the item can be used to change the clothing of a villager or the player either during or after the designing process for screenshot purposes.\r\n', 2000, 100, 'Clothes'),
(33, 'Cat Dress', 'The cat dress is a dress-up item in Animal Crossing: New Horizons. The item can be worn by either the player or any villagers.\r\n\r\nIn Happy Home Paradise, this item is unlocked for use in designing when doing a vacation home request for  Bangle and  Punchy. In addition, the item can be used to change the clothing of a villager or the player either during or after the designing process for screenshot purposes.', 1800, 100, 'Clothes'),
(34, 'Dreamy Pants', 'The dreamy pants are a bottom item in Animal Crossing: New Horizons. The dreamy pants can be obtained during the winter from Mabel before building Able Sisters, or from the shop once it has opened for  1,440 Bells. The item can also be obtained from the apparel shop in Happy Home Paradise for  1,300 Poki if the shop\'s theme is set to sell \"cute clothes\", or when the store is asked to sell any clothes under the \"anything is fine\" option.', 1440, 100, 'Clothes'),
(35, 'Fiery Cheer Megaphone', '', 1550, 100, 'Tools'),
(36, 'Outdoorsy Watering Can', '', 2550, 100, 'Tools'),
(37, 'Shamrock Soda', '', 1000, 100, 'Tools'),
(38, 'Spooky Treats Basket', '', 3000, 100, 'Tools'),
(39, 'Yellow Balloon', '', 600, 100, 'Tools');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review_text` varchar(250) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `review_text`, `rating`) VALUES
(1, 6, 18, 'wow! very comfy very kewl :3c', 5),
(2, 6, 14, 'Super comfortable, will order again!', 5),
(3, 14, 14, 'Too expensive :// not worth the price...', 2),
(4, 14, 18, 'literally y is it so expensive LOL', 1),
(6, 14, 19, 'mbait yong seller kso wlang kwenta item AHHAHHAHAHAHA 83,000 bells para lang di2 kala ko naman gawa sa ginto', 1),
(7, 14, 17, 'ginaslight q sarili q magustuhan to, 83k bells ba naman kasa wala talaga mga anteh\r\n\r\nat least inalagaan ng nagdeliver huhu', 2),
(8, 14, 20, 'hay naku mga bhie eto na b ang sinabagong skam', 1),
(9, 14, 16, '?????????????????? 83k bells tas mukhang gawa sa plastic oh its so over', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(14, 'jumbo_hotdog', '$2y$10$RpCapoW7cSHOqBqFVgh92ObMkq.PPPj61LKSXKlaW/3XOhE/3iz7K', 'Hatdog'),
(15, 'jye_martillano', '$2y$10$oD7fJQIBRUM0X2jZ1WDQ3eRN1Ws1vMszGV.DLidGm2rl6KL5.YAGK', 'Jye'),
(16, 'productuser1', '$2y$10$UNZsaS3AOH1LJgmKPFwKCOSOkie2kzUlQafnEp7UUBjB9KG00klA.', 'User1'),
(17, 'jyemartillano', '$2y$10$B0.W.cXoAFyTIgblGf8FGOiGozVU94TiAeYQCGGEpRG1nhmjd2UJm', 'Jye'),
(18, 'bobthecat', '$2y$10$3eFMEQEyeEmSWUUbHZMt6uwLraUByYaLLEaEVnU80rkXuF0UqQGIi', 'Bob'),
(19, 'gaston_stache', '$2y$10$Pbb8khrZFEhVlK/gzv58ZOK6piDBrzaJzsltOyOyPS.lU4LJcQmDO', 'Gaston'),
(20, 'LimbergNaDaga', '$2y$10$teSfFiCJlYULCz5v.Abz1expZVf7gMyteflIMlIN057QqgxxfFbDK', 'Limberg'),
(21, 'jye_ch', '$2y$10$/.NcGfQMGdwm/V/VlE1faOpzLqsd1OsbD8GhzVSg01Fh8KK6n0aEq', 'Jye'),
(22, 'jye_charlett', '$2y$10$i12nP4qq7.cNqGTbBUCWoeU64uSe8rOFZ4gBCUUIVYQRQ34yvoiry', 'Jye');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `rev_ibfk_1` (`user_id`),
  ADD KEY `rev_ibfk_2` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`item_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `rev_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rev_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
