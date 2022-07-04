-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 08:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'shubham@gmail.com', '$2y$10$r8SYIVtTyF6lsWJiq726keVl45NZDBvZWTtm8DKI1MpVC.wTZKfva'),
(2, 'denis@gmail.com', '$2y$10$0jGhWxMLGSIOBkibPIVk9eIsgMCQ.8TWtRTBru04ASx.vE.eFINb.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `colour` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `quantity`, `size`, `colour`) VALUES
(7, 14, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Laptop'),
(2, 'Mobile'),
(3, 'Footware'),
(6, 'Clothes'),
(7, 'Bag'),
(8, 'Stationary'),
(9, 'Purse');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `message`, `subject`) VALUES
(8, 'denis shingala', 'denisshingala@gmail.com', 'this is for trial.', 'Nothing');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `colour` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `size_available` varchar(10) DEFAULT NULL,
  `colour_available` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `title`, `description`, `brand`, `price`, `discount`, `category_id`, `seller_id`, `image`, `size_available`, `colour_available`) VALUES
(12, 'Ideapad gaming Laptop 3 | 8GB RAM | 1TB HHD | 256G', 'Ideapad gaming Laptop 3 | 8GB RAM | 1TB HHD | 256GB SSD\\r\\nBlack Color\\r\\nProcessor : Intel Core i5 11Gen\\r\\n', 'Lenovo', 50300, 3, 1, 5, 'upload/1656311529_product-10.jpg', '', ''),
(14, 'Shoes', 'Main materials: mesh upper/ Rubber outsole\\r\\nBrand colour: CBLACK/FTWWHT\\r\\nLace-up closure\\r\\nWoven design\\r\\nWarranty: 3 months\\r\\nWarranty provided by brand / manufacturer', 'Adidas', 900, 5, 3, 5, 'upload/1656311945_product-1.jpg,upload/1656311945_product-2.jpg,upload/1656311945_product-3.jpg', '8,9,10', 'Black,White,Orange'),
(15, 'Men Slim Fit Casual Shirt', 'Slim Fit\\r\\nThe model (height 6\\\') is wearing a size 40\\r\\n\\r\\nMaterial & Care\\r\\n100% cotton\\r\\nMachine-wash', 'Dennis Lingo', 1200, 2, 6, 5, 'upload/1656312047_product-page-1.jpeg,upload/1656312047_product-page-2.jpeg,upload/1656312047_product-page-3.jpeg,upload/1656312047_product-page-4.jpeg,upload/1656312047_product-page-thumb-1.jpeg', 'XL,L,S,M', ''),
(16, 'Grey 56 cm Premium Hardsided Trolley Suitcase', 'Design Details:\\r\\nRed textured hardside check-in trolley suitcase, secured with a fixed combination lock\\r\\nNo. of wheels: 4\\r\\nOne handle on top and one on the side\\r\\nPush button trolley\\r\\n360 degree wheeling system\\r\\nPush button trolley\\r\\nScratch resistant polycarbonate shell\\r\\nWarranty: 5 years\\r\\nWarranty provided by the brand/manufacturer', 'Safari', 500, 1, 7, 5, 'upload/1656312188_bag6.jpg', '', ''),
(17, 'Graphic Dairy', 'Set Content: 1 Notebook\\r\\nColour: purple\\r\\nPattern: Printed\\r\\n\\r\\nSize & Fit\\r\\nLength: 20 cm\\r\\nWidth: 15cm\\r\\n\\r\\nMaterial & Care\\r\\n100% Paper', 'Apsara', 50, 10, 8, 5, 'upload/1656312297_notebook.jfif', '', ''),
(18, 'realme Narzo 50i (Carbon Black, 32 GB)  (2 GB RAM)', '2 GB RAM | 32 GB ROM | Expandable Upto 256 GB\\r\\n16.51 cm (6.5 inch) Display\\r\\n8MP Rear Camera | 5MP Front Camera\\r\\n5000 mAh Battery\\r\\nSC9863A Processor\\r\\nNo cost EMI starting from ₹2,500/month\\r\\nCash on Delivery\\r\\nNet banking & Credit/ Debit/ ATM card', 'realme', 7999, 6, 2, 5, 'upload/1656319516_mobile-1.webp,upload/1656319516_mobile-2.webp', '32GB 64GB', 'Carbon Black , white'),
(19, 'Infinix Note 12 (Force Black, 64 GB)  (4 GB RAM)', '4 GB RAM | 64 GB ROM | Expandable Upto 512 GB\\r\\n17.02 cm (6.7 inch) Full HD+ AMOLED Display\\r\\n50MP + 2MP Depth + AI Lens | 16MP Front Camera\\r\\n5000 mAh Li-ion Polymer Battery\\r\\nMediaTek Helio G88 Processor', 'Infinix', 15999, 25, 2, 5, 'upload/1656319798_mobile-3.webp,upload/1656319798_mobile-4.webp', '', 'Force Black , Blue'),
(20, 'STYLISH MENS BLACK SNEAKER Sneakers For Men  (Blac', '100% Original Products\\r\\nPay on delivery might be available\\r\\nEasy 30 days returns and exchanges\\r\\nTry & Buy might be available', 'puma', 1499, 66, 3, 5, 'upload/1656320093_shoes-1.webp,upload/1656320093_shoes-2.webp', '6,7,8,9', 'Black,White,Blue'),
(21, 'Sneakers For Men  (Black)', '00% Original Products\\r\\nPay on delivery might be available\\r\\nEasy 30 days returns and exchanges\\r\\nTry & Buy might be available', 'puma', 499, 33, 3, 5, 'upload/1656320283_shoes-3.webp,upload/1656320283_shoes-4.webp', '8,9,10', NULL),
(22, 'Self Design Men Round Neck Black T-Shirt', '100% Original Products\\r\\nPay on delivery might be available\\r\\nEasy 30 days returns and exchanges\\r\\nTry & Buy might be available', ' MenRocks', 500, 3, 6, 5, 'upload/1656320539_cloth-1.webp,upload/1656320539_cloth-2.webp', 'XL,L', NULL),
(23, 'Printed Daily Wear Georgette Saree  (Pack of 2, Mu', '100% Original Products\\r\\nPay on delivery might be available\\r\\nEasy 30 days returns and exchanges\\r\\nTry & Buy might be available', 'KASHVISAREES', 1299, 75, 6, 5, 'upload/1656320751_cloth-3.webp,upload/1656320751_cloth-4.webp', '', NULL),
(24, 'Large 34 L Backpack Golazo 34L Blue school, casual', '100% Original Products\\r\\nPay on delivery might be available\\r\\nEasy 30 days returns and exchanges\\r\\nTry & Buy might be available', 'Genius', 1915, 43, 7, 5, 'upload/1656320995_bag-1.webp,upload/1656320995_bag-2.webp', '', NULL),
(25, 'Brown Men Sling Bag - Mini', '100% Original Products\\r\\nPay on delivery might be available\\r\\nEasy 30 days returns and exchanges\\r\\nTry & Buy might be available', 'Genius', 1899, 65, 7, 5, 'upload/1656321094_bag-1.webp,upload/1656321094_bag-2.webp', '', NULL),
(26, 'Redmi 9A Sport (Coral Green, 2GB RAM, 32GB Storage) | 2GHz Octa-core Helio G25 Processor | 5000 mAh Battery', 'About this item\\r\\nProcessor: MediaTek Helio G25 Octa-core; Up to 2.0GHz clock speed\\r\\nCamera: 13 MP Rear camera with AI portrait| 5 MP front camera\\r\\nDisplay: 16.58 centimeters (6.53-inch) HD+ display with 720x1600 pixels and 20:9 aspect ratio\\r\\nBattery: 5000 mAH large battery with 10W wired charger in-box\\r\\nMemory, Storage & SIM: 2GB RAM | 32GB storage | Dual SIM (nano+nano) + Dedicated SD card slot\\r\\nThe Selfie camera allows easy and convenient access to your phone with AI face unlock\\r\\nform_factor:Bar,operating_system:MIUI 12', '', 2, 50, 2, 5, 'upload/1656914247_mobile-6.jpg,upload/1656914247_mobile-5.jpg', NULL, 'black , blue'),
(27, 'Apple iPhone 13 Pro (256GB) - Graphite', 'About this item\\r\\n15 cm (6.1-inch) Super Retina XDR display with ProMotion for a faster, more responsive feel\\r\\nCinematic mode adds shallow depth of field and shifts focus automatically in your videos\\r\\nPro camera system with new 12MP Telephoto, Wide and Ultra Wide cameras; LiDAR Scanner; 6x optical zoom range; macro photography; Photographic Styles, ProRes video, Smart HDR 4, Night mode, Apple ProRAW, 4K Dolby Vision HDR recording\\r\\n12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording\\r\\nA15 Bionic chip for lightning-fast performance\\r\\nUp to 22 hours of video playback\\r\\nDurable design with Ceramic Shield\\r\\n', '', 200000, 5, 2, 5, 'upload/1656914408_mobile-7.jpg,upload/1656914408_mobile-8.jpg', NULL, 'black'),
(28, 'OPPO F21 Pro (Cosmic Black, 8GB RAM, 128 Storage) with No Cost EMI/Additional Exchange Offers', 'About this item\\r\\nUltra-slim Retro Design with Industry First Fiberglass-leather finish and Orbit Light for Notifications\\r\\nAI Triple Camera setup - 64MP + 2MP + 2MP with microlens| 32MP Front Camera with Flagship Sony IMX709 Sensor\\r\\nBig 4500 mAh Battery with 33W SUPERVOOC Charging\\r\\n6.43\\\" inch (16.33cm) FHD+ AMOLED Punch-hole Display with 2400x1080 pixels. Larger Screen to Body ratio of 90.8%\\r\\nMemory, Storage & SIM: 8 GB RAM | 128 GB ROM | Expandable Upto 1TB | SIM 1 + SIM 2+ Micro SD', '', 27999, 18, 2, 5, 'upload/1656914689_mobile-9.jpg,upload/1656914689_mobile-10.jpg', NULL, 'black'),
(29, 'Samsung Galaxy S20 FE 5G (Cloud Mint, 8GB RAM, 128GB Storage)', 'About this item\\r\\n5G Ready powered by Qualcomm Snapdragon 865 Octa-Core processor, 8GB RAM, 128GB internal memory expandable up to 1TB, Android 11.0 operating system and dual SIM\\r\\nTriple Rear Camera Setup - 12MP (Dual Pixel) OIS F1.8 Wide Rear Camera + 8MP OIS Tele Camera + 12MP Ultra Wide | 30X Space Zoom, Single Take & Night Mode | 32MP F2.2 Front Punch Hole Camera\\r\\n6.5-inch(16.40 centimeters) Infinity-O Super AMOLED Display with 120Hz Refresh rate, 1080 x 2400 (FHD+) Resolution \\\"\\r\\n4500 mAh battery (Non -removable) with Super Fast Charging, FAst Wireless Charging & Finger Print sensor\\r\\nIP68 Rated, MicroSD Card Slot (Expandable upto 1 TB), Dual Nano Sim, Hybrid Sim Slot, 5G+5G Dual stand by\\r\\n5G Ready powered by Qualcomm Snapdragon 865 Octa-Core processor, 8GB RAM, 128GB internal memory expandable up to 1TB, Android 11.0 operating system and dual SIM.\\r\\nTriple Rear Camera Setup - 12megapixels (Dual Pixel) OIS F1.8 Wide Rear Camera + 8megapixels OIS Tele Camera + 12megapixels Ultra Wide | 30X Space Zoom, Single Take & Night Mode | 32megapixels F2.2 Front Punch Hole Camera.\\r\\n6.5-inch(16.40 centimeters) Infinity-O Super AMOLED Display with 120Hz Refresh rate, 1080 x 2400 (FHD+) Resolution.\\r\\n4500 mAh battery (Non -removable) with Super Fast Charging, Fast Wireless Charging & Finger Print sensor.\\r\\nIP68 Rated, MicroSD Card Slot (Expandable upto 1 TB), Dual Nano Sim, Hybrid Sim Slot.\\r\\n5G Ready powered by Qualcomm Snapdragon 865 Octa-Core processor, 8GB RAM, 128GB internal memory expandable up to 1TB, Android 11.0 operating system and dual SIM.\\r\\nTriple Rear Camera Setup - 12megapixels (Dual Pixel) OIS F1.8 Wide Rear Camera + 8megapixels OIS Tele Camera + 12megapixels Ultra Wide | 30X Space Zoom, Single Take & Night Mode | 32megapixels F2.2 Front Punch Hole Camera.\\r\\n6.5-inch(16.40 centimeters) Infinity-O Super AMOLED Display with 120Hz Refresh rate, 1080 x 2400 (FHD+) Resolution.\\r\\n4500 mAh battery (Non -removable) with Super Fast Charging, Fast Wireless Charging & Finger Print sensor.\\r\\nIP68 Rated, MicroSD Card Slot (Expandable upto 1 TB), Dual Nano Sim, Hybrid Sim Slot.\\r\\n', 'Samsung', 74990, 47, 2, 5, 'upload/1656914872_mobile-11.jpg,upload/1656914872_mobile-12.jpg', NULL, 'black'),
(30, 'Vivo V21 5G (Sunset Dazzle, 8GB RAM, 128GB Storage) Without Offer', 'About this item\\r\\n64MP+8MP+2MP Rear Camera | 44MP Selfie Camera\\r\\n16.65cm (6.44\\\") AMOLED Display with 90 Hz refresh rate and 2404 x 1080 pixels resolution.\\r\\nMemory & SIM: 8GB RAM | 128GB internal memory | Dual SIM (nano+nano) dual-standby (5G).\\r\\nFuntouch OS 11.1 (based on Android 11) operating system with Mediatek Dimensity 800U processor.\\r\\n33W flash charging with 4000mAh battery (Type-C).\\r\\n› See more product details', 'vivo', 32999, 28, 2, 5, 'upload/1656915088_mobile-13.jpg,upload/1656915088_mobile-14.jpg', NULL, NULL),
(31, 'Jio Phone Next 32 GB ROM, 2 GB RAM, Blue Smartphone', 'About this item\\r\\n5.45\\\" HD+SCREEN / 720*1440 RESO;UTION\\r\\n', 'jio', 7299, 37, 2, 5, 'upload/1656915384_mobile-15.jpg,upload/1656915384_mobile-16.jpg', NULL, 'blue');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `rating` int(11) NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `gst_number` varchar(30) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `IFSC_code` varchar(30) NOT NULL,
  `company_address` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `company_name`, `email`, `password`, `contact_number`, `gst_number`, `account_number`, `IFSC_code`, `company_address`, `status`) VALUES
