-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2025 at 05:17 PM
-- Server version: 5.7.44
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alagacom_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(250) NOT NULL,
  `imgPath` varchar(250) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `type`, `name`, `title`, `imgPath`, `status`) VALUES
(6, 2, 'academics', 'academics', 'b255867045de89da8da070f00bd8a9de.jpg', 1),
(9, 2, 'contact', 'contact', '86ee285a7350c992d2b915d7b33c60c5.jpg', 1),
(11, 2, 'gallery', 'gallery', '3dfdc6b938c3718cc6cd9e582673523b.jpg', 1),
(12, 2, 'facilities', 'facilities', '0d3fc10c4df663b3af997e79e05397ef.jpg', 1),
(24, 2, 'Admissions', 'admissions', 'dfa399a697bf0bb4bc55b352e6712e1b.jpg', 1),
(26, 2, 'Inner page', 'School Structure', '1d57df42e91580bc89d7b50e92ea2f28.jpeg', 1),
(27, 2, 'facilities', 'sportsfacilities', 'fcdf5191f4c54a7e234455dd6b4d0c06.jpg', 1),
(28, 1, 'banner', 'banner', 'e28ceb37f945a458df098c0fa9afb902.jpg', 1),
(29, 2, 'facilities', 'facilities', 'b097615eea6e4a1d9c06690c3c72d038.jpg', 1),
(35, 2, 'about', 'image', '90e5b867c12bbc0327115b7d9c77f693.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` bigint(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `alias`, `content`, `status`) VALUES
(2, 'Admissions', 'admissions', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">ADMISSIONS</h3>\r\n	\r\n		<h4>ADMISSIONS FOR THE ACADEMIC YEAR 2022-2023</h4>\r\n		\r\n		<p>Finding the right school is all about finding the right environment for a child and we at Alagappa Academy are committed to provide a good environment for your child to learn and grow. We have classes from Pre-primary to Class XII.</p><br>\r\n		\r\n		<h4>ADMISSION GUIDELINES:</h4>\r\n	\r\n		<div>\r\n			<ul>\r\n				<li>Parents desirous of an enriching learning experience for their wards in a healthy environment may contact our school office for admissions.</li>\r\n				<li>The Admission forms can be purchased at our school office.</li>\r\n				<li>Copy of birth certificate, Transfer certificate, 3 passport size photos and Copy of Aadhaar card should be submitted along with application during the process of admissions.</li>\r\n\r\n			</ul>\r\n		</div>\r\n	\r\n		<div>\r\n			<strong>To have an effective teaching learning process, we maintain limited class strength.</strong>\r\n		</div>\r\n<div>\r\n<h4>For Admission enquiry :</h4>\r\n<iframe src=\"https://docs.google.com/forms/d/1ybAFv9mh_ctWUP5G4QdeWXo57mqOvBO6YiQN1XETET4/viewform?edit_requested=true\" width=\"640\" height=\"2500\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\">Loading…</iframe>\r\n</div>\r\n	</div>', 1),
(3, 'Alagappa Academy', 'alagappa-academy', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">Alagappa Academy</h3>\r\n	\r\n		<p>The Dr. Alagappa Academy was founded by Dr. Ramanathan Vairavan in 2014 to establish a CBSE based academic program in the Alagappa group of institutions and expand the student offerings to a multi-model schooling system.</p>\r\n		\r\n		<p>With engaging extracurricular activities and a dedicated faculty, each student is considered uniquely nurtured with individual attention to help channelize energies and bring out their best. Housed in a serene environment, qualified teaching and non-teaching staff cater to the needs of every child. Our School is affiliated to CBSE, Delhi and we follow the standardized CBSE based curriculum that focuses on skills like critical thinking and problem solving through interactive events, activities and role-playing games in the classrooms. The Dr. Alagappa Academy is a Senior secondary school (Pre KG to Grade XII) that recommends NCERT Books.</p><br><br>\r\n		\r\n		<h4>Why Choose Us</h4>\r\n		\r\n		<div>\r\n			<ul>\r\n				<li>Empowering Dreams: To enable all students to realize their potential and dreams in the fields of academics, art and craft</li>\r\n				<li>Learning Environment: The Conducive atmosphere at Alagappa Academy prepares children for intellectual curiosity, personal accountability and love for learning.</li>\r\n				<li>Scholastic Success: With the high standards established and maintained, the student automatically acquires his or her entire complement of knowledge and passes out with flying colors.</li>\r\n				<li>Value Add on: At Alagappa Academy, we hold ourselves up to high standards of integrity. Values of love, obedience, hard work, service and broad-mindedness are ingrained even in the early years at the school.</li>\r\n			</ul>\r\n		</div>\r\n		\r\n	</div>', 1),
(4, 'Mission and Vision', 'mission-and-vision', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">Mission and Vision</h3>\r\n	\r\n		\r\n		<div>\r\n			<h5>Mission:</h5>\r\n			<div>\r\n				<ul>\r\n					<li>To maintain a strong emphasis on attaining high standards of academic achievement, a kaleidoscope of extra-curricular activities, community involvement programs and school events encourage Innovative Problem Solving, Independent Expression and Decision Making enabling the students to become more informed, confident and active learners.</li>\r\n					<li>We seek to promote strong links with the parents; to keep them well informed and work together with them to evolve pertinent strategies to bring out the children\'s full potential.</li>\r\n					<li>A well-qualified faculty with extensive experience to provide the students with an excellent learning environment</li><br>\r\n					\r\n				</ul>\r\n			</div>\r\n			\r\n			<h5>Vision:</h5>\r\n			\r\n			<p>To provide a happy and supportive environment to the students, to provide holistic education and enable full development of their personality, allowing them to think independently and innovatively and take their own initiative to actively participate in the learning process.</p>\r\n			\r\n		</div>\r\n		\r\n	</div>', 1),
(5, 'MESSAGE FROM THE MANAGEMENT', 'message-from-the-management', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">MESSAGE FROM THE MANAGEMENT</h3>\r\n	\r\n		\r\n		<div>\r\n			\r\n			\r\n			<p>Today with more than 30,00,000 students graduating from the various Alagappa institutions since its inception, the life story of Alagappa Chettiar is an inspiration to millions in India, as he brought smiles to the faces of students and their families by bringing primary, secondary, tertiary and professional education to the doorstep of the community in Tamil Nadu. His generous donations led to the establishment of a galaxy of educational institutions, which formed the basis for the establishment of the Alagappa University in 1985 by the Government of Tamil Nadu. When he died prematurely at the age of 48, Dr. Alagappa Chettiar had redefined philanthropy and contributed more to the betterment of education in Tamil Nadu than any other person had done until then.</p>\r\n			<p>Following his premature death, his daughter Mrs. Umayal Ramanathan assumed the responsibility to manage all the institutions that he founded. In 1968 to fulfil her father\'s dream of making these institutions a University, she donated 450 acres of land in Karaikudi with functioning professional institutions to the Tamil Nadu Government. We provide a comprehensive educational experience to children from Nursery to Higher educational streams with a lot of importance in developing life skills that are critical for a child to be competitive.</p>\r\n			<p>As our founder once said  “In course of time other branches of learning will, I hope, rise in this area and before of long this temple of learning which has been blessed at every stage by good and saintly personages will radiate its halo and enlightement to all who came within its orbit.” \r\n			- Dr. Alagappa Chettiar</p>\r\n			<p>This vision to extend the branches of learning through the establishment of Dr.Alagappa Academy : A CBSE based school was founded by Dr. Ramanathan Vairavan and thereby creating opportunities to the student community by effective teaching and promoting innovative practices. In the days to come the management has plans to upgrade the school to establish world class infrastructure and practices.</p><br><br>\r\n			<span><strong>Dr. Ramanathan Vairavan</span></strong><br>	<span><strong>Dr. Mrs. Umayal Ramanathan</strong></span>\r\n		</div>\r\n		\r\n	</div>', 1),
(6, 'MESSAGE FROM THE PRINCIPAL’S DESK', 'message-from-the-principals-desk', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">MESSAGE FROM THE PRINCIPAL</h3>\r\n	\r\n		\r\n		\r\n		<div>\r\n			\r\n			<p><strong>Dear Students,</strong></p>\r\n			<p>              A student asked one of the most genuinely inspirational personalities a question, “Sir how did you become so great?” This student herself wanted to become a singerinfact. The answer from this great personality was, “you  must have a  dream, must continuously  acquire knowledge, must work hard, must  persevere  in your work upon  achieve your dream, and you  should not be afraid of  problems”  . He was none otherthan Dr. Abdul Kalam, the former President of India.</p>\r\n			<p>Here, I am bound  to say,“Everyone  is talented  at least in one field, if not in many  fields”.Focus on  the ones that you  are most  emotionally attached to.It’s very common that  one might encounter difficulties, hindrances ,conflicts, discouragements etc. These negative agents can be easily overthrown, if one strongly believes in the power of perseverance.</p>\r\n<p>It’s known to many who have gone through the biography of “Padma Bhushan Dr.RM. Alagappa  Chettiar THE SOCIALIST CAPITALIST, A CHETTINAD GEM AND A VISIONARY ” who  pioneered in many fields that hard  work was what led him to an incredible point of success.  There  is no denying  that everyone  wants to be a winner .But  a  child  at school must  be made aware  of the importance of  focus and hard work. Therefore, students at school must be empowered to continuously acquire skills as skills enablethemto manage hard times easily.  A sense of responsibility and concern is essential for a student throughout his/her schooling.Children must accept responsibilities at school as well as at home in a healthy fashion.</p>\r\n<p>At Dr. Alagappa Academy we have  created  a stress  free  platform  for  our  students  where they  can excel  in  extracurricular activities, in addition to  the  top curriculum  framework, inspiring  them to outshine many other studentsin a global context. Children’s minds are so impressionable that they certainly adapt to their environmental set ups.</p>\r\n<p>At Dr.Alagappa Academy, Karaikudi, every teacher has been well trained that they can empower our students to grow as optimistic individuals with strong discerning minds with an international perspective. Our educational programmes are focused and advanced that  every programme encourages  students to develop their   critical thinking  and to learn through enquiry and reason, to exchange  thoughts and  ideas to strengthen their key  personal skills  and social values to take ownership for their intended  choices and to set goals  to realize their latent, unfathomable potentials.</p>\r\n<p>It is with the burning desire mixed with a sense of deep responsibility that our teachers teach our students with high degree of technical and communication skills so that our students can get far ahead of their peers of many other schools.</p>\r\n<p>Students learning at Dr.Alagappa Academy are guided through diverse   mechanisms facilitating them to seek ways to achieve victories with dynamisms and strategies. Active educational technologies like problem based  learning and inquiry based learning are actively incorporated along with Technology and  Physical Education as they are  absolutely student centred, ideally involving  real-world scenarios in which students are actively engaged in critical thinking activities. Both teachers and students employ technology in teaching-learning processes, furthering themselves to have an easy-to- access course materials, wide participation and to obtain instant feedback. Thus, every teacher in Dr. Alagappa Academy is admirably skillful to use the advanced computer technologies   using which they are able to demonstrate new lessons with much ease. Video conferencing is one among the modern computer technologies that our teachers are quite familiar with and use in their day to day teaching in every classroom.</p>\r\n<p>At this juncture, I should make a special mention here  that in Dr. Alagappa Academy, our teachers, students and parents work in unison  as an unshakable  team, where both  teachers and parents play an important role to identify a child’s skills and interests in their very  early stages in order to provide them  apt  guidance and assistance in realizing their dreams.</p>\r\n<p>Wishing the teachers , students and parents all the best in their journey to success.</p>\r\n			\r\n			<strong>Dr.N.Sivakumar</strong><span> </span>\r\n			<br><span>Principal</span>\r\n		</div>\r\n	</div>', 1),
(7, 'ACADEMICS', 'academics', '<h3>ACADEMICS</h3>\r\n\r\n<p>OUR CBSE BASED APPROACH:</p>\r\n\r\n<p>We follow the Central Board of Secondary Education (CBSE) syllabus, widely regarded as one with the most enlightened outlook and curriculum within our education system. The core faculty of the school is a proactive team of innovative facilitators, who combine high standards of teaching with sensitivity to the emotional needs of their students.</p>\r\n\r\n<p>ENHANCED LEARNING:</p>\r\n\r\n<p>We plan our learning engagements so that concepts are taught and reinforced at school itself. Mock exams and practice sheets are given regularly to the students so that they learn well and find it easy to keep up with their academics.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<h3>PRE- PRIMARY EDUCATION</h3>\r\n\r\n	<p>The school has introduced the traditional Montessori Method of education. The teachers recognize each child as a unique individual longing to develop. The main goal of pre-primary education is to provide a stimulating, child- oriented environment that children can explore, touch and learn without fear.</p>\r\n\r\n	<p>The end result is to encourage lifelong learning the joy of learning and happiness about one&rsquo;s path and purpose in life.</p>\r\n	</li>\r\n	<li>\r\n	<h3>PRIMARY, MIDDLE &amp; SECONDARY EDUCATION</h3>\r\n\r\n	<p>At the Primary, Middle and Secondary level, the curriculum comprises the study of Languages, Mathematics, Science &amp; Social Science. We take it upon us to continually upgrade and implement innovative strategies of imparting knowledge to our students from various disciplines and make them as relevant in the context of today&rsquo;s world.</p>\r\n	</li>\r\n\r\n<li>\r\n<h3>SENIOR SECONDARY</h3>\r\n<p>THE ACADEMIC GROUPS THAT WE ARE OFFERING ARE:<br>\r\n<strong>Group I:</strong> English/Hindi, Physics, Chemistry, Mathematics, Biology, Physical Education.   \r\n<strong>Group II: </strong>    English/Hindi, Physics, Chemistry,      Mathematics, Computer Science, Physical Education \r\n<strong>Group III: </strong>  English/Hindi, Physics, Chemistry, Biology, Computer Science,Physical Education. \r\n<strong>Group IV: </strong>   English/Hindi, Business Studies, Accountancy, Economics, Computer, Science/Mathematics, Physical Education</p>\r\n</li>\r\n\r\n</ul>\r\n\r\n<h3><strong>ACHIEVEMENTS - 2019: (As provided by the School )</strong></h3>\r\n\r\n<p><strong>V.AZHAGAR RAJA of Grade VIII</strong> who has carved out a place for himself in the&nbsp;<strong>Cholan Book of World Records,</strong>&nbsp;by his 24 hrs nonstop relay demonstration of Karate Martial Art(Shadow Fight) on 29.11.2019 5 pm hrs to 30.11.2019 5 pm, held at chennai ,TN,INDIA.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Azhagar Raja\" src=\"assets/images/achiv/1.jpg\" />&nbsp;&nbsp;</p>\r\n\r\n<p><strong>S. RISHI KUMAR of grade VI</strong>I won the I prize Kargil Vijay Diwas painting competition 9(TN) Battalion NCC</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Rishi Kumar\" src=\"assets/images/achiv/2.jpg\" /></p>\r\n\r\n<p><strong>C.ATCHAY KUMAR of &nbsp;Grade IX</strong>&nbsp; won the best commander, best in drill &amp; best cadet in firing -9 (TN) Battalion&nbsp; Conducted by Ex.service men welfare association</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Atchay Kumar\" src=\"assets/images/achiv/3.jpg\" /></p>\r\n\r\n<p><strong>SGT. M. VARUNA JEYA DEVI of Grade X </strong>won the<strong> </strong>best cadet award for firing &ndash; 9(TN) Battalion</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Varuna Jeya Devi\" src=\"assets/images/achiv/4.jpg\" /></p>\r\n\r\n<p><strong>AL.PRADEEV DHANUSH of Grade VI</strong> won the IV place in the chess competition conducted by Sigaram women&rsquo;s chess club</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Pradeev Dhanush\" src=\"assets/images/achiv/5.jpg\" /></p>\r\n\r\n<p><strong>P.SRI VISHNUKA of Grade I</strong> won the II PRIZE in the chess competition conducted by Sigaram women&rsquo;s chess club</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Sri Vishnuka\" src=\"assets/images/achiv/6.jpg\" /></p>\r\n\r\n<p><strong>BYJU&rsquo;S DISCOVERY OF INDIA ROUND &ndash; 1 SELECTED STUDENTS</strong></p>\r\n\r\n<p><strong>KALAIVANI CHESS ACADEMY</strong></p>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Byju Selected 1\" src=\"assets/images/achiv/byju selected 1.jpg\" />&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Byjus Selected 2\" src=\"assets/images/achiv/byjus selected 2.jpg\" /></strong></p>\r\n\r\n<p><strong>AL.PRADEEV DHANUSH of Grade VI won the I PRIZE</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Pradeev Dhanush\" src=\"assets/images/achiv/8.jpg\" /></p>\r\n\r\n<p><strong>V.LALITHA MEENAKSHI of Grade IX won the (SPECIAL PRIZE)</strong></p>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Lalitha Meenakshi\" src=\"assets/images/achiv/9.jpg\" /></strong></p>\r\n\r\n<p><strong>V.NACHAMMAI of Grade IV (PARTICIPATION)</strong></p>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong><img alt=\"Nachammal\" src=\"assets/images/achiv/10.jpg\" /></p>\r\n\r\n<p><strong>Dr. ALAGAPPA MEMORIAL INTER SCHOOL TOURNAMENT (2019-20)</strong></p>\r\n\r\n<p><img alt=\"Alagappa Memorial Inter\" src=\"assets/images/achiv/alagappa memorial inter school tournament.jpg\" /><strong>&nbsp; &nbsp; &nbsp;</strong><img alt=\"Alagappa Memorial Tournament\" src=\"assets/images/achiv/alagappa memorial tournament.jpg\" /><strong>&nbsp; &nbsp; &nbsp;</strong><img alt=\"Alagappa Memorial\" src=\"assets/images/achiv/alagappa memorial.jpg\" /><strong>&nbsp;&nbsp;&nbsp; </strong></p>\r\n\r\n<p><strong>ROTARY CLUB &ndash; KARMELA -2019</strong></p>\r\n\r\n<p><strong>SCIENCE EXHIBITION- (PARTICIPATION)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\r\n\r\n<p><strong>ADARSH.J</strong></p>\r\n\r\n<p><strong><img alt=\"Adarsh\" src=\"assets/images/achiv/12.jpg\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>\r\n\r\n<p><strong>JOE EDWIN .S</strong></p>\r\n\r\n<p><strong><img alt=\"Joe Edwin\" src=\"assets/images/achiv/13.jpg\" />&nbsp;&nbsp; </strong></p>\r\n\r\n<p><strong>GUGANITHIN.S</strong></p>\r\n\r\n<p><strong><img alt=\"Guganithin\" src=\"assets/images/achiv/14.jpg\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>\r\n\r\n<p><strong>Our Students won the II prize in the folk dance and dumb show competition conducted by Rotary club of Karaikudi</strong></p>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Alagappa Academy\" src=\"assets/images/achiv/15.jpg\" /></strong></p>\r\n\r\n<p><strong>POOJIKA SRI.V OF Grade VIII</strong> won the I prize in the classical dance conducted by Rotary club of Karaikudi</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Poojika Sri\" src=\"assets/images/achiv/16.jpg\" /></p>\r\n\r\n<p><strong>S. LITHIKA ROSHINI of Grade VIII</strong> won the I prize in the painting competition conducted by Rotary club of Karaikudi</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Lithika Roshini\" src=\"assets/images/achiv/17.jpg\" /></p>\r\n\r\n<p><strong>VARNIKA PRAVEEN CHANDRASEKAR of Grade SKG</strong> won the I prize in the Fancy dress Competition conducted by Rotary club of Karaikudi</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Varnika Praveen\" src=\"assets/images/achiv/18.jpg\" /></p>\r\n\r\n<p><strong>A.SUJAN KUMAR of Grade IV </strong>won the I PRIZE in the Skating competition conducted by SIVAGANGA DISTRICT STUDENTS GAMES ASSOCIATION</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Sujan Kumar\" src=\"assets/images/achiv/19.jpg\" /></p>\r\n\r\n<p><strong>YOGASANA CHAMPIONSHIP THIRUMOOLAR YOGA RESEARCH CENTRE &ndash; SPECIAL PRIZE</strong></p>\r\n\r\n<p><strong>Deva Vanjinathan .A of Grade V</strong></p>\r\n\r\n<p><strong>Sri Ram.S of Grade V</strong></p>\r\n\r\n<p><strong>Sri Sanmugesh.M of Grade VII </strong></p>\r\n\r\n<p><strong>Vijay Vignesh of Grade VII</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Yogasana\" src=\"assets/images/achiv/20.jpg\" /></p>\r\n\r\n<p><strong>NITHIYASHRINI.MS won the I PRIZE</strong> in the poem recitation conducted by Kambanm Manimandabam School (State level book exhibition)</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Nithiya Shrini\" src=\"assets/images/achiv/21.jpg\" /></p>\r\n\r\n<p><strong>S.RANJANA won the II PRIZE</strong> in the poem recitation conducted by Kamban Manimandabam School (State level book exhibition)</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Ranjana\" src=\"assets/images/achiv/22.jpg\" /></p>\r\n\r\n<p><strong>HARINE .IS won the II prize</strong> in the ECMAS ABACUS conducted by online abacus competition</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Harine\" src=\"assets/images/achiv/23.jpg\" /></p>\r\n\r\n<p><strong>J.SHIRANJEEVI KUMAR of Grade IX</strong> won the &nbsp;III prize in Silambattam competition conducted by sivaganga district silambattam association</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Shiranjeevi Kumar\" src=\"assets/images/achiv/24.jpg\" /></p>\r\n\r\n<p><strong>NITHIYA&nbsp;SHRINI .MS of Grade IX</strong> - ENTERED INTO SEMI FINALS&nbsp; in Table Tennis conducted&nbsp; by&nbsp; District level table tennis tournament -2019</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Nithiya Shrini\" src=\"assets/images/achiv/25.jpg\" /></p>\r\n\r\n<p><strong>ALAGAPPA VOCATIONAL ACADEMY &ndash; YOGA COMPETITION</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"Alagappa\" src=\"assets/images/achiv/26.jpg\" /></p>\r\n\r\n<p><strong>Dinamalar Pattam Quiz competition</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Dinamalar\" src=\"assets/images/achiv/27.jpg\" /></p>\r\n\r\n<p><strong>Dinamalar Pattam Quiz competition &ndash;Selected for Semi Finals.</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Dinamalar\" src=\"assets/images/achiv/28.jpg\" /></p>\r\n\r\n<p><strong>V.AZHAGAR RAJA of Grade VIII</strong> who has carved out a place for himself in the&nbsp;<strong>Cholan Book of World Records,</strong>&nbsp;by his 24 hrs nonstop relay demonstration of Karate Martial Art(Shadow Fight) on 29.11.2019 5 pm hrs to 30.11.2019 5 pm, held at chennai ,TN,INDIA.&nbsp;&nbsp;</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img alt=\"Azhagar Raja\" src=\"assets/images/achiv/29.jpg \" /></p>\r\n\r\n<p><strong>OLYMPIAD HANDWRITING COMPETITION 2019</strong></p>\r\n\r\n<p><strong>248 STUDENTS PARTICIPATED WINNERS</strong></p>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Olympiad\" src=\"assets/images/achiv/30.jpg\" /></strong></p>\r\n\r\n<p><strong>Tamil Isai sangam conducted Bharatham Dance competition</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"Tamil Isai\" src=\"assets/images/achiv/31.jpg\" /></p>', 1),
(8, 'MODERN SMART CLASS ROOMS', 'modern-smart-class-rooms', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">MODERN SMART CLASS ROOMS</h3>\r\n		\r\n		<div>\r\n			<p>Alagappa E- Campus initiative has improved teachers effectiveness and proficiency. The installation of Interactive smart boards has improved the standards of teaching and has elevated learning to the next level by providing the following benefits</p>\r\n			<ul>\r\n				<li>Visualization makes learning an enjoyable experience for students.</li>\r\n				<li>Enable teachers to instantly assess and evaluate the learning achieved by the students.</li>\r\n				<li>Smart Class has also been observed to be highly effective in maintaining student\'s interest and engagement in the class room.</li>\r\n				<li>Interaction among the teachers and students is promoted during the smart class sections.</li>\r\n			</ul>\r\n		</div>\r\n		\r\n	</div>', 1),
(9, 'LIBRARY', 'library', '<h3>LIBRARY</h3>\r\n\r\n<p>Alagappa Academy has established a well furnished library with over 1500+ books. At our school each and every student is provided with the opportunity to learn, to enjoy reading in the library. We provide high quality education and an atmosphere furnished with all the necessary tools of learning.</p>\r\n\r\n<p>Our teachers accompany students to the libraries and thereby facilitate and promote reading</p>', 1),
(10, 'COMPUTER LAB', 'computer-lab', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">COMPUTER LAB</h3>\r\n		\r\n		\r\n		<div>\r\n			\r\n			<p>Alagappa Academy has a well equipped Computer Lab with an adequate number of computers and well-qualified teachers who are always ready to make the students understand the subject practically and theoretically.</p>\r\n			<p>Computer Course offerings for</p>\r\n			<p>Primary classes (I to V): – MS office package, Logo Programming language, Notepad, MS paint</p>\r\n			<p>Middle classes (VI to VIII): – QBASIC, Photo Editing software, Animation, HTML, Visual Basic, Flash, and Java</p>\r\n			<p>Secondary classes (IX & X): – MS Office/ Open Office, Societal impacts of IT, Basics of OS, Basics of IT, Various Information Technology tools, IT applications, spreadsheets and Internet concept.</p>\r\n		</div>\r\n		\r\n		\r\n		\r\n	</div>', 1),
(11, 'SPORT FACILITIES', 'sport-facilities', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">SPORT FACILITIES</h3>\r\n		\r\n		\r\n		<div>\r\n			\r\n			<p>At Alagappa academy there is a provision for an inbuilt sports period in the daily timetable. The school provides a wide range of indoor games and outdoor games in which students are encouraged to participate at all levels.</p>\r\n			<p>Alagappa academy has vast playgrounds for various individual and team sports like Volley Ball, Cricket, Football etc. Our sport trainers facilitate the students to excel in their selected fields and also assist them to participate in various national and state level competitions.</p>\r\n		</div>\r\n		\r\n		\r\n	</div>', 1),
(12, 'RESIDENTIAL FACILITIES', 'residential-facilities', '<h3>&nbsp;</h3>\r\n\r\n<h3>RESIDENTIAL FACILITIES</h3>\r\n\r\n<p>RESIDENTIAL FACILITIES:</p>\r\n\r\n<p>Alagappa academy provides a natural and secure abode to blossoming children, providing a personalized care to each individual. Residential facilities for boys and girls are provided separately at different buildings respectively. Life at the campus, a serene environment encourages the inner peace which is necessary for study and creativity. The hostel facility at present is available for students from class VI to XII.</p>\r\n\r\n<p>The following are the benefits at our residential complex,</p>\r\n\r\n<ul>\r\n	<li>The hostels are located in the heart of the Alagappa Group of Educational Institution campus near the school.</li>\r\n	<li>Well trained Caretakers are available for taking good care of the hostel dwellers</li>\r\n	<li>Delicious and healthy food is served at the Ritz canteen.</li>\r\n	<li>Sports and Other activities are available for the students.</li>\r\n	<li>Round-the-clock 24&times;7 security and power backup facilities to ensure a safe haven for the students.</li>\r\n</ul>', 1),
(13, 'OTHER FACILITIES', 'other-facilities', '<div class=\"row col-md-9 text-justify padding_inline\">\r\n		<h3 class=\"orangecolor inline_heading_margin_bottom\">OTHER FACILITIES</h3>\r\n				\r\n		<div>\r\n			<h4>SCHOOL TRANSPORT:</h4>\r\n			<p>Alagappa Academy maintains a fleet of safe and comfortable school buses that is available for the convenience of Day Boarders from various places in and around Karaikudi.</p>\r\n			<p>All the buses are installed with speed controlling devices for the general safety of the students and also participate in the yearly fitness certification as a part of the Quality assurance policy.</p>\r\n		</div>\r\n		\r\n		<div>\r\n			<h4>RITZ CANTEEN:</h4>\r\n			<p>Ritz Canteen with the upgrade with Hi Tech features has been established recently and could accommodate over 500+ students at a stretch. It is serviced by a very modern and hygienic kitchen. The entire management of the Ritz canteen is standardized around the best global practices.</p>\r\n			<p>Ritz canteen provides a wide range of menu, which is prepared on the advice of nutritionist to ensure that the required nutrient are made available for the students for better mental and physical growth and stability.</p>\r\n		</div>\r\n		\r\n		<div>\r\n			<h4>ALAGAPPA PARENTS APP:</h4>\r\n			<p>The Alagappa Parents app is exclusively designed to provide Real time insights on the progression of their ward and acts as a bridge between the school and the parents.</p>\r\n		</div>\r\n		\r\n		<div>\r\n			<h4>RO FACILITIES:</h4>\r\n			<p>We have installed RO Plant that enables the availability of safe and purified water for the students throughout the day.</p>\r\n		</div>\r\n		\r\n		<div>\r\n			<h4>MEDICAL CHECKUP:</h4>\r\n			<p>The school monitors the student’s health through yearly medical camps by experienced Doctors. We also have tie up with the local multi-specialty hospital for any emergencies.</p>\r\n		</div>\r\n		\r\n		<div>\r\n			<h4>ALAGAPPA ERP SYSTEM:</h4>\r\n			<p>Dr. Alagappa Academy is empowered with the Alagappa ERP Software that enables in the effective analysis of student’s performance. The digital database is maintained to actively manage the class. Day to day activities such as attendance, examinations, lesson planning etc is operated through the software.</p>\r\n			<p>The Parents are updated regularly through SMS and Voicemails. The daily students’ attendance tracking is maintained and parents receive SMS alerts in case your ward is absent to school</p>\r\n		</div>\r\n	</div>', 1),
(14, 'Achievements', 'achievements', '<h3>ACHIEVEMENTS: (As provided by the School )</h3>\r\n<!--<h4>Alagappa Academy</h4>-->\r\n\r\n<p>Scholastic Activities:</p>\r\n\r\n<p>145 Children from Grade I to Grade VII took part in the SPELL BEE competitions Conducted by &lsquo; National Spell Bee Wizard&rsquo; The children cleared the various levels and six children appeared for the National Level . The National level participants are &ndash; M.Tonya Tansy(Grade IV),S.Sahana (Grade IV), MR.Rakshana (Grade V), S.PranavRam (Grade IX), C.Jaijaswanth (Grade IX).</p>\r\n\r\n<ul>\r\n	<li>Spell Bee:</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Spell Bee.jpg\" /></p>\r\n\r\n<p>172 Children have appeared for IAIS , Conducted by Macmillan &amp; Associate.</p>\r\n\r\n<ul>\r\n	<li>IAIS (International Assessment for Indian Schools)</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa\" src=\"assets/images/achiv/IAIS 1.jpg\" /></p>\r\n\r\n<p>Participated in Kamarajar &ndash; Kalvi Valarchi Nal competitions 2018.</p>\r\n\r\n<ul>\r\n	<li>Kamarajar Academy Inter School Competitions</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa\" src=\"assets/images/achiv/Kamarajar Academy Inter School Competitions 1.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Koviloor Inter School Competitions</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa\" src=\"assets/images/achiv/Koviloor Inter School Competitions 1.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>KinsFest &ndash; 2019</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa\" src=\"assets/images/achiv/KinsFest 1.jpg\" /></p>\r\n\r\n<p>Children Grade IV to IX participated in the Basic level Competitions conducted by BJUS learning APP. 6 children were selected for the 2nd level.</p>\r\n\r\n<ul>\r\n	<li>BYJUS Learning APP</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa\" src=\"assets/images/achiv/BYJUS Learning APP 1.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Postal India Quiz</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa\" src=\"assets/images/achiv/Postal India Quiz 1.jpg\" /></p>\r\n\r\n<p>Co &ndash; Scholastic</p>\r\n\r\n<p>145 Children from Grade I to Grade VII took part in the SPELL BEE competitions Conducted by &lsquo; National Spell Bee Wizard&rsquo; The children cleared the various levels and six children appeared for the National Level . The National level participants are &ndash; M.Tonya Tansy(Grade IV),S.Sahana (Grade IV), MR.Rakshana (Grade V), S.PranavRam (Grade IX), C.Jaijaswanth (Grade IX).</p>\r\n\r\n<ul>\r\n	<li>Singing</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Co – Scholastic Singing 1.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Chess</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Chess 1.jpg\" /> <img alt=\"Alagappa \" src=\"assets/images/achiv/Chess 2.jpg\" /></p>\r\n\r\n<p>Academy children won the checkmate championship with the highest points (District level).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yoga</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Yoga.jpg\" /></p>\r\n\r\n<p>A.Deva Vanjinathan, BR.Hariharan, youngest Achievers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Athletic</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Athletic.jpg\" /></p>\r\n\r\n<p>P.Boomika &ndash; VIII,Won the 1st &amp; 2nd prizes in the district level</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Silambam</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Silambam.jpg\" /></p>\r\n\r\n<p>J.Shiranjeevi Kumar &ndash; VIII, won the 3rd prize in Tamilnadu State Sub &ndash;Junior &amp; Senior Silambam.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Swimming</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Swimming.jpg\" /></p>\r\n\r\n<p>S.Ranjana &ndash; IX, Won the 2nd prize at the district level CM Trophy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Drawing</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Drawing.jpg\" /></p>\r\n\r\n<p>S.Sahana &ndash; IV, D.Aniruth &ndash; II, S.Shravan &ndash; JKG, MR. Jayapriyan -V, J.Santhosh &ndash; IV, Participants of DESSIN Academy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Table Tennis</li>\r\n</ul>\r\n\r\n<p><img alt=\"Alagappa \" src=\"assets/images/achiv/Table Tennis.jpg\" /></p>\r\n\r\n<p>MS.Nithiya Shrini &ndash; VIII - Won the 1st prize at the district level CM Trophy.</p>', 1),
(15, 'Fire Safety', 'fire-safety', '<p>sfsfsdfsdfsdfsdfsdfsdfsdf fsd fsd fsd fsd fdsf sdfsd sfd sdfds fsdf sdf sdfsd fsd fsd fsd fsd fsdf sdf</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `event_desc` text NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `url`, `event_desc`, `status`) VALUES
(22, 'Parents Teachers committee', 'https://drive.google.com/file/d/1tOe0P-WfUXDjQlEEMQA_udUJ_gsOMvfE/view?usp=drivesdk', '', 1),
(23, 'Admission Form', 'https://alagappaacademy.com/upload/admission-form/Alagappa-Academy-School.pdf', '', 1),
(27, 'Academy Calender 2022', 'https://alagappaacademy.com/upload/academy-calender-2022.pdf', '', 1),
(28, 'Affiliation', 'https://alagappaacademy.com/upload/affiliation-senior-secondary-level-26-3-20.pdf', '', 1),
(29, 'Building Stability', 'https://alagappaacademy.com/upload/building-stability.pdf', '', 1),
(30, 'CBSE  Recognition', 'https://alagappaacademy.com/upload/CBSE-recognition-30-11-22.pdf', '', 1),
(31, 'DEO Certificate', 'https://alagappaacademy.com/upload/DEO-certificates.pdf', '', 1),
(32, 'Fire Certificate 21-22', 'https://alagappaacademy.com/upload/fire-certificate-21-22.pdf', '', 1),
(33, 'NOC', 'https://alagappaacademy.com/upload/NOC.pdf', '', 1),
(34, 'Parents Teacher Association 2022-23', 'https://alagappaacademy.com/upload/parents-teacher-association-2022-23.pdf', '', 1),
(35, 'Sanitary Certificate 21-22', 'https://alagappaacademy.com/upload/sanitary-certificate-21-22.pdf', '', 1),
(36, 'Trust Deed 1947', 'https://alagappaacademy.com/upload/trust-deed-1947.pdf', '', 1),
(37, 'Trust Deed', 'https://alagappaacademy.com/upload/trust-deed.pdf', '', 1),
(38, 'Grade X & XII Result', 'https://alagappaacademy.com/upload/last-three-year-result.jpg', '', 1),
(39, 'School Management Committee', 'https://alagappaacademy.com/upload/school-management-committee.pdf', '', 1),
(40, 'Fee Structure', 'https://alagappaacademy.com/upload/fees-structure-2022-2023.pdf', '', 1),
(41, 'Annual Day celebration 2023', 'https://fb.watch/k3xS4CJrtb/', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `small_img` varchar(250) NOT NULL,
  `big_img` varchar(250) NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `small_img`, `big_img`, `status`) VALUES
(28, 'Kamarajar Birthday Celebration 1', '19f3bab068eb5151f9e8b5ca7401b364.jpg', '19f3bab068eb5151f9e8b5ca7401b364.jpg', 1),
(29, 'Kamarajar Birthday Celebration 2', '5d7259b1fffc585017976267bb907d69.jpg', '5d7259b1fffc585017976267bb907d69.jpg', 1),
(31, 'Independence Day Celebration 2', '6c9fc4939886d3c2b79ad276e69350d1.jpg', '6c9fc4939886d3c2b79ad276e69350d1.jpg', 1),
(32, 'Independence Day Celebration 3', '6630d6739abb6cdd77367e5838a2c3f8.jpg', '6630d6739abb6cdd77367e5838a2c3f8.jpg', 1),
(33, 'Krishna Jeyanthi 1', '6928d4f0a3545d3db9733008d6a201f7.jpg', '6928d4f0a3545d3db9733008d6a201f7.jpg', 1),
(35, 'Navarathri 1', 'bf22e8264be62ca78b8d344540a1598f.jpg', 'bf22e8264be62ca78b8d344540a1598f.jpg', 1),
(36, 'Navarathri 2', 'b02682122325b65f853d6f7d27b3b19b.jpg', 'b02682122325b65f853d6f7d27b3b19b.jpg', 1),
(37, 'Diwali Celebration 2', '2c12471bd81db1554d596063f40dfe04.jpg', '2c12471bd81db1554d596063f40dfe04.jpg', 1),
(38, 'Diwali Celebration 1', '3b720af37bcaf252e6c3514218e003f7.jpg', '3b720af37bcaf252e6c3514218e003f7.jpg', 1),
(52, 'Dr. ALAGAPPA MEMORIAL INTER SCHOOL TOURNAMENT', '97958647e30ba1f2e2b343660fe7c3c6.jpg', '97958647e30ba1f2e2b343660fe7c3c6.jpg', 1),
(53, 'Dr. ALAGAPPA MEMORIAL INTER SCHOOL TOURNAMENT', '804073f104dca8b2455995636817ee50.jpg', '804073f104dca8b2455995636817ee50.jpg', 1),
(54, 'Dr. ALAGAPPA MEMORIAL INTER SCHOOL TOURNAMENT', '91b5f1e1354a5785dea5c87769ae9487.jpg', '91b5f1e1354a5785dea5c87769ae9487.jpg', 1),
(58, 'Our Students won the II prize in the folk dance and dumb show competition conducted by Rotary club of Karaikudi', '3a7f5112856a2e8feca5d36d2936586c.jpg', '3a7f5112856a2e8feca5d36d2936586c.jpg', 1),
(63, 'YOGASANA CHAMPIONSHIP THIRUMOOLAR YOGA RESEARCH CENTRE – SPECIAL PRIZE', 'e5a1d6a9b551999a111e8ec1a5c3513a.jpg', 'e5a1d6a9b551999a111e8ec1a5c3513a.jpg', 1),
(71, 'Dinamalar Pattam Quiz competition –Selected for Semi Finals.', '4a66dcef9865cc5c4aede9fdfa57ad29.jpg', '4a66dcef9865cc5c4aede9fdfa57ad29.jpg', 1),
(73, 'OLYMPIAD HANDWRITING COMPETITION 2019 - 248 STUDENTS PARTICIPATED WINNERS', '8fa2993d9251b9f171a867a514d49865.jpg', '8fa2993d9251b9f171a867a514d49865.jpg', 1),
(79, 'Merit Certificate', '68abf0b8b253295326a055936428aaac.jpg', '68abf0b8b253295326a055936428aaac.jpg', 1),
(85, 'Christmas Carol 2020', '3761696d04c2402004b8e6ceb256bd5f.jpg', '3761696d04c2402004b8e6ceb256bd5f.jpg', 1),
(86, 'Christmas Carol 2020', 'ea4083d362198ab938d336381f2830a6.jpg', 'ea4083d362198ab938d336381f2830a6.jpg', 1),
(88, 'Christmas Carols 2020', 'cdd5ae3b71febdb1812b925c59dcd7c0.jpg', 'cdd5ae3b71febdb1812b925c59dcd7c0.jpg', 1),
(89, 'Christmas Carol 2020', '019c4cf5534e2e83682dc333ce9127cb.jpg', '019c4cf5534e2e83682dc333ce9127cb.jpg', 1),
(90, 'Christmas Carol 2020', 'd45777baefcd608d8d228486ea8431e1.jpg', 'd45777baefcd608d8d228486ea8431e1.jpg', 1),
(95, 'Kindergarten activity', 'a62769c735e8d180947bf4049e831712.jpg', 'a62769c735e8d180947bf4049e831712.jpg', 1),
(97, 'Kindergarten activity', 'b5542fbdbe80bf25cfa83e21aa9c8e78.jpg', 'b5542fbdbe80bf25cfa83e21aa9c8e78.jpg', 1),
(99, 'Playtime (KG)', '96691acfc57fab12b573af58b2c8a0dd.jpg', '96691acfc57fab12b573af58b2c8a0dd.jpg', 1),
(100, 'vijayadhasami flyer', 'a4eefb18e29604047065a336d2a5e357.jpg', 'a4eefb18e29604047065a336d2a5e357.jpg', 1),
(104, 'PongalFest2021', '', '', 1),
(105, 'pongal fest2021', 'e67dc6ad2f2648c9e147c59706113157.jpg', 'e67dc6ad2f2648c9e147c59706113157.jpg', 1),
(108, 'pongal fest 2021', '12cffd90b2020bcb38e1c074b2c45e16.jpeg', '12cffd90b2020bcb38e1c074b2c45e16.jpeg', 1),
(109, 'pongal fest 2021-rangoli', '7c55939f6402bedd69accb16d6c36122.jpeg', '7c55939f6402bedd69accb16d6c36122.jpeg', 1),
(110, 'pongal fest 2021-rangoli', '083f3defdcfdd35aec22aad3e1905c48.jpeg', '083f3defdcfdd35aec22aad3e1905c48.jpeg', 1),
(111, 'pongal fest 2021', 'e073763c4e1b2052201e8a920d9ef905.jpeg', 'e073763c4e1b2052201e8a920d9ef905.jpeg', 1),
(112, 'pongal fest 2021-folkdance', '914822a07d06ebda6f4d71cc7dc02e27.jpeg', '914822a07d06ebda6f4d71cc7dc02e27.jpeg', 1),
(113, 'pongal fest 2021-fusion dance', 'f68e3817d121239a9d6f2137b628eebc.jpeg', 'f68e3817d121239a9d6f2137b628eebc.jpeg', 1),
(114, 'pongal fest 2021-folkdance', 'ccdf6bc190cbca60e00102a61650c916.jpeg', 'ccdf6bc190cbca60e00102a61650c916.jpeg', 1),
(115, 'pongal fest 2021-rangoli', 'dddc413a0ff0500dc223608a85479932.jpeg', 'dddc413a0ff0500dc223608a85479932.jpeg', 1),
(116, 'pongal fest 2021', '981e8cf8088561ae9ff98af4792ac09e.jpeg', '981e8cf8088561ae9ff98af4792ac09e.jpeg', 1),
(117, 'pongal fest 2021', 'cb0f1c9e0a5cdb39af5a31202c7e3061.jpeg', 'cb0f1c9e0a5cdb39af5a31202c7e3061.jpeg', 1),
(118, 'Broucher', 'eabf0829e7c8bb72da583afdc09791fc.jpeg', 'eabf0829e7c8bb72da583afdc09791fc.jpeg', 1),
(119, 'pongal pot', 'adbd4d82cda1b2a2530d26e9a4bfc0b8.jpeg', 'adbd4d82cda1b2a2530d26e9a4bfc0b8.jpeg', 1),
(120, 'pongal greetings', '73c7e46c9f1eb18633bc8c37080a1687.jpeg', '73c7e46c9f1eb18633bc8c37080a1687.jpeg', 1),
(121, 'yoga day', '93938acaa9effc6c1e123c328d33ebd0.jpg', '93938acaa9effc6c1e123c328d33ebd0.jpg', 1),
(122, 'prayer', '7053bd63dd4415ac74576eef076a0983.jpeg', '7053bd63dd4415ac74576eef076a0983.jpeg', 1),
(123, 'krishnajeyanthi', '5fc66cb22604b43aabfce1d6f30086da.jpg', '5fc66cb22604b43aabfce1d6f30086da.jpg', 1),
(124, 'school structure', '8777cc585504727db6b7026aaedb2f9f.jpeg', '8777cc585504727db6b7026aaedb2f9f.jpeg', 1),
(125, 'Republic Day', '19dad4ced471ae747afe8d0d902c9bd7.jpeg', '19dad4ced471ae747afe8d0d902c9bd7.jpeg', 1),
(126, '72nd Republic Day', 'ecc5813efa8cc8cfef032d8d36877503.jpeg', 'ecc5813efa8cc8cfef032d8d36877503.jpeg', 1),
(127, 'Republic Day', '2a0eeb2728baaf90ec6b87c2cf44aac8.jpeg', '2a0eeb2728baaf90ec6b87c2cf44aac8.jpeg', 1),
(128, 'Republic Day', '2d1c7e0438470c17ecc2d7b92519fbec.jpeg', '2d1c7e0438470c17ecc2d7b92519fbec.jpeg', 1),
(129, 'Republic Day', '7b850c4f820efdc3e8b249c6cbef97d6.jpeg', '7b850c4f820efdc3e8b249c6cbef97d6.jpeg', 1),
(130, 'Republic Day', '99e6498d474e42f57f7ea69e63508bee.jpeg', '99e6498d474e42f57f7ea69e63508bee.jpeg', 1),
(131, 'Republic Day', '11f50df5cc73766f77b787cc7a14f853.jpeg', '11f50df5cc73766f77b787cc7a14f853.jpeg', 1),
(132, 'Republic Day', 'cf7756015fc9e9de0e0ed7333cc5f728.jpg', 'cf7756015fc9e9de0e0ed7333cc5f728.jpg', 1),
(133, 'Republic Day', 'e9235853c38a5fcc2528665042a7415f.jpg', 'e9235853c38a5fcc2528665042a7415f.jpg', 1),
(134, 'Republic Day', '5c1cc77838521ab6b8273e418a5a0a9d.jpeg', '5c1cc77838521ab6b8273e418a5a0a9d.jpeg', 1),
(135, 'Republic Day', '68a552e6f4e85e73b041cfd1c78f7b50.jpeg', '68a552e6f4e85e73b041cfd1c78f7b50.jpeg', 1),
(136, 'Achievement 2021', 'c15862a71c87465c2d6c322af11094f6.jpg', 'c15862a71c87465c2d6c322af11094f6.jpg', 1),
(139, 'ACHIEVEMENT 2021', '89631be8ca31040b8ba6025657a42c15.jpg', '89631be8ca31040b8ba6025657a42c15.jpg', 1),
(140, 'WELCOMING', 'e03ea99cf7b3b84c9668a76f8a1b273b.jpeg', 'e03ea99cf7b3b84c9668a76f8a1b273b.jpeg', 1),
(141, 'DIWALI CELEBRATION 2021', '6486ce9fc6c51a9419f6766e3093856b.jpeg', '6486ce9fc6c51a9419f6766e3093856b.jpeg', 1),
(142, 'DIWALI MODE', '31ae554f0825dd14dd0e7a58bb7ece1a.jpeg', '31ae554f0825dd14dd0e7a58bb7ece1a.jpeg', 1),
(143, 'STUDENT ACHIEVEMENT', '53ece4bf05f6e668f57cf07bc384b3fe.jpeg', '53ece4bf05f6e668f57cf07bc384b3fe.jpeg', 1),
(144, 'VIJAYADHASAMI ADMISSION 2021', '8d4342d1787edae65436dd6ba5450942.jpeg', '8d4342d1787edae65436dd6ba5450942.jpeg', 1),
(145, 'VIJAYADHASAMI ADMISSION 2021', 'fe420c82d7a2f553bbf7293f8beb128a.jpeg', 'fe420c82d7a2f553bbf7293f8beb128a.jpeg', 1),
(146, 'CHAIRMAN VISIT', 'c4a4372c24444195f0290cf99c8b5e6f.jpeg', 'c4a4372c24444195f0290cf99c8b5e6f.jpeg', 1),
(148, 'CHILDRENS DAY CELEBRATION 2021', '382ef7eaa7fc33cfaf705526e2eecb44.jpeg', '382ef7eaa7fc33cfaf705526e2eecb44.jpeg', 1),
(149, 'SIDE VIEW OF SCHOOL BUILDING', '684e017311b52a1e58d037058a1f62cc.jpeg', '684e017311b52a1e58d037058a1f62cc.jpeg', 1),
(150, 'GOLU CELEBRATION 2021', 'f39f965bdd9568741c39fa63dee85094.jpeg', 'f39f965bdd9568741c39fa63dee85094.jpeg', 1),
(151, 'GOLU 2021', '5ff3a1df68ebbcbd956b446376290c8f.jpeg', '5ff3a1df68ebbcbd956b446376290c8f.jpeg', 1),
(152, 'GOLU 2021', 'da881ff54f41c3e6dd71b28fb45eda5b.jpeg', 'da881ff54f41c3e6dd71b28fb45eda5b.jpeg', 1),
(153, 'CHAIRMAN VISIT 2021', '1bf641b4701a469d602fc6bfb04e5ef4.jpeg', '1bf641b4701a469d602fc6bfb04e5ef4.jpeg', 1),
(154, 'CHILDRENS DAY CELEBRATION 2021', '4d7e9a6e4cc696d3a824c3afeb67139b.jpeg', '4d7e9a6e4cc696d3a824c3afeb67139b.jpeg', 1),
(155, 'ACHIEVEMENT 2021', 'bb04833fd46a96920bb86dd65bacbca9.jpeg', 'bb04833fd46a96920bb86dd65bacbca9.jpeg', 1),
(156, 'ACHIEVEMENT 2021', '8cc1347e0cf1253c98c2a6da09241c41.jpeg', '8cc1347e0cf1253c98c2a6da09241c41.jpeg', 1),
(157, 'ACHIEVEMENT 2021', '31c644f9440190e0ae5c3ab7645321db.jpeg', '31c644f9440190e0ae5c3ab7645321db.jpeg', 1),
(158, 'PLANTING', 'dc305cc96d41f879babcd1832c9ecfcf.jpeg', 'dc305cc96d41f879babcd1832c9ecfcf.jpeg', 1),
(159, 'PLANTING 2021', 'da8591096c11f7eb28f42750801569b0.jpeg', 'da8591096c11f7eb28f42750801569b0.jpeg', 1),
(160, 'HIGHER SECONDARY PARENTS MEETING 2021', '4323922beb8f988e993605579321ccb6.jpeg', '4323922beb8f988e993605579321ccb6.jpeg', 1),
(161, 'INDEPENDENCE DAY 2021', '72a7ad79f96e0f6037d37d302becb9c5.jpeg', '72a7ad79f96e0f6037d37d302becb9c5.jpeg', 1),
(163, 'INDEPENDENCE DAY 2021', 'acfd379566c763dadb53159434536122.jpeg', 'acfd379566c763dadb53159434536122.jpeg', 1),
(164, 'INDEPENDENCE DAY 2021', 'f077b015664f64a5c733dd1c48a03544.jpeg', 'f077b015664f64a5c733dd1c48a03544.jpeg', 1),
(165, 'AESTHETIC VIEW OF SCHOOL', '22ab3403773f3e8601f334f9cbb7d8f2.jpeg', '22ab3403773f3e8601f334f9cbb7d8f2.jpeg', 1),
(166, 'CHILDRENS DAY CELEBRATION 2021', 'a054b01e322cfe07b7415dc95d1b6c4d.jpeg', 'a054b01e322cfe07b7415dc95d1b6c4d.jpeg', 1),
(168, 'FIRST DAY SCHOOL REOPEN(GRADE:I TO V)', '6278e2c9e3e5ec60ae9366eaaa6d08ae.jpeg', '6278e2c9e3e5ec60ae9366eaaa6d08ae.jpeg', 1),
(169, 'FIRST DAY SCHOOL REOPEN(GRADE:VI-VII)', '06956628e5e5d542a1393b07c25c5787.jpeg', '06956628e5e5d542a1393b07c25c5787.jpeg', 1),
(170, 'DIWALI CELEBRATION 2021', '6bb8e5bc925f00bedec5bf9aa3b5fe09.jpeg', '6bb8e5bc925f00bedec5bf9aa3b5fe09.jpeg', 1),
(171, 'HONOUR MOMENT', '214ee71685bb85362ffd61520919ba02.jpeg', '214ee71685bb85362ffd61520919ba02.jpeg', 1),
(172, 'SCHOOL TOPPER(GRADE:X) 2020', 'fc912ec23fb0b4a5a5f8fa1c178b2781.jpeg', 'fc912ec23fb0b4a5a5f8fa1c178b2781.jpeg', 1),
(173, 'SCHOOL TOPPER(GRADE:X) 2020', '0bd4c1697950d314a84535738bc1eaba.jpeg', '0bd4c1697950d314a84535738bc1eaba.jpeg', 1),
(174, 'ACHIEVEMENT 2021', '6ba8cf5daca735bb0eb3e195927474f6.jpeg', '6ba8cf5daca735bb0eb3e195927474f6.jpeg', 1),
(178, 'ACHIEVEMENT 2022', 'e74cb4c9c7d99cf312236308707adf9b.jpg', 'e74cb4c9c7d99cf312236308707adf9b.jpg', 1),
(179, 'ACHIEVEMENT 2022', 'b2601c9229bae0a78e3f97f8c65dda85.png', 'b2601c9229bae0a78e3f97f8c65dda85.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `static_content`
--

CREATE TABLE `static_content` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `static_content`
--

INSERT INTO `static_content` (`id`, `type`, `content`, `status`) VALUES
(4, 'Alagappa Anthem', 'https://www.youtube.com/embed/ZzojjtcHTv0', 1),
(5, 'christmas carol 2020', 'https://drive.google.com/file/d/1OW-ufSES2DR30Hvxvbps0btpIuAn9lz9/view?usp=sharing', 1),
(6, 'christmas carol wishes 2020', 'https://drive.google.com/file/d/1kQQlaUphORsp8RCXH3B40wINVs-e6uZX/view?usp=drivesdk', 1),
(7, 'New year wishes 2021', 'https://drive.google.com/file/d/11hr_k_Vl0WxPVPI22wB0kK_4S-uKhFYm/view?usp=drivesdk', 1),
(8, 'Pongal fest 2021', 'https://drive.google.com/file/d/15GxWhYSsUxV2zLb6PYgRK7LDd9yJSHbx/view?usp=drivesdk', 1),
(9, 'Pongal Fest 2021', 'https://drive.google.com/file/d/17S1kgPR3eFghZHSqKKwTuKc3leboMzda/view?usp=sharing', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_content`
--
ALTER TABLE `static_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `static_content`
--
ALTER TABLE `static_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
