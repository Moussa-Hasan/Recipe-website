-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 03:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test-3`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `recipe_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_id`, `recipe_id`) VALUES
(38, 4, 120),
(39, 4, 73),
(40, 4, 109),
(41, 4, 119),
(73, 4, 121),
(78, 3, 76),
(80, 3, 121),
(88, 3, 71),
(89, 18, 74),
(97, 3, 72);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `recipe_id` int(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `review` text NOT NULL,
  `rate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `recipe_id`, `create_date`, `review`, `rate`) VALUES
(6, 3, 73, '2023-04-19 15:33:32', 'this recipe is amazing !!!!!!!!', 4),
(8, 4, 72, '2023-04-19 15:35:14', 'this chicken looks delicious.', 4),
(10, 3, 74, '2023-04-19 15:39:53', 'It didn\'t turn on well :(', 2),
(33, 4, 77, '2023-05-06 18:53:41', 'very good :)', 4),
(36, 3, 117, '2023-05-06 18:57:35', 'i dont think its good', 2),
(43, 3, 73, '2023-05-06 19:26:13', 'nicee', 4),
(56, 4, 76, '2023-05-06 20:00:14', 'I like Italian food', 4),
(68, 3, 121, '2023-05-07 07:40:09', 'nice <3', 4),
(71, 3, 110, '2023-05-07 12:45:45', 'awesome', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_tips`
--

CREATE TABLE `kitchen_tips` (
  `tip_id` int(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `create_date` datetime(6) NOT NULL,
  `user_id` int(20) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kitchen_tips`
--

INSERT INTO `kitchen_tips` (`tip_id`, `title`, `description`, `text`, `create_date`, `user_id`, `image`) VALUES
(1, 'What Can I Substitute for Cream of Tartar?', 'If your recipe calls for cream of tartar and you don\'t have it, don\'t panic. Here\'s what to substitute instead.\r\n\r\n', 'Whether added to snickerdoodle cookies to make them wonderfully soft, to whipped egg whites to make them stable, or to simple syrup to prevent sugar crystals from forming, cream of tartar is an all-around good thing to have on hand. But what is it about cream of tartar that makes it so magical? \r\n\r\n', '2023-05-08 11:10:46.000000', 1, 'ERD.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `user_id` int(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `role` varchar(25) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `preferences` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `date`, `role`, `gender`, `preferences`) VALUES
(1, 'admin', '', 'admin@gmail.com', '12345678', '03222666', '1999-03-11', 'admin', 'male', ''),
(2, 'moussa', 'hasan', 'moderator@gmail.com', '12345678', '71222873', '1999-06-10', 'moderator', 'male', ''),
(3, 'mhmd', 'hasan', 'user@gmail.com', '12345678', '71889202', '2006-10-10', 'user', 'male', 'french'),
(4, 'jaafar', 'jaafar', 'jaafar@gmail.com', '12345678', '03227777', '1995-06-15', 'user', 'male', 'italian'),
(11, 'hassan', 'sahmarani', 'hassan@gmail.com', '12345678', '71287326', '1999-03-16', 'moderator', 'male', ''),
(16, 'dana', 'mare', 'dana@gmail.com', '12345678', '71567263', '2001-04-05', 'user', 'female', 'filipino'),
(17, 'ali', 'hasan', 'ali@gmail.com', '12345678', '03898212', '1994-03-29', 'user', 'male', 'greek'),
(18, 'jamil', 'mhmd', 'jamil@gmail.com', '12345678', '71898276', '1997-04-03', 'user', 'male', 'indian');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `preparation_time` int(5) NOT NULL,
  `cooking_time` int(5) NOT NULL,
  `total_time` int(5) NOT NULL,
  `servings` int(5) NOT NULL,
  `meal_time` varchar(20) NOT NULL,
  `cuisine` varchar(20) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `user_id`, `name`, `description`, `create_date`, `preparation_time`, `cooking_time`, `total_time`, `servings`, `meal_time`, `cuisine`, `image`, `status`) VALUES
(71, 3, ' Filipino Beef Steak', 'This beef steak is a very easy recipe to make. A tender cut of beef is sliced thin, then marinated with lemon juice and soy sauce for at least an hour.', '2023-05-07 11:28:32', 15, 10, 25, 6, 'dinner', 'filipino', 'Filipino Beef Steak.jpg', 'approved'),
(72, 1, 'Parmesan Crusted Chicken', 'This is a simple and crispy oven baked chicken.', '2023-04-20 18:27:44', 20, 25, 45, 4, 'dinner', 'french', 'Parmesan Crusted Chicken.jpg', 'approved'),
(73, 1, 'Caramel Cake', 'Moist caramel cake with delicious layers of cake and caramel icing.', '2023-04-14 15:21:58', 40, 55, 95, 12, 'dessert', 'german', 'Caramel Cake.jpg', 'approved'),
(74, 1, 'Greek Lemon Chicken Soup', 'This Greek lemon chicken soup is a perfect introduction to a full Greek meal or a hearty bowlful for a meal in itself. Serve with fresh pita triangles, and you ll be sure to please your guests!', '2023-04-14 21:22:41', 20, 30, 50, 16, 'lunch', 'greek', 'Greek Lemon Chicken Soup.jpg', 'approved'),
(75, 3, 'Spinach and Strawberry Salad', 'My family loves this spinach strawberry salad all year-round, if we can find strawberries. Even the grandchildren love this salad. Quick and easy.', '2023-04-14 21:31:05', 10, 10, 20, 8, 'snack', 'french', 'Spinach and Strawberry Salad.jpg', 'pending'),
(76, 1, 'Quick Meatball Stroganoff', 'This meatball stroganoff was a hit with everyone. I came up with this easy recipe that\'s quick to prepare because my family loves stroganoff so much!', '2023-04-14 21:37:25', 5, 55, 60, 4, 'dinner', 'italian', 'Quick Meatball Stroganoff.jpg', 'approved'),
(77, 1, 'Blueberry Loaf', 'This moist blueberry quick bread recipe is easy to make. It works equally well with fresh or frozen blueberries.', '2023-04-14 21:43:45', 15, 60, 75, 12, 'dessert', 'french', 'Blueberry Loaf.jpg', 'approved'),
(109, 4, 'Naan', 'This homemade naan recipe makes soft, chewy naan with a buttery taste. It is the best I have tasted outside of an Indian restaurant. Simply delicious eaten warm brushed with melted butter or served with your favorite curry.', '2023-04-21 18:32:53', 30, 45, 75, 14, 'breakfast', 'indian', 'Naan.jpg', 'approved'),
(110, 1, 'Lebanese Mountain Bread', 'This Lebanese Mountain flatbread brings me back to my early childhood when the Syrian lady across the street from my grandmother made it and always gave us some. It\'s my first food memory. The bread has a unique texture, gorgeous appearance, and fun-to-make technique.', '2023-04-22 15:17:00', 20, 10, 30, 8, 'breakfast', 'lebanese', 'Lebanese Mountain Bread.jpg', 'approved'),
(117, 3, 'German Apple Cake', 'German apple cake is a moist, dense cake that keeps well. It has been a family favorite for 20 years. Serve with a dusting of confectioners\' sugar or topped with a cream cheese frosting.', '2023-05-07 11:28:38', 15, 45, 60, 24, 'dessert', 'german', 'German Apple Cake.jpg', 'approved'),
(119, 4, 'California Roll', 'A California roll is a fresh take on traditional Japanese rice rolls. Filled with avocado, crab, and cucumber, it\'s fresh and crunchy and makes a filling meal. You can use real or imitation crab.', '2023-04-24 16:49:41', 60, 20, 80, 5, 'lunch', 'japanese', 'California Roll.jpg', 'approved'),
(120, 3, 'Fiesta Slow Cooker Shredded Chicken Tacos', 'This chicken tacos recipe is easy to make in a slow cooker. Spoon the filling into warm tortillas for a very tasty meal.', '2023-04-24 17:13:29', 10, 240, 250, 8, 'dinner', 'mexican', 'Fiesta Slow Cooker Shredded Chicken Tacos.jpg', 'approved'),
(121, 4, 'Chinese Corn Soup', 'This quick and easy Chinese corn soup is so good that I never bother ordering it from restaurants anymore!', '2023-04-24 17:28:23', 5, 10, 15, 4, 'breakfast', 'chinese ', 'Chinese Corn Soup.jpg', 'approved'),
(122, 3, 'Italian Baked Meatballs', 'These baked meatballs are tender and tasty. I also freeze these meatballs and take out how many servings I need for each meal.', '2023-04-24 17:40:07', 15, 30, 45, 6, 'dinner', 'italian', 'Italian Baked Meatballs.jpg', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `recipes_info`
--

CREATE TABLE `recipes_info` (
  `info_id` int(20) NOT NULL,
  `recipe_id` int(20) NOT NULL,
  `calories` int(5) NOT NULL,
  `carbs` int(5) NOT NULL,
  `fat` int(5) NOT NULL,
  `protein` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes_info`
--

INSERT INTO `recipes_info` (`info_id`, `recipe_id`, `calories`, `carbs`, `fat`, `protein`) VALUES
(58, 72, 602, 14, 19, 85),
(59, 73, 1019, 155, 43, 9),
(60, 74, 124, 9, 7, 8),
(61, 75, 235, 23, 16, 4),
(62, 76, 656, 61, 32, 30),
(63, 77, 168, 28, 5, 3),
(95, 109, 52, 4, 4, 1),
(96, 110, 47, 6, 2, 1),
(102, 117, 201, 28, 10, 2),
(103, 71, 756, 8, 39, 89),
(104, 119, 445, 70, 11, 15),
(105, 120, 71, 2, 1, 11),
(106, 121, 121, 24, 2, 5),
(107, 122, 343, 14, 20, 24);

-- --------------------------------------------------------

--
-- Table structure for table `recipes_ingredients`
--

CREATE TABLE `recipes_ingredients` (
  `ingredient_id` int(20) NOT NULL,
  `recipe_id` int(20) NOT NULL,
  `ingredient` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes_ingredients`
--

INSERT INTO `recipes_ingredients` (`ingredient_id`, `recipe_id`, `ingredient`) VALUES
(40, 72, '3 pounds chicken breasts'),
(41, 72, '½ teaspoon garlic powder '),
(42, 72, '1 (12 fluid ounce) bottle Lawry\'s Herb & Garlic Marinade with Lemon Juice '),
(43, 72, '1 ½ cups Parmesan cheese, grated'),
(44, 72, '1 teaspoon paprika'),
(45, 72, '1 teaspoon dried oregano'),
(46, 73, '3 cups white sugar  '),
(47, 73, '1 ½ cups butter  '),
(48, 73, '5 large eggs  '),
(49, 73, '3 ½ cups all-purpose flour  '),
(50, 73, '½ teaspoon baking powder '),
(51, 73, ' ¼ teaspoon salt  1'),
(52, 73, ' ¼ cups whole milk  '),
(53, 73, '1 teaspoon vanilla extract '),
(54, 73, '1 (16 ounce) package brown sugar  '),
(55, 73, '1 cup butter  '),
(56, 73, '¼ teaspoon salt  '),
(57, 73, '⅔ cup evaporated milk  '),
(58, 73, '1 (16 ounce) package confectioners\' sugar, sifted  '),
(59, 73, '2 teaspoons pure vanilla extract'),
(60, 74, '8 cups chicken broth'),
(61, 74, '½ cup fresh lemon juice'),
(62, 74, '½ cup shredded carrots'),
(63, 74, '½ cup finely chopped onion'),
(64, 74, '½ cup finely chopped celery'),
(65, 74, '\r\n6 tablespoons chicken soup base'),
(66, 74, '\r\n¼ teaspoon ground white pepper'),
(67, 74, '\r\n¼ cup margarine'),
(68, 74, '\r\n¼ cup all-purpose flour'),
(69, 74, '\r\n8 egg yolks'),
(70, 74, '\r\n1 cup cooked white rice'),
(71, 74, '\r\n1 cup diced, cooked chicken meat'),
(72, 74, '\r\n16 slices lemon'),
(74, 75, '2 bunches spinach, rinsed and torn into bite-size pieces'),
(75, 75, '4 cups sliced strawberries'),
(76, 75, '\r\n\r\n½ cup vegetable oil'),
(77, 75, '\r\n\r\n½ cup white sugar'),
(78, 75, '\r\n\r\n¼ cup white wine vinegar'),
(79, 75, '\r\n\r\n2 tablespoons sesame seeds'),
(80, 75, '\r\n\r\n1 tablespoon poppy seeds'),
(81, 75, '\r\n\r\n¼ teaspoon paprika'),
(82, 75, ''),
(83, 76, '1 tablespoon vegetable oil'),
(84, 76, '\r\n\r\n½ onion, chopped'),
(85, 76, '\r\n\r\n2 teaspoons minced garlic'),
(86, 76, '\r\n\r\n1 (10.5 ounce) can condensed cream of mushroom soup'),
(87, 76, '\r\n\r\n½ cup milk'),
(88, 76, '\r\n\r\n1 tablespoon Worcestershire sauce'),
(89, 76, '\r\n\r\n15 frozen beef meatballs, or more to taste'),
(90, 76, '\r\n\r\n8 ounces broad egg white noodles (such as No Yolks®)'),
(91, 76, '\r\n\r\n¾ cup sour cream'),
(92, 76, '\r\n\r\nsalt and ground black pepper to taste'),
(94, 77, '1 ½ cups all-purpose flour'),
(95, 77, '\r\n\r\n¾ cup white sugar'),
(96, 77, '\r\n\r\n2 teaspoons baking powder'),
(97, 77, '\r\n\r\n⅛ teaspoon salt'),
(98, 77, '\r\n\r\n½ cup milk'),
(99, 77, '\r\n\r\n¼ cup vegetable oil'),
(100, 77, '\r\n\r\n1 egg'),
(101, 77, '\r\n\r\n½ teaspoon vanilla extract'),
(102, 77, '\r\n\r\n1 ½ cups blueberries'),
(264, 109, '1 (.25 ounce) package active dry yeast'),
(265, 109, '1 cup warm water'),
(266, 109, '¼ cup white sugar'),
(267, 109, '3 tablespoons milk'),
(268, 109, '1 large egg, beaten'),
(269, 109, '2 teaspoons salt'),
(270, 109, '4 ½ cups bread flour'),
(271, 109, '2 teaspoons minced garlic (Optional)'),
(272, 109, '¼ cup butter, melted'),
(273, 110, '1 ½ cups bread flour, divided, or more as needed'),
(274, 110, '1 teaspoon active dry yeast'),
(275, 110, '1 teaspoon white sugar'),
(276, 110, '½ cup warm water'),
(277, 110, '1 tablespoon olive oil, plus extra to coat bowl'),
(278, 110, '¾ teaspoon kosher salt'),
(293, 117, '1 cup vegetable oil'),
(294, 117, '2 eggs'),
(295, 117, '2 cups white sugar'),
(296, 117, '1 teaspoon vanilla extract'),
(297, 117, '2 cups all-purpose flour'),
(298, 117, '2 teaspoons ground cinnamon'),
(299, 117, '1 teaspoon baking soda'),
(300, 117, '½ teaspoon salt'),
(301, 117, '4 cups apples - peeled, cored and diced'),
(302, 71, '4 pounds New York strip steak, sliced thin'),
(303, 71, '1 lemon, juiced'),
(304, 71, '3 tablespoons soy sauce'),
(305, 71, '1 teaspoon white sugar'),
(306, 71, 'salt and pepper to taste'),
(307, 71, '1 tablespoon cornstarch'),
(308, 71, '¼ cup vegetable oil'),
(309, 71, '3 tablespoons olive oil'),
(310, 71, '1 onion, chopped'),
(311, 71, '2 cloves garlic, chopped'),
(312, 119, '4 cups water'),
(313, 119, '2 cups uncooked white rice'),
(314, 119, '½ cup seasoned rice vinegar'),
(315, 119, '1 teaspoon white sugar, or to taste'),
(316, 119, '1 teaspoon salt, or to taste'),
(317, 119, '¼ pound cooked crab meat, drained of excess liquid and shredded'),
(318, 119, '1 tablespoon mayonnaise'),
(319, 119, '5 sheets nori (dry seaweed)'),
(320, 119, '1 avocado, sliced'),
(321, 119, '¼ cup red caviar, such as tobiko'),
(322, 119, '1 English cucumber, seeded and sliced into strips'),
(323, 119, '2 tablespoons drained pickled ginger, for garnish'),
(324, 119, '2 tablespoons soy sauce, or to taste'),
(325, 119, '1 tablespoon wasabi paste'),
(326, 120, '1 cup chicken broth'),
(327, 120, '3 tablespoons taco seasoning mix'),
(328, 120, '1 pound skinless, boneless chicken breasts'),
(329, 121, '1 (15 ounce) can cream style corn'),
(330, 121, '1 (14.5 ounce) can low-sodium chicken broth'),
(331, 121, '1 tablespoon cornstarch'),
(332, 121, '2 tablespoons water'),
(333, 121, '1 large egg, beaten'),
(334, 122, '1 cup Italian-seasoned bread crumbs'),
(335, 122, '¼ cup grated Romano cheese'),
(336, 122, '2 tablespoons chopped fresh parsley'),
(337, 122, '½ teaspoon salt'),
(338, 122, '½ teaspoon ground black pepper'),
(339, 122, '½ teaspoon garlic powder'),
(340, 122, '½ teaspoon onion powder'),
(341, 122, '½ cup water'),
(342, 122, '2 eggs, beaten'),
(343, 122, '1 ½ pounds ground beef');

-- --------------------------------------------------------

--
-- Table structure for table `recipes_steps`
--

CREATE TABLE `recipes_steps` (
  `step_id` int(20) NOT NULL,
  `recipe_id` int(20) NOT NULL,
  `step` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes_steps`
--

INSERT INTO `recipes_steps` (`step_id`, `recipe_id`, `step`) VALUES
(36, 72, 'Thoroughly rinse chicken and pat dry with a paper towel. You can remove the skin if you like'),
(37, 72, ' Deeply pierce each piece of chicken 5 or 6 times with a knife or fork. In a large re-sealable plastic bag, combine chicken parts and the Marinade. Try to eliminate most of the air as you seal the bag. Gently shake to make sure all pieces are coated. Marinate in refrigerator for at least 30 minutes (or overnight).'),
(38, 72, ' Preheat oven to 350 degrees F. Prepare a baking rack; oil or use a vegetable spray. '),
(39, 72, ' Pour the Parmesan cheese onto a plate. Mix in the garlic powder, paprika and oregano.'),
(40, 72, '  Remove chicken from marinade, discarding used marinade. Shake off excess liquid. Roll chicken onto the cheese to coat. Arrange the chicken on rack in a roasting pan. Bake in preheated 350 degrees F oven until meat is no longer pink and juices run clear. This will be about 40 to 45 minutes (approx. 180 degrees F).'),
(41, 73, 'Preheat the oven to 350 degrees F (175 degrees C). Grease and flour three 9-inch cake pans.'),
(42, 73, '  Make cake: Place white sugar and butter into a mixing bowl. Beat with an electric mixer on medium speed until light and fluffy. Add eggs, one at a time, mixing well after each addition.'),
(43, 73, '  Combine flour, baking powder, and salt in a separate bowl. Add flour mixture in batches, alternating with milk, beating batter briefly after each addition. Add vanilla extract; beat until batter makes ribbons when falling from the beaters. Divide batter among the prepared cake pans. '),
(44, 73, ' Bake in the preheated oven until a toothpick inserted in the center comes out clean, about 30 minutes. Cool on a wire rack for 5 minutes. Run a table knife around the edges to loosen. Invert carefully onto a cooling rack. Let cool, about 30 minutes. '),
(45, 73, ' Make icing: Combine brown sugar, butter, and salt in a saucepan over medium heat. Stir until brown sugar is dissolved, about 3 minutes. Add evaporated milk and continue stirring. Bring to a gentle boil and let bubble for about 4 minutes, stirring constantly to avoid sticking. Remove from heat and allow to cool, about 5 minutes. '),
(46, 73, ' Mix confectioners\' sugar and vanilla extract into brown sugar mixture using an electric mixer until icing caramelizes and thickens to the desired consistency.'),
(47, 73, '  Spread icing onto cooled cake layers. Stack layers; ice top and sides.'),
(48, 74, 'Combine chicken broth, lemon juice, carrots, onions, celery, soup base, and white pepper in a large pot. Bring to a boil over high heat, then reduce heat and simmer for 15 to 20 minutes, or until the vegetables are tender.'),
(49, 74, 'Blend margarine and flour in a small bowl; gradually stir into soup mixture. Simmer, stirring frequently, for 8 to 10 minutes.'),
(50, 74, '\r\n\r\nMeanwhile, beat egg yolks in a bowl until light in color. Gradually whisk in some hot soup, using a ladle to pour in a thin stream while whisking the egg yolks vigorously. Add egg mixture to the pot in same manner, and heat through.'),
(51, 74, '\r\n\r\nAdd rice and chicken; cook until warmed through. Ladle hot soup into bowls and garnish with lemon slices.'),
(52, 74, ''),
(53, 75, 'Toss together spinach and strawberries in a large bowl.'),
(54, 75, '\r\n\r\nWhisk oil, sugar, vinegar, sesame seeds, poppy seeds, and paprika together in a medium bowl. Pour over the spinach and strawberries, and toss to coat.'),
(56, 76, 'Heat oil in a large skillet over medium-high heat. Add onion and garlic; cook and stir until onion is almost soft, about 3 minutes.'),
(57, 76, '\r\n\r\nReduce heat to medium; stir in condensed soup, milk, and Worcestershire sauce. Add meatballs; reduce heat to low and simmer, covered, until tender, 35 to 40 minutes.'),
(58, 76, '\r\n\r\nMeanwhile, bring a large pot of lightly salted water to a boil. Add noodles and cook, stirring occasionally, until tender yet firm to the bite, 10 to 12 minutes; drain.'),
(59, 76, '\r\n\r\nAdd sour cream, salt, and pepper to meatballs in sauce. Cook until flavors combine, about 2 minutes. Serve meatballs over noodles.'),
(61, 77, 'Preheat the oven to 350 degrees F (175 degrees C). Grease a loaf pan.'),
(62, 77, '\r\n\r\nMix flour, sugar, baking powder, and salt in a large bowl. Stir milk, oil, egg, and vanilla extract into flour mixture until just blended; gently fold blueberries into batter and pour into prepared loaf pan.'),
(63, 77, '\r\n\r\nBake in the preheated oven until a toothpick inserted into the center comes out clean, 60 to 70 minutes. Cool briefly on a wire rack before inverting carefully onto a serving plate or cooling rack. Let cool completely.'),
(164, 109, 'Dissolve yeast in warm water in a large bowl. Let stand about 10 minutes, until frothy.'),
(165, 109, 'Meanwhile, generously oil a large bowl.'),
(166, 109, 'Stir sugar, milk, egg, and salt into the yeast mixture. Mix in enough flour to make a soft dough.'),
(167, 109, 'Knead dough on a lightly floured surface until smooth, 6 to 8 minutes.'),
(168, 109, 'Knead dough on a lightly floured surface until smooth, 6 to 8 minutes.'),
(169, 109, 'Punch down dough on a lightly floured surface, and knead in garlic. Pinch off small handfuls of dough about the size of a golf ball; you should have about 14. Roll each piece into a ball and place on a tray. Cover with a towel, and allow to rise until doubled in size, about 30 minutes.'),
(170, 109, 'Meanwhile, preheat a large grill pan over high heat.'),
(171, 109, 'Roll each piece of dough into a thin circle.'),
(172, 109, 'Brush some melted butter on the preheated grill pan. Place a few pieces of dough in the pan (as many as you can fit) and cook until puffy and lightly browned, 2 to 3 minutes. Brush butter onto the uncooked sides, flip, and cook until browned, 2 to 4 more minutes. Remove from the grill and repeat to cook the remaining naan.'),
(173, 110, 'Place 1/2 cup flour, yeast, and sugar in a mixing bowl. Pour in warm water. Whisk together thoroughly, 2 to 3 minutes. Cover bowl and let sit until mixture gets bubbly, 30 to 60 minutes.'),
(174, 110, 'Drizzle in olive oil; add salt and remaining 1 cup flour. Mix together until mixture forms a sticky (not wet) dough ball that pulls away from the sides of the bowl. If mixture seems too wet, add a bit more flour.'),
(175, 110, 'Lightly flour a work surface. Knead dough until it is soft, supple, and slightly elastic, about 2 minutes. Pour a few drops of olive oil in a bowl. Transfer dough ball to the bowl and turn to coat surface with oil.'),
(176, 110, 'Cover bowl and place in a warm spot. Let dough rise until it has doubled in size, 60 to 90 minutes.'),
(177, 110, 'Transfer dough to a work surface and knead to remove air bubbles, about 1 minute. Transfer to a resealable plastic bag; refrigerate, 8 hours or overnight.'),
(178, 110, 'Lightly flour a work surface; dough may be sticky so make sure you use enough flour to keep dough from sticking to the surface or your hands (but less flour is best). Break off a piece of dough slightly smaller than a golf ball. Roll into a smooth ball. Flatten and roll out into a circle about 1/8-inch thick.'),
(179, 110, 'Invert a smooth mixing bowl on the work surface; lightly flour the bottom. Lightly stretch the dough and place the dough circle on the floured surface of the inverted bowl. Gently stretch dough evenly down the sides of the bowl, working your way around the edges, until it is very thin and translucent, or as thin as you can get it without tearing it.'),
(180, 110, 'Heat a cast iron skillet over high heat. Flour your hands and carefully remove the dough circle from the bottom of the bowl. Transfer to hot skillet. Cook until blisters form and begin to brown, about 45 to 60 seconds per side.'),
(181, 110, 'Transfer to a dish and cover to allow bread to steam and stay moist and supple.'),
(193, 117, 'Preheat the oven to 350 degrees F (175 degrees C). Grease and flour a 9x13-inch cake pan.'),
(194, 117, 'Beat oil and eggs in a mixing bowl with an electric mixer until creamy. Add sugar and vanilla; beat well.'),
(195, 117, 'Stir together flour, cinnamon, baking soda, and salt in a bowl. Slowly add flour mixture to egg mixture; mix until combined. The batter will be very thick. Fold in apples by hand using a wooden spoon. Spread batter into the prepared pan.'),
(196, 117, 'Bake cake in the preheated oven until a toothpick inserted into the center comes out clean, about 45 minutes. Cool cake on a wire rack.'),
(197, 71, 'Place sliced beef in a large bowl. Whisk together lemon juice, soy sauce, sugar, salt, and pepper in a small bowl; pour over beef and toss to coat. Stir in cornstarch. Cover and refrigerate for 1 hour to overnight.'),
(198, 71, 'Heat vegetable oil in a large skillet over medium heat.'),
(199, 71, 'Remove beef slices from marinade, shaking to remove any excess liquid. Discard marinade.'),
(200, 71, 'Working in batches, fry beef slices in hot oil until they start to firm and are reddish-pink and juicy in the center, 2 to 4 minutes per side. Transfer beef slices to a serving platter.'),
(201, 71, 'Heat olive oil in a small skillet over medium heat. Cook and stir onion and garlic in hot oil until onion is golden brown, 5 to 7 minutes; spoon over beef slices.'),
(202, 119, 'Wrap a sushi rolling mat completely in plastic wrap and set aside.'),
(203, 119, 'Bring water and rice to a boil in a saucepan over high heat. Reduce heat to medium-low, cover, and simmer until rice is tender and liquid has been absorbed, 20 to 25 minutes. Transfer rice to a bowl and cut in vinegar using a rice paddle or wooden spoon. Season with sugar and salt. Allow to cool to room temperature, about 30 minutes.'),
(204, 119, 'Combine crab meat with mayonnaise in a small bowl.'),
(205, 119, 'Place nori sheet on a flat work surface. Spread a thin layer of rice on top of nori. Place nori, rice side down, on the prepared rolling mat. Place 2 to 3 avocado slices on top of the nori in one layer. Top with 2 to 3 tablespoons of the crab mixture. Spoon 1 to 2 teaspoons tobiko lengthwise on one side of the avocado-crab mixture, and 2 cucumber strips on the other side. Using the mat as a guide, carefully roll the California roll into a tight log. Remove the rolling mat. Top roll with more tobiko, cover with plastic wrap, and gently press the tobiko into the top of the roll. Remove the plastic and cut roll into 6 even pieces using a wet knife.'),
(206, 119, 'Repeat with remaining sheets of nori and filling. Serve garnished with pickled ginger, soy sauce, and wasabi paste'),
(207, 120, 'Combine chicken broth and taco seasoning mix in a bowl.'),
(208, 120, 'Place chicken in a slow cooker. Pour chicken broth mixture over chicken.'),
(209, 120, 'Cook on Low for 6 to 8 hours. Shred chicken.'),
(210, 121, 'Combine corn and chicken broth in a saucepan. Bring to a boil over medium-high heat.'),
(211, 121, 'Mix together cornstarch and water in a small bowl or cup; pour into the boiling corn soup, and continue cooking for about 2 minutes, or until thickened.'),
(212, 121, 'Gradually add beaten egg while stirring the soup. Remove from heat and serve.'),
(213, 122, 'Preheat the oven to 350 degrees F (175 degrees C).'),
(214, 122, 'Mix bread crumbs, Romano cheese, parsley, salt, pepper, garlic powder, and onion powder together in a large bowl; stir in water and eggs. Add ground beef and mix until well combined. Form mixture into balls and place on a nonstick baking sheet.'),
(215, 122, 'Bake in the preheated oven cooked through and evenly browned, about 30 minutes.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `kitchen_tips`
--
ALTER TABLE `kitchen_tips`
  ADD PRIMARY KEY (`tip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recipes_info`
--
ALTER TABLE `recipes_info`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes_steps`
--
ALTER TABLE `recipes_steps`
  ADD PRIMARY KEY (`step_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `kitchen_tips`
--
ALTER TABLE `kitchen_tips`
  MODIFY `tip_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `recipes_info`
--
ALTER TABLE `recipes_info`
  MODIFY `info_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  MODIFY `ingredient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `recipes_steps`
--
ALTER TABLE `recipes_steps`
  MODIFY `step_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kitchen_tips`
--
ALTER TABLE `kitchen_tips`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`);

--
-- Constraints for table `recipes_info`
--
ALTER TABLE `recipes_info`
  ADD CONSTRAINT `recipes_info_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  ADD CONSTRAINT `recipes_ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes_steps`
--
ALTER TABLE `recipes_steps`
  ADD CONSTRAINT `recipes_steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