(5, 'Honda', 'honda@gmail.com', '$2y$10$KHdiA.Hkgz4TAuqFRagYY.AR5x9S.UpE26iA1I2h3XgYzqTjaDC8W', '8547521478', '5215478525487', '875412457845', '548485151548', 'Chandkheda, Ahmedabad', 'approve'),
(10, 'Bank', 'bank@gmail.com', '$2y$10$1eH/sJa9z0JcDCFYYM5KQ.CQtZyCKhqJRv6MUOU345ZhsAIADGvZC', '2458484258', '58551514848', '18748581251', 'hd85558552', 'Chandkheda, Ahmedabad', 'pending'),
(12, 'Cofi', 'cofi@gmail.com', '$2y$10$O.IXZXx/nX1UFa.BjTkRbe7Eg4PwF5zUIgNOMmqEdygoQheN5q2nq', '8574452552', '587898952', '4548549254584', 'RF45558484', 'Chandkheda, Ahmedabad', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(6) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `contact_number`, `profile_image`, `gender`, `dob`, `address`, `city`, `pincode`, `state`, `country`) VALUES
(6, 'Denis', 'denis@gmail.com', '$2y$10$9y4WTRL1gSOO9WIfw9CKpO9eA.p9QHvgcGBei7hvaWxj2ZylGExvK', '1234567890', '', 'male', '0000-00-00', 'Surat', 'Surat', 395004, 'Gujarat', 'India'),
(7, 'Shubham', 'shubham@gmail.com', '$2y$10$Xo9WZUETsS9AlushvrmDXehrD.vJJatnGijFxs7q9aJOP6Yqf4KtW', '9987456201', '', 'male', '2002-01-01', 'Chandkheda', 'Ahmedabad', 382424, 'Gujarat', 'India'),
(8, 'akshay', 'akshay123@gmail.com', '$2y$10$lkk2ghLRE7LjWHvGap6ByOsiHOlMjg/v7duRqZQ8VIGoiM7s1DSoe', '9586804648', '', 'male', '2001-11-01', 'xyz', 'ah', 362020, 'gu', 'in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`),
  ADD UNIQUE KEY `account_number` (`account_number`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
