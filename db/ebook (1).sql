-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 05:37 AM
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
-- Database: `ebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `books_categories` varchar(99) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  `shipping_info` text DEFAULT NULL,
  `subscription_details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `books_categories`, `author`, `description`, `price`, `format`, `shipping_info`, `subscription_details`, `image`, `file`, `status`) VALUES
(17, 'The Lost Treasure', 'Adventure', 'John Smith', 'Join the thrilling adventure to find the lost treasure', 9.99, 'Paperback', 'Free shipping worldwide', 'Subscribe now for weekly updates', '../images/The Lost Treasure.jpeg', '', '1'),
(18, 'The Mystery Mansion', 'Mystery', 'Jane Doe', 'Explore the secrets hidden within the mysterious mansion', 12.99, 'Hardcover', 'Shipping charges apply', 'Subscribe now for exclusive content', '../images/h1.jpeg', '', '1'),
(19, 'Love in Paris', 'Romance', 'Emily Johnson', 'Experience the romance and magic of Paris', 8.99, 'E-book', 'Instant download', 'Subscribe now for bonus chapters', '../images/Love in Paris.jpeg', '', '1'),
(20, 'Realm of Dragons', 'Fantasy', 'David Roberts', 'Embark on a journey through the mythical realm of dragons', 14.99, 'Hardcover', 'Shipping charges apply', 'Subscribe now for special offers', '../images/Realm of Dragons.jpeg', '', '1'),
(21, 'Galactic Odyssey', 'Science Fiction', 'Michael Thompson', 'Travel through the galaxy in this epic science fiction adventure', 11.99, 'E-book', 'Instant download', 'Subscribe now for sneak peeks', '../images/Galactic Odyssey.jpeg', '', '1'),
(22, 'Terrible Madness', 'Horror', 'Sarah Davis', 'Prepare for a terrifying journey into the nightmare on Elm Street', 10.99, 'Paperback', 'Free shipping within the US', 'Subscribe now for early access', '../images/Terrible Madness.jpeg', '', '1'),
(23, 'The Chase', 'Thriller', 'Chris Evans', 'Get ready for a heart-pounding chase to catch the culprit', 13.99, 'Hardcover', 'Shipping charges apply', 'Subscribe now for bonus content', '../images/The Chase.jpeg', '', '1'),
(25, 'Steve Jobs: A Biography', 'Biography', 'Mark Williams', 'Discover the life story of Steve Jobs and his revolutionary impact on technology', 16.99, 'Paperback', 'Free shipping worldwide', 'Subscribe now for bi-weekly updates', '../images/Steve Jobs.jpeg', '', '1'),
(26, 'The Power of Positive Thinking', 'Self-Help', 'Susan Johnson', 'Unlock the secrets to success and happiness with the power of positive thinking', 17.99, 'E-book', 'Instant download', 'Subscribe now for motivational quotes', '../images/The Power of Positive Thinking.jpeg', '', '1'),
(29, 'Dracula', 'Horror', 'Bram Stoker', 'A classic horror novel about Count Dracula.', 9.99, 'Paperback', 'Free shipping on orders above $25.', 'Subscribe to our newsletter for exclusive deals.', '../images/Dracula.jpeg', '', '1'),
(30, 'The Da Vinci Code', 'Mystery', 'Dan Brown', 'A mystery thriller involving symbology and conspiracy.', 11.99, 'Hardcover', 'Standard shipping rates apply.', 'Join our loyalty program for discounts.', '../images/The Da Vinci Code.jpeg', '', '1'),
(31, 'It', 'Horror', 'Stephen King', 'A terrifying horror novel about the town of Derry and the evil entity It.', 14.99, 'Hardcover', 'Free shipping on orders above $50.', 'Join our book club for monthly discussions.', 'it.jpg', 'it.pdf', '0'),
(32, 'Gone Girl', 'Mystery', 'Gillian Flynn', 'A psychological thriller about a missing wife and the suspicion falling on her husband.', 10.49, 'Paperback', 'Standard shipping rates apply.', 'Subscribe to our newsletter for updates.', '../images/pexels-engin-akyurt-1446948.jpg', '', '0'),
(33, 'The Exorcist', 'Horror', 'William Peter Blatty', 'A chilling tale of demonic possession and exorcism.', 8.99, 'Paperback', 'Free shipping on orders above $25.', 'Join our loyalty program for discounts.', 'exorcist.jpg', 'exorcist.pdf', '0'),
(34, 'The Girl on the Train', 'Mystery', 'Paula Hawkins', 'A gripping psychological thriller about a woman who becomes entangled in a missing person investigation.', 12.99, 'Hardcover', 'Standard shipping rates apply.', 'Subscribe to our newsletter for exclusive deals.', '../images/about.png', '', '0'),
(35, 'Pet Sematary', 'Horror', 'Stephen King', 'A terrifying novel about a burial ground that brings the dead back to life.', 11.49, 'Paperback', 'Free shipping on orders above $25.', 'Join our book club for monthly discussions.', 'pet_sematary.jpg', 'pet_sematary.pdf', '0'),
(36, 'The Hound of the Baskervilles', 'Mystery', 'Arthur Conan Doyle', 'A classic mystery novel featuring Sherlock Holmes and Dr. Watson as they investigate the legend of a supernatural hound.', 9.99, 'Paperback', 'Standard shipping rates apply.', 'Subscribe to our newsletter for updates.', 'hound_of_the_baskervilles.jpg', 'hound_of_the_baskervilles.pdf', '0'),
(37, 'Psycho', 'Horror', 'Robert Bloch', 'A psychological horror novel that inspired the iconic Alfred Hitchcock film.', 8.49, 'Paperback', 'Free shipping on orders above $25.', 'Join our loyalty program for discounts.', 'psycho.jpg', 'psycho.pdf', '0'),
(38, 'The Silent Patient', 'Mystery', 'Alex Michaelides', 'A gripping psychological thriller about a woman who stops speaking after being accused of murder.', 13.49, 'Hardcover', 'Standard shipping rates apply.', 'Subscribe to our newsletter for exclusive deals.', 'silent_patient.jpg', 'silent_patient.pdf', '0');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories_name` text NOT NULL,
  `categories_desc` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories_name`, `categories_desc`, `status`, `date`) VALUES
