-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2026 at 05:55 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobmatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int NOT NULL,
  `members_id` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `requirements` text NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `poster_dir` varchar(255) DEFAULT NULL,
  `deadlines` date NOT NULL,
  `status` int NOT NULL DEFAULT '3',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `members_id`, `location`, `job_type`, `title`, `description`, `category`, `salary`, `requirements`, `poster`, `poster_dir`, `deadlines`, `status`, `created`, `modified`) VALUES
(8, 17, 'UiTM Puncak Alam, Selangor', 'Full Time', 'HR Executive', 'Manage recruitment, employee relations and staff welfare to build a productive and positive workplace.', 'Human Resource', 4500.00, 'Bachelor\'s degree in Human Resource or related field. Good communication and interpersonal skills.', 'hre.png', 'uploads/posters/', '2026-08-01', 1, '2026-07-04 13:48:20', '2026-07-04 15:25:25'),
(9, 17, 'UiTM Rembau', 'Full Time', 'Finance Officer', 'Oversee daily accounting, budgeting and financial reporting to keep the organisation financially healthy.', 'Finance', 4800.00, 'Degree in Accounting or Finance. \r\nProficient in accounting software and Excel.', '1783189040_fo.png', 'uploads/posters/', '2026-08-07', 1, '2026-07-04 13:49:47', '2026-07-04 18:17:20'),
(10, 17, 'UiTM Shah Alam', 'Full Time', 'Marketing Executive', 'Plan and run marketing campaigns across digital and print channels to grow brand awareness.', 'Marketing', 4200.00, 'Degree in Marketing or Mass Communication. \r\nCreative and familiar with social media tools.', '1783189077_me.png', 'uploads/posters/', '2026-08-08', 1, '2026-07-04 13:51:24', '2026-07-04 18:17:57'),
(11, 17, 'Uitm Merbok', 'Full Time', 'IT Support Officer', 'Provide technical support and maintain systems, networks and hardware for smooth daily operations.', 'Information Technology', 4200.00, 'Diploma or Degree in IT/Computer Science. \r\nKnowledge of networks and troubleshooting.\r\n\r\n', '1783189104_itsa.png', 'uploads/posters/', '2026-08-08', 1, '2026-07-04 14:19:05', '2026-07-04 18:18:24'),
(12, 17, 'Uitm Segamat', 'Full Time', 'Admin Assistant', ' Support daily office operations, documentation and scheduling to keep the team organised.', 'Administration', 2800.00, 'SPM or Diploma. \r\nOrganised, detail-oriented, and proficient in Microsoft Office.', '1783238705_a.a.png', 'uploads/posters/', '2026-08-14', 1, '2026-07-04 14:20:20', '2026-07-05 08:05:05'),
(13, 17, 'Uitm Samarahan', 'Full Time', 'Graphic Designer', 'Create engaging visual content and branding materials for both digital and print media.', 'Creative & Design ', 3800.00, 'Degree/Diploma in Design. \r\nSkilled in Adobe Photoshop, Illustrator, and InDesign.', '1783238830_gd.png', 'uploads/posters/', '2027-01-08', 1, '2026-07-04 14:39:00', '2026-07-05 08:07:10'),
(14, 17, 'UiTM Puncak Alam', 'Full Time', 'Customer Service Officer ', 'Assist customers with inquiries and provide friendly, timely support to ensure satisfaction.', 'Customer Service', 2900.00, 'SPM or Diploma. \r\nPatient, good communication, and a customer-first attitude.', '1783238855_cso.png', 'uploads/posters/', '2026-12-05', 1, '2026-07-04 14:40:16', '2026-07-05 08:07:35'),
(15, 17, 'UiTM Rembau', 'Full Time', 'Software Developer', 'Design, build and maintain web applications and systems that meet business needs.', 'Software Engineering ', 6000.00, 'Degree in Computer Science. \r\nExperience with PHP, JavaScript, and databases.', '1783238888_sd.png', 'uploads/posters/', '2026-11-28', 1, '2026-07-04 14:41:12', '2026-07-05 08:08:08'),
(16, 17, 'Cafe NR, UiTM Segamat', 'Part Time', ' Barista', 'Prepare beverages and serve customers with a smile in a fast-paced cafe setting.', 'Food & Beverage', 1800.00, 'No experience needed. Friendly, energetic, and willing to learn.', '1783238909_barista.png', 'uploads/posters/', '2027-03-10', 1, '2026-07-04 14:42:34', '2026-07-05 08:08:29'),
(17, 17, 'UiTM Jasin,Melaka', 'Part Time', 'Data Entry Clerk', 'Enter and update records accurately to support smooth office operations.', 'Administration', 1800.00, 'Basic computer skills. Fast and accurate typing.', '1783238927_dec.png', 'uploads/posters/', '2027-03-12', 1, '2026-07-04 15:11:25', '2026-07-05 08:08:47'),
(18, 17, 'UiTM Bandaraya Melaka', 'Part Time', 'Event Promoter', 'Promote products and engage the crowd at events, roadshows and campaigns.', 'Events & Promotion', 1800.00, 'Outgoing personality. Comfortable speaking to the public.', '1783240157_parttime_4.png', 'uploads/posters/', '2027-11-17', 1, '2026-07-04 15:12:28', '2026-07-05 08:29:17'),
(19, 17, 'UiTM Raub', 'Part Time', 'Part-Time Tutor', 'Guide students and prepare simple materials to help them learn and improve.', 'Education', 2000.00, 'Strong in the subject taught. \r\nPatient and good at explaining.', '1783239012_ptt.png', 'uploads/posters/', '2026-10-17', 1, '2026-07-04 15:14:21', '2026-07-05 08:10:12'),
(20, 17, 'UiTM Kuala Pilah', 'Part Time', 'Social Media Assistant', 'Create simple posts and manage content to grow the brand online.', 'Marketing', 1600.00, 'Familiar with Instagram, TikTok, and Facebook. \r\nCreative mindset.', '1783239029_sme.png', 'uploads/posters/', '2026-10-10', 1, '2026-07-04 15:15:25', '2026-07-05 08:10:29'),
(21, 17, 'Cafe Jasmine, UiTM Puncak Perdana', 'Part Time', 'Barista', 'Prepare beverages and serve customers with a smile in a fast-paced cafe setting.', 'Food & Beverage', 1200.00, 'No experience needed. Friendly, energetic, and willing to learn.', '1783239047_barista.png', 'uploads/posters/', '2027-06-12', 1, '2026-07-04 15:20:19', '2026-07-05 08:10:47'),
(26, 17, 'Uitm Segamat', 'Full Time', 'System Analyst', 'Business Translation: Translating non-technical business needs into precise technical specifications for software developers.\r\nSystem Evaluation: Researching emerging technologies and performing cost-benefit analyses for system upgrades.\r\nSystem Design: Designing, configuring, and testing new hardware and software systems.\r\nSupport & Training: Troubleshooting issues and training end-users on how to operate new systems', 'Information Technology', 4200.00, 'Bachelor\'s Degree in Computer Science or IT, 3–5+ years of experience, and strong knowledge in System Development Life Cycle (SDLC), SQL/databases, and process mapping (UML/BPMN)', '1783871732_system_analyst.png', 'uploads/posters/', '2026-09-23', 1, '2026-07-12 15:55:32', '2026-07-12 15:55:32'),
(27, 17, 'Uitm Segamat', 'Full Time', 'Statistician', 'Study Design: Plan and design experiments, surveys, clinical trials, or opinion polls to gather reliable data.\r\nData Validation: Clean datasets, check for biases or errors, and ensure data integrity prior to analysis.\r\nData Analysis: Apply advanced mathematical theories, regression analysis, and statistical tests to extract meaningful patterns and test hypotheses.\r\nPredictive Modeling: Build forecasting models and risk evaluation tools to simulate scenarios and predict future trends.\r\nReporting: Summarize findings and deliver clear visual reports, charts, and presentations to technical and non-technical stakeholders', 'Economy', 4300.00, 'Minimum Bachelor’s degree in Statistics, Mathematics, or related quantitative fields. ', '1783871911_statistician.png', 'uploads/posters/', '2026-10-21', 1, '2026-07-12 15:58:31', '2026-07-12 15:58:31'),
(28, 17, 'UiTM Raub', 'Full Time', 'Data Analyst', 'Data Extraction & Cleaning: Query databases (SQL) and process raw information to ensure accuracy, consistency, and usability.\r\nAnalysis & Modeling: Apply statistical methods to evaluate trends, find root causes (Diagnostic), summarize performance (Descriptive), or forecast outcomes (Predictive).\r\nReporting & Visualization: Build interactive dashboards (e.g., Tableau, Power BI) to make complex metrics easily understandable for management.\r\nStakeholder Collaboration: Work with business leaders to define goals, determine KPI (Key Performance Indicators) requirements, and present actionable recommendations.', 'Information Technology', 4000.00, 'SQL: Essential for extracting, filtering, and joining data directly from databases.\r\nExcel: The foundational tool for data cleaning, pivot tables, and basic formulas.\r\nData Visualization: The ability to build clear, actionable dashboards using Tableau or Microsoft Power BI.\r\nProgramming Languages: Proficiency in Python or R is often required for advanced data manipulation and statistical modeling.\r\nStatistics: A solid grasp of descriptive statistics, probability, and hypothesis testing', '1783872109_data_analyst.png', 'uploads/posters/', '2026-09-22', 1, '2026-07-12 16:01:49', '2026-07-12 16:01:49'),
(30, 17, 'Selangor', 'Full Time', 'Business Analyst', 'Requirements Gathering: Conduct interviews, workshops, and surveys to understand stakeholder objectives and document clear functional specifications.', 'IT', 4500.00, 'A Bachelor’s degree in Business Administration, Information Technology, Finance, or Computer Science is standard.', '1783961394_business_analyst.png', 'uploads/posters/', '2026-10-24', 1, '2026-07-13 16:49:54', '2026-07-13 16:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int NOT NULL,
  `members_id` int NOT NULL,
  `advertisement_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '3',
  `offer_letter` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `members_id`, `advertisement_id`, `status`, `offer_letter`, `created`, `modified`) VALUES
(11, 20, 15, 0, NULL, '2026-07-11 14:22:36', '2026-07-11 14:22:36'),
(12, 27, 10, 0, NULL, '2026-07-12 15:36:42', '2026-07-12 15:36:42'),
(13, 27, 20, 0, NULL, '2026-07-12 15:36:57', '2026-07-12 15:36:57'),
(14, 27, 18, 0, NULL, '2026-07-12 15:37:12', '2026-07-12 15:37:12'),
(15, 27, 13, 0, NULL, '2026-07-12 15:37:29', '2026-07-12 15:37:29'),
(16, 20, 11, 0, NULL, '2026-07-12 15:38:39', '2026-07-12 15:38:39'),
(17, 20, 17, 1, 'To      : Nik Nur Aliyah\r\nFrom    : Human Resource Department, JobMatch\r\nDate    : 15 July 2026\r\nSubject : Offer of Employment — DATA ENTRY CLERK\r\n\r\nDear Nik Nur Aliyah,\r\n\r\nI am pleased to inform you, on behalf of JobMatch, that following the review of your application, qualifications, and interview, you have been selected for the position of Data Entry Clerk. We were impressed with your background and are confident that you will be a valuable addition to our team.\r\n\r\nThis letter serves as a formal offer of employment. The key details of your appointment are as follows:\r\n\r\n   1. Position          : Data Entry Clerk\r\n   2. Employment Type    : Part Time\r\n   3. Reporting To       : Head of Department\r\n   4. Commencement Date  : To be mutually agreed upon\r\n   5. Remuneration       : As stated in your employment contract\r\n\r\nWe would be grateful if you could confirm your acceptance of this offer in writing at your earliest convenience.\r\n\r\nWe look forward to welcoming you to JobMatch.\r\n\r\nYours sincerely,\r\n\r\n\r\n_______________________\r\nHuman Resource Department\r\nJobMatch\r\nConnect · Match · Succeed', '2026-07-12 15:38:53', '2026-07-15 08:04:16'),
(18, 22, 15, 2, NULL, '2026-07-12 15:39:36', '2026-07-13 16:50:48'),
(19, 22, 11, 0, NULL, '2026-07-12 15:39:48', '2026-07-12 15:39:48'),
(20, 23, 9, 0, NULL, '2026-07-12 15:40:39', '2026-07-12 15:40:39'),
(21, 23, 17, 2, NULL, '2026-07-12 15:40:48', '2026-07-15 08:04:05'),
(22, 25, 8, 0, NULL, '2026-07-12 15:42:31', '2026-07-12 15:42:31'),
(23, 25, 12, 0, NULL, '2026-07-12 15:42:49', '2026-07-12 15:42:49'),
(24, 20, 28, 0, NULL, '2026-07-13 07:36:35', '2026-07-13 07:36:35'),
(25, 29, 20, 0, NULL, '2026-07-13 16:13:13', '2026-07-13 16:13:13'),
(26, 29, 18, 0, NULL, '2026-07-13 16:13:32', '2026-07-13 16:13:32'),
(27, 29, 13, 0, NULL, '2026-07-13 16:13:48', '2026-07-13 16:13:48'),
(28, 29, 10, 0, NULL, '2026-07-13 16:14:25', '2026-07-13 16:14:25'),
(29, 24, 17, 1, 'To      : Nurul Syazwina Binti Shoib\r\nFrom    : Human Resource Department, JobMatch\r\nDate    : 15 July 2026\r\nSubject : Offer of Employment — DATA ENTRY CLERK\r\n\r\nDear Nurul Syazwina Binti Shoib,\r\n\r\nI am pleased to inform you, on behalf of JobMatch, that following the review of your application, qualifications, and interview, you have been selected for the position of Data Entry Clerk. We were impressed with your background and are confident that you will be a valuable addition to our team.\r\n\r\nThis letter serves as a formal offer of employment. The key details of your appointment are as follows:\r\n\r\n   1. Position          : Data Entry Clerk\r\n   2. Employment Type    : Part Time\r\n   3. Reporting To       : Head of Department\r\n   4. Commencement Date  : To be mutually agreed upon\r\n   5. Remuneration       : As stated in your employment contract\r\n\r\nWe would be grateful if you could confirm your acceptance of this offer in writing at your earliest convenience.\r\n\r\nWe look forward to welcoming you to JobMatch.\r\n\r\nYours sincerely,\r\n\r\n\r\n_______________________\r\nHuman Resource Department\r\nJobMatch\r\nConnect · Match · Succeed', '2026-07-13 16:18:36', '2026-07-15 08:04:48'),
(30, 24, 14, 0, NULL, '2026-07-13 16:18:47', '2026-07-13 16:18:47'),
(31, 24, 12, 0, NULL, '2026-07-13 16:18:59', '2026-07-13 16:18:59'),
(32, 24, 11, 0, NULL, '2026-07-13 16:19:17', '2026-07-13 16:19:17'),
(33, 30, 26, 0, NULL, '2026-07-13 16:44:40', '2026-07-13 16:44:40'),
(34, 30, 15, 0, NULL, '2026-07-13 16:45:06', '2026-07-13 16:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int UNSIGNED NOT NULL,
  `transaction` char(36) NOT NULL,
  `type` varchar(7) NOT NULL,
  `primary_key` int UNSIGNED DEFAULT NULL,
  `source` varchar(255) NOT NULL,
  `parent_source` varchar(255) DEFAULT NULL,
  `original` mediumtext,
  `changed` mediumtext,
  `meta` mediumtext,
  `status` int NOT NULL DEFAULT '1',
  `slug` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `transaction`, `type`, `primary_key`, `source`, `parent_source`, `original`, `changed`, `meta`, `status`, `slug`, `created`) VALUES
(8, 'a4711ac4-ba92-4609-9bcb-405d086d7cd8', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-04 19:11:19'),
(9, 'c92a5380-66f6-4bdc-9dfb-f1f035307559', 'create', 25, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"sss\"}', 1, 'Admin', '2026-07-04 19:14:47'),
(10, 'e88c46f8-42b7-4340-9c04-c39e5d5eacc1', 'delete', 25, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"sss\"}', 1, 'Admin', '2026-07-04 19:15:08'),
(11, 'f41f0f4a-e615-450b-8e0e-8e80d92a139a', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 02:29:06'),
(12, '61d5a938-2d14-4113-a286-7a8af99f7437', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin\"}', 1, 'Admin', '2026-07-05 07:02:40'),
(13, '3057968a-9022-430c-aa55-96832341a7ee', 'update', 17, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Aisyah Maisarah\"}', 1, 'Admin', '2026-07-05 07:02:41'),
(14, '7e549508-785e-4ced-b2be-d696b40ca75a', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-05 07:43:27'),
(15, '5766cd5a-30b4-49ce-9472-19771f15769d', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-05 07:43:29'),
(16, 'ead4db5c-147d-474f-8730-6b8ab6300ce3', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 07:49:49'),
(17, '5768e184-ddcf-4a05-a3e6-8514360d9cf9', 'update', 12, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin Assistant\"}', 1, 'Admin', '2026-07-05 08:05:05'),
(18, '73fdad9b-dd20-4da7-93be-876eef22312a', 'update', 13, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Graphic Designer\"}', 1, 'Admin', '2026-07-05 08:07:10'),
(19, 'a76f1666-3bf0-42a1-b92d-2e7ba981c187', 'update', 14, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Customer Service Officer \"}', 1, 'Admin', '2026-07-05 08:07:35'),
(20, 'c6436829-ef54-4648-8968-0eab68625dab', 'update', 15, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Software Developer\"}', 1, 'Admin', '2026-07-05 08:08:08'),
(21, '985ba181-a7ea-457e-9604-303a8c38501b', 'update', 16, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\" Barista\"}', 1, 'Admin', '2026-07-05 08:08:29'),
(22, '3c74befa-e2d6-48f3-992b-5c5f5606ec5d', 'update', 17, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Data Entry Clerk\"}', 1, 'Admin', '2026-07-05 08:08:47'),
(23, '10b200e4-76d0-467b-b491-b6b8795466cd', 'update', 19, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Part-Time Tutor\"}', 1, 'Admin', '2026-07-05 08:10:12'),
(24, '8cb23dff-a674-450d-8836-6ef8d90d18fa', 'update', 20, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Social Media Assistant\"}', 1, 'Admin', '2026-07-05 08:10:29'),
(25, '960f9b7f-e1e7-4540-88f6-d79f090852c3', 'update', 21, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Barista\"}', 1, 'Admin', '2026-07-05 08:10:47'),
(26, '1f51a6fe-7ce6-40e3-9662-4a95272e476c', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin\"}', 1, 'Admin', '2026-07-05 08:28:39'),
(27, '8a47fec5-7382-4d10-a7df-e9b4a8ae218b', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin\"}', 1, 'Admin', '2026-07-05 08:28:42'),
(28, '0248797b-52bb-44db-b9fa-34003478809e', 'update', 18, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Event Promoter\"}', 1, 'Admin', '2026-07-05 08:29:18'),
(29, 'd58da19a-742a-4455-bdbf-54b3d910d386', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin\"}', 1, 'Admin', '2026-07-05 11:17:11'),
(30, '1fc3cbfd-1914-4698-838f-95f27afdc926', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-05 11:21:38'),
(31, 'de403695-03c5-4e12-8eb9-8853cbe5d642', 'update', 18, 'members', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-05 11:22:36'),
(32, 'dcd1865f-6e53-49bf-80d0-eebea60b756f', 'update', 18, 'members', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-05 16:17:07'),
(33, '79b64b4d-3637-43ec-a446-d3dea1422458', 'create', 2, 'applications', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"2\"}', 1, 'saleha', '2026-07-05 16:17:07'),
(34, '93cfe84b-b79d-4cc7-a12b-7d144aed0ad0', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 16:17:38'),
(35, '8e6575db-20db-4c40-a0ca-e7ffe1f7188e', 'update', 2, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"2\"}', 1, 'Admin', '2026-07-05 16:17:57'),
(36, 'c6d67a2c-66b9-4cf9-a166-38154d72b3ff', 'update', 2, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"2\"}', 1, 'Admin', '2026-07-05 16:30:50'),
(37, 'ae7a7205-cb79-4c6f-997b-ab5f712fc67a', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-05 16:31:05'),
(38, 'b165db58-7a2d-4ba8-9193-a72addd0487e', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 17:10:28'),
(39, '0150f159-4c2f-4e54-868f-7990036a80b0', 'update', 2, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"2\"}', 1, 'Admin', '2026-07-05 17:11:18'),
(40, '1d34d6d9-c3b7-4f07-91d1-bdabf90946fc', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-05 17:11:46'),
(41, '7e272cce-690e-4eb4-b01f-1941b2b50ca3', 'update', 18, 'members', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-05 17:18:33'),
(42, 'b3c6ec0c-ac4b-48e3-b368-5b8f9f2c4373', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-05 17:18:48'),
(43, '474b859a-08a8-4225-87a2-82c7262ea771', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 17:19:01'),
(44, '420736c5-fa51-4bc5-b046-8aa8d51ee3f2', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 17:32:05'),
(45, '70603537-9b98-4e6d-9235-c4d7cae99a87', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 17:38:53'),
(46, 'a16cebff-1409-458e-8e8a-633debf7ae97', 'update', 17, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Aisyah Maisarah\"}', 1, 'Admin', '2026-07-05 17:39:02'),
(47, '22660ad6-4ab3-49e2-867b-3172ae026921', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-05 17:39:32'),
(48, 'aef1c4d4-f508-4099-828c-c628ab37010f', 'update', 18, 'members', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-05 17:39:45'),
(49, '0d2a48dc-1b5b-403e-be55-7dda3388d30b', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-05 17:39:59'),
(50, '671ee921-d731-42c8-af42-b0d526c9f95c', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-06 13:08:06'),
(51, '3c009791-81b1-4634-b8b0-3de1b94b2812', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-06 13:15:37'),
(52, '00d3fdfc-9322-4a28-bafe-11fb73f6d8a3', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-08 12:13:03'),
(53, '590b78bf-e5f0-482a-afd4-6ac3951c8aab', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-08 12:13:42'),
(54, 'e100d331-fde2-476a-bd13-cab547710222', 'update', 18, 'members', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-08 12:14:30'),
(55, '222664b8-a081-47d7-adc2-f2393401e299', 'create', 3, 'applications', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"3\"}', 1, 'saleha', '2026-07-08 12:14:30'),
(56, 'ac8c33f9-92c6-4db2-b3e9-c0b2fa3dffc3', 'update', 18, 'members', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-08 12:17:21'),
(57, '0a25eac3-115f-486e-b308-32be545dee88', 'create', 4, 'applications', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"4\"}', 1, 'saleha', '2026-07-08 12:17:21'),
(58, '3d310906-e390-42ef-9bf4-90650d02b754', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-08 12:25:41'),
(59, '13f4ac76-95f2-4a3f-889b-75f9590af095', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-08 12:35:21'),
(60, 'f089f8e8-a0f4-4556-b6a6-a287e3240a1d', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-08 12:35:52'),
(61, '73c05358-31d8-4f0b-ab63-ce82315ea408', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-08 13:06:41'),
(62, 'bb8aba5b-242d-431c-a031-0eb5ad6e37f3', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-08 13:07:25'),
(63, 'e9731201-a9b5-4cff-b813-afd2ab33dd58', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-08 13:07:27'),
(64, '360728f1-012b-4056-bd7f-d0b1a09cfd92', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-08 13:12:51'),
(65, '1b214dcf-ee8b-44d2-9ff3-453564632a6c', 'update', 3, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"3\"}', 1, 'Admin', '2026-07-08 13:13:07'),
(66, '1ddeebf4-42e7-4300-be30-52a7864afd78', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-09 07:08:58'),
(67, '2267edd7-4ffc-4b1e-a9ca-44ef1bac98f8', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-09 07:10:49'),
(68, '8efe4021-e0bd-424d-91db-84b9dff3b374', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-09 07:26:11'),
(69, 'c4870f31-8b69-4b03-bb8b-776d49e5316e', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-09 09:18:09'),
(70, '6529281c-0637-4931-99a3-d4e16f1bf1c5', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-09 14:11:16'),
(71, 'bbfa4373-a771-4648-9789-2d28fe1b0260', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-09 14:12:16'),
(72, 'be537cc6-2563-4396-81cd-ab7b9819c489', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-09 14:12:19'),
(73, '772212c4-c0c0-4d94-aea9-abfbd1f79b9c', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-09 14:28:14'),
(74, 'a5aae24e-d7fe-4724-b40b-de5cdd4176fb', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 03:56:18'),
(75, '3a045678-0114-4659-a9b7-30755fc6c57d', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 03:56:50'),
(76, 'e35c1178-8022-40df-acb3-b168d9dcadef', 'create', 5, 'applications', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"5\"}', 1, 'saleha', '2026-07-10 03:57:06'),
(77, '58026e29-5027-4f98-b1a5-79295bed5293', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 03:57:19'),
(78, '96813bf1-9a2b-4777-883b-53da253bb41e', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:02:03'),
(79, '4902de09-1a01-4164-ae6b-7cb98fb29b42', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:12:48'),
(80, '3dd77d9f-3384-45dc-9e36-59f0719f94ee', 'create', 2, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 04:13:29'),
(81, '2b00137c-a476-4c2e-9dfc-40632d911651', 'update', 1, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau meetibg room\"}', 1, 'Admin', '2026-07-10 04:14:57'),
(82, 'e44efe9c-8500-4075-af64-d33b1ade4750', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:15:23'),
(83, '6c9e8e18-d05b-4f1f-bde3-93b33695ad5d', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:32:46'),
(84, 'a87a0842-8cca-4501-92b1-ebeb0561245a', 'update', 5, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"5\"}', 1, 'Admin', '2026-07-10 04:33:14'),
(85, 'b6a9103f-9758-44fd-b83b-0e27520a6149', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:33:32'),
(86, '05a55ff5-3cf0-492d-a5fb-57d4a7f0395f', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:34:00'),
(87, 'b8c3b66b-4da1-4af9-bd0a-270f180b74f6', 'update', 2, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 04:38:08'),
(88, 'bcd564f4-6628-4a4b-99e7-c5653d7f908a', 'create', 3, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 04:47:18'),
(89, 'b9fa40b7-909f-4ea6-a2c0-f9ee56395686', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:47:49'),
(90, '56adb00b-be04-4843-9cca-a99a715a9bdb', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-10 04:47:50'),
(91, '95c029ac-cf4e-4a80-9a36-0db565b1b349', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:50:27'),
(92, '18ffbabe-5041-40ff-aa42-5d9ddb04aaa1', 'update', 3, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"3\"}', 1, 'Admin', '2026-07-10 04:50:48'),
(93, 'ea30f3ca-c60f-4587-9fea-6dbe2a4c56ee', 'update', 3, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"3\"}', 1, 'Admin', '2026-07-10 04:50:56'),
(94, '1502e99b-c197-4646-83be-6a4b8b975b32', 'update', 3, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"3\"}', 1, 'Admin', '2026-07-10 04:51:01'),
(95, 'c1e0cdd3-8052-4bcf-abaa-fcc5782485d5', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:52:25'),
(96, '97b941f1-9bb1-4989-a808-189cce581f04', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:53:01'),
(97, 'bef1d1b1-e6ca-4880-a525-17f67d8f5ed1', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:53:20'),
(98, 'b58c86de-c6fa-478f-a726-6bcb8540cc66', 'create', 6, 'applications', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"6\"}', 1, 'saleha', '2026-07-10 04:53:27'),
(99, '7cbb2d22-2ef0-4123-bbd7-9f98b4d22810', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:53:35'),
(100, '6041022f-f6be-4058-926b-7c798f6bbaa4', 'update', 6, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"6\"}', 1, 'Admin', '2026-07-10 04:54:18'),
(101, 'efacb3f5-148a-4853-ade4-25566a179dcd', 'update', 6, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"6\"}', 1, 'Admin', '2026-07-10 04:54:30'),
(102, 'c866b393-8aab-4fba-9f61-0ca4db080e1a', 'update', 6, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"6\"}', 1, 'Admin', '2026-07-10 04:54:35'),
(103, '7696b633-b171-49d8-824f-3bdf69862947', 'update', 6, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"6\"}', 1, 'Admin', '2026-07-10 04:55:04'),
(104, '43049a62-57d9-4555-9b43-d20307cc7830', 'create', 4, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 04:55:15'),
(105, '9f87286c-7950-4842-b834-7c4db01fe9c1', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 04:55:43'),
(106, 'fabec0f8-de1f-48d0-890d-818c0281f451', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"saleha\"}', 1, 'saleha', '2026-07-10 04:55:45'),
(107, 'f2675931-be6c-4a34-b239-692956cc0aa6', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 04:57:06'),
(108, 'a7954634-3250-4265-b8df-5c961198a08e', 'update', 4, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 05:00:11'),
(109, '4200b06b-c927-4058-9477-9a3d58939a2c', 'update', 6, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"6\"}', 1, 'Admin', '2026-07-10 05:00:20'),
(110, '6fcd152c-b9f3-434c-8f16-eb0b29d34922', 'update', 6, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"6\"}', 1, 'Admin', '2026-07-10 05:01:37'),
(111, 'db5e4528-d83b-4c0e-b2af-2ac27f260cd9', 'update', 3, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 05:01:54'),
(112, 'c8e34247-e207-4e5e-b04a-95cf41be0081', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 05:20:41'),
(113, 'f7212f39-c648-48f9-83ce-795649fdc184', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 05:21:41'),
(114, '0475c92c-bd50-4a86-b177-b18847026eec', 'create', 7, 'applications', '', '{}', '{}', '{\"username\":\"saleha\",\"record\":\"7\"}', 1, 'saleha', '2026-07-10 05:21:50'),
(115, '6ea8aa1b-34dd-458e-ad4e-494c8fe19613', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 05:22:00'),
(116, '0ca72255-238f-486f-88dc-42a710af1cb6', 'create', 5, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 05:22:31'),
(117, '78e1ef67-1d66-4001-9f1b-0e974093995b', 'update', 5, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-10 05:28:36'),
(118, 'd1fb590f-9db8-42bc-8dbb-d44803cbbfd1', 'update', 7, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"7\"}', 1, 'Admin', '2026-07-10 05:28:46'),
(119, '637f81c9-6fd7-4f3e-a33b-754b711dd726', 'update', 20, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"saleha\"}', 1, 'System', '2026-07-10 05:29:02'),
(120, '7465c36c-0c27-417c-be24-18b02d9f85a9', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-10 05:29:19'),
(121, '5f3deb6c-c725-495d-8886-97240e1e142b', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 13:20:54'),
(122, '5e2a9d39-6c22-465a-9418-5077c865d55b', 'update', 19, 'members', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"aliayh\"}', 1, 'aliayh', '2026-07-11 13:21:31'),
(123, '8bc6f073-de0a-4d58-9824-36aee547d12b', 'create', 8, 'applications', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"8\"}', 1, 'aliayh', '2026-07-11 13:21:31'),
(124, '2cdb83cd-f9de-4e0c-a8d8-4e2fc399e815', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 13:22:29'),
(125, '55a5208a-e425-452c-bd0f-d8eb9933fc84', 'create', 6, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-11 13:22:56'),
(126, 'ae41f08f-86e4-4114-b933-1e54c7a15aba', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 13:23:34'),
(127, '225fe23e-f9d8-456d-bfdf-1717257ac1ed', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 13:24:13'),
(128, '92554aa4-8cf7-4a78-b8eb-e3306cfbe343', 'update', 6, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-11 13:25:25'),
(129, 'a1c6a9ae-b8f9-4465-8906-e527a916ace9', 'update', 8, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"8\"}', 1, 'Admin', '2026-07-11 13:25:39'),
(130, '11fd433a-d8d6-4970-a191-f89ff3090598', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 13:26:06'),
(131, '53d4a1bd-f5e6-4b65-b49a-c2d3d4a60ace', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"aliayh\"}', 1, 'aliayh', '2026-07-11 13:26:08'),
(132, '79e7e6bf-20a6-4db6-a5e0-876effba7795', 'create', 9, 'applications', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"9\"}', 1, 'aliayh', '2026-07-11 13:57:56'),
(133, 'c1b93a7b-cd7f-4bb9-bb1f-06d49ecf0274', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 13:58:06'),
(134, 'd0f82e2a-a9a9-4c41-9603-5073875bc49f', 'create', 7, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"\"}', 1, 'Admin', '2026-07-11 13:58:20'),
(135, '8428e2e8-bf0a-42a9-a893-9302dd8ca626', 'update', 9, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"9\"}', 1, 'Admin', '2026-07-11 13:58:20'),
(136, 'a368d403-6685-41e1-bf70-1284dadbbeac', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 13:58:49'),
(137, 'bc0f5203-0b34-4511-97f9-4172e27f2fca', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"aliayh\"}', 1, 'aliayh', '2026-07-11 13:58:51'),
(138, '5298aac3-75d9-4ebc-8531-e1863e9dfad1', 'create', 10, 'applications', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"10\"}', 1, 'aliayh', '2026-07-11 13:59:27'),
(139, '968c62ba-3a28-4d24-925a-21e31c2f1eff', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 13:59:35'),
(140, 'b39c05aa-4d17-4369-b76f-1a6c0997f0ad', 'create', 8, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-11 14:00:14'),
(141, 'f1584b1a-361e-42c2-beb1-842ffe8ae654', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 14:00:32'),
(142, 'c266825a-0f63-40cc-b09d-458966a48281', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 14:00:53'),
(143, 'e7ffd0cb-234d-47bd-8bff-20b7c26d9da6', 'update', 8, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-11 14:01:21'),
(144, '83971331-5fff-4d1f-ae1d-3d47283442f6', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 14:01:40'),
(145, 'cc1e6e83-f7b2-455e-ba6c-6f6f0239090b', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 14:02:11'),
(146, 'f780499b-b258-489c-a461-5e4653506b28', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"aliayh\",\"record\":\"aliayh\"}', 1, 'aliayh', '2026-07-11 14:02:13'),
(147, 'd771ac3e-5b16-4562-b457-9dfe33362fb2', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 14:03:01'),
(148, '162594fe-a3fb-4ae8-bc30-b4d934e0354d', 'update', 10, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"10\"}', 1, 'Admin', '2026-07-11 14:03:23'),
(149, 'f0918efd-85b5-481b-97bf-e744ae655307', 'update', 21, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"aliayh\"}', 1, 'System', '2026-07-11 14:03:44'),
(150, '83f02848-a74f-4a6b-aeb7-300fa2a458dc', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 14:03:59'),
(151, '457a7f00-81d5-4e0c-b70f-fa11c6466e21', 'delete', 19, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"aliayh\"}', 1, 'Admin', '2026-07-11 14:05:00'),
(152, '24bfe239-8676-49e9-8a0e-46a7eee18f82', 'delete', 21, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"aliayh\"}', 1, 'Admin', '2026-07-11 14:05:01'),
(153, '3f887a99-e6ba-4cab-980b-087e59ba7591', 'delete', 18, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"saleha\"}', 1, 'Admin', '2026-07-11 14:05:05'),
(154, '109bbc99-81ea-4085-b26c-d9db7fe41cb9', 'delete', 20, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"saleha\"}', 1, 'Admin', '2026-07-11 14:05:05'),
(155, '0d49fbba-754c-4141-9a79-d319af09e930', 'delete', 16, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"aiman\"}', 1, 'Admin', '2026-07-11 14:05:10'),
(156, '7ecdf191-fbdd-42fe-9157-6451adfee212', 'delete', 19, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"aiman\"}', 1, 'Admin', '2026-07-11 14:05:10'),
(157, '00e56573-d50d-4cd0-95f3-fd8b8cce0d33', 'delete', 15, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"saleha\"}', 1, 'Admin', '2026-07-11 14:05:15'),
(158, '4221cd53-e87e-42c7-96ca-1013988526cd', 'delete', 18, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"saleha\"}', 1, 'Admin', '2026-07-11 14:05:15'),
(159, '47a6f3f8-06d0-4c66-94b0-fcc37da74032', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin\"}', 1, 'Admin', '2026-07-11 14:06:40'),
(160, '8fa1a67a-7d44-48b3-a756-adcecf144250', 'update', 17, 'members', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Aisyah Maisarah Binti Seliman\"}', 1, 'Admin', '2026-07-11 14:06:40'),
(161, '11cacf57-94d8-47d2-94df-ac9f78fac53d', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Admin\"}', 1, 'Admin', '2026-07-11 14:06:57'),
(162, 'fc99b383-c929-49a9-ac82-b4e3ef6e1bc0', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-11 14:19:59'),
(163, '36840260-5d98-40eb-9efa-02de151a1b42', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:20:01'),
(164, 'cccaf02a-b3bd-49d5-99d2-dbd010f7d5fb', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:21:20'),
(165, '0670f654-e828-4988-badd-0110a24da1fc', 'update', 20, 'members', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:21:20'),
(166, '5f7a14c8-9f32-4cdf-aff7-92562695cb7e', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:21:32'),
(167, 'e3a0c753-02ba-40e4-a723-3a8b4dad5161', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:21:35'),
(168, '44964dd8-d02d-4fdd-9d93-c956643ab856', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:22:05'),
(169, '5610dd8b-78d2-46ee-9764-fe92c9e825ac', 'update', 20, 'members', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:22:36'),
(170, '72df9621-5773-4edf-977d-c33793943c98', 'create', 11, 'applications', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"11\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:22:36'),
(171, '8a8cb63b-e7ab-471a-8007-91e38b486afe', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 14:22:45'),
(172, '640aef06-7e91-4aee-9c18-3bfbf99e0251', 'create', 9, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau\"}', 1, 'Admin', '2026-07-11 14:23:35'),
(173, 'f86f6b9a-da32-4930-a2fe-49d124dc4475', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-11 14:24:52'),
(174, 'e8b76d69-100c-4a09-a21c-ddd6453af259', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-11 14:34:30'),
(175, '18d89f0c-e5c6-4084-9079-b5ae483c88fa', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-11 14:34:31'),
(176, '6036af92-855e-4cc6-8dae-b01aa0a079f4', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-12 13:43:46'),
(177, '9c8f89c4-e9bf-4d99-a7f7-857ca224cadc', 'update', 24, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Farah Syazana Binti Mat Rohani\"}', 1, 'System', '2026-07-12 14:58:12'),
(178, '3cae47ed-fa31-42e2-8910-f2724eaf2dd7', 'update', 24, 'users', '', '{}', '{}', '{\"username\":\"Farah Syazana Binti Mat Rohani\",\"record\":\"Farah Syazana Binti Mat Rohani\"}', 1, 'Farah Syazana Binti Mat Rohani', '2026-07-12 15:03:14'),
(179, '3ae469fe-8b73-4b70-8300-15ac6de0f826', 'update', 22, 'members', '', '{}', '{}', '{\"username\":\"Farah Syazana Binti Mat Rohani\",\"record\":\"Farah Syazana Binti Mat Rohani\"}', 1, 'Farah Syazana Binti Mat Rohani', '2026-07-12 15:03:14'),
(180, 'c95f743d-965f-4469-b9d2-fa08e66edfde', 'update', 25, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Hawa Binti Mohd Zamri\"}', 1, 'System', '2026-07-12 15:04:42'),
(181, 'b26e77a1-14c8-49f0-95e4-1e943cfe3013', 'update', 25, 'users', '', '{}', '{}', '{\"username\":\"Hawa Binti Mohd Zamri\",\"record\":\"Hawa Binti Mohd Zamri\"}', 1, 'Hawa Binti Mohd Zamri', '2026-07-12 15:09:24'),
(182, 'd98055f9-94c9-45c4-91e6-7905631f404e', 'update', 23, 'members', '', '{}', '{}', '{\"username\":\"Hawa Binti Mohd Zamri\",\"record\":\"Hawa Binti Mohd Zamri\"}', 1, 'Hawa Binti Mohd Zamri', '2026-07-12 15:09:25'),
(183, 'a76cf224-0752-4270-8400-933ef6066e63', 'update', 26, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"NURUL SYAZWINA BINTI SHOIB\"}', 1, 'System', '2026-07-12 15:10:59'),
(184, 'fd6c282d-879f-4b6f-a819-354114ab4f57', 'update', 27, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Danial Rizqi Bin Mokhtar\"}', 1, 'System', '2026-07-12 15:16:23'),
(185, '0fb66e13-4622-4b0b-af2b-10f54d0ed159', 'update', 25, 'members', '', '{}', '{}', '{\"username\":\"Danial Rizqi Bin Mokhtar\",\"record\":\"Danial Rizqi Bin Mokhtar\"}', 1, 'Danial Rizqi Bin Mokhtar', '2026-07-12 15:18:44'),
(186, '1856fa52-a632-4cfb-bdc0-d589a6d7a53b', 'update', 29, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Marissa Adilla Binti Adib\"}', 1, 'System', '2026-07-12 15:22:29'),
(187, 'e51192a4-1b47-44fd-9fbd-9ebdb6f75a10', 'update', 27, 'members', '', '{}', '{}', '{\"username\":\"Marissa Adilla Binti Adib\",\"record\":\"Marissa Adilla Binti Adib\"}', 1, 'Marissa Adilla Binti Adib', '2026-07-12 15:22:40'),
(188, 'd012ae18-e4ea-4808-ab00-0907a5ed1bf9', 'update', 27, 'members', '', '{}', '{}', '{\"username\":\"Marissa Adilla Binti Adib\",\"record\":\"Marissa Adilla Binti Adib\"}', 1, 'Marissa Adilla Binti Adib', '2026-07-12 15:25:18'),
(189, '07cffbf7-f777-4610-b3bd-981d53e5fb18', 'create', 12, 'applications', '', '{}', '{}', '{\"username\":\"Marissa Adilla Binti Adib\",\"record\":\"12\"}', 1, 'Marissa Adilla Binti Adib', '2026-07-12 15:36:42'),
(190, '64ed90fd-a185-4583-8f7c-a60b2e9054fe', 'create', 13, 'applications', '', '{}', '{}', '{\"username\":\"Marissa Adilla Binti Adib\",\"record\":\"13\"}', 1, 'Marissa Adilla Binti Adib', '2026-07-12 15:36:57'),
(191, '3c17c994-38a7-46d6-992f-ee608f55ede4', 'create', 14, 'applications', '', '{}', '{}', '{\"username\":\"Marissa Adilla Binti Adib\",\"record\":\"14\"}', 1, 'Marissa Adilla Binti Adib', '2026-07-12 15:37:12'),
(192, '9453e8f3-c32c-4ec9-928e-501d838f6b1f', 'create', 15, 'applications', '', '{}', '{}', '{\"username\":\"Marissa Adilla Binti Adib\",\"record\":\"15\"}', 1, 'Marissa Adilla Binti Adib', '2026-07-12 15:37:29'),
(193, '0a7a269d-23bd-4fd8-bb43-a319163e5d5d', 'update', 26, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"NURUL SYAZWINA BINTI SHOIB\"}', 1, 'System', '2026-07-12 15:37:50'),
(194, 'b1a2df7c-2ed0-4aee-bd5e-1ecca43d97da', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-12 15:38:21'),
(195, '5a2d7f1d-0a1d-460f-9d25-214d0aedf385', 'create', 16, 'applications', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"16\"}', 1, 'Nik Nur Aliyah', '2026-07-12 15:38:39'),
(196, 'e6c5d5d1-6fd8-4066-b9ce-2bf07ac6a3be', 'create', 17, 'applications', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"17\"}', 1, 'Nik Nur Aliyah', '2026-07-12 15:38:53'),
(197, 'd5a6e115-f7b9-4173-a3b2-bf39b687ae43', 'update', 24, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Farah Syazana Binti Mat Rohani\"}', 1, 'System', '2026-07-12 15:39:12'),
(198, '82622b35-7490-45e2-90f9-3b501e573382', 'create', 18, 'applications', '', '{}', '{}', '{\"username\":\"Farah Syazana Binti Mat Rohani\",\"record\":\"18\"}', 1, 'Farah Syazana Binti Mat Rohani', '2026-07-12 15:39:36'),
(199, '998c125a-48f8-4af5-be44-3baca31872f6', 'create', 19, 'applications', '', '{}', '{}', '{\"username\":\"Farah Syazana Binti Mat Rohani\",\"record\":\"19\"}', 1, 'Farah Syazana Binti Mat Rohani', '2026-07-12 15:39:48'),
(200, '6b4cf490-97a4-4151-9a61-2116fd1938ef', 'update', 25, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Hawa Binti Mohd Zamri\"}', 1, 'System', '2026-07-12 15:40:18'),
(201, 'ac79fb2d-3dcb-43fd-98f1-35c39ab637c5', 'create', 20, 'applications', '', '{}', '{}', '{\"username\":\"Hawa Binti Mohd Zamri\",\"record\":\"20\"}', 1, 'Hawa Binti Mohd Zamri', '2026-07-12 15:40:39'),
(202, '0c94aa77-6688-4534-8c9c-1dcf09148c1c', 'create', 21, 'applications', '', '{}', '{}', '{\"username\":\"Hawa Binti Mohd Zamri\",\"record\":\"21\"}', 1, 'Hawa Binti Mohd Zamri', '2026-07-12 15:40:48'),
(203, '4eea5523-d06b-49ca-a562-7b806aec11cd', 'update', 27, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Danial Rizqi Bin Mokhtar\"}', 1, 'System', '2026-07-12 15:42:06'),
(204, '722b3960-3a9a-4c2b-a0ac-8e779b8d1674', 'create', 22, 'applications', '', '{}', '{}', '{\"username\":\"Danial Rizqi Bin Mokhtar\",\"record\":\"22\"}', 1, 'Danial Rizqi Bin Mokhtar', '2026-07-12 15:42:31'),
(205, '9ecef687-b7b7-40bb-ab93-344dcc614291', 'create', 23, 'applications', '', '{}', '{}', '{\"username\":\"Danial Rizqi Bin Mokhtar\",\"record\":\"23\"}', 1, 'Danial Rizqi Bin Mokhtar', '2026-07-12 15:42:49'),
(206, '1580969d-7c50-4963-ac6e-a247eaf40520', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-12 15:42:56'),
(207, 'cfab85f4-9c14-4660-87e3-f084265ac91a', 'create', 26, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"System Analyst\"}', 1, 'Admin', '2026-07-12 15:55:32'),
(208, 'bf409da4-211b-4694-b7aa-ca90e54803b7', 'create', 27, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Statistician\"}', 1, 'Admin', '2026-07-12 15:58:31'),
(209, '585d2dd1-ab7a-445a-95e0-2bd57e208474', 'create', 28, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Data Analyst\"}', 1, 'Admin', '2026-07-12 16:01:49'),
(210, 'f1e8b93a-819a-4790-a1f6-92a4dfb75836', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-13 07:30:09'),
(211, '41a5ac03-db01-4473-9ec4-816d0bf5819c', 'update', 20, 'members', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-13 07:34:48'),
(212, 'a5c633e2-bcfa-4dbd-99a8-f44537350719', 'create', 24, 'applications', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"24\"}', 1, 'Nik Nur Aliyah', '2026-07-13 07:36:35'),
(213, 'bbf0d217-c0e0-4e9a-b0dd-6ce33c730009', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-13 07:37:18'),
(214, '0f4503a0-2a2c-4894-b2b8-a1f5e7ad0970', 'create', 29, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"data analyst\"}', 1, 'Admin', '2026-07-13 07:40:16'),
(215, '40d4f18f-b8a6-4721-b175-db48a1beb370', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-13 16:03:23'),
(216, '96cca7c1-8896-4815-ae1f-0b65db99cfac', 'delete', 29, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"data analyst\"}', 1, 'Admin', '2026-07-13 16:03:49'),
(217, '49635f74-6c49-4a4a-8712-f20b3b29764d', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-13 16:10:27'),
(218, 'e62e8b9f-d06c-4726-b0a5-e38e65ed13e1', 'update', 31, 'users', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Nur Arina Qistina Binti Abdul\"}', 1, 'Admin', '2026-07-13 16:10:59'),
(219, 'f644ad2e-953d-4687-97c3-7ca91894a091', 'update', 31, 'users', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"Nur Arina Qistina Binti Abdul\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:11:00'),
(220, 'd51be8db-4e71-4f6e-8abf-8c242a2ff6b8', 'update', 29, 'members', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"Nur Arina Qistina Binti Abdul\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:12:22'),
(221, 'b415dcf6-4e81-45a8-92b1-c9fa47f2e55c', 'update', 29, 'members', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"Nur Arina Qistina Binti Abdul\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:12:40'),
(222, 'dd95b384-831c-405a-9ea0-44220c11b249', 'create', 25, 'applications', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"25\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:13:13'),
(223, '59dc90f1-7fbd-4ac8-83ba-1b9d2a81e071', 'create', 26, 'applications', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"26\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:13:32'),
(224, 'ad56d6c9-dd5c-4ecc-85ee-238ec90da8d3', 'create', 27, 'applications', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"27\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:13:48'),
(225, 'c4779fb7-8c72-4948-b6b3-0771fe9e1896', 'create', 28, 'applications', '', '{}', '{}', '{\"username\":\"Nur Arina Qistina Binti Abdul\",\"record\":\"28\"}', 1, 'Nur Arina Qistina Binti Abdul', '2026-07-13 16:14:25'),
(226, '0a4d0e63-2ee1-4994-9411-9599228c1abe', 'update', 26, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"NURUL SYAZWINA BINTI SHOIB\"}', 1, 'System', '2026-07-13 16:15:43'),
(227, 'f2e643e1-7d7f-4901-b75b-03358eb030cd', 'update', 26, 'users', '', '{}', '{}', '{\"username\":\"NURUL SYAZWINA BINTI SHOIB\",\"record\":\"NURUL SYAZWINA BINTI SHOIB\"}', 1, 'NURUL SYAZWINA BINTI SHOIB', '2026-07-13 16:18:20'),
(228, '386b45ad-e7be-4947-948a-dbfa22169c49', 'update', 24, 'members', '', '{}', '{}', '{\"username\":\"NURUL SYAZWINA BINTI SHOIB\",\"record\":\"Nurul Syazwina Binti Shoib\"}', 1, 'NURUL SYAZWINA BINTI SHOIB', '2026-07-13 16:18:20'),
(229, '190268a5-7233-43e8-a4f0-3c47426493ca', 'create', 29, 'applications', '', '{}', '{}', '{\"username\":\"NURUL SYAZWINA BINTI SHOIB\",\"record\":\"29\"}', 1, 'NURUL SYAZWINA BINTI SHOIB', '2026-07-13 16:18:36'),
(230, '49303fe4-8058-4a59-9df7-d906d3a9226e', 'create', 30, 'applications', '', '{}', '{}', '{\"username\":\"NURUL SYAZWINA BINTI SHOIB\",\"record\":\"30\"}', 1, 'NURUL SYAZWINA BINTI SHOIB', '2026-07-13 16:18:47'),
(231, '8c2f8da8-2d04-48bc-8df3-25514d029ece', 'create', 31, 'applications', '', '{}', '{}', '{\"username\":\"NURUL SYAZWINA BINTI SHOIB\",\"record\":\"31\"}', 1, 'NURUL SYAZWINA BINTI SHOIB', '2026-07-13 16:18:59'),
(232, '07af0785-6653-40b1-976e-f3b1ef5c9821', 'create', 32, 'applications', '', '{}', '{}', '{\"username\":\"NURUL SYAZWINA BINTI SHOIB\",\"record\":\"32\"}', 1, 'NURUL SYAZWINA BINTI SHOIB', '2026-07-13 16:19:17'),
(233, '5dcf7806-713c-4cae-8fe5-bf2a9ccd02b1', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-13 16:19:41'),
(234, '802652f1-255b-428d-b382-4b6a87e60161', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-13 16:19:43'),
(235, 'c6d26a45-9ac8-485c-87e5-56003655420f', 'update', 20, 'members', '', '{}', '{}', '{\"username\":\"Nik Nur Aliyah\",\"record\":\"Nik Nur Aliyah\"}', 1, 'Nik Nur Aliyah', '2026-07-13 16:23:57'),
(236, 'b18cd454-289e-4acd-8819-bfa4b55489ee', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-13 16:28:51'),
(237, 'e0bd8322-fe60-424b-8f5f-a7d70bb797bc', 'update', 32, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Samira Najwa Binti Sayyid\"}', 1, 'System', '2026-07-13 16:42:19'),
(238, 'd1e03a64-8771-4b99-8220-6ba4e911da39', 'update', 32, 'users', '', '{}', '{}', '{\"username\":\"Samira Najwa Binti Sayyid\",\"record\":\"Samira Najwa Binti Sayyid\"}', 1, 'Samira Najwa Binti Sayyid', '2026-07-13 16:44:02'),
(239, 'b23f86f2-47d2-40a7-a78e-5b51e38e29bf', 'update', 30, 'members', '', '{}', '{}', '{\"username\":\"Samira Najwa Binti Sayyid\",\"record\":\"Samira Najwa Binti Sayyid\"}', 1, 'Samira Najwa Binti Sayyid', '2026-07-13 16:44:03'),
(240, '3bf2b368-ac91-4aa6-970b-46e2742117ac', 'create', 33, 'applications', '', '{}', '{}', '{\"username\":\"Samira Najwa Binti Sayyid\",\"record\":\"33\"}', 1, 'Samira Najwa Binti Sayyid', '2026-07-13 16:44:40'),
(241, 'a9122c42-a7ca-472c-bb3f-ed5782e44a93', 'create', 34, 'applications', '', '{}', '{}', '{\"username\":\"Samira Najwa Binti Sayyid\",\"record\":\"34\"}', 1, 'Samira Najwa Binti Sayyid', '2026-07-13 16:45:06'),
(242, '8d8bec05-c4b5-4aae-af42-4fadc594bc42', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-13 16:46:42'),
(243, '8d8721e1-f023-4540-b3a1-5459fff967e4', 'create', 30, 'advertisements', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Business Analyst\"}', 1, 'Admin', '2026-07-13 16:49:54'),
(244, 'b1a214f9-4d88-491f-99e8-bdf33646f81d', 'create', 10, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"\"}', 1, 'Admin', '2026-07-13 16:50:48'),
(245, 'c072ae73-e433-41bd-a0a2-9bc4c471b038', 'update', 18, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"18\"}', 1, 'Admin', '2026-07-13 16:50:48'),
(246, 'b24c700e-fc98-4ff8-a858-aca56f19c314', 'create', 11, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM shah alam meeting room\"}', 1, 'Admin', '2026-07-13 16:51:51'),
(247, '667f7663-18a3-4f51-bef7-264ee035a1b9', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-13 16:55:31'),
(248, '8154bcad-99db-490f-8449-fb9fa49d20ff', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-15 07:43:18'),
(249, 'f8dd10d9-6872-4948-848b-94cddd9e52b2', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-15 07:43:43'),
(250, '2a0307bd-0813-4945-9005-d36be2077c7b', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-15 08:01:27'),
(251, '6bd1d359-46df-48d7-b4fe-519d74785158', 'create', 12, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Via online (Google Meet)\"}', 1, 'Admin', '2026-07-15 08:02:51'),
(252, '19ab2fa6-2348-4859-a1aa-9a1b6da7d017', 'create', 13, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Via online (Google Meet)\"}', 1, 'Admin', '2026-07-15 08:03:11'),
(253, '1ea7bfa9-8820-4685-a762-0104e09a897c', 'create', 14, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Via online (Google Meet)\"}', 1, 'Admin', '2026-07-15 08:03:33'),
(254, '90e745b0-3599-4f11-9f06-52c975a1691f', 'update', 12, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Via online (Google Meet)\"}', 1, 'Admin', '2026-07-15 08:03:57'),
(255, '49b14c37-aa23-4a29-9729-429b3359bbd0', 'update', 13, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Via online (Google Meet)\"}', 1, 'Admin', '2026-07-15 08:04:05'),
(256, '5dc6569f-9b94-4f82-b9fe-96d6bb888b49', 'update', 21, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"21\"}', 1, 'Admin', '2026-07-15 08:04:05'),
(257, 'bfaf1d17-8fac-4b99-9a09-eb87bf47b01e', 'update', 17, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"17\"}', 1, 'Admin', '2026-07-15 08:04:16'),
(258, 'f6783790-6a66-4cae-92f0-1c52e8ac972d', 'update', 14, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"Via online (Google Meet)\"}', 1, 'Admin', '2026-07-15 08:04:38'),
(259, '262042f4-49aa-4c9d-88e9-b39503de3611', 'update', 29, 'applications', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"29\"}', 1, 'Admin', '2026-07-15 08:04:48'),
(260, 'd95de3cf-3b59-49a4-b985-b169bb52459d', 'update', 22, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Nik Nur Aliyah\"}', 1, 'System', '2026-07-15 08:05:10'),
(261, 'c608bfe1-b086-44e7-ae0a-88a29b24970a', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-15 08:07:16'),
(262, 'c0b68a5f-a7b2-4c62-befd-62b218269086', 'create', 15, 'interviews', '', '{}', '{}', '{\"username\":\"Admin\",\"record\":\"UiTM Rembau Meeting room BK2\"}', 1, 'Admin', '2026-07-15 08:08:59'),
(263, 'f6714f59-d8bd-4c80-bd4f-66d4e25b973a', 'update', 29, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Marissa Adilla Binti Adib\"}', 1, 'System', '2026-07-15 08:09:21'),
(264, '969d9fd3-cdef-438f-8f2f-9c5aa668e455', 'update', 16, 'users', '', '{}', '{}', '{\"username\":\"System\",\"record\":\"Admin\"}', 1, 'System', '2026-07-15 15:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` int NOT NULL,
  `application_id` int NOT NULL,
  `interview_date` date DEFAULT NULL,
  `interview_time` time DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `notes` text,
  `letter` text,
  `status` int DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `application_id`, `interview_date`, `interview_time`, `mode`, `location`, `notes`, `letter`, `status`, `created`, `modified`) VALUES
