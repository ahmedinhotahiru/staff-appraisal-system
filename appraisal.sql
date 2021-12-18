-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2021 at 03:55 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appraisal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `password`) VALUES
(1, 'issahahmed00@gmail.com', 'admin', '$2y$10$BnTvbQ93Se0ANhOkGHgBH.JiN4zEorn/kGPNQxqg2kgwOLE2pmZV6');

-- --------------------------------------------------------

--
-- Table structure for table `appraisal`
--

CREATE TABLE `appraisal` (
  `appraisal_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `fiscal_session_id` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `grand_mean` double NOT NULL,
  `remarks` varchar(60) NOT NULL,
  `general_comments` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appraisal`
--

INSERT INTO `appraisal` (`appraisal_id`, `staff_id`, `department_id`, `fiscal_session_id`, `total_score`, `grand_mean`, `remarks`, `general_comments`) VALUES
(1, 13, 3, 1, 36, 3.67, 'Good', 'This is a good performance'),
(2, 14, 15, 5, 20, 1.96, 'Poor', 'This is a poor performance. Staff must sit up'),
(3, 15, 3, 5, 32, 2.3, 'Average', 'This is an average performance. Not bad, but staff can do better.'),
(4, 13, 3, 5, 36, 3.67, 'Good', 'This is a good performance'),
(5, 16, 15, 5, 36, 3.67, 'Good', 'This is a good performance'),
(6, 17, 3, 5, 32, 2.3, 'Average', 'This is an average performance. Not bad, but staff can do better.'),
(7, 19, 3, 5, 20, 1.96, 'Poor', 'This is a poor performance. Staff must sit up'),
(8, 20, 15, 5, 32, 2.3, 'Average', 'This is an average performance. Not bad, but staff can do better.'),
(9, 21, 3, 5, 36, 3.67, 'Good', 'This is a good performance'),
(10, 23, 3, 5, 32, 2.3, 'Average', 'This is an average performance. Not bad, but staff can do better.');

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_details`
--

CREATE TABLE `appraisal_details` (
  `appraisal_detail_id` int(11) NOT NULL,
  `appraisal_id` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `deadline` int(11) NOT NULL,
  `student_service` int(11) NOT NULL,
  `relates_well` int(11) NOT NULL,
  `collaboration` int(11) NOT NULL,
  `evaluation_methods` int(11) NOT NULL,
  `assignments` int(11) NOT NULL,
  `sufficient_assignments` int(11) NOT NULL,
  `adheres_to_rules` int(11) NOT NULL,
  `marking_of_scripts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appraisal_details`
--

INSERT INTO `appraisal_details` (`appraisal_detail_id`, `appraisal_id`, `attendance`, `deadline`, `student_service`, `relates_well`, `collaboration`, `evaluation_methods`, `assignments`, `sufficient_assignments`, `adheres_to_rules`, `marking_of_scripts`) VALUES
(1, 1, 4, 4, 4, 3, 3, 2, 5, 3, 3, 5),
(2, 2, 2, 2, 2, 3, 3, 2, 2, 1, 2, 1),
(3, 3, 2, 3, 4, 5, 3, 4, 5, 4, 1, 1),
(4, 4, 2, 2, 2, 3, 3, 2, 2, 1, 2, 1),
(5, 5, 2, 2, 2, 3, 3, 2, 2, 1, 2, 1),
(6, 6, 2, 3, 4, 5, 3, 4, 5, 4, 1, 1),
(7, 7, 2, 2, 2, 3, 3, 2, 2, 1, 2, 1),
(8, 8, 2, 3, 4, 5, 3, 4, 5, 4, 1, 1),
(9, 9, 2, 2, 2, 3, 3, 2, 2, 1, 2, 1),
(10, 10, 2, 3, 4, 5, 3, 4, 5, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `school_faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `school_faculty_id`) VALUES
(3, 'Department Of Real Estate Development', 8),
(15, 'Department Of Social Development', 2),
(16, 'Department Of Computer Science', 2),
(17, 'Department Of Business', 9);

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_sessions`
--

CREATE TABLE `fiscal_sessions` (
  `fiscal_session_id` int(11) NOT NULL,
  `fiscal_year` varchar(60) NOT NULL,
  `deadline` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fiscal_sessions`
--

