-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2024 at 06:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peso`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_level` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `username`, `password`, `email`, `admin_level`) VALUES
(1, 'Admin', '$2y$10$szZWza9fsLiGXs4evidE7.uc3zwFoQjs/hfwGvw2Vd6lddYLzBuTW', 'mercadomarklawrence55@gmail.com', NULL),
(2, 'jervin123', '$2y$10$bs.kIy4YfXaiSviKhSgXLeis9MBQHvqUMP0PV0pzCGuKxQSNqvqCG', 'jervinguevarra123@gmail.com', NULL),
(3, 'jerving123', '$2y$10$AvSxZd27fLrwIIFprAJC1eYvMEiZ9zZdW689Uvta6pXcVZQEIl4T6', 'jervinguevarra123@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_profile`
--

CREATE TABLE `applicant_profile` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `specialization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sex` enum('male','female') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_no` int DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'user.png',
  `house_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sss_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pagibig_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `philhealth_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passport_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `immigration_status` enum('Documented','Undocumented','Returning','Repatriated') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spouse_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spouse_contact` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fathers_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mothers_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emergency_contact_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `next_of_kin_relationship` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `next_of_kin_contact` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `education_level` enum('Elementary Undergraduate','Elementary Graduate','High School Undergraduate','High School Graduate','College Undergraduate','College Graduate','Vocational') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `occupation` enum('Administrative Work','Medical Work','Factory/Manufacturing','Farmers (Agriculture)','Teaching','Information Technology','Engineering','Restaurant Jobs (F&B)','Seaman (Sea-Based)','Household Service Worker (Domestic Helper)','Construction Work','Entertainment','Tourism Sector','Hospitality Sector','Others') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prefix` enum('Sr.','Jr.','II','III','IV','V','VI','VII') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emergency_contact_num` int DEFAULT NULL,
  `income` int DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employment_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employment_form` enum('Recruitment Agency','Government Hire','Name Hire','Referral') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` int DEFAULT NULL,
  `employer_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `local_agency_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `local_agency_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `dept_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant_profile`
--

INSERT INTO `applicant_profile` (`id`, `user_id`, `email`, `first_name`, `last_name`, `middle_name`, `dob`, `age`, `specialization`, `sex`, `civil_status`, `contact_no`, `photo`, `house_address`, `sss_no`, `pagibig_no`, `philhealth_no`, `passport_no`, `immigration_status`, `spouse_name`, `spouse_contact`, `fathers_name`, `fathers_address`, `mothers_name`, `mothers_address`, `emergency_contact_name`, `next_of_kin_relationship`, `next_of_kin_contact`, `education_level`, `occupation`, `prefix`, `emergency_contact_num`, `income`, `country`, `employment_type`, `employment_form`, `employer_name`, `contact_number`, `employer_address`, `local_agency_name`, `local_agency_address`, `arrival_date`, `dept_date`) VALUES
(1, 13, 'marklawrencemercado8@gmail.com', 'Mark Lawrence', 'Mercado', 'Aranda', '2002-07-23', 22, '', 'male', 'Single', 2147483647, 'user.png', '398, Malinta Los Banos, Laguna', '0', '0', '0', '0', 'Undocumented', 'Adaw', '435323423', 'mama', '323543425', 'fafa', '5345345345', 'fama', 'child', '2232435432', 'College Undergraduate', 'Engineering', 'II', 21435364, 14000, 'Philippines', 'Land-Based', 'Government Hire', 'wsefrews', 2147483647, '342sdcdfgs Streets', 'asfdgdfgdf', 'sdawdsdfsd', '2024-12-18', '2024-10-09'),
(2, 14, 'marklawrencemercado8@gmail.com', 'Mark Lawrence', 'Mercado', 'Aranda', '2002-07-23', 22, 'Information and Technology', 'female', 'Widowed', 2147483647, '66f2a88a36579.png', '398, Malinta Los Banos, Laguna', '0', '0', '0', '0', 'Undocumented', '', '', '', '', '', '', NULL, NULL, NULL, 'Vocational', 'Factory/Manufacturing', '', 0, 0, 'Philippines', 'Sea-Based', 'Recruitment Agency', 'wsefrews', 0, '342sdcdfgs Streets', 'asfdgdfgdf', 'sdawdsdfsd', '2024-10-12', '2024-10-01'),
(3, 15, 'marklawrencemercado8@gmail.com', 'Batbat', 'mercado', 'aranda', '2002-06-11', 22, '', 'male', 'Single', 0, 'user.png', '9783 baysdgdfgser', '0', '0', '0', '0', 'Documented', '', '', '', '', '', '', NULL, NULL, NULL, 'High School Graduate', 'Medical Work', 'Sr.', 0, 0, 'Philippines', 'Land-Based', 'Name Hire', 'fdgsd', 0, 'gtry45gdfg4e', 'Batbat aranda mercado', 'e4tdfge5t4e', '2024-11-21', '2024-10-10'),
(4, 16, 'jervinguevarra123@gmail.com', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 0, 'user.png', '', NULL, NULL, NULL, NULL, 'Documented', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sr.', 0, 0, '', '', 'Recruitment Agency', '', 0, '', '', '', '0000-00-00', '0000-00-00'),
(5, 22, 'ict1mercado.cdlb@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 23, 'ict1mercado.cdlb@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '66f77a02318a6.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int NOT NULL,
  `applicant_id` int DEFAULT NULL,
  `job_posting_id` int DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `applicant_id`, `job_posting_id`, `application_date`, `status`, `job`) VALUES
(4, 14, 8, NULL, 'accepted', 'backend dev'),
(5, 14, 9, NULL, 'accepted', 'front end'),
(6, 14, 10, NULL, 'accepted', 'system Administration'),
(7, 16, 1, NULL, 'pending', 'Laborer');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('filed','in_review','resolved') COLLATE utf8mb4_unicode_ci DEFAULT 'filed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `user_id`, `title`, `description`, `file`, `status`, `created_at`) VALUES
(3, 1, 'stalking', 'following everywhere', '../uploads/LSPU-LB CCS - Participant Certificates.pdf', 'filed', '2024-09-07 07:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `messages` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `email`, `name`, `subject`, `messages`) VALUES
(1, 'meyekop757@buzblox.com', 'meyokop', 'Trying', 'try lng to <./.>'),
(2, 'mercadomarklawrence55@gmail.com', 'nezuko', 'Trying', 'b**bies'),
(3, 'ict1mercado.cdlb@gmail.com', 'nezuko', 'Trying', '2143rfsg5rdhg5dr6u5r67uftyhjft'),
(4, 'marklawrencemercado8@gmail.com', 'meyokop', 'Trying', 'yhtgnyrthnbnbytdrh5rtd54etyegwe4tf3wrfsdf34wtdfgfhbhthbrty54'),
(5, 'marklawrencemercado8@gmail.com', 'meyokop', 'Trying', 'spam');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `module_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `description`, `module_count`) VALUES
(1, 'Dressmaking', 'sewing', 3),
(2, 'Programming', 'coding html, php, sql', 3),
(3, 'new', '123', 2),
(4, 'Cookery', 'Baking', 1),
(5, 'Digital Marketing Essentials', 'Master the fundamentals of digital marketing, including SEO, social media strategies, content creation, and paid advertising.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employer_documents`
--

CREATE TABLE `employer_documents` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `document_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employer_documents`
--

INSERT INTO `employer_documents` (`id`, `user_id`, `document_name`, `document_path`, `is_verified`, `comment`) VALUES
(1, 1, 'asdawdawf', 'uploads/a.jpg', 1, NULL),
(2, 1, 'Widowed', 'uploads/supply.pdf', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employer_profile`
--

CREATE TABLE `employer_profile` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `president` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HR` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HR_mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employer_profile`
--

INSERT INTO `employer_profile` (`id`, `user_id`, `company_name`, `company_address`, `tel_num`, `president`, `HR`, `company_mail`, `HR_mail`, `photo`) VALUES
(1, 1, 'JOLLYBOYS', 'crossing kanto', '09162602288', 'JOE BIDEN', 'DUKIN TRUMPS', 'JOLLYBOYS@gmail.com', 'DUKIN TRUMPS@gmail.com', '66f686ecbd255.png');

-- --------------------------------------------------------

--
-- Table structure for table `empyers`
--

CREATE TABLE `empyers` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Bdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empyers`
--

INSERT INTO `empyers` (`id`, `username`, `password`, `email`, `Fname`, `Lname`, `Bdate`, `contact`) VALUES
(1, 'azure', '$2y$10$uuxWdsGRfcNdTON/tfERYeeWaTngF9te5DMyjQjogMAY.xuxBZOKi', 'mercadomarklawrence55@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `Job_id` int DEFAULT NULL,
  `sched_date` date DEFAULT NULL,
  `sched_time` time DEFAULT NULL,
  `interview` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meeting` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_read` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`id`, `user_id`, `Job_id`, `sched_date`, `sched_time`, `interview`, `meeting`, `is_read`) VALUES
(1, 14, 9, '2024-10-03', '08:00:00', 'FacetoFace', '123sdfd3aws4fsewrf3w4', 1),
(2, 14, 9, '2024-10-11', '13:20:00', 'online', '', 0),
(3, 14, 9, '2024-10-11', '13:20:00', 'online', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `j_id` int NOT NULL,
  `employer_id` int NOT NULL,
  `job_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacant` int NOT NULL,
  `requirment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_posted` date NOT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`j_id`, `employer_id`, `job_title`, `job_description`, `specialization`, `vacant`, `requirment`, `work_location`, `remarks`, `date_posted`, `is_active`) VALUES
(1, 1, 'Laborer', 'construction worker', '', 12, '', '', '', '2024-09-22', 1),
(4, 1, 'electrician', 'fix electrical', '', 50, '', '', '', '2024-08-30', 1),
(8, 1, 'backend dev', 'database, php, mysql', 'Information and technology', 8, '', '', '', '2024-09-12', 1),
(9, 1, 'front end', 'dasfesargcvgbbdnnjghtydhdrtfggrt', 'Information and Technology', 11, '', '', '', '2024-09-21', 1),
(10, 1, 'system Administration', '-Installing, configuring, maintaining, and securing an organization\'s computer systems and networks.\r\n-Supporting, troubleshooting, and maintaining computer servers and networks.\r\n-Identifying and fixing network issues.\r\n-Updating equipment and software.\r\n-Advising on IT policies and optimizing computer networks.', 'Information and Technology', 2, '-College Graduate\r\n-4yrs of work experience\r\n-can use command line', 'Gotham city, back street', '', '2024-09-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`) VALUES
(1, 1, 'sadaSfsezcvzsdfcawes', '2024-09-09 01:29:59'),
(2, 0, 'Hi', '2024-09-18 13:05:27'),
(3, 0, 'Hi', '2024-09-18 13:05:37'),
(4, 0, 'hi', '2024-09-18 13:12:48'),
(5, 14, 'hi', '2024-09-18 13:40:32'),
(6, 14, 'joke', '2024-09-18 13:43:32'),
(7, 14, 'bnye', '2024-09-19 06:24:09'),
(8, 14, 'sdasdsfgsefs', '2024-09-21 04:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `course_id` int DEFAULT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `module_name`) VALUES
(1, 1, 'measurements'),
(2, 1, 'needle & thread'),
(3, 1, 'dresses'),
(4, 3, 'new1'),
(5, 3, 'new12'),
(6, 4, 'Baking'),
(7, 4, 'Grilling'),
(9, 5, 'Introduction to Digital Marketing'),
(10, 5, 'Search Engine Optimization (SEO)'),
(11, 5, ' Social Media Marketing'),
(12, 4, 'Frying');

-- --------------------------------------------------------

--
-- Table structure for table `module_content`
--

CREATE TABLE `module_content` (
  `id` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modules_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_content`
--

INSERT INTO `module_content` (`id`, `description`, `video`, `file_path`, `modules_id`) VALUES
(1, 'learning correct measurements', 'https://www.youtube.com/watch?v=Qxo2ToDM-uE&list=RDCLAK5uy_kmPRjHDECIcuVwnKsx2Ng7fyNgFKWNJFs&index=9', 'uploads/1.jpg', 1),
(2, 'correct needle and uses', 'https://www.youtube.com/watch?v=WvoAL44J42g', 'uploads/2.jpg', 2),
(3, 'types of dress', 'https://www.youtube.com/watch?v=z-5tJblM-WQ', 'uploads/3.jpg', 3),
(4, 'new', 'https://www.youtube.com/watch?v=ahHiepqCDK8', 'uploads/supply.pdf', 4),
(5, 'how to bake ', 'https://www.youtube.com/watch?v=KTh4kTdj3Kk&list=RDKTh4kTdj3Kk&start_radio=1', 'uploads/download (1).jpeg', 6),
(6, 'how to grill', 'https://www.youtube.com/watch?v=NoZJYcNcbUA', 'uploads/PESO.pdf', 7),
(8, 'Introduction To Digital Marketing', 'https://www.youtube.com/watch?v=ZVuHLPl69mM', 'uploads/diskette.png', 9),
(9, 'Search Engine Optimization (SEO)', 'https://www.youtube.com/watch?v=xsVTqzratPs', 'uploads/diskette.png', 10),
(10, 'FRIED', 'https://www.youtube.com/watch?v=nqwvvmzfWDA', 'uploads/diskette.png', 12);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `quiz_id` int DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marks` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `marks`) VALUES
(4, 4, 'what is CM', 'centimeter', 'milimeter', 'inches', 'meter', 'a', 1),
(5, 4, 'Inches ', '1', '2', '3', '4', 'b', 1),
(6, 4, 'Meter', '1', '2', '3', '4', 'd', 1),
(7, 4, 'Color', '1', '2', '3', '4', 'c', 1),
(8, 5, 'what is CM', '1', '2', '3', '4', 'c', 1),
(9, 5, '2', '3', '4', '6', '7', 'b', 1),
(10, 6, 'Which of the following is considered a leavening agent used in baking?', '.Salt', 'Sugar', ' Baking powder', 'Olive oil', 'c', 1),
(11, 6, 'What type of flour is most commonly used for making bread?', 'Cake flour', 'All-purpose flour', 'Bread flour', 'Self-rising flour', 'c', 1),
(12, 6, 'Which ingredient is often used to give baked goods a tender texture?', 'Butter', 'Baking soda', 'Cornstarch', 'Water', 'a', 1),
(13, 6, 'When a recipe calls for creaming, which two ingredients are typically mixed together?', 'Flour and eggs', 'Butter and sugar', 'Milk and flour', 'Eggs and sugar', 'b', 1),
(14, 6, ' What is the primary function of eggs in most baking recipes?', 'To add sweetness', 'To provide structure and stability', 'To act as a thickening agent', 'To enhance flavor', 'b', 1),
(15, 6, 'Which of the following is commonly used as a fat in baking?', 'Sugar', 'Salt', ' Shortening', 'Cornstarch', 'c', 1),
(16, 6, ' What is the purpose of adding salt to baked goods?', 'To increase sweetness', 'To enhance flavor', ' To act as a preservative', 'To provide moisture', 'b', 1),
(17, 6, 'Which sugar is most often used in making meringue? a) Granulated sugar', ' Brown sugar', 'Granulated sugar', ' Confectioners’ sugar', 'Raw sugar', 'b', 1),
(18, 6, 'What is the main purpose of using yeast in bread baking?', 'To add flavor', ' To sweeten the dough', ' To make the dough rise', ' To improve the dough’s texture', 'c', 1),
(19, 6, ' What ingredient is typically used to thicken custards and fillings?', 'Flour', ' Cornstarch', 'Yeast', ' Baking soda', 'b', 1),
(20, 7, ' What is the primary purpose of marinating meat before grilling?', 'To make the meat look better', 'To reduce cooking time', 'To enhance flavor and tenderize the meat', 'To increase the temperature of the grill', 'c', 1),
(21, 7, ' Which of the following is the best oil to use for greasing the grill to prevent sticking?', 'Olive oil', 'Butter', 'Vegetable oil', 'Coconut oil', 'c', 1),
(22, 7, 'What is the ideal internal temperature for grilling a medium-rare steak?', ' 120°F (49°C)', '140°F (60°C)', '130°F (54°C)', '160°F (71°C)', 'c', 1),
(23, 7, 'Which of the following cuts of meat is typically used for grilling?', 'Ribeye', 'Shank', 'Chuck roast', 'Brisket', 'a', 1),
(24, 7, 'What is the correct technique for using indirect heat while grilling?', 'Placing the food directly over the flames', 'Cooking the food with the grill lid open', 'Cooking the food away from the flames with the lid closed', 'Cooking the food with high heat for a short time', 'c', 1),
(25, 7, 'Which type of grill typically provides the most smoky flavor?', 'Electric grill', 'Gas grill', 'Charcoal grill', 'Infrared grill', 'c', 1),
(26, 7, ' What is the best way to check if chicken is fully cooked when grilling?', 'By cutting it open and checking the color', 'By using a meat thermometer to check the internal temperature', 'By feeling its texture', ' By measuring the cooking time', 'b', 1),
(27, 7, 'How often should you flip burgers while grilling?', 'Every 1 minute', ' As often as possible', 'Only once during grilling', 'Every 30 seconds', 'c', 1),
(28, 7, 'What is the best method for preventing vegetables from falling through the grill grates?', ' Use high heat to cook them faster', ' Use a grilling basket or skewers', 'Cut them into large pieces', 'Keep the grill lid open', 'b', 1),
(29, 7, 'Which of the following meats is best suited for quick grilling over high heat?', 'Pork chops', 'Brisket', 'Lamb shank', ' Beef short ribs', 'a', 1),
(30, 8, ' What is the primary purpose of marinating meat before grilling?', 'To make the meat look better', 'To reduce cooking time', 'To enhance flavor and tenderize the meat', 'To increase the temperature of the grill', 'c', 1),
(31, 8, 'Which of the following is the best oil to use for greasing the grill to prevent sticking?', ' Olive oil', 'Butter', 'Vegetable oil', ' Coconut oil', 'c', 1),
(32, 8, 'What is the ideal internal temperature for grilling a medium-rare steak?', '120°F (49°C)', ' 160°F (71°C)', '130°F (54°C)', '140°F (60°C)', 'c', 1),
(33, 8, 'Which of the following cuts of meat is typically used for grilling?', 'Ribeye', 'Shank', 'Chuck roast', 'Brisket', 'a', 1),
(34, 8, 'What is the correct technique for using indirect heat while grilling?', 'Placing the food directly over the flames', 'Cooking the food with the grill lid open', 'Cooking the food away from the flames with the lid closed', 'Cooking the food with high heat for a short time', 'c', 1),
(35, 8, 'Which type of grill typically provides the most smoky flavor?', 'Electric grill', 'Gas grill', 'Charcoal grill', 'Infrared grill', 'c', 1),
(36, 8, 'What is the best way to check if chicken is fully cooked when grilling?', 'By cutting it open and checking the color', ' By using a meat thermometer to check the internal temperature', 'By feeling its texture', ' By measuring the cooking time', 'b', 1),
(37, 8, 'How often should you flip burgers while grilling?', 'Every 1 minute', 'As often as possible', 'Only once during grilling', 'Every 30 seconds', 'c', 1),
(38, 8, 'What is the best method for preventing vegetables from falling through the grill grates?', ' Use high heat to cook them faster', 'Use a grilling basket or skewers', 'Cut them into large pieces', 'Keep the grill lid open', 'b', 1),
(39, 8, ' Which of the following meats is best suited for quick grilling over high heat?', 'Pork chops', ' Brisket', 'Lamb shank', 'Beef short ribs', 'a', 1),
(40, 9, 'Which of the following meats is best suited for quick grilling over high heat?', ' Pork chops', ' Brisket', 'Lamb shank', 'Beef short ribs', 'a', 1),
(41, 9, '. What is the best method for preventing vegetables from falling through the grill grates?', 'Cut them into large pieces', 'Keep the grill lid open', 'Use a grilling basket or skewers', 'Use high heat to cook them faster', 'c', 1),
(42, 9, ' Which type of grill typically provides the most smoky flavor?', 'Electric grill', 'Gas grill', ' Charcoal grill', 'Infrared grill', 'c', 1),
(43, 9, 'How often should you flip burgers while grilling?', 'Every 1 minute', 'As often as possible', 'Only once during grilling', ' Every 30 seconds', 'c', 1),
(44, 9, ' What is the best way to check if chicken is fully cooked when grilling?', 'By cutting it open and checking the color', ' By using a meat thermometer to check the internal temperature', ' By feeling its texture', 'By measuring the cooking time', 'b', 1),
(45, 9, 'What is the correct technique for using indirect heat while grilling?', 'Cooking the food with the grill lid open', 'Placing the food directly over the flames', 'Cooking the food away from the flames with the lid closed', 'Cooking the food with high heat for a short time', 'c', 1),
(46, 9, 'Which of the following cuts of meat is typically used for grilling?', 'Ribeye', 'Shank', 'Chuck roast', 'Brisket', 'a', 1),
(47, 9, 'What is the ideal internal temperature for grilling a medium-rare steak?', ' 120°F (49°C)', ' 140°F (60°C)', ' 130°F (54°C)', ' 160°F (71°C)', 'c', 1),
(48, 9, 'Which of the following is the best oil to use for greasing the grill to prevent sticking?', 'Coconut oil', ') Butter', 'Vegetable oil', 'Olive oil', 'c', 1),
(49, 9, ' What is the primary purpose of marinating meat before grilling?', 'To make the meat look better', 'To reduce cooking time', 'To enhance flavor and tenderize the meat', 'To increase the temperature of the grill', 'c', 1),
(50, 10, 'What is digital marketing primarily concerned with?', 'Traditional advertising methods', 'Marketing through digital channels', 'Product manufacturingSupply chain management', 'Supply chain management', 'b', 1),
(51, 10, 'Which of the following is NOT a component of digital marketing?', 'Search Engine Optimization (SEO)', 'Social Media Marketing (SMM)', 'Print advertising', 'Email Marketing', 'c', 1),
(52, 10, 'What does SEO stand for?', 'Search Engine Optimization', 'Search Enhanced Organization', ' Simple Email Outreach', 'Social Engagement Optimization', 'b', 1),
(53, 10, 'Which platform is primarily used for B2B marketing?', 'Instagram', 'LinkedIn', 'TikTok', ' Pinterest', 'b', 1),
(54, 10, 'What is the purpose of content marketing?', 'To sell products directly', 'o create and distribute valuable content', 'To increase ad spending', 'To reduce production costs', 'b', 1),
(55, 11, 'What does SEO stand for?', 'Search Engine Operation', ' Search Engine Optimization', 'Search Engine Outreach', 'Social Engine Optimization', 'b', 1),
(56, 11, 'Which of the following is considered an on-page SEO factor?', ' Backlinks', 'Social media shares', ' Content quality', ' Domain authority', 'c', 1),
(57, 11, 'What is the primary purpose of keyword research in SEO?', ' To determine the best colors for a website', 'To identify what users are searching for', 'To create social media ads', 'To increase website load speed', 'b', 1),
(58, 11, 'Which of the following is an example of off-page SEO?', 'Optimizing meta tags', 'Improving site speed', 'Building backlinks from other websites', 'Writing high-quality blog content', 'c', 1),
(59, 11, 'Which tool is commonly used for keyword research?', ' Google Analytics', 'Google Keyword Planner', ' SEMrush', ' Ahrefs', 'b', 1),
(60, 12, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(61, 12, 'What is the primary goal of a social media strategy?', 'To create viral content', ' To post as much content as possible', 'To align social media efforts with business objectives', 'To focus only on paid campaigns', 'c', 1),
(62, 12, 'Which platform is best known for its image and video-centric content?', 'Twitter', 'Instagram', 'LinkedIn', ' Facebook', 'd', 1),
(63, 12, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(64, 12, 'What is the primary goal of a social media strategy?', 'To create viral content', ' To post as much content as possible', 'To align social media efforts with business objectives', 'To focus only on paid campaigns', 'c', 1),
(65, 12, 'Which platform is best known for its image and video-centric content?', 'Twitter', 'Instagram', 'LinkedIn', ' Facebook', 'd', 1),
(66, 12, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(67, 12, 'What is the primary goal of a social media strategy?', 'To create viral content', ' To post as much content as possible', 'To align social media efforts with business objectives', 'To focus only on paid campaigns', 'c', 1),
(68, 12, 'Which platform is best known for its image and video-centric content?', 'Twitter', 'Instagram', 'LinkedIn', ' Facebook', 'd', 1),
(69, 12, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(70, 12, 'What is the primary goal of a social media strategy?', 'To create viral content', ' To post as much content as possible', 'To align social media efforts with business objectives', 'To focus only on paid campaigns', 'c', 1),
(71, 12, 'Which platform is best known for its image and video-centric content?', 'Twitter', 'Instagram', 'LinkedIn', ' Facebook', 'd', 1),
(72, 12, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(73, 12, 'What is the primary goal of a social media strategy?', 'To create viral content', ' To post as much content as possible', 'To align social media efforts with business objectives', 'To focus only on paid campaigns', 'c', 1),
(74, 12, 'Which platform is best known for its image and video-centric content?', 'Twitter', 'Instagram', 'LinkedIn', ' Facebook', 'd', 1),
(75, 13, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(76, 13, 'What is the primary goal of a social media strategy?', 'To create viral content', 'To post as much content as possible', 'To align social media efforts with business objectives', ' To focus only on paid campaigns', 'c', 1),
(77, 13, 'Which platform is best known for its image and video-centric content?', 'Twitter', ' Instagram', ' LinkedIn', 'Facebook', 'b', 1),
(78, 13, 'Which of the following is an example of paid social media marketing?', ' Sharing a personal blog post on your profile', 'Responding to customer comments on your page', 'Running a Facebook Ads campaign', 'Posting a story on Instagram', 'c', 1),
(79, 13, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(80, 13, 'What is the primary goal of a social media strategy?', 'To create viral content', 'To post as much content as possible', 'To align social media efforts with business objectives', ' To focus only on paid campaigns', 'c', 1),
(81, 13, 'Which platform is best known for its image and video-centric content?', 'Twitter', ' Instagram', ' LinkedIn', 'Facebook', 'b', 1),
(82, 13, 'Which of the following is an example of paid social media marketing?', ' Sharing a personal blog post on your profile', 'Responding to customer comments on your page', 'Running a Facebook Ads campaign', 'Posting a story on Instagram', 'c', 1),
(83, 13, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(84, 13, 'What is the primary goal of a social media strategy?', 'To create viral content', 'To post as much content as possible', 'To align social media efforts with business objectives', ' To focus only on paid campaigns', 'c', 1),
(85, 13, 'Which platform is best known for its image and video-centric content?', 'Twitter', ' Instagram', ' LinkedIn', 'Facebook', 'b', 1),
(86, 13, 'Which of the following is an example of paid social media marketing?', ' Sharing a personal blog post on your profile', 'Responding to customer comments on your page', 'Running a Facebook Ads campaign', 'Posting a story on Instagram', 'c', 1),
(87, 13, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(88, 13, 'What is the primary goal of a social media strategy?', 'To create viral content', 'To post as much content as possible', 'To align social media efforts with business objectives', ' To focus only on paid campaigns', 'c', 1),
(89, 13, 'Which platform is best known for its image and video-centric content?', 'Twitter', ' Instagram', ' LinkedIn', 'Facebook', 'b', 1),
(90, 13, 'Which of the following is an example of paid social media marketing?', ' Sharing a personal blog post on your profile', 'Responding to customer comments on your page', 'Running a Facebook Ads campaign', 'Posting a story on Instagram', 'c', 1),
(91, 13, 'Which social media platform is most commonly used for professional networking?', 'Facebook', ' Instagram', 'LinkedIn', 'Twitter', 'c', 1),
(92, 13, 'What is the primary goal of a social media strategy?', 'To create viral content', 'To post as much content as possible', 'To align social media efforts with business objectives', ' To focus only on paid campaigns', 'c', 1),
(93, 13, 'Which platform is best known for its image and video-centric content?', 'Twitter', ' Instagram', ' LinkedIn', 'Facebook', 'b', 1),
(94, 13, 'Which of the following is an example of paid social media marketing?', ' Sharing a personal blog post on your profile', 'Responding to customer comments on your page', 'Running a Facebook Ads campaign', 'Posting a story on Instagram', 'c', 1),
(95, 14, ' What is frying?', 'Cooking food in hot oil', ' Cooking food in dry heat', 'Cooking food in water', 'Cooking food in steam', 'a', 1),
(96, 14, 'Which type of frying involves submerging food completely in hot oil?', 'Pan-frying', 'Shallow frying', 'Deep frying', ' Dry frying', 'c', 1),
(97, 14, 'Which oil is commonly used for deep frying due to its high smoke point?', 'Olive oil', 'Coconut oil', 'Sunflower oil', 'Sesame oil', 'd', 1),
(98, 14, 'What temperature range is typically used for deep frying?', ' 100°C - 150°C', ' 150°C - 190°C', '200°C - 250°C', ' 50°C - 100°C', 'b', 1),
(99, 14, ' What is the purpose of breading or battering food before frying?', 'To change the color', ' To make it sweeter', ' To create a crispy coating', 'To soften the food', 'c', 1),
(100, 14, ' What is pan-frying?', 'Frying food without oil', 'Frying food with a small amount of oil', 'Frying food in deep oil', 'Frying food on high heat', 'b', 1),
(101, 14, 'Which of the following is not typically used in frying?', ' Oil', ' Fat', 'Butter', 'Water', 'd', 1),
(102, 14, 'What effect does overcrowding the frying pan have?', ' Makes food fry faster', ' Lowers the oil temperature', ' Increases the oil temperature', 'Cooks food evenly', 'b', 1),
(103, 14, 'What is shallow frying?', 'Submerging food in oil', 'Cooking food in a small amount of oil covering part of the food', 'Cooking food in steam', 'Cooking food in no oil', 'b', 1),
(104, 14, 'Which of the following foods is commonly deep-fried?', ' Bread', 'French fries', 'Fruit salad', ' Salad', 'b', 1),
(105, 14, 'What happens if oil is not hot enough when frying?', 'Food becomes crispy', ' Food absorbs too much oil', 'Food cooks faster', ' Food doesn’t cook at all', 'b', 1),
(106, 14, ' Which frying method is healthier?', 'Air frying', 'Deep frying', 'Shallow frying', 'Pan-frying', 'a', 1),
(107, 14, 'Which utensil is commonly used to remove fried food from oil?', 'Knife', 'Spoon', 'Slotted spoon', 'Fork', 'c', 1),
(108, 14, 'What is the smoke point of oil?', 'The temperature at which oil bubbles', 'The temperature at which oil starts to burn', 'The temperature at which oil cools', 'The temperature at which oil freezes', 'b', 1),
(109, 14, 'What type of oil is often avoided for deep frying due to its low smoke point?', 'Canola oil', ' Extra virgin olive oil', 'Peanut oil', ' Corn oil', 'b', 1),
(110, 14, 'How do you know when oil is ready for frying?', ' It cools down', 'It turns yellow', 'It stops bubbling', 'It begins to shimmer and lightly smoke', 'd', 1),
(111, 14, 'Why is it important to use dry ingredients when frying?', ' To improve taste', 'To prevent food from sticking to the pan', 'To avoid splattering and hot oil popping', 'To fry food faster', 'c', 1),
(112, 14, 'What is the role of a thermometer in frying?', 'To measure food weight', 'To check oil temperature', ') To stir food', 'To cool food down', 'b', 1),
(113, 14, 'What is stir-frying?', ' Frying food submerged in oil', 'Cooking food quickly with a small amount of oil while stirring constantly', 'Cooking food on a grill', 'Cooking food in water', 'b', 1),
(114, 14, 'What is the main difference between pan-frying and sautéing?', 'The type of oil used', 'The amount of oil and the heat applied', 'The type of food cooked', 'The cooking time', 'b', 1),
(115, 14, 'Which food is not usually fried?', 'Cake', 'Chicken', 'Donuts', 'French fries', 'a', 1),
(116, 14, 'What is double frying?', ' Frying food in two different oils', 'Frying the same food twice', 'Frying food, letting it cool, and frying it again for crispiness', 'Frying two foods at once', 'c', 1),
(117, 14, 'What happens when food is fried at too high a temperature?', 'It burns outside and remains raw inside', 'It cooks evenly', 'It absorbs less oil', 'It becomes too tender', 'a', 1),
(118, 14, 'Why is it important to let fried food drain on paper towels?', 'To improve flavor', 'To keep food moist', 'To remove excess oil', 'To add texture', 'c', 1),
(119, 14, ' What is a common sign that frying oil has degraded?', ' It turns clear', ' It produces a lot of smoke and smells burnt', 'It becomes thicker', 'It produces bubbles', 'b', 1),
(120, 14, 'What is tempura frying?', ' Frying in butter', 'Japanese method of frying with a light batter', 'Frying without oil', ' Frying with only flour', 'b', 1),
(121, 14, 'What does the term \"golden brown\" refer to in frying?', ' The oil used', 'The desired color of the food when perfectly fried', 'The name of a frying pan', 'The temperature of the oil', 'b', 1),
(122, 14, 'What’s the best way to keep fried food crispy?', 'Keep it on a wire rack', 'Cover it with foil', 'Store it in a plastic container', 'Let it sit in oil', 'a', 1),
(123, 14, 'Why is it not recommended to reuse oil for multiple frying sessions?', ' It makes the food oily', ' It affects the cooking time', 'It can lead to burnt flavors and unhealthy compounds', 'It increases the smoke point', 'c', 1),
(124, 14, 'Which of the following frying techniques is considered low-fat?', ' Deep frying', 'Pan-frying', 'Air frying', ' Shallow frying', 'c', 1),
(125, 14, 'What is the purpose of adding a pinch of salt to oil before frying?', ' To improve flavor', ' To reduce oil splattering', 'o change the color of oil', ' To increase oil temperature', 'b', 1),
(126, 14, ' What is flash frying?', 'Cooking food with a low temperature', 'Cooking food very quickly at high heat', 'Frying in butter', ' Frying food at a medium temperature', 'b', 1),
(127, 14, 'What should be done before frying frozen food?', 'Fry it immediately', 'Thaw it and dry it completely', 'Heat it in a microwave', 'Add extra oil', 'b', 1),
(128, 14, 'Which of the following is a benefit of frying with peanut oil?', 'It has a low smoke point', ' It has a strong flavor', 'It has a neutral flavor and high smoke point', 'It is not healthy', 'c', 1),
(129, 14, 'What type of frying uses little to no oil?', 'Shallow frying', ' Deep frying', 'Air frying', ' Stir frying', 'c', 1),
(130, 14, 'What is the risk of frying with wet or damp food?', ' It fries faster', ' It doesn’t absorb oil', 'It causes oil splatters and can be dangerous', 'It burns easily', 'c', 1),
(131, 14, 'What type of batter is typically used in tempura frying?', ' A batter made with milk', 'A batter made with yeast', 'A heavy batter made with breadcrumbs', 'A light, airy batter made with flour, water, and egg', 'd', 1),
(132, 14, 'Which oil is least suitable for frying due to its low smoke point?', 'Peanut oil', 'Extra virgin olive oil', 'Vegetable oil', 'Corn oil', 'b', 1),
(133, 14, 'What is the main role of a thermometer in frying?', ' To cook food faster', 'To make oil boil', 'To ensure oil is at the correct temperature', 'To cool the oil', 'c', 1),
(134, 14, 'Why is frying at the right temperature important?', 'To ensure food cooks evenly and doesn’t absorb too much oil', 'o burn the food', 'To cook the food faster', 'To make the food dry', 'a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_name`
--

CREATE TABLE `quiz_name` (
  `id` int NOT NULL,
  `module_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_ans` int DEFAULT NULL,
  `wrong_ans` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_name`
--

INSERT INTO `quiz_name` (`id`, `module_id`, `title`, `correct_ans`, `wrong_ans`, `total`, `tag`, `date`) VALUES
(4, 1, 'Different Measurements', 1, 1, 3, 'how to measure ', '2024-09-02 13:54:06'),
(5, 4, 'New', 1, 1, 2, 'how to measure ', '2024-09-02 15:04:41'),
(6, 6, 'Ingredients Of Baking', 1, 0, 10, 'Quiz/Exam', '2024-09-26 16:01:35'),
(9, 7, 'Grill', 1, 0, 10, 'How to Grill', '2024-09-26 12:29:00'),
(10, 9, 'Intro To Digital Marketing', 1, 0, 5, 'Introduction To Digital Marketing', '2024-09-26 12:51:38'),
(11, 10, 'Search Engine Optimization', 2, 0, 5, 'quiz', '2024-09-26 12:56:12'),
(12, 11, 'Social Media Marketing', 2, 0, 5, 'Quiz/Exam', '2024-09-26 14:57:30'),
(14, 12, 'How To Fry', 1, 0, 40, 'QUIZ', '2024-09-26 16:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NOT NULL',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `email`, `username`, `password`, `token`, `is_verified`) VALUES
(13, 'marklawrencemercado8@gmail.com', 'Azure', '$2y$10$8EpYIZYPSYNGChcXfsMpTOhZ82mEeh6ZqUK4t9UszJCyDzfgmKgSS', '3b17bee68feeb18350a947d3ced7247b6461ae8fc07101635e552f2af00b6a405b24e4831a950f4207bfc36bdfb0f8aa5c35', 1),
(14, 'marklawrencemercado8@gmail.com', 'mark', '$2y$10$aGuDjBWRMUEnTw0O8/evlusGclWGzc6unMr1Qbh.uz1oOgAZDJ5rK', 'e887e669be437912dcbed8d38cd2b7392a7281a5ffcba9c497cae823146d838bdca443a11ef31a9ddd91878e4235ffa0c4e5', 1),
(15, 'marklawrencemercado8@gmail.com', 'Azure1', '$2y$10$YVy4hWWcCXqjGI1Uns6HG.XtP76PBlQu9Ai540OBIC4Rh2B28s.ea', '47733609259b9248acd3466506d91358ab4bc33618933aa38fdbc4971ca05cb49d6a8b8e21a42cffabd2593e09fc4cb2f6f1', 1),
(16, 'jervinguevarra123@gmail.com', 'jervin123', '$2y$10$6./p3k3siOiK8P0vaA1AFOH3lR0NRfczIFEUNNDLEOBg4QVNUH5bK', '2addf21b0f58aaaef6b864b5aef3f914679c542fff530dfe95a2ac9acb7cd8b4d0ea05a04ace38cfbfe68bad13d57755061f', 1),
(23, 'ict1mercado.cdlb@gmail.com', 'Lawrence', '$2y$10$nSV7vPZd5JryWvi.AeTU8.OzQ5SbHVi7whpabIIsDTKOavhCSJFWK', 'd8ec8807a932f6cde174d3e1df7776dd691d3acf28b683bd0b7d099b9248a8478fca57a2a18e1b0c76019a57d476a13cc055', 1);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int NOT NULL,
  `message_id` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `message_id`, `admin_id`, `reply`, `created_at`) VALUES
(1, 1, 1, 'ok', '2024-09-09 02:20:15'),
(2, 8, 1, 'reply', '2024-09-21 04:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `survey_form`
--

CREATE TABLE `survey_form` (
  `id` int NOT NULL,
  `question` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_form`
--

INSERT INTO `survey_form` (`id`, `question`) VALUES
(1, 'workerssssss'),
(2, 'nerver'),
(3, 'Enter survey Questions');

-- --------------------------------------------------------

--
-- Table structure for table `survey_reponse`
--

CREATE TABLE `survey_reponse` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `survey_id` int DEFAULT NULL,
  `reponse` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_reponse`
--

INSERT INTO `survey_reponse` (`id`, `user_id`, `survey_id`, `reponse`) VALUES
(12, 14, 1, 'Never'),
(13, 14, 2, 'Sometimes'),
(14, 15, 1, 'Never'),
(15, 15, 2, 'Sometimes');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `quiz_id` int DEFAULT NULL,
  `answer` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `question_id`, `quiz_id`, `answer`) VALUES
(413, 14, 95, 14, ''),
(414, 14, 96, 14, 'a'),
(415, 14, 97, 14, ''),
(416, 14, 98, 14, 'a'),
(417, 14, 99, 14, ''),
(418, 14, 100, 14, ''),
(419, 14, 101, 14, ''),
(420, 14, 102, 14, ''),
(421, 14, 103, 14, ''),
(422, 14, 104, 14, 'a'),
(423, 14, 105, 14, ''),
(424, 14, 106, 14, 'a'),
(425, 14, 107, 14, 'a'),
(426, 14, 108, 14, 'a'),
(427, 14, 109, 14, 'a'),
(428, 14, 110, 14, 'a'),
(429, 14, 111, 14, ''),
(430, 14, 112, 14, 'a'),
(431, 14, 113, 14, 'a'),
(432, 14, 114, 14, 'a'),
(433, 14, 115, 14, 'a'),
(434, 14, 116, 14, ''),
(435, 14, 117, 14, ''),
(436, 14, 118, 14, ''),
(437, 14, 119, 14, ''),
(438, 14, 120, 14, ''),
(439, 14, 121, 14, 'a'),
(440, 14, 122, 14, 'a'),
(441, 14, 123, 14, 'a'),
(442, 14, 124, 14, ''),
(443, 14, 125, 14, ''),
(444, 14, 126, 14, 'a'),
(445, 14, 127, 14, ''),
(446, 14, 128, 14, 'a'),
(447, 14, 129, 14, 'a'),
(448, 14, 130, 14, ''),
(449, 14, 131, 14, 'a'),
(450, 14, 132, 14, ''),
(451, 14, 133, 14, ''),
(452, 14, 134, 14, 'a'),
(453, 14, 50, 10, 'a'),
(454, 14, 51, 10, 'c'),
(455, 14, 52, 10, 'c'),
(456, 14, 53, 10, 'a'),
(457, 14, 54, 10, 'd'),
(458, 14, 8, 5, 'b'),
(459, 14, 9, 5, 'c'),
(470, 14, 10, 6, 'c'),
(471, 14, 11, 6, 'c'),
(472, 14, 12, 6, 'a'),
(473, 14, 13, 6, 'b'),
(474, 14, 14, 6, 'b'),
(475, 14, 15, 6, 'b'),
(476, 14, 16, 6, 'b'),
(477, 14, 17, 6, 'b'),
(478, 14, 18, 6, 'b'),
(479, 14, 19, 6, 'c');

-- --------------------------------------------------------

--
-- Table structure for table `user_score`
--

CREATE TABLE `user_score` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `quiz_id` int DEFAULT NULL,
  `score` int DEFAULT NULL,
  `correct_answers` int DEFAULT NULL,
  `wrong_answers` int DEFAULT NULL,
  `dates` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_score`
--

INSERT INTO `user_score` (`id`, `user_id`, `quiz_id`, `score`, `correct_answers`, `wrong_answers`, `dates`) VALUES
(16, 1, 4, 2, 2, 2, NULL),
(30, 14, 4, 4, 4, 0, '2024-09-24 16:00:00'),
(32, 16, 0, 0, 0, 0, '2024-09-25 16:00:00'),
(33, 16, 5, 0, 0, 2, '2024-09-25 16:00:00'),
(40, 14, 14, 4, 4, 36, '2024-09-25 16:00:00'),
(41, 14, 10, 1, 1, 4, '2024-09-26 16:00:00'),
(42, 14, 5, 0, 0, 2, '2024-09-26 16:00:00'),
(44, 14, 6, 7, 7, 3, '2024-09-26 16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicant_profile`
--
ALTER TABLE `applicant_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `job_posting_id` (`job_posting_id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_documents`
--
ALTER TABLE `employer_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_doc_id` (`user_id`);

--
-- Indexes for table `employer_profile`
--
ALTER TABLE `employer_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employerid` (`user_id`);

--
-- Indexes for table `empyers`
--
ALTER TABLE `empyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`j_id`),
  ADD KEY `employer_job_id` (`employer_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_content`
--
ALTER TABLE `module_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_name`
--
ALTER TABLE `quiz_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_form`
--
ALTER TABLE `survey_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_reponse`
--
ALTER TABLE `survey_reponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_score`
--
ALTER TABLE `user_score`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applicant_profile`
--
ALTER TABLE `applicant_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employer_documents`
--
ALTER TABLE `employer_documents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employer_profile`
--
ALTER TABLE `employer_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `empyers`
--
ALTER TABLE `empyers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `interview`
--
ALTER TABLE `interview`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `j_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `module_content`
--
ALTER TABLE `module_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `quiz_name`
--
ALTER TABLE `quiz_name`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_form`
--
ALTER TABLE `survey_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey_reponse`
--
ALTER TABLE `survey_reponse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `user_score`
--
ALTER TABLE `user_score`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