(9, 11, '2026-07-23', '12:25:00', NULL, 'UiTM Rembau', NULL, 'To      : Nik Nur Aliyah\nFrom    : Human Resource Department, JobMatch\nDate    : 11 July 2026\nSubject : Invitation to Interview — SOFTWARE DEVELOPER\n\nDear Nik Nur Aliyah,\n\nThank you for your application for the position of Software Developer at JobMatch. We are pleased to inform you that, following a review of your application, you have been shortlisted for an interview.\n\nWe would like to invite you to attend an interview session with the details below:\n\n   1. Position   : Software Developer\n   2. Date       : 23 July 2026\n   3. Time       : 12:25 PM\n   4. Venue      : UiTM Rembau\n\nKindly confirm your attendance by replying to this letter. Please bring along a copy of your resume and any relevant certificates. Should you be unable to attend at the scheduled time, please contact our Human Resource Department to arrange an alternative date.\n\nWe look forward to meeting you.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 0, '2026-07-11 14:23:35', '2026-07-11 14:23:35'),
(10, 18, NULL, NULL, NULL, NULL, NULL, 'To      : Farah Syazana Binti Mat Rohani\nFrom    : Human Resource Department, JobMatch\nDate    : 13 July 2026\nSubject : Application Outcome — SOFTWARE DEVELOPER\n\nDear Farah Syazana Binti Mat Rohani,\n\nThank you for your interest in the position of Software Developer at JobMatch and for taking the time to submit your application.\n\nAfter careful review of all applications received, we regret to inform you that you have not been shortlisted to proceed to the interview stage for this position on this occasion.\n\nWe appreciate the effort you put into your application and encourage you to apply for future opportunities that match your skills and experience. We wish you every success in your job search.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 2, '2026-07-13 16:50:48', '2026-07-13 16:50:48'),
(11, 34, '2026-08-01', '16:51:00', NULL, 'UiTM shah alam meeting room', NULL, 'To      : Samira Najwa Binti Sayyid\nFrom    : Human Resource Department, JobMatch\nDate    : 13 July 2026\nSubject : Invitation to Interview — SOFTWARE DEVELOPER\n\nDear Samira Najwa Binti Sayyid,\n\nThank you for your application for the position of Software Developer at JobMatch. We are pleased to inform you that, following a review of your application, you have been shortlisted for an interview.\n\nWe would like to invite you to attend an interview session with the details below:\n\n   1. Position   : Software Developer\n   2. Date       : 1 August 2026\n   3. Time       : 4:51 PM\n   4. Venue      : UiTM shah alam meeting room\n\nKindly confirm your attendance by replying to this letter. Please bring along a copy of your resume and any relevant certificates. Should you be unable to attend at the scheduled time, please contact our Human Resource Department to arrange an alternative date.\n\nWe look forward to meeting you.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 0, '2026-07-13 16:51:51', '2026-07-13 16:51:51'),
(12, 17, '2026-07-16', '09:00:00', NULL, 'Via online (Google Meet)', NULL, 'To      : Nik Nur Aliyah\nFrom    : Human Resource Department, JobMatch\nDate    : 15 July 2026\nSubject : Invitation to Interview — DATA ENTRY CLERK\n\nDear Nik Nur Aliyah,\n\nThank you for your application for the position of Data Entry Clerk at JobMatch. We are pleased to inform you that, following a review of your application, you have been shortlisted for an interview.\n\nWe would like to invite you to attend an interview session with the details below:\n\n   1. Position   : Data Entry Clerk\n   2. Date       : 16 July 2026\n   3. Time       : 9:00 AM\n   4. Venue      : Via online (Google Meet)\n\nKindly confirm your attendance by replying to this letter. Please bring along a copy of your resume and any relevant certificates. Should you be unable to attend at the scheduled time, please contact our Human Resource Department to arrange an alternative date.\n\nWe look forward to meeting you.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 1, '2026-07-15 08:02:51', '2026-07-15 08:03:57'),
(13, 21, '2026-07-17', '09:00:00', NULL, 'Via online (Google Meet)', NULL, 'To      : Hawa Binti Mohd Zamri\nFrom    : Human Resource Department, JobMatch\nDate    : 15 July 2026\nSubject : Interview Result — DATA ENTRY CLERK\n\nDear Hawa Binti Mohd Zamri,\n\nThank you for taking the time to attend the interview for the position of Data Entry Clerk at JobMatch. We appreciate the opportunity to have met with you.\n\nAfter careful consideration following your interview, we regret to inform you that you have not been selected for this position on this occasion. This was a difficult decision, as we met with a number of strong candidates.\n\nWe were genuinely impressed by your background, and we encourage you to apply for future opportunities with us. We wish you every success in your future endeavours.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 3, '2026-07-15 08:03:11', '2026-07-15 08:04:05'),
(14, 29, '2026-07-17', '09:00:00', NULL, 'Via online (Google Meet)', NULL, 'To      : Nurul Syazwina Binti Shoib\nFrom    : Human Resource Department, JobMatch\nDate    : 15 July 2026\nSubject : Invitation to Interview — DATA ENTRY CLERK\n\nDear Nurul Syazwina Binti Shoib,\n\nThank you for your application for the position of Data Entry Clerk at JobMatch. We are pleased to inform you that, following a review of your application, you have been shortlisted for an interview.\n\nWe would like to invite you to attend an interview session with the details below:\n\n   1. Position   : Data Entry Clerk\n   2. Date       : 17 July 2026\n   3. Time       : 9:00 AM\n   4. Venue      : Via online (Google Meet)\n\nKindly confirm your attendance by replying to this letter. Please bring along a copy of your resume and any relevant certificates. Should you be unable to attend at the scheduled time, please contact our Human Resource Department to arrange an alternative date.\n\nWe look forward to meeting you.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 1, '2026-07-15 08:03:33', '2026-07-15 08:04:38'),
(15, 14, '2026-07-17', '09:00:00', NULL, 'UiTM Rembau Meeting room BK2', NULL, 'To      : Marissa Adilla Binti Adib\nFrom    : Human Resource Department, JobMatch\nDate    : 15 July 2026\nSubject : Invitation to Interview — EVENT PROMOTER\n\nDear Marissa Adilla Binti Adib,\n\nThank you for your application for the position of Event Promoter at JobMatch. We are pleased to inform you that, following a review of your application, you have been shortlisted for an interview.\n\nWe would like to invite you to attend an interview session with the details below:\n\n   1. Position   : Event Promoter\n   2. Date       : 17 July 2026\n   3. Time       : 9:00 AM\n   4. Venue      : UiTM Rembau Meeting room BK2\n\nKindly confirm your attendance by replying to this letter. Please bring along a copy of your resume and any relevant certificates. Should you be unable to attend at the scheduled time, please contact our Human Resource Department to arrange an alternative date.\n\nWe look forward to meeting you.\n\nYours sincerely,\n\n\n_______________________\nHuman Resource Department\nJobMatch\nConnect · Match · Succeed', 0, '2026-07-15 08:08:59', '2026-07-15 08:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `preferred_job_position` varchar(255) DEFAULT NULL,
  `certificate_skill` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `resume_dir` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '3',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `name`, `image`, `address`, `location`, `preferred_job_position`, `certificate_skill`, `phone_number`, `resume`, `resume_dir`, `status`, `created`, `modified`) VALUES
(17, 16, 'Aisyah Maisarah Binti Seliman', '', '', NULL, 'Human Resource', 'Management', '+6011-23496125', '', '', 1, '2026-07-04 21:09:06', '2026-07-11 14:06:40'),
(20, 22, 'Nik Nur Aliyah', '', 'No. 89, Jalan BK 2/7, Bandar Kinrara, 47180 Puchong Selangor', 'Shah Alam, Selangor', 'IT Department', 'MIcrosoft word\r\nMicrosfot Power Point\r\nC++', '+6011-46981366', '1783959837_Resume Aliyah.pdf', 'uploads/resumes/', 1, '2026-07-11 14:19:43', '2026-07-13 16:23:57'),
(22, 24, 'Farah Syazana Binti Mat Rohani', '', 'ks 8/G taman tiara, shah alam, selangor', 'Selangor', 'Programmer', 'Web Development\r\nSoftware Development\r\nProblem Solving', '+6011-56471536', '1783868594_Resume Farah.jpeg', 'uploads/resumes/', 1, '2026-07-12 14:57:59', '2026-07-12 15:03:14'),
(23, 25, 'Hawa Binti Mohd Zamri', '', 'lot2, Taman Katsuri, Jalan Megawati, Negeri Sembilan', 'Negeri Sembilan', 'Finance Department', 'Microsoft Office Certificated\r\nMicrosoft Excel\r\nMicrosoft Project', '+6011-12378956', '1783868964_RESUME.pdf', 'uploads/resumes/', 1, '2026-07-12 15:04:17', '2026-07-12 15:09:25'),
(24, 26, 'Nurul Syazwina Binti Shoib', '', 'JS 8/B Taman Nilam, shah alam, selangor', 'Shah Alam, Selangor', 'Information Management', 'Basic c++\r\nMicrosoft Excel\r\nMicrosoft Word\r\nTeamwork', '+6011-56471536', '1783959500_RESUME_NURUL SYAZWINA BINTI SHOIB.pdf', 'uploads/resumes/', 1, '2026-07-12 15:10:42', '2026-07-13 16:18:20'),
(25, 27, 'Danial Rizqi Bin Mokhtar', '', 'JS 8/B Taman Nilam, shah alam, selangor', 'Merbok, Kedah', 'IT', 'System Analyst\r\nIT Support\r\nCommunication', '+6011-56471536', '1783869524_WhatsApp Image 2026-07-10 at 19.45.56.jpeg', 'uploads/resumes/', 1, '2026-07-12 15:16:10', '2026-07-12 15:18:44'),
(27, 29, 'Marissa Adilla Binti Adib', '', 'No15 Jalan Sialang, Tangkak, Johor', 'Shah Alam, Selangor', 'Marketing', 'Digital Marketing\r\nSocial Media Management\r\nCanva Design \r\nCreativity', '+6011-12378956', '1783869918_WhatsApp Image 2026-07-10 at 19.45.55.jpeg', 'uploads/resumes/', 1, '2026-07-12 15:20:35', '2026-07-12 15:25:18'),
(29, 31, 'Nur Arina Qistina Binti Abdul', '', 'ks 8/G taman tiara, shah alam, selangor', 'Shah Alam, Selangor', 'Marketing', 'Adobe Photoshop\r\nAdobe Illustrator\r\nCommunication\r\nTeamwork', '+6011-56471536', '1783959142_WhatsApp Image 2026-07-10 at 19.45.55 (1).jpeg', 'uploads/resumes/', 1, '2026-07-13 16:07:38', '2026-07-13 16:12:40'),
(30, 32, 'Samira Najwa Binti Sayyid', '', 'KS 8/G Kampung Kinrarar, Shah Alam Selangor', 'Selangor', 'IT', 'Web designing\r\nMicrosoft Excel\r\nC++\r\nTeamwork', '0137562499', '1783961042_Samira Resume.pdf', 'uploads/resumes/', 1, '2026-07-13 16:42:05', '2026-07-13 16:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Admin', '2026-07-03 23:05:56', '2026-07-03 23:05:56'),
(2, 'User', '2026-07-03 23:05:56', '2026-07-03 23:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `role_id` int DEFAULT NULL,
  `user_group_id` int DEFAULT '3',
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `avatar_dir` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_created_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '	is_active',
  `is_email_verified` int NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_by` int DEFAULT NULL COMMENT 'user_id',
  `modified_by` int DEFAULT NULL COMMENT 'user_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_group_id`, `fullname`, `password`, `email`, `avatar`, `avatar_dir`, `token`, `token_created_at`, `status`, `is_email_verified`, `last_login`, `ip_address`, `slug`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(16, 1, 1, 'Admin', 'Admin123!', 'admin@admin.com', 'avatar_1783778817_9781.jpeg', 'img/avatars', NULL, '0000-00-00 00:00:00', '1', 0, '2026-07-15 15:17:52', NULL, 'admin-1', '2026-07-04 11:16:27', '2026-07-15 15:17:52', NULL, NULL),
(22, 2, 0, 'Nik Nur Aliyah', 'Ai@486298', 'niknur@gmail.com', 'avatar_1783779725_4245.jpeg', 'img/avatars', NULL, '2026-07-11 14:19:43', '1', 0, '2026-07-15 08:05:10', NULL, 'user-1783779583', '2026-07-11 14:19:43', '2026-07-15 08:05:10', NULL, NULL),
(23, 2, 0, 'Nik Nur Aliyah', 'Ai@486298', 'niknur@gmail.com', NULL, NULL, NULL, '2026-07-11 14:19:45', '1', 0, NULL, NULL, 'user-1783779585', '2026-07-11 14:19:45', '2026-07-11 14:19:45', NULL, NULL),
(24, 2, 0, 'Farah Syazana Binti Mat Rohani', 'Ai@486298', 'farahsyazana@gmail.com', 'avatar_1783868594_2059.png', 'img/avatars', NULL, '2026-07-12 14:57:59', '1', 0, '2026-07-12 15:39:12', NULL, 'user-1783868279', '2026-07-12 14:57:59', '2026-07-12 15:39:12', NULL, NULL),
(25, 2, 0, 'Hawa Binti Mohd Zamri', 'Ai@486298', 'hawa211@gmail.com', 'avatar_1783868964_2967.png', 'img/avatars', NULL, '2026-07-12 15:04:17', '1', 0, '2026-07-12 15:40:18', NULL, 'user-1783868657', '2026-07-12 15:04:17', '2026-07-12 15:40:18', NULL, NULL),
(26, 2, 0, 'NURUL SYAZWINA BINTI SHOIB', 'Ai@486298', 'nurulsyazwina@gmail.com', 'avatar_1783959500_7528.jpeg', 'img/avatars', NULL, '2026-07-12 15:10:42', '1', 0, '2026-07-13 16:15:43', NULL, 'user-1783869042', '2026-07-12 15:10:42', '2026-07-13 16:18:20', NULL, NULL),
(27, 2, 0, 'Danial Rizqi Bin Mokhtar', 'Ai@486298', 'danial365@gmail.com', NULL, NULL, NULL, '2026-07-12 15:16:10', '1', 0, '2026-07-12 15:42:06', NULL, 'user-1783869370', '2026-07-12 15:16:10', '2026-07-12 15:42:06', NULL, NULL),
(29, 2, 0, 'Marissa Adilla Binti Adib', 'Ai@486298', 'marissaadilla@gmail.com', NULL, NULL, NULL, '2026-07-12 15:20:35', '1', 0, '2026-07-15 08:09:21', NULL, 'user-1783869635', '2026-07-12 15:20:35', '2026-07-15 08:09:21', NULL, NULL),
(31, 2, 0, 'Nur Arina Qistina Binti Abdul', 'Ai@486298', 'arinaqis@gmail.com', NULL, NULL, NULL, '2026-07-13 16:07:38', '1', 0, '2026-07-13 16:11:00', NULL, 'user-1783958858', '2026-07-13 16:07:38', '2026-07-13 16:11:00', NULL, NULL),
(32, 2, 0, 'Samira Najwa Binti Sayyid', 'Ai@486298', 'samiranajwa@gmail.com', 'avatar_1783961042_9026.jpg', 'img/avatars', NULL, '2026-07-13 16:42:05', '1', 0, '2026-07-13 16:42:19', NULL, 'user-1783960925', '2026-07-13 16:42:05', '2026-07-13 16:44:02', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`members_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisement_id` (`advertisement_id`),
  ADD KEY `user_id` (`members_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction` (`transaction`),
  ADD KEY `type` (`type`),
  ADD KEY `primary_key` (`primary_key`),
  ADD KEY `source` (`source`),
  ADD KEY `parent_source` (`parent_source`),
  ADD KEY `created` (`created`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_members_user` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `fk_advertisements_member` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `fk_applications_advertisement` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_applications_member` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_members_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
