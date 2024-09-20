-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 06:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `username`, `password`, `email`, `admin_level`) VALUES
(1, 'Admin', '$2y$10$szZWza9fsLiGXs4evidE7.uc3zwFoQjs/hfwGvw2Vd6lddYLzBuTW', 'mercadomarklawrence55@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_profile`
--

CREATE TABLE `applicant_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `specialization` varchar(255) NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed') DEFAULT NULL,
  `contact_no` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT 'user.png',
  `house_address` varchar(255) NOT NULL,
  `sss_no` varchar(20) DEFAULT NULL,
  `pagibig_no` varchar(20) DEFAULT NULL,
  `philhealth_no` varchar(20) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `immigration_status` enum('Documented','Undocumented','Returning','Repatriated') NOT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `spouse_contact` varchar(15) DEFAULT NULL,
  `fathers_name` varchar(100) DEFAULT NULL,
  `fathers_address` varchar(255) DEFAULT NULL,
  `mothers_name` varchar(100) DEFAULT NULL,
  `mothers_address` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `next_of_kin_relationship` varchar(50) DEFAULT NULL,
  `next_of_kin_contact` varchar(15) DEFAULT NULL,
  `education_level` enum('Elementary Undergraduate','Elementary Graduate','High School Undergraduate','High School Graduate','College Undergraduate','College Graduate','Vocational') DEFAULT NULL,
  `occupation` enum('Administrative Work','Medical Work','Factory/Manufacturing','Farmers (Agriculture)','Teaching','Information Technology','Engineering','Restaurant Jobs (F&B)','Seaman (Sea-Based)','Household Service Worker (Domestic Helper)','Construction Work','Entertainment','Tourism Sector','Hospitality Sector','Others') DEFAULT NULL,
  `prefix` enum('Sr.','Jr.','II','III','IV','V','VI','VII') NOT NULL,
  `emergency_contact_num` int(100) NOT NULL,
  `income` int(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `employment_type` varchar(100) NOT NULL,
  `employment_form` enum('Recruitment Agency','Government Hire','Name Hire','Referral') NOT NULL,
  `employer_name` varchar(100) NOT NULL,
  `contact_number` int(100) NOT NULL,
  `employer_address` varchar(100) NOT NULL,
  `local_agency_name` varchar(100) NOT NULL,
  `local_agency_address` varchar(100) NOT NULL,
  `arrival_date` date NOT NULL,
  `dept_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant_profile`
--

INSERT INTO `applicant_profile` (`id`, `user_id`, `email`, `first_name`, `last_name`, `middle_name`, `dob`, `age`, `specialization`, `sex`, `civil_status`, `contact_no`, `photo`, `house_address`, `sss_no`, `pagibig_no`, `philhealth_no`, `passport_no`, `immigration_status`, `spouse_name`, `spouse_contact`, `fathers_name`, `fathers_address`, `mothers_name`, `mothers_address`, `emergency_contact_name`, `next_of_kin_relationship`, `next_of_kin_contact`, `education_level`, `occupation`, `prefix`, `emergency_contact_num`, `income`, `country`, `employment_type`, `employment_form`, `employer_name`, `contact_number`, `employer_address`, `local_agency_name`, `local_agency_address`, `arrival_date`, `dept_date`) VALUES
(1, 13, 'marklawrencemercado8@gmail.com', 'Mark Lawrence', 'Mercado', 'Aranda', '2002-07-23', 22, '', 'male', 'Single', 2147483647, 'user.png', '398, Malinta Los Banos, Laguna', '0', '0', '0', '0', 'Undocumented', 'Adaw', '435323423', 'mama', '323543425', 'fafa', '5345345345', 'fama', 'child', '2232435432', 'College Undergraduate', 'Engineering', 'II', 21435364, 14000, 'Philippines', 'Land-Based', 'Government Hire', 'wsefrews', 2147483647, '342sdcdfgs Streets', 'asfdgdfgdf', 'sdawdsdfsd', '2024-12-18', '2024-10-09'),
(2, 14, 'marklawrencemercado8@gmail.com', 'Mark Lawrence', 'Mercado', 'Aranda', '2002-07-23', 22, '', 'female', 'Widowed', 2147483647, 'user.png', '398, Malinta Los Banos, Laguna', '0', '0', '0', '0', 'Undocumented', '', '', '', '', '', '', NULL, NULL, NULL, 'Vocational', 'Factory/Manufacturing', '', 0, 0, 'Philippines', 'Sea-Based', 'Recruitment Agency', 'wsefrews', 0, '342sdcdfgs Streets', 'asfdgdfgdf', 'sdawdsdfsd', '2024-10-12', '2024-10-01'),
(3, 15, 'marklawrencemercado8@gmail.com', 'Batbat', 'mercado', 'aranda', '2002-06-11', 22, '', 'male', 'Single', 0, 'user.png', '9783 baysdgdfgser', '0', '0', '0', '0', 'Documented', '', '', '', '', '', '', NULL, NULL, NULL, 'High School Graduate', 'Medical Work', 'Sr.', 0, 0, 'Philippines', 'Land-Based', 'Name Hire', 'fdgsd', 0, 'gtry45gdfg4e', 'Batbat aranda mercado', 'e4tdfge5t4e', '2024-11-21', '2024-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `job_posting_id` int(11) DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `job` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `applicant_id`, `job_posting_id`, `application_date`, `status`, `job`) VALUES
(1, 1, 1, NULL, 'accepted', 'Laborer'),
(2, 1, 2, NULL, 'accepted', 'Programmer'),
(3, 1, 1, NULL, 'pending', 'Laborer');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('filed','in_review','resolved') DEFAULT 'filed',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `user_id`, `title`, `description`, `file`, `status`, `created_at`) VALUES
(3, 1, 'stalking', 'following everywhere', '../uploads/LSPU-LB CCS - Participant Certificates.pdf', 'filed', '2024-09-07 07:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `module_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `description`, `module_count`) VALUES
(1, 'Dressmaking', 'sewing', 3),
(2, 'Programming', 'coding html, php, sql', 3),
(3, 'new', '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employer_documents`
--

CREATE TABLE `employer_documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_name` varchar(100) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employer_documents`
--

INSERT INTO `employer_documents` (`id`, `user_id`, `document_name`, `document_path`, `is_verified`) VALUES
(1, 1, 'asdawdawf', 'uploads/a.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employer_profile`
--

CREATE TABLE `employer_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `tel_num` varchar(255) DEFAULT NULL,
  `president` varchar(255) DEFAULT NULL,
  `HR` varchar(255) DEFAULT NULL,
  `company_mail` varchar(255) DEFAULT NULL,
  `HR_mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employer_profile`
--

INSERT INTO `employer_profile` (`id`, `user_id`, `company_name`, `company_address`, `tel_num`, `president`, `HR`, `company_mail`, `HR_mail`) VALUES
(1, 1, 'JOLLYBOYS', 'crossing kanto', '09162602288', 'JOE BIDEN', 'DUKIN TRUMPS', 'JOLLYBOYS@gmail.com', 'DUKIN TRUMPS@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `empyers`
--

CREATE TABLE `empyers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Fname` varchar(255) DEFAULT NULL,
  `Lname` varchar(255) DEFAULT NULL,
  `Bdate` varchar(255) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empyers`
--

INSERT INTO `empyers` (`id`, `username`, `password`, `email`, `Fname`, `Lname`, `Bdate`, `contact`) VALUES
(1, 'azure', '$2y$10$uuxWdsGRfcNdTON/tfERYeeWaTngF9te5DMyjQjogMAY.xuxBZOKi', 'mercadomarklawrence55@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `j_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `vacant` int(11) NOT NULL,
  `date_posted` date NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`j_id`, `employer_id`, `job_title`, `job_description`, `specialization`, `vacant`, `date_posted`, `is_active`) VALUES
(1, 1, 'Laborer', 'construction worker', '', 12, '2024-09-15', 0),
(4, 1, 'electrician', 'fix electrical', '', 50, '2024-08-30', 1),
(8, 1, 'backend dev', 'database, php, mysql', 'Information and technology', 11, '2024-09-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
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
(7, 14, 'bnye', '2024-09-19 06:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `module_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `module_name`) VALUES
(1, 1, 'measurements'),
(2, 1, 'needle & thread'),
(3, 1, 'dresses'),
(4, 3, 'new1'),
(5, 3, 'new12');

-- --------------------------------------------------------

--
-- Table structure for table `module_content`
--

CREATE TABLE `module_content` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `modules_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_content`
--

INSERT INTO `module_content` (`id`, `description`, `video`, `file_path`, `modules_id`) VALUES
(1, 'learning correct measurements', 'https://www.youtube.com/watch?v=Qxo2ToDM-uE&list=RDCLAK5uy_kmPRjHDECIcuVwnKsx2Ng7fyNgFKWNJFs&index=9', 'uploads/1.jpg', 1),
(2, 'correct needle and uses', 'https://www.youtube.com/watch?v=WvoAL44J42g', 'uploads/2.jpg', 2),
(3, 'types of dress', 'https://www.youtube.com/watch?v=z-5tJblM-WQ', 'uploads/3.jpg', 3),
(4, 'new', 'https://www.youtube.com/watch?v=ahHiepqCDK8', 'uploads/supply.pdf', 4);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `marks` int(11) DEFAULT 1
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
(9, 5, '2', '3', '4', '6', '7', 'b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_name`
--

CREATE TABLE `quiz_name` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `correct_ans` int(11) DEFAULT NULL,
  `wrong_ans` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_name`
--

INSERT INTO `quiz_name` (`id`, `module_id`, `title`, `correct_ans`, `wrong_ans`, `total`, `tag`, `date`) VALUES
(4, 1, 'Different Measurements', 1, 1, 3, 'how to measure ', '2024-09-02 13:54:06'),
(5, 4, 'New', 1, 1, 2, 'how to measure ', '2024-09-02 15:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL DEFAULT 'NOT NULL',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `email`, `username`, `password`, `token`, `is_verified`) VALUES
(13, 'marklawrencemercado8@gmail.com', 'Azure', '$2y$10$8EpYIZYPSYNGChcXfsMpTOhZ82mEeh6ZqUK4t9UszJCyDzfgmKgSS', '3b17bee68feeb18350a947d3ced7247b6461ae8fc07101635e552f2af00b6a405b24e4831a950f4207bfc36bdfb0f8aa5c35', 1),
(14, 'marklawrencemercado8@gmail.com', 'mark', '$2y$10$aGuDjBWRMUEnTw0O8/evlusGclWGzc6unMr1Qbh.uz1oOgAZDJ5rK', 'e887e669be437912dcbed8d38cd2b7392a7281a5ffcba9c497cae823146d838bdca443a11ef31a9ddd91878e4235ffa0c4e5', 1),
(15, 'marklawrencemercado8@gmail.com', 'Azure1', '$2y$10$YVy4hWWcCXqjGI1Uns6HG.XtP76PBlQu9Ai540OBIC4Rh2B28s.ea', '47733609259b9248acd3466506d91358ab4bc33618933aa38fdbc4971ca05cb49d6a8b8e21a42cffabd2593e09fc4cb2f6f1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `message_id`, `admin_id`, `reply`, `created_at`) VALUES
(1, 1, 1, 'ok', '2024-09-09 02:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `survey_form`
--

CREATE TABLE `survey_form` (
  `id` int(11) NOT NULL,
  `question` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_form`
--

INSERT INTO `survey_form` (`id`, `question`) VALUES
(1, 'workerssssss'),
(2, 'nerver');

-- --------------------------------------------------------

--
-- Table structure for table `survey_reponse`
--

CREATE TABLE `survey_reponse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `reponse` varchar(100) DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `answer` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `question_id`, `quiz_id`, `answer`) VALUES
(73, 1, 4, 4, 'a'),
(74, 1, 5, 4, 'b'),
(75, 1, 6, 4, 'c'),
(76, 1, 7, 4, 'd');

-- --------------------------------------------------------

--
-- Table structure for table `user_score`
--

CREATE TABLE `user_score` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `correct_answers` int(11) DEFAULT NULL,
  `wrong_answers` int(11) DEFAULT NULL,
  `dates` timestamp NULL DEFAULT NULL,
  `ranks` int(11) DEFAULT NULL,
  `retake_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_score`
--

INSERT INTO `user_score` (`id`, `user_id`, `quiz_id`, `score`, `correct_answers`, `wrong_answers`, `dates`, `ranks`, `retake_count`) VALUES
(16, 1, 4, 2, 2, 2, NULL, NULL, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicant_profile`
--
ALTER TABLE `applicant_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employer_documents`
--
ALTER TABLE `employer_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employer_profile`
--
ALTER TABLE `employer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `empyers`
--
ALTER TABLE `empyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `j_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `module_content`
--
ALTER TABLE `module_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz_name`
--
ALTER TABLE `quiz_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survey_form`
--
ALTER TABLE `survey_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_reponse`
--
ALTER TABLE `survey_reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_score`
--
ALTER TABLE `user_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