(23, 'Adventure', 'Books that take readers on exciting journeys and adventures', 1, '2024-03-05 04:26:05'),
(24, 'Mystery', 'Books that involve solving puzzles or uncovering secrets', 1, '2024-03-05 04:26:05'),
(25, 'Romance', 'Books that focus on romantic relationships and love stories', 0, '2024-03-05 04:26:05'),
(26, 'Fantasy', 'Books that feature magical worlds and mythical creatures', 1, '2024-03-05 04:26:05'),
(27, 'Science Fiction', 'Books that explore futuristic or speculative concepts', 0, '2024-03-05 04:26:05'),
(28, 'Horror', 'Books that evoke fear and suspense in readers', 1, '2024-03-05 04:26:05'),
(29, 'Thriller', 'Books that are fast-paced and full of suspenseful twists', 0, '2024-03-05 04:26:05'),
(30, 'Historical Fiction', 'Books set in the past that blend historical events with fictional elements', 1, '2024-03-05 04:26:05'),
(31, 'Biography', 'Books that tell the life stories of real people', 0, '2024-03-05 04:26:05'),
(32, 'Self-Help', 'Books that offer advice and strategies for personal growth and improvement', 1, '2024-03-05 04:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `competitionentries`
--

CREATE TABLE `competitionentries` (
  `entry_id` int(11) NOT NULL,
  `competition_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `competition_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `prize_details` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`competition_id`, `title`, `description`, `start_date`, `end_date`, `prize_details`, `status`) VALUES
(3, 'Music Battle', 'Battle it out with your music compositions!', '2024-05-05', '2024-05-15', 'Recording studio session', '0');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `MessageID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` int(255) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`MessageID`, `Name`, `Email`, `Phone`, `Message`, `Timestamp`) VALUES
(13, 'imtiaz', 'imtiaz@imtiaz.com', 2147483647, 'acbMessage', '2024-03-16 01:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `ZipCode` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `PaymentType` varchar(50) DEFAULT NULL,
  `total_price` float NOT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `User_id`, `Country`, `Address`, `City`, `ZipCode`, `Email`, `Phone`, `PaymentType`, `total_price`, `Status`, `OrderDate`) VALUES
(11, 31, 'pakistan', 'jkjk', 'jkjkj', 'jkjk', 'jkjkj@jkjk', 'jkjkj', 'cod', 12.99, 'Pending', '2024-03-27 04:27:56'),
(12, 31, 'pakistan', 'jkjk', 'jkjkj', 'jkjkj', 'jj@jkjkj', 'jkjkj', 'cod', 12.99, 'Pending', '2024-03-27 04:31:04'),
(13, 31, 'pakistan', 'jkjkj', 'jkjj', 'jkjj', 'jjkj@jkjjkj', 'jkjkj', 'cod', 12.99, 'Pending', '2024-03-27 04:35:15'),
(14, 31, 'pakistan', 'jkjkj', 'jkjkjk', 'jkjkj', 'jkjkj@hjhjh', 'jkjkj', 'cod', 12.99, 'Pending', '2024-03-27 04:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(16, 13, 18, 1, 12.99),
(17, 14, 18, 1, 12.99);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `renewal_status` enum('Automatic','Manual') DEFAULT 'Automatic',
  `payment_status` enum('Paid','Pending','Overdue') DEFAULT 'Pending',
  `billing_cycle` enum('Monthly','Annually') DEFAULT NULL,
  `subscription_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `additional_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `image`, `name`, `email`, `password`, `registration_date`) VALUES
(31, '../images/home.png', 'admin1', 'admin@admin', '$2y$10$8zMQKtMyzT1jX7OR6fm1FOwgsBtDnDj/KY2GKAAVMVPcAqEDADBf2', '2024-03-18'),
(34, '../images/gallery.png', 'imtiaz', 'i@i', '$2y$10$p1CrX0TGDpZsrF6Yhd2AnOv8wAw56AbfW9pc8MohkgUMu3pZzqpHm', '2024-03-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);
ALTER TABLE `books` ADD FULLTEXT KEY `title` (`title`,`author`,`description`);
ALTER TABLE `books` ADD FULLTEXT KEY `title_2` (`title`,`description`);
ALTER TABLE `books` ADD FULLTEXT KEY `title_3` (`title`,`description`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitionentries`
--
ALTER TABLE `competitionentries`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`competition_id`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `competition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