INSERT INTO `fiscal_sessions` (`fiscal_session_id`, `fiscal_year`, `deadline`, `status`) VALUES
(1, '2018/2019', '2022-01-20', 1),
(4, '2019/2020', '2021-12-29', 2),
(5, '2020/2021', '2021-12-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schools_faculties`
--

CREATE TABLE `schools_faculties` (
  `school_faculty_id` int(11) NOT NULL,
  `school_faculty_name` varchar(255) NOT NULL,
  `acronym` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools_faculties`
--

INSERT INTO `schools_faculties` (`school_faculty_id`, `school_faculty_name`, `acronym`) VALUES
(2, 'School Of Computing And Information Sciences', 'SCIS'),
(8, 'Faculty Of Integrated Development Studies', 'FIDS'),
(9, 'School Of Business', 'SOB');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_id_no` varchar(50) NOT NULL,
  `title` varchar(10) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `sch_fac_dept_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `position` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_id_no`, `title`, `staff_name`, `sch_fac_dept_id`, `role`, `position`, `email`) VALUES
(12, 'UBIDS887775', 'Prof.', 'Ophelius Yinyeh', 8, 'Dean', 'Exams Officer', 'ahmedissah419@yahoo.com'),
(13, 'UBIDS155454', 'Mrs.', 'Paula Nyame', 3, 'HOD', 'Senior Lecturer', 'ahmedinhonasheeds@gmail.com'),
(14, 'UBIDS55688', 'Dr.', 'Nabita Teye', 15, 'HOD', 'Exams Officer', 'ahmedissah4190@gmail.com'),
(15, 'UBIDS68796', 'Mr.', 'Mumin Abdallah', 3, 'Lecturer', 'Junior Lecturer', 'ahmedissah419@gmail.com'),
(16, 'UBIDS56878', 'Ms.', 'Matilda Nii', 15, 'HOD', 'Lecturer', 'matilda@gmail.com'),
(17, 'UBIDS56578', 'Dr.', 'Sampson Abogoba', 3, 'HOD', 'Assistant Exam Officer', 'sampson@gmail.com'),
(18, 'UBIDS68765', 'Prof.', 'Jude Apana Richlove', 15, 'HOD', 'It Guy 2', 'judeapana@gmail.com'),
(19, 'UBIDS85678', 'Mr.', 'Nuhu Laah', 3, 'Lecturer', 'Lecturer', 'nuhulaar@gmail.com'),
(20, 'UBIDS32158', 'Mrs.', 'Gloria Amanfi', 15, 'Lecturer', 'Senior Lecturer', 'glorryy@yahoo.com'),
(21, 'UBIDS54785', 'Prof.', 'Daabo Nkrumah', 3, 'Lecturer', 'Liberian', 'dopi@yahoo.com'),
(22, 'UBIDS63254', 'Prof.', 'Mahmood Bawumia', 15, 'Lecturer', 'Senior Lecturer', 'mahmoud@gmail.com'),
(23, 'UBIDS98546', 'Ms.', 'Rodalyn Quaye', 3, 'Lecturer', 'Lecturer', 'roqu@gmail.com'),
(24, 'UBIDS36487', 'Prof.', 'Daabo Ibrahim', 2, 'Dean', 'Senior Lecturer', 'issahahmed@gmail.com'),
(25, 'UBIDS24589', 'Prof.', 'Edward Baagyere', 16, 'HOD', 'Senior Lecturer', 'ahmedinhonasheedsmedia@gmail.com'),
(26, 'UBIDS65879', 'Dr.', 'Wisdom Nagaye', 9, 'Dean', 'Senior Lecturer', 'issahahmed00dff@gmail.com'),
(27, 'UBIDS54789', 'Prof.', 'Ophelius Yinyeh', 9, 'Dean', 'Director Ict', 'ophelius24@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_id_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `staff_id`, `staff_id_no`, `password`) VALUES
(10, 12, 'UBIDS887775', '$2y$10$S00BbqhGKfe3.cyKDTpTduYkEhxCGTP/r4CmirJ.IJfHWbeZhdwbq'),
(11, 13, 'UBIDS155454', '$2y$10$BKkjWey2KgycovXaXNr7L.49r/n8HCm04uGUSb3L6Vtr6WbP5uy1e'),
(12, 14, 'UBIDS55688', '$2y$10$4dCxzv3ViMVp00bJLxss/uLBYgIvb08ao4m7FJg7QOvKiSUT2ILn.'),
(13, 16, 'UBIDS56878', '$2y$10$kPhqs.BvJKUNMKKU3iFiNezw9JYZys266PX09m2b8VkAWSkD9GGda'),
(14, 17, 'UBIDS56578', '$2y$10$K9JYNjmpOYRY81HJv9hWquixqoM0VQ37VX6FIzQ/vtiMoHshhNLYS'),
(15, 18, 'UBIDS68765', '$2y$10$HkcfvWw/vhY2tmZACnCFBuwGR3k51pBpb5ojbTM5JtFZ5ATPqBi5O'),
(16, 24, 'UBIDS36487', '$2y$10$fxOjBVNoaqXa.Bb.9x5oaOsLzx5aOqfNYm5jODUM3nl.O9Og41sRC'),
(17, 25, 'UBIDS24589', '$2y$10$HkcfvWw/vhY2tmZACnCFBuwGR3k51pBpb5ojbTM5JtFZ5ATPqBi5O'),
(18, 26, 'UBIDS65879', '$2y$10$1xiPN75t4vSWaDD1FImdbuWzewknr1hi60f64vWLGdVe1/rWsDbre'),
(19, 27, 'UBIDS54789', '$2y$10$TuhdlrqPoQpd9q741VT08OQZMirVeL6y1jjnZZWHncerGfyZtaSQi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal`
--
ALTER TABLE `appraisal`
  ADD PRIMARY KEY (`appraisal_id`);

--
-- Indexes for table `appraisal_details`
--
ALTER TABLE `appraisal_details`
  ADD PRIMARY KEY (`appraisal_detail_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `fiscal_sessions`
--
ALTER TABLE `fiscal_sessions`
  ADD PRIMARY KEY (`fiscal_session_id`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools_faculties`
--
ALTER TABLE `schools_faculties`
  ADD PRIMARY KEY (`school_faculty_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appraisal`
--
ALTER TABLE `appraisal`
  MODIFY `appraisal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appraisal_details`
--
ALTER TABLE `appraisal_details`
  MODIFY `appraisal_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `fiscal_sessions`
--
ALTER TABLE `fiscal_sessions`
  MODIFY `fiscal_session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools_faculties`
--
ALTER TABLE `schools_faculties`
  MODIFY `school_faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
