-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2015 at 10:00 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aadinath_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE IF NOT EXISTS `about_us` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `overview` text NOT NULL,
  `core_value` text NOT NULL,
  `leadership` text NOT NULL,
  `mission_n_vision` text NOT NULL,
  `brand_story` text NOT NULL,
  `testimonial` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `description`, `overview`, `core_value`, `leadership`, `mission_n_vision`, `brand_story`, `testimonial`) VALUES
(1, 'description content', 'here will be the overview', 'this text is for core value ', 'here will be the leadership section', 'mission_n_vision text here', 'brand story text will be placed in this field', 'testimonial text here...');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE IF NOT EXISTS `amenities` (
  `id` int(11) NOT NULL,
  `amenity_name` varchar(100) NOT NULL,
  `amenity_image` varchar(100) NOT NULL,
  `amenity_type_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenity_name`, `amenity_image`, `amenity_type_id`, `is_active`, `is_delete`) VALUES
(1, 'penguin1111id2', '106_Jellyfish.jpg', 1, 0, 1),
(2, 'ext_tulips', '106_Jellyfish.jpg', 2, 0, 1),
(3, '111111', '106_Jellyfish.jpg', 1, 1, 1),
(4, '22222eeeeeeee', '106_Jellyfish.jpg', 1, 1, 1),
(5, '333333', '106_Jellyfish.jpg', 1, 0, 1),
(6, '444444', '106_Jellyfish.jpg', 1, 0, 1),
(7, '55555', '106_Jellyfish.jpg', 1, 0, 1),
(8, 'wewewewew', '106_Jellyfish.jpg', 1, 1, 1),
(9, 'werwe', '106_Jellyfish.jpg', 2, 1, 1),
(10, 'sdfsdf', '106_Jellyfish.jpg', 2, 1, 1),
(11, 'ewrewr', '106_Jellyfish.jpg', 2, 1, 1),
(12, 'sdfsdfds', '106_Jellyfish.jpg', 2, 1, 1),
(13, 'Landscaped garden', '340_icon-landscape.png', 1, 1, 1),
(14, 'Commercial Shops', '881_icon-shopping.png', 2, 1, 0),
(15, 'Commercial Shops', '', 1, 1, 1),
(16, 'Badminton Court', '632_icon-indoor-games.png', 2, 1, 0),
(17, 'Parking Space', '551_icon-parking.png', 1, 1, 0),
(18, 'Water & Power Supply', '360_icon-water-power.png', 1, 1, 0),
(19, 'Earthquake Resistant', '888_icon-rcc.png', 1, 1, 0),
(20, 'Cross Ventilation', '823_icon-apartments.png', 2, 1, 0),
(21, 'Landscaped garden', '190_icon-landscape.png', 1, 1, 0),
(22, 'Landscaped garden', '593_icon-landscape.png', 1, 1, 1),
(23, 'Landscaped garden', '248_icon-landscape.png', 1, 1, 1),
(24, 'Landscaped garden', '', 1, 1, 1),
(25, 'Landscaped garden', '793_phone-icon.png', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `amenity_type_list`
--

CREATE TABLE IF NOT EXISTS `amenity_type_list` (
  `id` int(11) NOT NULL,
  `amenity_type` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenity_type_list`
--

INSERT INTO `amenity_type_list` (`id`, `amenity_type`, `is_active`) VALUES
(1, 'Internal Amenity', 1),
(2, 'External Amenity', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bannerlist`
--

CREATE TABLE IF NOT EXISTS `bannerlist` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `banner_type` int(1) NOT NULL,
  `banner_image` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bannerlist`
--

INSERT INTO `bannerlist` (`id`, `project_id`, `banner_type`, `banner_image`, `is_active`, `is_delete`, `date_created`) VALUES
(1, 1, 2, '187_add-banner1.jpg', 1, 0, '2015-06-30 08:41:56'),
(2, 1, 1, '457_lp1.jpg', 1, 0, '2015-06-30 08:42:18'),
(3, 2, 1, '431_lp1111.jpg', 1, 0, '2015-07-01 08:36:05'),
(4, 3, 1, '455_lp2222.jpg', 1, 0, '2015-07-01 08:36:22'),
(5, 4, 1, '214_lp12222.jpg', 1, 0, '2015-07-01 08:36:42'),
(6, 6, 1, '527_lp-bg.jpg', 1, 0, '2015-07-01 08:36:57'),
(7, 3, 2, '546_lp12222.jpg', 1, 0, '2015-07-01 11:33:46'),
(8, 21, 1, '729_banner.jpg', 1, 1, '2015-07-08 05:44:17'),
(11, 21, 1, '503_banner (2).jpg', 1, 1, '2015-07-08 05:55:48'),
(12, 23, 1, '182_banner (1).jpg', 1, 1, '2015-07-08 05:56:48'),
(13, 21, 1, '163_79760ee6e0_3c-lotus-boulevard-main-banner-01.jpg', 1, 0, '2015-07-13 08:49:04'),
(14, 23, 1, '474_amrapali-crystal-homes.jpg', 1, 0, '2015-07-13 08:49:28'),
(15, 24, 1, '994_aadinath banner3 copy.jpg', 1, 0, '2015-07-13 08:49:51'),
(16, 25, 1, '551_aadinath banner3--.jpg', 1, 0, '2015-07-13 08:50:16'),
(17, 25, 2, '582_banner1 copy.jpg', 1, 0, '2015-07-15 10:03:06'),
(18, 24, 2, '912_banner3 copy.jpg', 1, 1, '2015-07-15 10:52:07'),
(19, 24, 2, '348_banner5 copy.jpg', 1, 1, '2015-07-15 11:14:24'),
(20, 24, 2, '413_banner3 copy.jpg', 1, 0, '2015-07-15 11:15:03'),
(21, 29, 1, '936_aadinath banner6 .jpg', 1, 0, '2015-07-17 08:02:23'),
(22, 30, 1, '903_aadinath banner2-.jpg', 1, 0, '2015-07-17 08:21:57'),
(23, 29, 2, '416_banner6 copy.png', 1, 0, '2015-07-20 06:34:18'),
(24, 30, 2, '281_banner5 copy.jpg', 1, 0, '2015-07-20 06:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `banner_type_list`
--

CREATE TABLE IF NOT EXISTS `banner_type_list` (
  `id` int(11) NOT NULL,
  `banner_type` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_type_list`
--

INSERT INTO `banner_type_list` (`id`, `banner_type`, `is_active`) VALUES
(1, 'Hot Deals', 1),
(2, 'Project List', 1);

-- --------------------------------------------------------

--
-- Table structure for table `builders`
--

CREATE TABLE IF NOT EXISTS `builders` (
  `id` int(11) NOT NULL,
  `builder_name` varchar(100) NOT NULL,
  `builderSlug` varchar(200) NOT NULL,
  `about_builder` text NOT NULL,
  `priority` int(11) NOT NULL,
  `builder_experience` varchar(50) NOT NULL,
  `builder_image` varchar(100) NOT NULL,
  `builder_footer_image` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `builders`
--

INSERT INTO `builders` (`id`, `builder_name`, `builderSlug`, `about_builder`, `priority`, `builder_experience`, `builder_image`, `builder_footer_image`, `is_active`, `is_delete`, `date_created`) VALUES
(1, 'Builder 1', '', '<p>Builder 1</p>', 1, '10', '953_Chrysanthemum.jpg', '', 1, 1, '2015-06-02 08:23:31'),
(4, 'Builder 2', '', '<p>Builder 2</p>', 3, '5', '704_Tulips.jpg', '', 1, 1, '2015-06-06 07:50:39'),
(5, 'Amrapali', '', '<p><strong>AMRAPALI GROUP - A CONSTRUCTION MAJOR. A GIGANTIC CONGLOMERATE.</strong></p>\r\n<p>&nbsp;</p>\r\n<p>The new wave of development in India that came with the beginning of the new millennium unleashed the latent entrepreneurial energy in different enterprises including construction. Amrapali Group, started off nearly 10 years ago by its Chairman &amp; Managing Director Dr. Anil Kumar Sharma, a proud IIT alumnus, rose to the leading ranks in the real estate domain in a short span of time. Today, enjoying pan-India presence, the Group has delivered over 25 world-class projects and is developing more than 50 projects comprising residential, commercial, and IT Parks. Amrapali&rsquo;s projects delineate the skyline of Noida, satellite city of Delhi, besides various others cities from Kochi to Ranchi and endorsed by M.S. Dhoni as the brand ambassador. Consolidating on its success, Amrapali Group has impressively expanded its foray, establishing massive footprints in hospitality, healthcare, education, entertainment, and FMCG manufacturing.</p>', 0, '', '', '', 1, 1, '2015-07-04 11:42:08'),
(6, 'Amrapali', '', '<p><strong>AMRAPALI GROUP - A CONSTRUCTION MAJOR. A GIGANTIC CONGLOMERATE.</strong></p>\r\n<p>&nbsp;</p>\r\n<p>The new wave of development in India that came with the beginning of the new millennium unleashed the latent entrepreneurial energy in different enterprises including construction. Amrapali Group, started off nearly 10 years ago by its Chairman &amp; Managing Director Dr. Anil Kumar Sharma, a proud IIT alumnus, rose to the leading ranks in the real estate domain in a short span of time. Today, enjoying pan-India presence, the Group has delivered over 25 world-class projects and is developing more than 50 projects comprising residential, commercial, and IT Parks. Amrapali&rsquo;s projects delineate the skyline of Noida, satellite city of Delhi, besides various others cities from Kochi to Ranchi and endorsed by M.S. Dhoni as the brand ambassador. Consolidating on its success, Amrapali Group has impressively expanded its foray, establishing massive footprints in hospitality, healthcare, education, entertainment, and FMCG manufacturing.</p>', 1, '10 years', '465_a-logo.jpg', '', 1, 1, '2015-07-04 11:44:24'),
(7, 'Amrapali', '', '<p>Amrapali</p>', 1, '10 years', '331_i5^cimgpsh_orig.jpg', '', 1, 1, '2015-07-04 11:44:58'),
(8, 'DLF', '', '<h2>Overview</h2>\r\n<div class="contantSection">\r\n<p dir="ltr">DLF has over 68 years of track record of sustained growth, customer satisfaction, and innovation. The company has 290 msf of planned projects with 45 msf of projects under construction.</p>\r\n<p dir="ltr">DLF''s primary business is development of residential, commercial and retail properties. The company has a unique business model with earnings arising from development and rentals. Its exposure across businesses, segments and geographies, mitigates any down-cycles in the market. From developing 22 major colonies in Delhi, DLF is now present across 15 states-24 cities in India.</p>\r\n<p dir="ltr"><strong>Development Business</strong><br />The development business of DLF includes Homes and Commercial Complexes</p>\r\n<p dir="ltr">The Homes business caters to 3 segments of the residential market - Super Luxury, Luxury and Premium. The product offering involves a wide range of products including condominiums, duplexes, row houses and apartments of varying sizes.</p>\r\n<p dir="ltr">DLF is credited with introducing and pioneering the revolutionary concept of developing commercial complexes in the vicinity of residential areas. DLF has successfully launched commercial complexes and is in the process of marking its presence across various locations in India.</p>\r\n<p dir="ltr">The development business at present has 243 msf of development potential.</p>\r\n</div>', 2, '68 years ', '255_dlf.logo.png', '', 1, 1, '2015-07-04 11:57:05'),
(9, 'Amrapali', '', '<p>axa csa</p>', 1, '13', '870_amrapalisapphire.jpg', '', 1, 1, '2015-07-08 12:24:14'),
(10, 'abc', '', '<p>Property Cafe Pvt. Ltd. is an independent Real Estate Consultant with a  NCR presence. We possess vast experience and knowledge of real estate market, and  aspire to be your guide for your all property needs. We are led by a group of dynamic and visionary investors; Property Cafe  Pvt. Ltd. aims to utilize its vast knowledge of the real estate sector  to help those looking to buy property in NCR Region. -</p>\r\n<p>&nbsp;</p>\r\n<p>Property Cafe Pvt. Ltd. is an independent Real Estate Consultant with a   NCR presence. We possess vast experience and knowledge of real estate  market, and  aspire to be your guide for your all property needs. We are  led by a group of dynamic and visionary investors; Property Cafe  Pvt.  Ltd. aims to utilize its vast knowledge of the real estate sector  to  help those looking to buy property in NCR Region. -</p>\r\n<p>&nbsp;</p>\r\n<p>Property Cafe Pvt. Ltd. is an independent Real Estate Consultant with a   NCR presence. We possess vast experience and knowledge of real estate  market, and  aspire to be your guide for your all property needs. We are  led by a group of dynamic and visionary investors; Property Cafe  Pvt.  Ltd. aims to utilize its vast knowledge of the real estate sector  to  help those looking to buy property in NCR Region. -</p>', 1, '1', '848_Amrapali-Silicon-City-Banner.jpg', '', 1, 1, '2015-07-10 05:38:11'),
(11, 'Amrapali', 'amrapali', '<p style="text-align: justify;">The new wave of development in India that came  with the beginning of the new millennium unleashed the latent  entrepreneurial energy in different enterprises including construction.  Amrapali Group, started off nearly 10 years ago by its Chairman &amp;  Managing Director Dr. Anil Kumar Sharma, a proud IIT alumnus, rose to  the leading ranks in the real estate domain in a short span of time.  Today, enjoying pan-India presence, the Group has delivered over 25  world-class projects and is developing more than 50 projects comprising  residential, commercial, and IT Parks. Amrapali&rsquo;s projects delineate the  skyline of Noida, satellite city of Delhi, besides various others  cities from Kochi to Ranchi and endorsed by M.S. Dhoni as the brand  ambassador. Consolidating on its success, Amrapali Group has  impressively expanded its foray, establishing massive footprints in  hospitality, healthcare, education, entertainment, and FMCG  manufacturing.</p>', 1, '10', '615_logo.jpg', '313_logo1.png', 1, 0, '2015-07-11 05:40:27'),
(12, 'Gulshan Homz', 'gulshan-homz', '<div class="txt1">\r\n<p style="text-align: justify;">While fire, water, wind, earth and sky are the five indispensable aspects of our environment, Gulshan Homz calls quality, faith, professionalism, truthfulness and passion as the five element of its blueprint.</p>\r\n<p style="text-align: justify;">Some may term them as are our building blocks, we call them our raison d''&ecirc;tre, or to put it simply - our very essence of existence.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><strong>Mission:</strong></p>\r\n<p style="text-align: justify;">Our undying mission is to excel through Quality, Product Innovation, Technology and Up-gradation. And our eternal creed is our commitment to customers and their continual satisfaction.</p>\r\n<p style="text-align: justify;"><strong>Vision: </strong></p>\r\n<p style="text-align: justify;">To be the leader in its product line and provide unparalleled real estate services to the community.</p>\r\n<p style="text-align: justify;"><strong>Core Values: </strong></p>\r\n<ul>\r\n<li style="text-align: justify;">Striving for excellence in our work, and adhering      faithfully to the highest ethical and technical standards of our      profession and business.</li>\r\n<li style="text-align: justify;">Giving top priority to customer satisfaction through      relentless efforts to provide better services.</li>\r\n<li style="text-align: justify;">Meeting delivery timelines would be our way of valuing      the customers.</li>\r\n<li style="text-align: justify;">Fulfilling its responsibilities as a good corporate      citizen.</li>\r\n<li style="text-align: justify;">Providing good and safe working environment to all      employees.</li>\r\n<li style="text-align: justify;">Providing the equal opportunity of employment and best      use of human talent.</li>\r\n<li style="text-align: justify;">Encouraging the involvement of employees in the      planning and direction of their work and appreciating their work and      success.</li>\r\n</ul>\r\n</div>', 1, '20', '416_logo.png', '303_logo.png', 1, 0, '2015-07-11 05:46:38'),
(13, 'Ajnara', 'ajnara', '<p style="text-align: justify;">Ajnara Group is the leading real estate builder in Noida and Delhi/NCR, known to bestow a new way of life to desirous ones. It offers extensive range of flats in Noida, which includes Luxury apartments, studio apartments and Group Housing like Ambrosia, Panorama, Homes &amp; LeGarden. whether one is willing to buy 1, 2, 3, 4 BHK flat or ready to move in Flats, Ajnara fulfills it all. Ajnara has already completed projects in Vasundhra, Ghaziabad, Delhi and Noida. Along with this, it has delivered and ongoing projects in Noida and Delhi NCR.</p>\r\n<p style="text-align: justify;"><br />Ajnara is also into Hospitality, Commercial and Residential projects. View our upcoming projects which includes residential projects in Delhi NCR and commercial projects in Noida .</p>', 2, '10', '988_ajnara.jpg', '369_ajnara-white-logo.png', 1, 0, '2015-07-11 05:51:37'),
(14, 'Supertech', 'supertech', '<p style="text-align: justify;">Supertech Limited, India''s leading real estate developer was founded 25  years back in National Capital Region and since then has been scaling  new heights by each passing day. The company has set new trends of  architectural finesse in the contemporary global scenario touching the  horizons of excellence. Established under the dynamic leadership of Mr.  R. K. Arora, Supertech has led to creation of various landmark projects.  The leaders and skilled professionals of the company have worked  towards launching out of the league projects and take the real estate  sector to the next level. Supertech is the pioneer to launch the concept  of mixed-use development in India and to come up with high rise  constructions in North India.</p>', 3, '25', '552_logo_home.png', '152_logo_home.png', 1, 0, '2015-07-13 11:02:19'),
(15, 'Prateek Group', 'prateek-group', '<p class="mrgbtm Justify" style="text-align: justify;">The word ''Prateek'' in Hindi means a symbol and  that''s exactly what we are, a symbol of perfection. We''re a symbol of  the spirit that pushes on to surpass earlier benchmarks and outdo  ourselves ceaselessly. At Prateek Group, we''re not just building homes,  we''re creating a lifestyle less ordinary. Armed with passion, ambition,  commitment and driven by customer satisfaction, we have created a  formidable reputation in a short span of time.</p>\r\n<p class="mrgbtm Justify" style="text-align: justify;">Since inception, we have put our best foot  forward every single time. Being young makes us more eager to please and  it is this  fervour to give more than what''s promised that has earned  us substantial respect in a really short span of time. We are truly  thankful to our customers  and associates for trusting and being with  us.</p>\r\n<p class="mrgbtm Justify" style="text-align: justify;">Come, look at lifestyles the way we do and become a  part of the Prateek Group.</p>', 4, '10', '345_logo.png', '183_logo.png', 1, 0, '2015-07-13 12:03:33'),
(16, 'Newtech Group', 'newtech-group', '<p style="text-align: justify;">Newtech Group is founded by people who have been pioneers in the real  estate industry for over 15 years. The vast experience and expertise of  our people and the deep comprehension of the client needs brings  indispensable and valuable wisdom to the group.</p>\r\n<p style="text-align: justify;">Newtech, A leading real estate company in India, is engaged in all  key segments like residential, commercial, retail &amp; hospitality. The  company&rsquo;s operation encompasses various aspects such as land  identification &amp; acquisition, project planning, designing, marketing  and execution. To continue our efforts for expansion and growth through  true customer delight, utilizing the latest technology for     successful business and happier lifestyles. To establish everlasting  relationship with our customers by delivering unrivalled services at  fair and market competitive prices.</p>\r\n<p style="text-align: justify;">We are committed to build up the business, keeping in view, the  overall betterment of the society. All our projects, existing and under  construction reflect class, style and comfort. The journey of Newtech  Group is largely about making a difference, without compromising on  quality.</p>\r\n<p style="text-align: justify;">Our constant efforts towards improving the effectiveness of our  quality management systems make all our constructions worth emulating.  Right from raw material selection to the processing stages, till the  final product, constant quality checks are carried out. We at Newtech  strongly believe that quality is not the responsibility of a particular  department or a person, but of the organization as a whole. Quality of  the project is not compromised at any cost or at any level.</p>', 1, '15', '814_newtech_logo.png', '745_newtech_logo.png', 1, 0, '2015-07-17 07:41:16'),
(17, 'Parsvnath', 'parsvnath', '<table border="0" cellspacing="0" cellpadding="0" width="100%">\r\n<tbody>\r\n<tr>\r\n<td style="text-align: justify;" height="25" valign="top">\r\n<p>Parsvnath  																		is a  																		company  																		whose  																		business  																		philosophy  																		lies in  																		the  																		commitment  																		to  																		creating  																		architectural  																		marvels  																		using  																		state-of-the-art  																		technology  																		and  																		global  																		architectural,  																		construction  																		and  																		business  																		practices.  																		We are  																		passionate  																		about  																		providing  																		cost-effective  																		and  																		holistic  																		solutions  																		for our  																		customers  																		while  																		creating  																		and  																		adding  																		value  																		for our  																		partners  																		and  																		stakeholders.  																		Our  																		unwavering  																		focus on  																		these  																		factors  																		catapulted  																		Parsvnath  																		Developers  																		Limited  																		into the  																		top  																		echelons  																		of the  																		Indian  																		Real  																		Estate  																		and  																		Construction  																		Industry  																		in 2007.</p>\r\n<p>With a  																	pan-India  																	presence in  																	over 42  																	cities in 15  																	states, we  																	are  																	steadfastly  																	focused on  																	continuing  																	to create  																	and build  																	dreamscapes  																	that  																	transform  																	lives and  																	the world  																	around us &ndash;  																	be it  																	through  																	contemporary  																	residential  																	spaces,  																	state-of-the-art  																	office  																	complexes,  																	affordable  																	housing,  																	luxurious,  																	shopping  																	malls and  																	hypermarkets,  																	posh hotels,  																	futuristic  																	multiplexes,  																	and ultra  																	modern IT  																	Parks and  																	special  																	economic  																	zones.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="text1" style="text-align: justify;" width="100%" valign="top"><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>', 5, '20', '641_par.png', '199_par.png', 1, 0, '2015-07-27 12:46:38'),
(18, 'Goursons', 'goursons', '<p style="text-align: justify;">It&rsquo;s not what we claim. Rather it&rsquo;s what our customers say. With a proud  history of delivering projects on time and as per promised specifications,  Gaursons is a name to reckon with when it comes to real estate in NCR. With a  burgeoning list of residential projects that encompass high end apartments to  highly affordable accommodations occupied by thousands of happy families,  Gaursons stress on customer&rsquo;s trust has become the winning mantra. A fact our  customers would vouch for.</p>\r\n<p style="text-align: justify;">Gaursons India Limited needs no introduction in the world of brick and  mortar. The company has significant presence in the NCR region with  various projects successfully completed and delivered.</p>\r\n<p style="text-align: justify;">Founded in the year 1995, Gaursons India Limited has never looked back.  With a credo of chasing excellence in each and every endeavour,  Gaursons, since its inception, has been riding high on the path of  success.  Since the very beginning, the company is on a journey of  architectural excellence and customer satisfaction with a clear vision -  to not only create innovative architecture but transform real estate  vision into reality. With a long list of residential projects in Delhi  NCR, it is one of the leading builders active in the region today. This  multi-interest, multi-utility, real estate company is determined to  create new architectural marvels in the future.</p>\r\n<p style="text-align: justify;">Gaursons India Limited stands for "The synonym of trust in realty", a  fact that thousands of its customers would vouch for. With a proud  history of delivering projects on time and as per promised  specifications, Gaursons is a name to reckon with when it comes to real  estate in NCR. With a burgeoning list of residential projects, Gaursons  has been involved in providing living spaces ranging from high end  apartments to highly affordable accommodations to thousands of families  today. The company has been incessantly delivering projects on time and  with committed specifications along with stressing on the customer''s  trust which has become the winning mantra for Gaursons.</p>\r\n<p style="text-align: justify;">With its projects Gaur city, Gaur Cascades, Green Avenue, Gaur Heights,  Gaur Ganga, Gaur Homes Elegante, Gaur Grandeur and Gaur Gracious,  Gaursons has left no stone unturned in giving the best deals to its  buyers. The company''s latest projects Gaur Mulberry Mansions and Gaur  Saundaryam in Noida Extension is the latest in luxury living.</p>\r\n<p style="text-align: justify;">In 2013, Gaursons entered into the retail business with the launch of  ''Gaur Central Mall'' at RDC, Ghaziabad is an extraordinary mall blending  International standard with the effervescence of modern life.</p>\r\n<p style="text-align: justify;">Today, after successfully building number of landmarks projects and  achieving substantial amount of success in housing apartments, the  company is geared to build major townships and commercial projects  having hi-tech infrastructure and ultra-modern international facilities.  The company intends to emerge as the leading realty and space developer  in India with a future line-up of projects planned across the country.  Gaursons'' vision is to be bracketed amongst the best and most innovative  real estate developers in the country by creating value for its  customers through excellence in corporate practices and real estate  products.</p>', 50, '25', '490_gaursons-196057.png', '863_gaursons-196057.png', 1, 0, '2015-07-28 06:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `callback_interested_users`
--

CREATE TABLE IF NOT EXISTS `callback_interested_users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `date_created` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `callback_interested_users`
--

INSERT INTO `callback_interested_users` (`id`, `project_id`, `email`, `mobile`, `date_created`, `is_active`, `is_delete`) VALUES
(1, 1, 'arvind@idigroup.com', 1234567890, '2015-06-23 15:35:47', 1, 0),
(2, 1, 'arvindvi@gmail.com', 1234567890, '2015-06-24 07:58:28', 1, 0),
(3, 21, 'afdf@gmail.com', 2147483647, '2015-07-17 09:41:03', 1, 0),
(4, 21, 'aaakak@2gmail.com', 1234567891, '2015-07-20 09:43:54', 1, 0),
(5, 21, 'akash.bhardwaj590@gail.com', 2147483647, '2015-07-20 09:44:26', 1, 0),
(6, 23, 'akash.bhardwaj590@gmail.com', 2147483647, '2015-07-20 09:59:41', 1, 0),
(7, 21, 'arvind@ymail.com', 2147483647, '2015-07-23 06:08:59', 1, 0),
(8, 21, 'arvind@yay.com', 2147483647, '2015-07-23 06:57:38', 1, 0),
(9, 21, 'arvind@yay.com', 2147483647, '2015-07-23 07:02:56', 1, 0),
(10, 21, 'arvind@yay.com', 2147483647, '2015-07-23 07:10:28', 1, 0),
(11, 21, 'arvind@yay.com', 2147483647, '2015-07-23 07:27:07', 1, 0),
(12, 21, 'arvind@gmail.com', 2147483647, '2015-07-23 08:55:13', 1, 0),
(13, 21, 'arrvind@idi.com', 2147483647, '2015-07-23 08:58:23', 1, 0),
(14, 23, 'mail.discoverysolutions@gmail.com', 2147483647, '2015-07-27 09:56:42', 1, 0),
(15, 28, 'mail.discoverysolutions@gmail.com', 2147483647, '2015-07-27 09:59:54', 1, 0),
(16, 23, 'chaman.gupta115@gmail.com', 2147483647, '2015-07-28 06:56:17', 1, 0),
(17, 29, 'akash.bhardwaj590@gmail.com', 1234567890, '2015-08-07 05:28:20', 1, 0),
(18, 37, 'akash.bhardwaj590@gmail.com', 2147483647, '2015-08-08 06:42:25', 1, 0),
(19, 30, 'techlapalasia@gmail.com', 2147483647, '2015-08-11 12:59:34', 1, 0),
(20, 25, 'techlapalasia@gmail.com', 2147483647, '2015-08-11 13:01:04', 1, 0),
(21, 23, 'mail.discoverysolutions@gmail.com', 1234667890, '2015-08-12 12:13:52', 1, 0),
(22, 34, 'akash.bhardwaj590@gmail.com', 2147483647, '2015-09-21 07:18:54', 1, 0),
(23, 23, 'ajnaralegardenflats@gmail.com', 1211351351, '2015-09-24 06:55:14', 1, 0),
(24, 24, 'ajnaralegardenflats@gmail.com', 1234567890, '2015-09-24 06:57:43', 1, 0),
(25, 24, 'arvind@discoverysolutions.in', 2147483647, '2015-09-28 09:32:19', 1, 0),
(26, 26, 'arvind@discoverysolutions.in', 2147483647, '2015-10-28 07:44:38', 1, 0),
(27, 25, 'arvind@discoverysolutions.in', 2147483647, '2015-10-28 08:17:40', 1, 0),
(28, 25, 'arvind@discoverysolutions.in', 2147483647, '2015-10-28 08:18:42', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `citySlug` varchar(200) NOT NULL,
  `state_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `citySlug`, `state_id`, `is_active`, `is_delete`, `date_created`, `last_updated`) VALUES
(1, 'City 1', '', 1, 1, 0, '2015-05-26 13:02:17', '2015-06-12 08:22:14'),
(2, 'City 2', '', 1, 1, 0, '2015-05-26 15:15:44', '2015-07-02 08:34:14'),
(3, 'Noida', '', 8, 1, 0, '2015-07-04 08:38:37', '2015-07-04 08:38:37'),
(4, 'Ghaziabad', '', 12, 1, 0, '2015-07-04 09:07:56', '2015-07-04 09:07:56'),
(5, 'ghajiabad ', '', 12, 1, 0, '2015-07-04 09:13:09', '2015-07-04 09:13:09'),
(6, 'sfsdf', '', 16, 1, 1, '2015-07-04 10:50:01', '2015-07-10 07:27:22'),
(7, 'U.Noida', '', 15, 1, 0, '2015-07-04 11:05:45', '2015-07-04 11:05:45'),
(8, 'Noida', 'noida', 16, 1, 0, '2015-07-08 11:23:18', '2015-08-05 09:53:36'),
(9, 'abc', '', 16, 1, 1, '2015-07-08 11:24:27', '2015-07-08 11:24:34'),
(10, 'sfsdf', '', 13, 1, 1, '2015-07-10 07:27:29', '2015-07-10 07:27:54'),
(11, 'sfsdf', '', 13, 1, 1, '2015-07-10 07:28:01', '2015-07-10 07:28:08'),
(12, 'sfsdf', '', 16, 1, 1, '2015-07-10 07:28:16', '2015-07-11 05:23:14'),
(13, 'sfsdf', '', 16, 1, 1, '2015-07-11 05:23:25', '2015-07-11 05:23:31'),
(14, 'sfsdf', '', 16, 1, 1, '2015-07-11 05:23:39', '2015-07-11 05:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `enquired_projects`
--

CREATE TABLE IF NOT EXISTS `enquired_projects` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquired_projects`
--

INSERT INTO `enquired_projects` (`id`, `project_id`, `user_id`, `is_active`, `is_delete`, `date_created`) VALUES
(1, 34, 4, 1, 0, '2015-09-21 07:18:55'),
(2, 23, 5, 1, 0, '2015-09-24 06:55:15'),
(3, 24, 5, 1, 0, '2015-09-24 06:57:44'),
(4, 26, 11, 1, 0, '2015-10-28 07:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `homepagebanners`
--

CREATE TABLE IF NOT EXISTS `homepagebanners` (
  `id` int(11) NOT NULL,
  `banner_image_1` varchar(100) NOT NULL,
  `banner_image_2` varchar(100) NOT NULL,
  `banner_image_3` varchar(100) NOT NULL,
  `banner_image_4` varchar(100) NOT NULL,
  `banner_image_5` varchar(100) NOT NULL,
  `banner_image_6` varchar(100) NOT NULL,
  `banner_image_7` varchar(100) NOT NULL,
  `banner_image_8` varchar(100) NOT NULL,
  `banner_image_9` varchar(100) NOT NULL,
  `banner_image_10` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homepagebanners`
--

INSERT INTO `homepagebanners` (`id`, `banner_image_1`, `banner_image_2`, `banner_image_3`, `banner_image_4`, `banner_image_5`, `banner_image_6`, `banner_image_7`, `banner_image_8`, `banner_image_9`, `banner_image_10`) VALUES
(1, '272_1.jpg', '885_2.jpg', '688_3.jpg', '329_4.jpg', '719_5.jpg', '845_7.jpg', '846_9.jpg', '755_10.jpg', '935_12.jpg', '729_14.jpg'),
(2, '603_amrapalisapphire.jpg', '187_Amrapali-Silicon-City-Banner.jpg', '102_banner (1).jpg', '247_banner (2).jpg', '554_banner.jpg', '', '', '', '', ''),
(3, '500_banner (1).jpg', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `home_page`
--

CREATE TABLE IF NOT EXISTS `home_page` (
  `id` int(11) NOT NULL,
  `home_slider_image_1` varchar(100) NOT NULL,
  `home_slider_image_2` varchar(100) NOT NULL,
  `home_slider_image_3` varchar(100) NOT NULL,
  `home_slider_image_4` varchar(100) NOT NULL,
  `home_slider_image_5` varchar(100) NOT NULL,
  `home_slider_image_6` varchar(100) NOT NULL,
  `home_slider_image_7` varchar(100) NOT NULL,
  `home_slider_image_8` varchar(100) NOT NULL,
  `home_slider_image_9` varchar(100) NOT NULL,
  `home_slider_image_10` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `city_id`, `state_id`, `is_active`, `is_delete`, `date_created`, `last_updated`) VALUES
(1, 'aaaa2222', 2, 1, 1, 1, '0000-00-00 00:00:00', '2015-07-04 08:38:56'),
(2, 'bbb', 1, 1, 1, 1, '0000-00-00 00:00:00', '2015-07-04 08:38:56'),
(3, 'abcd', 1, 1, 0, 1, '0000-00-00 00:00:00', '2015-07-04 08:38:56'),
(4, 'kkkk', 2, 1, 1, 1, '0000-00-00 00:00:00', '2015-07-04 08:38:56'),
(5, 'Noida Extension', 3, 8, 1, 1, '2015-07-04 08:39:57', '2015-07-04 09:02:40'),
(6, 'Grater Noida', 8, 16, 1, 0, '2015-07-04 11:13:59', '2015-07-08 12:15:57'),
(7, 'Noida s', 7, 15, 1, 1, '2015-07-04 11:16:13', '2015-07-08 12:15:13'),
(8, 'Sec-62', 8, 16, 1, 0, '2015-07-08 11:33:16', '2015-07-08 11:33:16'),
(9, 'Sec-100', 8, 16, 1, 0, '2015-07-08 11:33:37', '2015-07-08 11:33:37'),
(10, 'Noida Extension', 8, 16, 1, 0, '2015-07-08 11:33:56', '2015-07-08 11:33:56'),
(11, 'Sec-100', 8, 16, 1, 1, '2015-07-08 11:34:16', '2015-07-08 12:14:57'),
(12, 'sec-100', 6, 13, 1, 1, '2015-07-08 12:16:40', '2015-07-08 12:16:52'),
(13, 'sec-62', 8, 16, 1, 0, '2015-07-10 07:31:57', '2015-07-10 07:31:57'),
(14, 'Sec-76', 8, 16, 1, 0, '2015-07-11 05:26:25', '2015-07-11 05:26:25'),
(15, 'Sec-118', 8, 16, 1, 0, '2015-07-14 06:11:39', '2015-07-14 06:11:39'),
(16, 'sec 10000', 8, 16, 1, 1, '2015-10-28 07:03:02', '2015-10-28 06:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `id` int(11) NOT NULL,
  `homelogo` varchar(255) NOT NULL,
  `headerlogo` varchar(255) NOT NULL,
  `bottomlogo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `homelogo`, `headerlogo`, `bottomlogo`) VALUES
(1, '636_1387546569logo.jpg', '723_1387357106Penguins.jpg', '723_1387357106Penguins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news_detail`
--

CREATE TABLE IF NOT EXISTS `news_detail` (
  `id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_msg` text NOT NULL,
  `activ_date` date NOT NULL,
  `expir_date` date NOT NULL,
  `news_img` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_delete` int(1) DEFAULT '0',
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_detail`
--

INSERT INTO `news_detail` (`id`, `news_title`, `news_msg`, `activ_date`, `expir_date`, `news_img`, `is_active`, `is_delete`, `date_created`, `last_updated`) VALUES
(13, 'dfsdsfds', 'sddsffdsdsf', '2015-06-09', '2015-06-10', 'AVI-LOGO.jpg', 0, 1, '0000-00-00 00:00:00', '2015-06-15 06:10:29'),
(14, 'ggfgff', 'gfgfgfhg', '2015-06-09', '2015-06-10', '', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(15, 'dfsdsfds', 'ffffffff', '2015-06-09', '2015-06-10', 'Qtr Page ad.jpg', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(16, 'dfsdsfds', 'lkjhgfd', '2015-06-08', '2015-06-15', 'Megazine Ad 7.5 x 10 inch.jpg', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(17, 'ggfgff', 'ffffffff', '2015-06-09', '2015-06-15', 'Full Page Print Ad.jpg', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(19, 'dfsdsfds', 'ffffffff', '2015-06-09', '2015-06-10', 'Qtr Page ad.jpg', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(23, 'rtter', 'rtrertrt', '2015-08-15', '2015-08-18', '001.JPG', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(24, 'fggfdf', 'ffdffd', '2015-08-15', '2015-08-18', '', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(25, 'rtter', 'rtrertrt', '2015-08-15', '2015-08-18', '812_001.JPG', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(26, 'rtter', 'rtrertrt', '2015-08-15', '2015-08-18', '278_001.JPG', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(27, 'fggfdf', 'rtrertrt', '2015-08-15', '2015-08-18', '833_001.JPG', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(28, 'errttrtrtrt', 'jfdjfddfshjfhfs', '2015-08-20', '2015-08-25', '681_printed-collage.jpg', 0, 1, '0000-00-00 00:00:00', '2015-07-09 06:48:15'),
(29, 'dffdfd', 'fdfddf', '2015-06-08', '2015-06-10', '979_AVI-LOGO.jpg', 0, 1, '2015-06-10 11:39:05', '2015-07-09 06:48:15'),
(30, 'dffdfd', '<p>tyyhjyhhjhgjhjhj</p>', '0000-00-00', '0000-00-00', '968_1388676648location-map.jpg', 0, 1, '2015-06-15 13:24:50', '2015-07-09 06:48:15'),
(31, 'kkkkkkkkkkkkkkkkkkk', '<p>ffgdgddggfgfgf</p>', '2015-06-15', '2015-06-30', '163_event1.jpg', 0, 1, '2015-06-15 13:33:20', '2015-07-09 06:48:15'),
(32, 'ppppppppppppp', '<p>sdfvgfvxvxcbvxcbvxvxnxvvbbxcxvcvv</p>', '2015-06-17', '2015-06-30', '999_siteplan.jpg', 0, 1, '2015-06-15 13:36:47', '2015-06-15 06:10:35'),
(33, 'Prices falling, sector hopeful for revival', '<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;</span></p>\r\n<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;<br /></span></p>', '2015-07-09', '2015-08-31', '630_logo.png', 1, 0, '2015-07-09 06:50:39', '2015-07-10 07:24:27'),
(34, 'Prices falling, sector hopeful for revival', '<p><span>For the past half-decade, the real estate sector had been reeling heavily under the severe pressure of decreasing demand, slowdown in economy and soaring property prices across the country, primarily in metro regions such as&nbsp;<a href="https:/', '2015-07-09', '2015-07-31', '122_logo.png', 0, 1, '2015-07-09 06:51:52', '2015-07-09 07:05:03'),
(35, 'a', '<p>acvds</p>', '2015-07-23', '2015-07-31', '838_phone-icon.png', 0, 1, '2015-07-09 07:06:35', '2015-07-09 07:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `page_desc` text NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_desc`, `is_active`, `date_created`, `last_updated`) VALUES
(1, 'About Us', '<p>about us</p>', 0, '2015-06-06 13:59:33', '2015-06-16 01:15:47'),
(2, 'Buying Sell', 'buying sell', 0, '2015-06-06 14:10:14', '2015-06-08 05:44:21'),
(3, 'Faq', 'faq', 0, '2015-06-06 14:10:23', '2015-06-08 05:44:43'),
(4, 'Terms and Privacy', 'terms and privacy', 0, '2015-06-06 14:10:31', '2015-06-08 05:49:01'),
(5, 'Earn with Us', '<p>earn with us</p>', 0, '2015-06-06 14:10:39', '2015-06-15 05:41:11'),
(6, 'List with Us', '', 0, '2015-06-06 14:10:46', '2015-06-06 06:40:46'),
(7, 'Contact Us', '', 0, '2015-06-06 14:10:53', '2015-06-06 06:40:53'),
(8, 'Services', '', 0, '2015-06-06 14:11:01', '2015-06-06 06:41:01'),
(9, 'Nri Services', '', 0, '2015-06-06 14:11:11', '2015-06-06 06:41:11'),
(10, 'Docs Required for Home Loan', '', 0, '2015-06-06 14:11:29', '2015-06-06 06:41:29'),
(11, 'Home Loan', '', 0, '2015-06-06 14:11:37', '2015-06-06 06:41:37'),
(12, 'Privacy', '', 0, '2015-06-06 14:11:45', '2015-06-06 06:41:45'),
(13, 'Term', '', 0, '2015-06-06 14:11:56', '2015-06-06 06:41:56'),
(14, 'Careers', '', 0, '2015-06-06 14:12:10', '2015-06-06 06:42:10'),
(15, 'Buying', '', 0, '2015-06-06 14:12:18', '2015-06-06 06:42:18'),
(16, 'Selling', '', 0, '2015-06-06 14:12:24', '2015-06-06 06:42:24'),
(17, 'Property Buying Tips', '', 0, '2015-06-06 14:12:32', '2015-06-06 06:42:32'),
(18, 'Vaastu Tips', '', 0, '2015-06-06 14:12:41', '2015-06-06 06:42:41'),
(19, 'List Your Info', '', 0, '2015-06-06 14:12:48', '2015-06-06 06:42:48'),
(20, 'NRI Services', '', 0, '2015-06-06 14:12:56', '2015-06-06 06:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `transaction_type_id` int(1) NOT NULL,
  `project_title` varchar(200) NOT NULL,
  `projectSlug` varchar(200) NOT NULL,
  `project_plan` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `builtup_area` varchar(50) NOT NULL,
  `starting_price` varchar(30) NOT NULL,
  `buildings` int(3) NOT NULL,
  `configurations` int(11) NOT NULL,
  `builder` int(11) NOT NULL,
  `possession` date NOT NULL,
  `project_desc` text NOT NULL,
  `city` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `contact` int(10) NOT NULL,
  `display_size` varchar(100) NOT NULL,
  `display_price` varchar(100) NOT NULL,
  `price_unit` varchar(50) NOT NULL,
  `search_price` varchar(50) NOT NULL,
  `has_1BHK` int(1) NOT NULL,
  `has_2BHK` int(1) NOT NULL,
  `has_3BHK` int(1) NOT NULL,
  `has_4BHK` int(1) NOT NULL,
  `has_5BHK` int(1) NOT NULL,
  `project_status` int(1) NOT NULL,
  `completion_date` datetime NOT NULL,
  `search_min_price` varchar(20) NOT NULL,
  `search_max_price` varchar(20) NOT NULL,
  `search_min_size` varchar(20) NOT NULL,
  `search_max_size` varchar(20) NOT NULL,
  `is_focused` int(1) NOT NULL,
  `order` int(1) NOT NULL,
  `amenities` varchar(100) NOT NULL,
  `slide_image_1` varchar(100) NOT NULL,
  `slide_image_2` varchar(100) NOT NULL,
  `slide_image_3` varchar(100) NOT NULL,
  `slide_image_4` varchar(100) NOT NULL,
  `slide_image_5` varchar(100) NOT NULL,
  `slide_image_6` varchar(100) NOT NULL,
  `slide_image_7` varchar(100) NOT NULL,
  `slide_image_8` varchar(100) NOT NULL,
  `slide_image_9` varchar(100) NOT NULL,
  `slide_image_10` varchar(100) NOT NULL,
  `project_image` varchar(100) NOT NULL,
  `brochure` varchar(100) NOT NULL,
  `location_map` varchar(100) NOT NULL,
  `site_plan` varchar(100) NOT NULL,
  `application_form` varchar(100) NOT NULL,
  `recommendation` int(3) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `location_advantages` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `property_type_id`, `transaction_type_id`, `project_title`, `projectSlug`, `project_plan`, `address`, `builtup_area`, `starting_price`, `buildings`, `configurations`, `builder`, `possession`, `project_desc`, `city`, `location`, `contact`, `display_size`, `display_price`, `price_unit`, `search_price`, `has_1BHK`, `has_2BHK`, `has_3BHK`, `has_4BHK`, `has_5BHK`, `project_status`, `completion_date`, `search_min_price`, `search_max_price`, `search_min_size`, `search_max_size`, `is_focused`, `order`, `amenities`, `slide_image_1`, `slide_image_2`, `slide_image_3`, `slide_image_4`, `slide_image_5`, `slide_image_6`, `slide_image_7`, `slide_image_8`, `slide_image_9`, `slide_image_10`, `project_image`, `brochure`, `location_map`, `site_plan`, `application_form`, `recommendation`, `latitude`, `longitude`, `location_advantages`, `is_active`, `is_delete`, `created_date`, `last_updated`) VALUES
(1, 3, 1, 'Project Title 1   ', '', 'Project Plan:', 'Address', 'Super Built-up Area:', '2 lac', 5, 0, 1, '2015-06-27', '<p>sfsdsafsdfds</p>', 1, 0, 2147483647, '2 lac', '767656', 'Lakh', '34534533', 0, 0, 1, 1, 1, 2, '1970-01-01 00:00:00', '5000000', '10000000', '432543', '556667', 1, 1, '1,3,4,9,10,11', '340_Chrysanthemum.jpg', '651_Desert.jpg', '807_Chrysanthemum.jpg', '609_Tulips.jpg', '271_Penguins.jpg', '', '', '', '', '', '895_Koala.jpg', '714_Jellyfish.jpg', '256_Tulips.jpg', '787_Desert.jpg', '557_Koala.jpg', 0, '28.62566', '77.37521', 'dfgfdgsfd', 1, 1, '2015-06-10 12:44:23', '2015-07-04 12:07:46'),
(2, 3, 1, '25 - 80 lac', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-09-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 2, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(3, 3, 1, 'Project Title 2   ', '', 'Project Plan:', 'Address', 'Super Built-up Area:', '2 lac', 5, 0, 4, '2015-08-27', '<p>sfsdsafsdfds</p>', 1, 0, 2147483647, '2 lac', '767656', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '5000000', '10000000', '', '', 0, 0, '1,3,4,9,10,11', '340_Chrysanthemum.jpg', '651_Desert.jpg', '807_Chrysanthemum.jpg', '609_Tulips.jpg', '271_Penguins.jpg', '', '', '', '', '', '895_Koala.jpg', '', '916_Tulips.jpg', '', '', 0, '', '', '', 1, 1, '2015-06-10 12:44:23', '2015-07-04 12:07:46'),
(4, 3, 1, 'Project Title 3   ', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2016-02-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(5, 3, 1, 'Project Title 4   ', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2016-03-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(6, 3, 1, 'Project Title 5   ', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-08-27', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(7, 3, 1, 'Project Title 5', '', 'Project Plan:', 'Address', 'Super Built-up Area:', '2 lac', 5, 0, 1, '2015-07-27', '<p>sfsdsafsdfds</p>', 1, 0, 2147483647, '2 lac', '767656', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '5000000', '10000000', '', '', 0, 0, '1,3,4,9,10,11', '340_Chrysanthemum.jpg', '651_Desert.jpg', '807_Chrysanthemum.jpg', '609_Tulips.jpg', '271_Penguins.jpg', '', '', '', '', '', '895_Koala.jpg', '', '916_Tulips.jpg', '', '', 0, '', '', '', 1, 1, '2015-06-10 12:44:23', '2015-07-04 12:07:46'),
(8, 3, 1, 'Project Title 6', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 4, '2015-07-25', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(9, 3, 1, 'Project Title 7', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-10-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(10, 3, 1, 'Project Title 8', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-11-28', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(11, 3, 1, 'Project Title 9', '', 'Project Plan:', 'Address', 'Super Built-up Area:', '2 lac', 5, 0, 4, '2015-11-27', '<p>sfsdsafsdfds</p>', 1, 0, 2147483647, '2 lac', '767656', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '5000000', '10000000', '', '', 0, 0, '1,3,4,9,10,11', '340_Chrysanthemum.jpg', '651_Desert.jpg', '807_Chrysanthemum.jpg', '609_Tulips.jpg', '271_Penguins.jpg', '', '', '', '', '', '895_Koala.jpg', '', '916_Tulips.jpg', '', '', 0, '', '', '', 1, 1, '2015-06-10 12:44:23', '2015-07-04 12:07:46'),
(12, 3, 1, 'Project Title 10', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-09-11', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(13, 3, 1, 'Project Title 11', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 4, '2015-10-15', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(14, 3, 1, 'Project Title 12', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-11-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(15, 3, 1, 'Project Title 13', '', 'Project Plan:', 'Address', 'Super Built-up Area:', '2 lac', 5, 0, 4, '2015-06-27', '<p>sfsdsafsdfds</p>', 1, 0, 2147483647, '2 lac', '767656', '', '', 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', '5000000', '10000000', '', '', 0, 0, '1,3,4,9,10,11', '340_Chrysanthemum.jpg', '651_Desert.jpg', '807_Chrysanthemum.jpg', '609_Tulips.jpg', '271_Penguins.jpg', '', '', '', '', '', '895_Koala.jpg', '', '916_Tulips.jpg', '', '', 0, '', '', '', 1, 1, '2015-06-10 12:44:23', '2015-07-04 12:07:46'),
(16, 3, 1, '25 - 80 lac', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 4, '2015-12-26', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(17, 3, 1, 'Project Title 14', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 4, '2015-08-24', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(18, 3, 1, 'Project Title 15', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-06-28', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(19, 3, 1, 'Project Title 14', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 1, '2015-06-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 1, 0, 1, 1, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(20, 3, 1, 'Project Title 15', '', 'sdf', 'sdf', 'sdfd', 'sdfd', 4, 0, 4, '2015-08-18', '<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdf</p>\r\n<p>asasdfdfasasdfdfasas</p>\r\n<p>dfdfasasdfdfasasdfdfasasdf</p>\r\n<p>dfasasdfdfasasdfdfasasdfdfasasdfdfasasdfdfasa</p>\r\n<p>sdfdfasasdfdfasasdfdfasasdfdfasasdfdfas</p>\r\n<p>asdfdfasasdfdfasasdfdfasasdfdfasasdfdfa</p>\r\n<p>sasdfdfasasdfdfas</p>', 1, 0, 54354354, 'sdfd', 'sdf', '', '', 0, 0, 0, 0, 0, 2, '0000-00-00 00:00:00', '2500000', '8000000', 'were', '454', 0, 0, '7,8,10,11', '261_Tulips.jpg', '332_Lighthouse.jpg', '182_Jellyfish.jpg', '507_Chrysanthemum.jpg', '505_Koala.jpg', '', '', '', '', '', '382_Penguins.jpg', '636_Jellyfish.jpg', '523_Penguins.jpg', '195_Koala.jpg', '740_Jellyfish.jpg', 0, 'sdfsd', 'sdfd', 'sdfdsf', 1, 1, '2015-06-15 08:14:10', '2015-07-04 12:07:46'),
(21, 4, 1, '3C LOTUS BOULEVARD', '3c-lotus-boulevard', '2 BHK - 3 BHK', 'Dadri Main Rd, Sector 102, Noida, Uttar Pradesh 201301', '1019-1860 sq.ft.', '55,84,000', 2, 0, 11, '2015-06-01', '<p style="text-align: justify;"><span>Nestled amidst 40 acres of tranquility and solace at Sec 100, Noida, Lotus Boulevard heralds an era of new world luxuries combined with suburban living. The ''Green'' features and benefits of this unique residential estate, take it much beyond any other project. Right from sprawling acres of refreshing greens populating every corner, to fresh and cool breezes streaming inside, to the cross-ventilated arrangement that guides natural light into all corners of the houses, are parts of the exceptional advantages of a lifestyle in this exquisite ''Green'' haven. As if that''s not all, it also conserves critical natural resources and huge amounts of energy &amp; living costs and lets you contribute towards making this planet a greener and healthier place.&nbsp;</span></p>\r\n<p style="text-align: justify;"><br /><span>3C Lotus Boulevard Noida 3C Portfolio includes WIPRO CAMPUS , Gurgaon &amp; PATNI CAMPUS, Noida ? PLATINUM rated LEED (Leadership in Energy and Environmental Design) certified Green Buildings under the USGBC (United States Green Building Council) umbrella. 3C Lotus Boulevard NoidaRealty verticals &ndash; Residential, Commercial, IT Parks, SEZ, School, Hospitals, Offices, Exhibition Centers etc. 3C Lotus Boulevard Noida To be globally recognised as an Integrated Green Developer that is Creating, Caring and Conserving&rdquo;.</span></p>', 8, 11, 12345678, '55,84,000', '55,84000', '', '', 0, 1, 1, 0, 0, 1, '2015-06-01 00:00:00', ' 5584000', '9501000', '1095', '1863', 0, 1, '17,18,19,14,16,20', '298_slider2.jpg', '118_slider3.jpg', '965_slider4.jpg', '212_slider5.jpg', '650_1.jpg', '141_2.jpg', '238_3.jpg', '', '', '', '893_slider2.jpg', '147_22520129_l.jpg', '464_l.jpg', '308_siteplan.jpg', '', 0, '28.54476', '77.38699', 'N/A', 1, 0, '2015-07-04 12:39:40', '2015-08-05 09:57:14'),
(22, 4, 1, '3C LOTUS BOULEVARD', '', '2bhk', 'saac', 'vdsv', 'v  vw', 0, 0, 11, '2015-07-06', '<p>vwew</p>', 7, 7, 0, 'v  vw', 'dv fd', '', '', 1, 1, 0, 0, 0, 2, '2015-07-08 00:00:00', 'sac', 'vs  af', 'fdvda', 'fdabdaf', 0, 0, '13,17,18,19,14,16,20', '952_slider2.jpg', '984_slider3.jpg', '958_slider4.jpg', '942_slider22.jpg', '', '', '', '', '', '', '696_slider5.jpg', '882_google-img.jpg', '566_locationmap.jpg', '341_siteplan.jpg', '641_kingswood.jpg', 0, '28.545241500000000000', '77.367947899999990000', 'DND Flyover - 10 minutes\r\nSector 18 - 10 minutes\r\nSec 37 Golf Course - 8 minutes\r\nConnaught Place - 25 minutes\r\nMetro Station - 8 minutes\r\nLotus Valley International School - 5 minutes\r\n', 1, 1, '2015-07-04 12:55:20', '2015-07-14 06:12:47'),
(23, 4, 1, 'Amrapali Crystal Homes', 'amrapali-crystal-homes', '3BHK', 'GH-07,Sector 76, Noida, Uttar Pradesh 201301', '1375-2175 sq.ft.', '55 L', 7, 0, 11, '2018-09-01', '<p style="text-align: justify;"><span>Amrapali Crystal Homes located at Sector 76 of Noida, is exactly as per your aspirations. This ultra-modern 3 BHK residential condominium is a right amalgamation of strategic location, tasteful ambience and enriched features. Amrapali Crystal Homes, ultra luxurious residential towers, complete with an elevated landscaped podium offers you perfect blend of elegance, nature and architecture with all modern amenities. Come, experience and indulge in the new epitome of luxurious living.</span><br /><br /><span>Crafted with immense aesthetic and gracious outlook suitable for lavish living for the most congenial people in the town, Amrapali Crystal Homes is well versed with all the technical and advanced amenities. Amrapali Builders promise the timely possession of your Dream Housing to shape your dream to reality.</span></p>', 8, 14, 4444444, '55 L', '55 - 86L', '', '', 0, 0, 1, 0, 0, 1, '2018-09-01 00:00:00', '5500000', '8600000', '1375', '2175 ', 0, 1, '17,18,19,21,14,16,20', '726_slider2.jpg', '894_slider3.jpg', '563_slider4.jpg', '782_slider5.jpg', '235_siteplancopy.jpg', '', '', '', '', '', '978_slider2.jpg', '', '483_locationmap.jpg', '392_1.jpg', '', 0, '28.584907', '77.379097', 'Near Up Coming Metro Station-78', 1, 0, '2015-07-05 06:23:21', '2015-09-30 07:00:34'),
(24, 4, 1, 'Amrapali Silicon City', 'amrapali-silicon-city', '2 BHK-3BHK', 'Sector-76 Noida ', '1035-2410 sq.ft', '50L', 27, 0, 11, '2015-06-01', '<p style="text-align: justify;">Welcome to an address that&rsquo;s more than an experience. A  sonnet that draws inspiration from 30 acres of lush greens habitat. A  gateway to an oasis of luxurious calm and quiet efficiency. The only  home where exclusivity is truly personified, extravagantly. This  luxurious experience is brought to you by, &ldquo;Amrapali Group&rdquo;, a  real-estate conglomerate in north India.</p>\r\n<p style="text-align: justify;"><br /> Silicon City is as hi-tech as its inspiration. The information  technology breakthroughs and the way it has redefined our lifestyle is  the inherent concept of silicon city. Equipped with latest technology  gizmos, constructed with new age materials. Silicon city reflects the  aesthetic amalgamation of technology and nature in creating dream homes.  With Silicon City, the Group strives towards making every abode a  gateway to royal living. Only the privileged few will have the  opportunity to call this their neighbourhood.</p>', 8, 14, 2147483647, '50L', '50-1.16Cr', '', '', 0, 1, 1, 1, 0, 2, '2015-06-01 00:00:00', '5000000', '11600000', '1035', '2410', 0, 1, '17,18,19,16,20', '225_about.jpg', '955_banner1.jpg', '552_banner2.jpg', '369_about.jpg', '177_silicon-city-bg1.jpg', '', '', '', '', '', '907_banner1.jpg', '716_sc.pdf', '238_locationmap.jpg', '704_siteplan.jpg', '', 0, '28.568746', '77.382684', 'N/A', 1, 0, '2015-07-11 06:40:07', '2015-09-29 11:53:14'),
(25, 4, 1, 'Amrapali Verona Heights', 'amrapali-verona-heights', '2BHK - 3BHK - 4 BHK ', 'GH-2, Sec-Tech Zone-4,Grater Noida', '975 - 2135 sq.ft.', '23 L', 26, 0, 11, '2018-12-01', '<p style="text-align: justify;"><span id="5018132_more">Amrapali Verona Heights is illuminated by the  light of innumerable  conveniences. The enchanting abodes-a part of  Amrapali Leisure Valley,  is a realm to relax in amidst the abundance of  amenities. The cornucopia  of facilities, will make it one of the most  sought after destinations  in Noida Extension. With a dedicated Cricket  Academy, Amrapali has yet  again confirmed its commitment to offer the  best of amenities and  facilities to youngsters and to make living an  enriching experience for  the entire family. It gives me immense  pleasure to present this stellar  project from Amrapali Group. </span></p>', 8, 10, 2147483647, '23 L', '23 Lac - 50 Lac', '', '', 0, 1, 1, 1, 0, 1, '2018-12-01 00:00:00', '2300000', '5000000', '975 sq.ft.', '2135sq.ft.', 0, 2, '17,18,19,21,14,16,20', '258_slider1.jpg', '404_slider3.jpg', '393_slider4.jpg', '590_slider5.jpg', '129_siteplan.jpg', '', '', '', '', '', '667_slider1.jpg', '674_verona_heights_brochure.pdf', '224_locationmap.jpg', '352_siteplan.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-11 06:58:58', '2015-09-29 12:04:01'),
(26, 4, 1, 'Ajnara Ambrosia', 'ajnara-ambrosia', '2BHK - 3BHK - 4 BHK', 'Sector 118, Noida', '1090 - 1995 sqft', '21.5 Lrs', 0, 0, 13, '2016-05-31', '<p style="text-align: justify;">Ajnara Ambrosia literally soaks in the spirit of nature. Ajnara Ambrosia, Spanish Living Designated to be airy and planned in a manner to be naturally lit complete with proper ventilation, the pleasure of living at Ajnara Ambrosia will simply be indescribable. Life here will be a celebration, a sheer delight unmatched by anything else.</p>', 8, 15, 2147483647, '21.5 Lrs', '21.5 Lac - 90.0 Lac', '', '', 0, 1, 1, 0, 0, 1, '2016-05-31 00:00:00', '2150000', '900000', '1090', '1995', 1, 3, '17,18,19,21,14,16,20', '311_Ajnara-Ambrosia-1.jpg', '514_ajnaraambrosianoida-img.jpg', '214_url.jpg', '503_locationmap.jpg', '371_f6.jpg', '', '', '', '', '', '955_ajnaraambrosianoida-img.jpg', '875_ambrosia-brochure.pdf', '651_locationmap.jpg', '814_siteplan.jpg', '', 0, '28.582381', '77.405645', 'N/A', 1, 0, '2015-07-14 06:41:23', '2015-08-07 07:01:23'),
(27, 4, 1, 'Ajnara Grand Heritage', 'ajnara-grand-heritage', '2BHK - 3BHK ', 'Plot No-GH-01B, Sector 74, Noida, Uttar Pradesh 201304', '1075 - 2045sqft', '56 L', 0, 0, 13, '2015-12-01', '<p style="text-align: justify;">Ajnara Grand Heritage is emerging as a new attraction in real estate,  designed and developed by Ajnara Group with a vision to satiate the  modern need of homes. With attractive price range the apartments under  this project are available in 2/3 BHK units and committed to serve  quality living experience with a mark of comfort and complete customer  satisfaction. This new residential project is ready with finest  amenities and embedded with lavish specifications giving new dimensions  to the interiors it is a composition of traditional living with modern  features. Having the exceptional way of life these homes are ranging  from 1075sqft to 1765sqft floor area. One can own these luxury homes  easily by associating with excellent purchase plan proposed by  developers with flexible options. Adding one by one successful projects  it is the most awaited property from Ajnara Group.</p>', 8, 14, 2147483647, '56 L', '56 L - 1.06 Cr', '', '', 0, 1, 1, 0, 0, 1, '2015-12-01 00:00:00', '56000000', '10600000', '1075', '2045', 1, 4, '17,19,14,16,20', '247_ajnara-grand-heritage-sector-74-noida.jpg', '759_Ajnara-heritage-1.jpg', '772_Project-Photo-63-Ajnara-Grand-Heritage-Noida-5023991_480_1366.jpg', '810_heritage-lmap-z.jpg', '587_heritage-siteplan-z.jpg', '', '', '', '', '', '775_Ajnara-heritage-1.jpg', '339_grand-heritage-brochure1.pdf', '894_heritage-lmap-z.jpg', '406_heritage-siteplan-z.jpg', '', 0, '28.575294', '77.391295', 'N/A', 1, 0, '2015-07-14 10:18:04', '2015-09-30 06:31:43'),
(28, 4, 1, 'Gulshan Vivante', 'gulshan-vivante', '2BHK - 3BHK - 4 BHK', 'Plot No. 3, Sector 16B, Noida Extension\r\nUttar Pradesh 201306\r\n', '810 -2650 sq.ft.', '48.6 Lac ', 0, 0, 12, '2019-01-01', '<p style="text-align: justify;"><span id="5010101_more">Gulshan Vivante from Gulshan Homz  offers one-of-its-kinds residential project that has been conceptualized  to match the requirements of a modern lifestyle. Gulshan Vivante  located in sector 137, Noida enjoys great connectivity, as it is only  two minutes from the Metro Station, 8 minutes from Amity Chowk, 12  minutes from Sector 18, 15 minutes from Ashram Chowk, 20 minutes from  Akshardham Temple and 25 minutes from Connaught Place. A host of amazing  amenities accompany these elegantly designed accommodations at Gulshan  Vivante. Some of them include kids play area, gym, indoor games room,  flower garden, clubhouse, swimming pool and flower gardens. Since it is  situated right on the Noida-Greate Noida Expressway, therefore most of  the basic amenities and infrastructural facilities can be found nearby. 2  BHK apartments at Gulshan Vivante cover an area size of 1080 square  feet, 3 BHK apartments cover an area size of 1175 and 2190 square feet  and 4 BHK apartments occupy an area size of 2645 square feet. The  excellent advantage of the location combined with lush green  surroundings and superb connectivity does make Gulshan Vivante one of  the best options to buy a house for investment or staying purpose. With  so many numerous benefits and advantages, Gulshan Vivante is an ideal  choice for those seeking an exceptional lifestyle. </span></p>', 8, 10, 2147483647, '48.6 Lac ', '48.6 Lac - 3.76 Cr', '', '', 0, 1, 1, 1, 0, 1, '2018-01-01 00:00:00', '48.6 Lac', ' 3.76 Cr', '810sq.ft.', '2650 sq.ft.', 0, 4, '17,18,19,21,14,16,20', '936_Gulshan_Vivante_3WOCECP1381229872.jpg', '709_Project-Photo-59-Gulshan-Vivante-Noida-5010101_972_1296.JPEG', '219_Project-Photo-57-Gulshan-Vivante-Noida-5010101_480_1366.jpg', '480_Project-Photo-57-Gulshan-Vivante-Noida-5010101_972_1296.JPEG', '271_Floor-Plan-1080.jpg', '', '', '', '', '', '588_Gulshan_Vivante_3WOCECP1381229872.jpg', '746_8913vivantebrochure.pdf', '766_gulshan-vivante-location-map.jpg', '902_site-plan.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-15 09:08:51', '2015-08-07 06:24:35'),
(29, 4, 1, ' La Palacia ', '-la-palacia-', '2BHK-3BHK', 'Block B, Noida Extension, Yakubpur, Noida, Uttar Pradesh 201305', '955 - 1425 sqft', '29.8 Lac - 50.0 Lac', 0, 0, 16, '2021-10-08', '<p style="text-align: justify;"><span id="5020147_more">The new La Palacia in the Noida  Extension is another spectacle piece made by Newtech engineered in  Noida. Noida has established itself quite well by the time but what&rsquo;s  notable is that there is a bright future waiting for the city.<br /><br />The  flats in La Palacia are equipped with exceptional amenities available  in 2 and 3 bedroom sets. There are possibilities that in future, it  would be hard to step in Noida in search of new homes but La Palacia is  affordable as well as quite a dream house for all of those who desire  flats in this developing city.<br /><br />The locality is nearby several  essential stations, including airport, railway station, shopping malls  and many more. The pollution free ambiance makes it perfect for everyone  including kids as well as old-aged ones in the family. All the material  used is top-notch quality-wise crafting a beautiful structure inside  and outside. The flats and the house, both are of 995sqft in size.<br /></span></p>', 8, 10, 2147483647, '29.8 Lac - 50.0 Lac', '29.8 Lac - 50.0 Lac', '', '', 0, 1, 1, 0, 0, 1, '2020-01-07 00:00:00', '29.8 Lac', '50.0 Lac', '955', '1425 sqft', 0, 1, '17,18,19,21,14,16,20', '663_Project-Photo-14-La-Palacia-Noida-5020147_480_1366.jpg', '260_Project-Photo-18-La-Palacia-Noida-5020147_972_1296.JPEG', '377_Site-Photos-21-La-Palacia-Noida-5020147_972_1296.JPEG', '862_Site-Photos-22-La-Palacia-Noida-5020147_972_1296.JPEG', '619_Site-Photos-23-La-Palacia-Noida-5020147_972_1296.JPEG', '', '', '', '', '', '262_Project-Photo-14-La-Palacia-Noida-5020147_480_1366.jpg', '521_Newtech-La-Palacia-Brochure.pdf', '812_location-map.png', '175_site-plan-newtechlapalacia.jpg', '329_Newtech-La-Palacia-Application-Form.pdf', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-17 07:58:45', '2015-08-05 09:58:05'),
(30, 4, 1, 'O2 Valley', 'o2-valley', '2, 3 BHK', 'GH 05, Tech Zone, Sector IV, Greater Noida, Uttar Pradesh 201308', '885 - 990 sqft', '31.0 Lac ', 0, 0, 11, '2020-01-07', '<p style="text-align: justify;"><span id="5026306_more"> </span></p>\r\n<div style="text-align: justify;">Amrapali O2 Valley by Amrapali Developers is located in Tech Zone  in Greater Noida. Location is the key as far as these apartments are  concerned. The Buddh International Circuit and International Standard  Cricket Stadium are located nearby. Moreover, the proposed Metro Station  and the upcoming Night Safari are both close by. Various schools,  hospitals and shopping malls are in the vicinity. Also, the airport is  well connected.</div>\r\n<div style="text-align: justify;">Amrapali O2 Valley covers 75  acres of lush green land. It has 2BHK apartments covering an area  ranging from 885 sq-ft to 990 sq-ft and 3BHK apartments covering an area  of 1185 sq-ft that make it possible for you to choose as per your  requirement.</div>\r\n<div style="text-align: justify;">All basic amenities and then some  more are provided to residents. There is a swimming pool, reserved  parking and club house to make your life more comfortable. Power back  up, high speed elevators and green open spaces help in enhancing the  quality of life by a great deal. The project combines the benefits of  past and present as it has internet and Wi-Fi connectivity and is also  vaastu complaint.</div>\r\n<div style="text-align: justify;">Other projects from Amprapali  Group in the vicinity include Amrapali River View, Amrapali Verona  Heights, Amrapali Kingswood, Heartbeat City and Amrapali La Residentia.</div>', 8, 6, 2147483647, '31.0 Lac ', '31.0 Lac - 34.7 Lac', '', '', 0, 1, 1, 0, 0, 1, '2018-01-01 00:00:00', '31.0 Lac', ' 34.7 Lac', '885 sqft', ' 990 sqft', 0, 4, '17,18,19,21,14,16,20', '325_2013-11-14_12-53-54.271_elevation - ----.jpg', '717_Amarpali-O2-Valley-e1384344780801.jpg', '317_amrapali-o2-valley.jpg', '517_Festive-Offer-on-2BHK-Amrapali-O2-Valley-Ph-91-9266-850-850_1.jpg', '610_pic_name_n5683_1383638738.jpg', '', '', '', '', '', '131_pic_name_n5683_1383638738.jpg', '303_amrapali-o2-valley-brochure.pdf', '262_locationl.png', '887_sitemap.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-17 08:18:31', '2015-08-07 06:30:07'),
(31, 4, 1, 'Amrapali Kingswood', 'amrapali-kingswood', '2BHK-3BHK', 'Noida Extention', '835 - 1595 sqft', '23.5 L', 15, 0, 11, '2018-12-01', '<p style="text-align: justify;"><span id="5017315_more">After grand success of Amrapali Golf  Homes we proud to present Amrapali Kings Wood new towers in Golf Homes,  Our projects are designed to bring in quality of life into everyday  living. Perfectly planned and qualitatively constructed, it is a  treasure house of amicable amenities, lavish luxuries and cool  conveniences all ingredients that go to present a lifestyle tailor made  for the trendsetter of today. Comfort and convenience being the key  concern, the architectural edifices have been circumspectly premeditated  and executed. An outstanding fusion of modernity and eloquent  structural design stand here to be admired. In an effort to utilize the  space to its optimum, a widespread methodology has been adapted to  augment all the micro as well as macro details whereby the distinction  between nifty interiors and ingenious exteriors becomes almost  invisible. </span></p>', 8, 10, 2147483647, '835-1595 Sq.Ft', '23.5 Lac - 45 Lac', '', '', 0, 1, 1, 0, 0, 1, '2018-12-01 00:00:00', '2350000', '4500000', '835', '1595', 0, 5, '17,18,19,21,14,16,20', '113_amrapali-kingswood-aboutus.jpg', '498_slider4.jpg', '977_slider3.jpg', '305_slider5.jpg', '339_slider22.jpg', '', '', '', '', '', '817_amrapali-kingswood-aboutus.jpg', '786_Amrapali-Kingswood.pdf', '147_kingswood-locationmap1.jpg', '306_kingswood-siteplan1.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-23 12:30:13', '2015-10-01 09:31:06'),
(32, 4, 1, 'Amrapali Leisure Park', 'amrapali-leisure-park', '2BHK-3BHK', 'Noida Extension, Greater Noida West, Noida, Uttar Pradesh 201301', '845-1730 sq.ft.', '24Lac', 18, 0, 11, '2015-12-01', '<p style="text-align: justify;">There is a standard and peaceful environment available for the efficient  cluster taking care of the peace requirement with the added green  beauty in The Upcoming Project of Amrapali Groups named as Amrapali  Leisure Park at your easily reachable location in Noida Extension which  is a modern city of India. Here at Amrapali Leisure Park the residential  Apartments domain encompassing size range from 815 sq ft to 1680 sq ft.  for his 2/3 BHK luxury apartments.<br /> <br /> Amrapali group provides the all  luxurious amenities in his 25 acres green Leisure Park project offering  2/3 BHK residential apartments with all new amenities like 75% open and  lavish green serenity, Club Area, swimming pool and gymnasium, security  system with CCTV, visitors&rsquo; notifications, fire extinguisher system,  basic needs of the Leisure park to easily approachable hospitals,  Schools metro etc eminent water and power back up and Wi-Fi enabled  campus.</p>', 8, 10, 2147483647, '845-1730 Sq.Ft', '24 - 49.3 Lac', '', '', 0, 1, 1, 0, 0, 1, '2015-12-01 00:00:00', '2400000', '4930000', '845', '1730', 0, 6, '17,18,19,21,14,16,20', '300_14360085762.jpg', '343_pic_name_9js57_1289806856.jpg', '566_Project-Photo-55-Amrapali-Leisure-Park-Noida-5023866_480_1366.jpg', '571_leisure-park-banner1.jpg', '719_leisure-park-banner2.jpg', '', '', '', '', '', '678_14360085762.jpg', '', '147_locationmap.jpg', '251_siteplan.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-24 05:29:22', '2015-10-01 10:00:50'),
(33, 4, 1, 'Amrapali Princely Estate', 'amrapali-princely-estate', '2BHK-3BHK', 'Sector-76 Noida', '875-2410 sq.ft.', '35Lac', 20, 0, 11, '2020-07-24', '<p style="text-align: justify;">Amrapali Princely Estate is an upcoming residential project launched  by well-known Amrapali group. It is suitably located at sector 76, Noida  and sited at gated community. It is one of the most promising projects  of the city, who is offering affordable and luxurious APARTMENTS in  reasonable prices. It offers 2/3/4 BHK luxury apartments ranging the  sizes of 875 sq. ft. to 1540 sq. ft. at splendid location of the urban.  It gives the complete satisfaction for home buyers to live a splendid  life. It makes people very happy and comfortable, while launching a rich  and elite residential society to live thankfully. It spreads happiness  and prosperity just by launching world class homes in the lush greenery  landscapes.</p>\r\n<p style="text-align: justify;">Spread over 17 acres of green landscapes, the posh area is very  comfortable and splendid locality of the city. It is very suitable area  for various residential purposes. It has turned to be a splendid  locality for many residential purposes. It has rich connectivity to  nearby places of the urban for daily purposes. It launches a world class  society in which people can increase their living standard. It is very  green and peaceful area in term of delivering quality services and  affordability. In term of deluxe amenities, the project has become a  favorite choice of upcoming buyers. The project Amrapali Princely Estate  provides deluxe amenities like round clock the security concerns, 100%  power back guarantee, regular water supply, a pool for children,  multipurpose halls for various meetings and other services. It is the  excellent opportunity to move up in the natural life cycle and you can  dream a heavenly life in the world of luxurious and reliefs.</p>', 8, 14, 2147483647, '35Lac', ' 35.0 Lac - 80.5 Lac', '', '', 0, 1, 1, 0, 0, 1, '2020-07-24 00:00:00', '875sq.ft.', '2410 sq.ft.', ' 35.0 Lac', '80.5 Lac', 0, 7, '17,18,19,21,14,16,20', '180_ape_elivation.jpg', '689_slider1.jpg', '499_slider2.jpg', '709_slider3.jpg', '469_locationmap.jpg', '', '', '', '', '', '753_ape_elivation.jpg', '', '973_locationmap.jpg', '544_siteplan.jpg', '', 0, '28.568746', '77.382684', 'N/A', 1, 0, '2015-07-24 06:57:19', '2015-08-07 06:38:02'),
(34, 4, 1, 'Amrapali Riverview', 'amrapali-riverview', '2BHK-3BHK', 'Greater Noida, Uttar Pradesh', '845-1145 sq.ft.', '.20.75Lac', 7, 0, 11, '2017-12-01', '<p style="text-align: justify;"><span id="5070178_more">Amrapali River View exquisite  landscaping, water features and parks inside the complex, wide expanse  of Hindon River Bed, green belt areas-all culminate into an ambiance of  peace and serenity, presenting a breathtaking panoramic view. The  project offers the exclusivity of an independent gate community with all  amenities and a well planned infrastructure. </span></p>', 8, 6, 2147483647, '.20.75Lac', '.20.75-34Lac', '', '', 0, 1, 1, 0, 0, 1, '2017-12-01 00:00:00', '20.75', '34', '845', '1145', 0, 7, '17,18,19,21', '478_amrapali-riverview-noida-extension.jpg', '630_01.jpg', '771_river-view1-560x380.jpg', '485_location-map.jpg', '737_site-plan.jpg', '', '', '', '', '', '625_download.jpg', '', '347_location-map.jpg', '469_site-plan.jpg', '', 0, '28.474388', '77.503990', 'N/A', 1, 0, '2015-07-24 07:30:32', '2015-08-13 06:24:52'),
(35, 4, 1, 'Amrapali Tropical Garden', 'amrapali-tropical-garden', '2BHK-3BHK', 'Noida Extension, Uttar Pradesh ', '885 - 1185 sqft', '24.8 Lac ', 4, 0, 11, '2018-01-01', '<p style="text-align: justify;">Amrapali Tropical Garden is brand name projects of Amrapali Groups.  Amrapali Tropical Garden is located at Noida Extension offers 2/3/4 BHK  High-Rise apartments with full of amenities that suitable your  requirements. Amrapali Tropical Garden is the project of Amrapali Group  and the services committed to unparalleled and exceptional quality. We  work with you to make home for every dream and a dream for every  home-seeker, with Amrapali Terrace Homes we have tried to fulfill the  requirements of you! Our philosophy of honesty and transparency has  earned us the most valuable award - your faith and trust.<br /><br /> Amrapali Tropical Garden is our endeavor to create luxury space where  man and nature co-exist in perfect harmony. Homes which are upscale but  unpretentious, contemporary without being trendy, functional as well as  aesthetically enticing.<br /><br /> Amrapali Tropical Garden in a short span of time, Amrapali has developed  luxurious residential complexes, townships, family entertainment  centres, offices and commercial complexes. With its unmatched expertise  in residential development, Amrapali has developed six ultra-modern  residential colonies in and around Delhi.</p>', 8, 10, 2147483647, '24.8 Lac ', '24.8 Lac - 38.5 Lac', '', '', 0, 1, 1, 0, 0, 1, '2018-01-01 00:00:00', '24.8', ' 38.5 ', '885 ', '1185', 0, 6, '17,18,19,21', '330_slider1.jpg', '222_slider2.jpg', '823_slider3.jpg', '586_locationmap.jpg', '759_siteplan.jpg', '', '', '', '', '', '712_slider1.jpg', '', '489_locationmap.jpg', '432_siteplan.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-24 07:50:58', '2015-08-07 06:39:00'),
(36, 4, 1, 'Ajnara Homes', 'ajnara-homes', '2BHK - 3BHK - 4 BHK', 'Noida Extension', '880 - 1960 sqft', '26.5 Lac', 15, 0, 13, '2020-01-01', '<p style="text-align: justify;">Ajnara Homes are value for money homes that offer a complete modern  lifestyle within budget. Here the facilities take care of both the  necessary and the luxury, bringing within reach a lifestyle that you  have always been wanting to have. The homes here offer 2, 3 and 4  BEDROOM APARTMENTS that are well planned to ensure maximum utilization  of space. Apart from this there are facilities like AC Banquet Party  Hall, Convenient Shopping Area and Family Club with sports &amp;  recreational facilities.<br /><br /> Ajnara Homes considering its location in Greater Noida, the opportunity  becomes all the more attractive. Greater Noida is a location that offers  great connectivity and is close to Delhi and other regions of the NCR.  All these unique features make Ajnara Homes the most desired destination  for your dream home.</p>\r\n<p style="text-align: justify;"><br /><br /></p>\r\n<p style="text-align: justify;">Ajnara Homes Noida To be globally recognised as an Integrated Green Developer that is Creating, Caring and Conserving.</p>', 8, 10, 2147483647, '26.5 Lac', '26.5 Lac - 64.7 Lac', '', '', 0, 1, 1, 1, 0, 1, '2020-01-01 00:00:00', '26.5', ' 64.7', '880', '1960 ', 0, 3, '17,18,19', '217_slider1.jpg', '477_slider3.jpg', '827_slider4.jpg', '103_slider5.jpg', '428_siteplan.jpg', '', '', '', '', '', '612_slider1.jpg', '579_home-brochure.pdf', '340_locationmap copy.jpg', '731_siteplan.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-24 08:57:10', '2015-08-10 09:53:04'),
(37, 4, 1, 'Ajnara Le Garden', 'ajnara-le-garden', '2BHK-3BHK', 'Noida Extension', '810-1795 sq.ft.', '23.6 Lac', 17, 0, 11, '2017-07-01', '<p style="text-align: justify;">Ajnara Group has launched the most awating luxury appartments, Ajnara Le  Garden appartments at Noida Extn. Ajnara Le Garden at Noida Extn is  equipped with all modern amenities, state of the art infrastructure and  everything that you need for a comfortable living. There is round the  clock security, continuous electricity and water supply and power back  up. Ajnara Le Garden appartments are beautifully spreading over acres of  prime land at Noida Extn with proposed Schools, Shopping  Malls,Commercial Complex &amp; Club with Swimming Pool, Tennis Court,  Gym etc.</p>', 8, 10, 2147483647, '23.6 Lac', '23.6 Lac - 55.2 Lac', '', '', 0, 1, 1, 0, 0, 1, '2017-07-01 00:00:00', '23.6', ' 55.2', '810', '1795', 0, 10, '17,18,19,21', '441_slider1.jpg', '377_slider2.jpg', '633_slider3.jpg', '498_location-map.jpg', '762_siteplan.jpg', '', '', '', '', '', '342_slider1.jpg', '156_legarden_brochure.pdf', '299_location-map.jpg', '253_siteplan copy.jpg', '', 0, '28.531869', '77.400800', 'N/A', 1, 0, '2015-07-24 10:32:51', '2015-08-10 09:23:48'),
(38, 4, 1, 'd', 'd', '2BHK-3BHK', 'asc babvja', '183', '20.75Lac', 31, 0, 11, '2015-12-12', '<p>jbvjsdbvjbndssvnb</p>', 8, 9, 2147483647, '20.75Lac', '23.6 Lac - 55.2 Lac', '', '', 0, 1, 1, 0, 0, 1, '2015-09-19 00:00:00', '23.67', '55.2', '810', '1795', 0, 12, '19,20', '974_f1.jpg', '191_f2.jpg', '114_f3.jpg', '912_f4.jpg', '468_locationmap.jpg', '', '', '', '', '', '299_siteplan.jpg', '401_f1.jpg', '105_locationmap.jpg', '346_siteplan.jpg', '944_f1.jpg', 0, '28.531869', '77.400800', 'n/a', 1, 1, '2015-07-31 05:15:06', '2015-08-08 07:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `project_floor_plan`
--

CREATE TABLE IF NOT EXISTS `project_floor_plan` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `plan_type` varchar(100) NOT NULL,
  `bhk_type` int(1) NOT NULL,
  `size` int(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `price_unit` varchar(50) NOT NULL,
  `search_price` int(50) NOT NULL,
  `floor_plan_image` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_floor_plan`
--

INSERT INTO `project_floor_plan` (`id`, `project_id`, `plan_type`, `bhk_type`, `size`, `unit`, `price`, `price_unit`, `search_price`, `floor_plan_image`, `is_active`, `is_delete`, `created_date`, `last_updated`) VALUES
(1, 1, '3 Bedroom', 0, 1942, 'Sqft', 2, 'Cr', 15000000, '953_Desert.jpg', 1, 1, '2015-06-12 13:42:22', '2015-07-05 06:47:13'),
(2, 1, '4 Bedroom', 0, 3025, 'Sqft', 5, 'Cr', 54000000, '423_Jellyfish.jpg', 1, 1, '2015-06-12 13:43:21', '2015-07-05 06:47:13'),
(3, 1, '5 Bedroom', 0, 5025, 'Sqft', 7, 'Cr', 74000000, '828_Lighthouse.jpg', 1, 1, '2015-06-12 13:44:23', '2015-07-05 06:47:13'),
(4, 2, '3 Bedroom', 0, 1942, 'Sqft', 4, 'Cr', 35000000, '', 1, 1, '2015-06-15 13:06:43', '2015-07-05 06:47:13'),
(5, 1, '2 Bedroom', 0, 1000, 'Sqft', 90, 'L', 9000000, '367_Hydrangeas.jpg', 1, 1, '2015-06-15 15:00:12', '2015-07-02 11:11:18'),
(6, 3, '2 Bedroom', 0, 1690, 'Sqft', 75, 'L', 7500000, '325_Chrysanthemum.jpg', 1, 1, '2015-06-29 11:23:19', '2015-07-05 06:47:13'),
(7, 4, '3 Bedroom', 0, 2500, 'Sqft', 90, 'L', 9000000, '550_Jellyfish.jpg', 1, 1, '2015-06-29 11:24:19', '2015-07-05 06:47:13'),
(8, 5, '4 Bedroom', 0, 3025, 'Sqft', 2, 'Cr', 15000000, '482_Tulips.jpg', 1, 1, '2015-06-29 11:26:38', '2015-07-05 06:47:13'),
(9, 8, '4 Bedroom', 0, 2500, 'Sqft', 2, 'Cr', 20000000, '554_Jellyfish.jpg', 1, 1, '2015-06-29 11:28:27', '2015-07-05 06:47:13'),
(10, 10, '5 Bedroom', 0, 3500, 'Sqft', 2, 'Cr', 18000000, '138_Desert.jpg', 1, 1, '2015-06-29 11:29:45', '2015-07-05 06:47:13'),
(11, 11, '3 Bedroom', 0, 2500, 'Sqft', 90, 'L', 9000000, '383_Koala.jpg', 1, 1, '2015-06-29 11:31:28', '2015-07-05 06:47:13'),
(12, 12, '5 Bedroom', 0, 3000, 'Sqft', 2, 'Cr', 19000000, '620_Hydrangeas.jpg', 1, 1, '2015-06-29 11:37:55', '2015-07-05 06:47:13'),
(13, 23, '3bhk', 3, 1375, 'sqft', 55, 'L', 5000000, '214_f1.jpg', 1, 0, '2015-07-06 06:09:13', '2015-09-28 11:49:16'),
(14, 23, '3bhk', 3, 1700, 'sqft', 67, 'L', 6500000, '161_f2.jpg', 1, 0, '2015-07-06 06:10:30', '2015-09-28 11:49:26'),
(15, 23, '3bhk', 3, 2140, 'sqft', 85, 'L', 8000000, '892_f3.jpg', 1, 0, '2015-07-06 06:11:25', '2015-09-28 11:49:34'),
(16, 23, '3bhk', 3, 2175, 'sqft', 86, 'L', 8500000, '879_f4.jpg', 1, 0, '2015-07-06 06:12:37', '2015-09-28 11:49:49'),
(17, 23, '3 BED + 2 TOILET', 0, 1375, 'Sqft', 63, 'L', 60, '550_f1.jpg', 1, 1, '2015-07-06 06:14:06', '2015-07-06 06:29:28'),
(18, 23, '3 BED + 2 TOILET', 0, 1375, 'Sqft', 63, 'L', 0, '567_locationmap.jpg', 1, 1, '2015-07-06 06:28:03', '2015-07-06 06:31:50'),
(19, 23, '2bhk', 0, 1300, 'sqft', 55, 'L', 5500000, '539_wuddco140-14-OE5evQI2UMBgOwDqp2nH$E1Tu-amrapali-verona-heights-banner.jpg', 1, 1, '2015-07-10 07:01:45', '2015-07-23 11:13:51'),
(20, 24, '2bhk', 2, 1035, 'sqft', 50, 'L', 5000000, '963_1035.jpg', 1, 0, '2015-07-11 07:03:20', '2015-09-29 11:42:22'),
(21, 24, '2bhk', 2, 1180, 'sqft', 57, 'L', 5700000, '432_1180.jpg', 1, 0, '2015-07-11 07:04:13', '2015-09-29 11:43:04'),
(22, 24, '3bhk', 3, 1420, 'sqft', 68, 'L', 6500000, '650_1420.jpg', 1, 0, '2015-07-11 07:05:08', '2015-09-29 11:43:48'),
(23, 24, '3bhk', 3, 1545, 'sqft', 74, 'L', 7400000, '318_1545.jpg', 1, 0, '2015-07-11 07:06:12', '2015-09-29 11:44:30'),
(24, 24, '3bhk', 3, 1835, 'sqft', 88, 'L', 8500000, '502_1835.jpg', 1, 0, '2015-07-11 07:07:19', '2015-09-29 11:45:32'),
(25, 25, '2bhk', 2, 975, 'sqft', 23, 'L', 2300000, '865_f1.jpg', 1, 0, '2015-07-11 07:10:45', '2015-09-29 12:08:45'),
(26, 25, '2bhk', 2, 1000, 'sqft', 23, 'L', 2300000, '904_f2.jpg', 1, 0, '2015-07-11 07:11:38', '2015-09-29 12:09:25'),
(27, 25, '2bhk', 2, 1100, 'sqft', 25, 'L', 2500000, '151_f3.jpg', 1, 0, '2015-07-11 07:12:47', '2015-09-29 12:09:54'),
(28, 25, '3bhk', 3, 1220, 'sqft', 28, 'L', 2500000, '768_f4.jpg', 1, 0, '2015-07-11 07:13:34', '2015-09-29 12:10:16'),
(29, 25, '3bhk', 3, 1450, 'sqft', 34, 'L', 3400000, '176_f7.jpg', 1, 0, '2015-07-11 07:14:32', '2015-09-29 12:10:33'),
(30, 21, '2bhk', 2, 1019, 'sqft', 35, 'L', 3500000, '469_f1.jpg', 1, 0, '2015-07-13 05:02:52', '2015-08-26 06:46:16'),
(31, 21, '2bhk', 2, 1135, 'sqft', 40, 'L', 4000000, '504_f2.jpg', 1, 0, '2015-07-13 05:04:19', '2015-08-26 06:46:22'),
(32, 21, '2bhk', 2, 1343, 'sqft', 50, 'L', 5000000, '920_f3.jpg', 1, 0, '2015-07-13 05:06:14', '2015-08-26 06:46:29'),
(33, 21, '3bhk', 3, 1691, 'sqft', 55, 'L', 5500000, '134_f4.jpg', 1, 0, '2015-07-13 05:07:17', '2015-08-26 06:46:36'),
(34, 21, '3bhk', 3, 1702, 'sqft', 60, 'L', 6000000, '430_f5.jpg', 1, 0, '2015-07-13 05:09:51', '2015-08-26 06:46:43'),
(35, 26, '2bhk', 2, 1095, 'sqft', 21, 'L', 2100000, '232_f1.jpg', 1, 0, '2015-07-14 08:51:00', '2015-08-26 06:47:58'),
(36, 26, '2bhk', 2, 1255, 'sqft', 25, 'L', 2500000, '815_f2.jpg', 1, 0, '2015-07-14 08:53:10', '2015-08-26 06:48:04'),
(37, 26, '3bhk', 3, 1475, 'sqft', 30, 'L', 3000000, '534_f3.jpg', 1, 0, '2015-07-14 08:57:16', '2015-08-26 06:48:08'),
(38, 26, '3bhk', 3, 1650, 'sqft', 40, 'L', 4000000, '961_f4.jpg', 1, 0, '2015-07-14 08:58:41', '2015-08-26 06:48:13'),
(39, 26, '3bhk', 3, 1795, 'sqft', 45, 'L', 4500000, '476_f5.jpg', 1, 0, '2015-07-14 08:59:48', '2015-08-26 06:48:19'),
(40, 26, '3bhk', 3, 1795, 'sqft', 50, 'L', 5000000, '795_f6.jpg', 1, 0, '2015-07-14 09:01:52', '2015-08-26 06:48:25'),
(41, 26, '3bhk', 3, 1795, 'sqft', 90, 'L', 9000000, '793_f7.jpg', 1, 0, '2015-07-14 09:03:53', '2015-08-26 06:48:30'),
(42, 27, '2bhk', 2, 1075, 'sqft', 56, 'L', 5600000, '465_f1.jpg', 1, 0, '2015-07-14 10:20:07', '2015-09-30 06:19:43'),
(43, 27, '2bhk', 2, 1195, 'sqft', 62, 'L', 6000000, '530_f2.jpg', 1, 0, '2015-07-14 10:21:08', '2015-09-30 06:20:03'),
(44, 27, '2bhk', 2, 1230, 'sqft', 64, 'L', 6400000, '764_f3.jpg', 1, 0, '2015-07-14 10:22:04', '2015-09-30 06:20:25'),
(45, 27, '2bhk', 2, 1295, 'sqft', 67, 'L', 6500000, '449_f4.jpg', 1, 0, '2015-07-14 10:25:35', '2015-09-30 06:20:51'),
(46, 27, '2bhk', 2, 1325, 'sqft', 69, 'L', 6500000, '976_405_f5 copy.jpg', 1, 0, '2015-07-14 10:26:39', '2015-09-30 06:40:01'),
(47, 27, '3bhk', 3, 1440, 'sqft', 75, 'L', 7500000, '332_f6.jpg', 1, 0, '2015-07-14 11:39:35', '2015-09-30 06:21:58'),
(48, 27, '3bhk', 3, 1545, 'sqft', 80, 'L', 8000000, '962_f7.jpg', 1, 0, '2015-07-14 11:41:05', '2015-09-30 06:22:18'),
(49, 27, '3bhk', 3, 1655, 'sqft', 86, 'L', 8500000, '772_1655.jpg', 1, 0, '2015-07-14 12:29:45', '2015-09-30 06:50:06'),
(50, 27, '3bhk', 3, 1690, 'sqft', 88, 'L', 8500000, '927_f9.jpg', 1, 0, '2015-07-14 12:39:00', '2015-09-30 06:23:11'),
(51, 27, '3bhk', 3, 1395, 'sqft', 72.5, 'L', 7000000, '412_1395.jpg', 1, 0, '2015-07-15 05:23:47', '2015-09-30 06:49:37'),
(52, 27, '3bhk', 3, 1795, 'sqft', 93, 'L', 9000000, '745_1795.jpg', 1, 0, '2015-07-15 05:26:44', '2015-09-30 06:27:04'),
(53, 27, '3bhk', 3, 1815, 'sqft', 94.5, 'L', 9000000, '455_f12.jpg', 1, 0, '2015-07-15 05:29:43', '2015-09-30 06:24:20'),
(54, 27, '3bhk', 3, 2025, 'sqft', 1.05, 'Cr', 10000000, '709_f13.jpg', 1, 0, '2015-07-15 05:31:35', '2015-09-30 06:24:55'),
(55, 27, '3bhk', 3, 2045, 'sqft', 1.06, 'Cr', 10000000, '368_f14.jpg', 1, 0, '2015-07-15 05:42:32', '2015-09-30 06:25:21'),
(56, 28, '2bhk', 2, 1080, 'sqft', 30, 'L', 3000000, '191_Floor-Plan-1080.jpg', 1, 0, '2015-07-15 09:34:20', '2015-08-26 07:42:38'),
(57, 29, '2BHK', 2, 995, 'sqft', 30, 'L', 3000000, '738_2bhk-995-floor-plan.jpg', 1, 0, '2015-07-17 08:00:35', '2015-08-10 06:54:39'),
(58, 29, '2BHK', 2, 1165, 'sqft', 40, 'L', 4000000, '723_2bhk-1165-floor-plan.jpg', 1, 0, '2015-07-17 08:01:15', '2015-08-10 06:54:52'),
(59, 29, '3BHK', 3, 1425, 'sqft', 55, 'L', 5500000, '810_3bhk-1425-floor-plan.jpg', 1, 0, '2015-07-17 08:01:53', '2015-08-10 06:55:02'),
(60, 30, '2bhk', 2, 900, 'sqft', 30, 'L', 3000000, '402_990.png', 1, 0, '2015-07-17 08:21:26', '2015-08-26 07:43:01'),
(61, 21, '2bhk', 2, 1019, 'sqft', 42, 'L', 4200000, '791_f6.jpg', 1, 0, '2015-07-23 10:19:06', '2015-08-26 06:46:50'),
(62, 21, '3bhk', 3, 1860, 'sqft', 90, 'L', 9000000, '728_f7.jpg', 1, 0, '2015-07-23 10:20:12', '2015-08-26 06:46:57'),
(63, 31, '2 BHK + 2 TOILETS', 2, 835, 'sqft', 23.5, 'L', 2000000, '488_kingswood-fp-big1.jpg', 1, 0, '2015-07-23 12:31:49', '2015-10-01 09:05:18'),
(64, 31, '2 BHK + 2 TOILETS + STUDY', 2, 945, 'sqft', 27, 'L', 2500000, '545_kingswood-fp-big2.jpg', 1, 0, '2015-07-23 12:37:56', '2015-10-01 09:05:33'),
(65, 31, '3 BHK + 2 TOILETS ', 3, 1115, 'sqft', 31.5, 'L', 3000000, '716_kingswood-fp-big3.jpg', 1, 0, '2015-07-23 12:38:44', '2015-10-01 09:05:46'),
(66, 31, '3 BHK + 2 TOILETS (Option-01)', 3, 1115, 'sqft', 31.5, 'L', 3000000, '637_kingswood-fp-big4.jpg', 1, 0, '2015-07-23 12:39:35', '2015-10-01 09:06:04'),
(67, 32, '2 BD + 2 Toilet', 2, 845, 'sqft', 24, 'L', 2000000, '788_lesiure-park-fp-big1.jpg', 1, 0, '2015-07-24 05:36:34', '2015-10-01 10:07:18'),
(68, 32, '2 BD + 2 Toilet + Study', 2, 955, 'sqft', 27, 'L', 2500000, '928_lesiure-park-fp-big2.jpg', 1, 0, '2015-07-24 05:38:30', '2015-10-01 10:08:32'),
(69, 32, '2 BD + 2 Toilet ', 2, 1125, 'sqft', 32, 'L', 3000000, '181_lesiure-park-fp-big3.jpg', 1, 0, '2015-07-24 05:49:22', '2015-10-01 10:12:13'),
(70, 32, '2 BD + 2 Toilet + Study', 2, 1225, 'sqft', 35, 'L', 3500000, '698_UNIT-PLAN-4.jpg', 1, 0, '2015-07-24 05:51:47', '2015-10-01 10:13:29'),
(71, 32, '3 BD + 2 Toilet ', 3, 1145, 'sqft', 32.5, 'L', 3000000, '263_lesiure-park-fp-big5.jpg', 1, 0, '2015-07-24 05:52:59', '2015-10-01 10:15:00'),
(72, 32, '3 BD + 2 Toilet', 3, 1450, 'sqft', 41.3, 'L', 4000000, '705_lesiure-park-fp-big6.jpg', 1, 0, '2015-07-24 05:54:14', '2015-10-01 10:33:35'),
(73, 32, '3 BD + 3 Toilet + Servant', 3, 1730, 'sqft', 49.3, 'L', 4500000, '551_lesiure-park-fp-big7.jpg', 1, 0, '2015-07-24 05:55:26', '2015-10-01 10:34:22'),
(74, 32, '3 BD + 3 Toilet + Servant ', 3, 1730, 'sqft', 49.3, 'L', 4500000, '147_lesiure-park-fp-big8.jpg', 1, 0, '2015-07-24 05:56:43', '2015-10-01 10:34:59'),
(75, 33, '2bhk', 2, 875, 'sqft', 35, 'L', 3500000, '471_f1.jpg', 1, 0, '2015-07-24 06:59:00', '2015-08-26 07:39:46'),
(76, 33, '2bhk', 2, 1015, 'sqft', 40, 'L', 4000000, '449_f2.jpg', 1, 0, '2015-07-24 07:00:55', '2015-08-26 07:39:50'),
(77, 33, '2bhk', 2, 1090, 'sqft', 45, 'L', 4500000, '919_f3.jpg', 1, 0, '2015-07-24 07:01:58', '2015-08-26 07:39:55'),
(78, 33, '2bhk', 2, 1315, 'sqft', 50, 'L', 5000000, '561_f4.jpg', 1, 0, '2015-07-24 07:03:02', '2015-08-26 07:39:59'),
(79, 33, '3bhk', 3, 1315, 'sqft', 55, 'L', 5500000, '900_f5.jpg', 1, 0, '2015-07-24 07:03:54', '2015-08-26 07:40:04'),
(80, 33, '3bhk', 3, 1540, 'sqft', 60, 'L', 6000000, '638_f7.jpg', 1, 0, '2015-07-24 07:05:49', '2015-08-26 07:40:09'),
(81, 34, '2bhk', 2, 845, 'sqft', 23, 'L', 2300000, '957_2bhk 845sqft.jpg', 1, 0, '2015-07-24 07:32:21', '2015-08-26 07:41:02'),
(82, 34, '2bhk', 2, 955, 'sqft', 35, 'L', 3500000, '614_2bhk 955sqft.jpg', 1, 0, '2015-07-24 07:33:10', '2015-08-26 07:41:06'),
(83, 34, '3bhk', 3, 1145, 'sqft', 40, 'L', 4000000, '731_3bhk 1145sqft.jpg', 1, 0, '2015-07-24 07:34:01', '2015-08-26 07:41:10'),
(84, 35, '2bhk', 2, 885, 'sqft', 25, 'L', 2500000, '834_f1.jpg', 1, 0, '2015-07-24 07:53:26', '2015-08-26 07:41:21'),
(85, 35, '2bhk', 2, 885, 'sqft', 25, 'L', 2500000, '132_f2.jpg', 1, 0, '2015-07-24 07:54:19', '2015-08-26 07:41:25'),
(86, 35, '2bhk', 2, 990, 'sqft', 35, 'L', 3500000, '275_f3.jpg', 1, 0, '2015-07-24 07:55:31', '2015-08-26 07:41:53'),
(87, 35, '2bhk', 2, 990, 'sqft', 35, 'L', 3500000, '860_f4.jpg', 1, 0, '2015-07-24 07:56:16', '2015-08-26 07:42:01'),
(88, 35, '3bhk', 3, 1185, 'sqft', 45, 'L', 4500000, '576_f5.jpg', 1, 0, '2015-07-24 07:57:25', '2015-08-26 07:42:06'),
(89, 35, '3bhk', 3, 1185, 'sqft', 45, 'L', 4500000, '494_f6.jpg', 1, 0, '2015-07-24 07:58:24', '2015-08-26 07:42:10'),
(90, 36, '2bhk', 2, 880, 'sqft', 23, 'L', 2300000, '263_f1.jpg', 1, 0, '2015-07-24 09:04:44', '2015-08-26 07:02:31'),
(91, 36, '2bhk', 2, 925, 'sqft', 25, 'L', 2500000, '267_f2.jpg', 1, 0, '2015-07-24 09:06:39', '2015-08-26 06:53:53'),
(92, 36, '2bhk', 2, 1005, 'sqft', 28, 'L', 2800000, '694_f3.jpg', 1, 0, '2015-07-24 09:07:30', '2015-08-26 06:53:58'),
(93, 36, '2bhk', 2, 1085, 'sqft', 30, 'L', 3000000, '249_f4.jpg', 1, 0, '2015-07-24 09:08:51', '2015-08-26 06:54:03'),
(94, 36, '2bhk', 2, 1115, 'sqft', 32, 'L', 3200000, '970_f5.jpg', 1, 0, '2015-07-24 09:09:48', '2015-08-26 06:54:07'),
(95, 36, '2bhk', 2, 1170, 'sqft', 35, 'L', 3500000, '416_f6.jpg', 1, 0, '2015-07-24 09:11:03', '2015-08-26 06:54:12'),
(96, 36, '2bhk', 2, 1270, 'sqft', 38, 'L', 3800000, '213_f7.jpg', 1, 0, '2015-07-24 09:11:50', '2015-08-26 06:54:17'),
(97, 36, '3bhk', 3, 1290, 'sqft', 40, 'L', 4000000, '630_f8.jpg', 1, 0, '2015-07-24 09:13:04', '2015-08-26 06:54:22'),
(98, 36, '3bhk', 3, 1330, 'sqft', 45, 'L', 4500000, '146_f9.jpg', 1, 0, '2015-07-24 09:13:52', '2015-08-26 06:54:29'),
(99, 36, '3bhk', 3, 1340, 'sqft', 48, 'L', 4800000, '566_f10.jpg', 1, 0, '2015-07-24 09:17:47', '2015-08-26 07:01:03'),
(100, 36, '3bhk', 3, 1385, 'sqft', 50, 'L', 5000000, '268_f11.jpg', 1, 0, '2015-07-24 09:20:26', '2015-08-26 07:01:07'),
(101, 36, '3bhk', 3, 1385, 'sqft', 53, 'L', 5300000, '855_f12.jpg', 1, 0, '2015-07-24 09:22:16', '2015-08-26 07:01:12'),
(102, 36, '3bhk', 3, 1595, 'sqft', 55, 'L', 5500000, '374_f13.jpg', 1, 0, '2015-07-24 09:23:05', '2015-08-26 07:01:18'),
(103, 36, '3bhk', 3, 1595, 'sqft', 56, 'L', 5600000, '666_f14.jpg', 1, 0, '2015-07-24 09:24:38', '2015-08-26 07:01:23'),
(104, 36, '3bhk', 3, 1625, 'sqft', 57, 'L', 5700000, '447_f15.jpg', 1, 0, '2015-07-24 09:25:38', '2015-08-26 07:01:28'),
(105, 36, '4bhk', 4, 1960, 'sqft', 65, 'L', 6500000, '537_f16.jpg', 1, 0, '2015-07-24 09:26:24', '2015-08-26 07:01:33'),
(106, 37, '2bhk', 2, 875, 'sqft', 23, 'L', 2300000, '953_f1.jpg', 1, 0, '2015-07-24 10:47:59', '2015-08-26 07:35:48'),
(107, 37, '2bhk', 2, 880, 'sqft', 25, 'L', 2500000, '428_f2.jpg', 1, 0, '2015-07-24 10:49:57', '2015-08-26 07:35:52'),
(108, 37, '2bhk', 2, 995, 'sqft', 28, 'L', 2800000, '398_f3.jpg', 1, 0, '2015-07-24 10:50:50', '2015-08-26 07:35:56'),
(109, 37, '2bhk', 2, 995, 'sqft', 28, 'L', 2800000, '507_f4.jpg', 1, 0, '2015-07-24 10:51:48', '2015-08-26 07:36:18'),
(110, 37, '2bhk', 2, 1040, 'sqft', 30, 'L', 3000000, '388_f5.jpg', 1, 0, '2015-07-24 10:52:45', '2015-08-26 07:36:22'),
(111, 37, '2bhk', 2, 1140, 'sqft', 35, 'L', 3500000, '551_f5.jpg', 1, 0, '2015-07-24 10:53:31', '2015-08-26 07:36:26'),
(112, 37, '3bhk', 3, 1195, 'sqft', 35, 'L', 3500000, '890_f7.jpg', 1, 0, '2015-07-24 10:54:51', '2015-08-26 07:36:30'),
(113, 37, '3bhk', 3, 1285, 'sqft', 40, 'L', 4000000, '734_f8.jpg', 1, 0, '2015-07-24 10:56:29', '2015-08-26 07:36:34'),
(114, 37, '3bhk', 3, 1295, 'sqft', 45, 'L', 4500000, '735_f9.jpg', 1, 0, '2015-07-24 10:58:43', '2015-08-26 07:36:40'),
(115, 37, '3bhk', 3, 1495, 'sqft', 50, 'L', 5000000, '447_f10.jpg', 1, 0, '2015-07-24 10:59:48', '2015-08-26 07:36:44'),
(116, 37, '3bhk', 3, 1500, 'sqft', 60, 'L', 6000000, '267_f11.jpg', 1, 0, '2015-07-24 11:02:10', '2015-08-26 07:36:49'),
(117, 38, '2bhk', 0, 835, 'sqft', 1, 'Cr', 2500000, '330_f1.jpg', 1, 1, '2015-07-31 05:15:58', '2015-08-08 07:05:26'),
(118, 24, '4bhk', 4, 2410, 'sqft', 1, 'Cr', 10000000, '217_4.jpg', 1, 0, '2015-09-29 11:46:48', '2015-09-30 05:24:15'),
(119, 25, '3bhk', 3, 1230, 'sqft', 28, 'L', 2500000, '333_f5.jpg', 1, 0, '2015-09-29 12:13:53', '2015-09-30 05:25:39'),
(120, 25, '3bhk', 3, 1300, 'sqft', 30, 'L', 3000000, '111_f6.jpg', 1, 0, '2015-09-29 12:14:53', '2015-09-30 05:25:46'),
(121, 25, '3bhk', 3, 1655, 'sqft', 38, 'L', 3500000, '446_f8.jpg', 1, 0, '2015-09-29 12:15:44', '2015-09-30 05:25:53'),
(122, 25, '4bhk', 4, 2135, 'sqft', 50, 'L', 5000000, '792_f9.jpg', 1, 0, '2015-09-29 12:16:44', '2015-09-30 05:26:04'),
(123, 31, '3 BHK + 2 TOILETS (Option-01)', 3, 1425, 'sqft', 40, 'L', 4000000, '468_kingswood-fp-big5.jpg', 1, 0, '2015-10-01 09:07:35', '2015-10-01 09:07:35'),
(124, 31, '3 BHK + 2 TOILETS ', 3, 1425, 'sqft', 40, 'L', 4000000, '621_kingswood-fp-big6.jpg', 1, 0, '2015-10-01 09:08:28', '2015-10-01 09:08:28'),
(125, 31, '3 BHK + 3 TOILETS', 3, 1595, 'sqft', 45, 'L', 4500000, '472_kingswood-fp-big7.jpg', 1, 0, '2015-10-01 09:09:27', '2015-10-01 10:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `property_category`
--

CREATE TABLE IF NOT EXISTS `property_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_category`
--

INSERT INTO `property_category` (`id`, `category_name`, `is_active`) VALUES
(1, 'Residential Properties', 1),
(2, 'Commercial Properties', 1),
(3, 'Plots Properties', 1),
(4, 'Studio Apartments', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE IF NOT EXISTS `property_type` (
  `id` int(11) NOT NULL,
  `property_type` varchar(100) NOT NULL,
  `property_category_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`id`, `property_type`, `property_category_id`, `is_active`, `is_delete`) VALUES
(1, 'Commercial Property One', 2, 1, 0),
(2, 'Plot Type one', 3, 1, 0),
(3, 'Plot Type two', 3, 1, 0),
(4, 'Residential Property', 1, 1, 0),
(5, 'studio property', 4, 1, 0),
(6, 'XYZ', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed_project`
--

CREATE TABLE IF NOT EXISTS `recently_viewed_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recently_viewed_project`
--

INSERT INTO `recently_viewed_project` (`id`, `project_id`, `user_id`, `ip_address`, `is_active`, `is_delete`, `date_created`) VALUES
(1, 27, 0, '66.249.65.154', 1, 0, '2015-09-18 18:36:46'),
(2, 27, 0, '66.249.65.168', 1, 0, '2015-09-18 19:02:03'),
(3, 36, 0, '180.76.15.10', 1, 0, '2015-09-18 21:57:57'),
(4, 23, 0, '66.249.65.168', 1, 0, '2015-09-19 01:21:49'),
(5, 23, 0, '14.141.22.198', 1, 0, '2015-09-19 05:53:44'),
(6, 28, 0, '180.76.15.29', 1, 0, '2015-09-19 06:17:09'),
(7, 26, 0, '180.76.15.146', 1, 0, '2015-09-19 11:18:29'),
(8, 23, 0, '66.249.65.161', 1, 0, '2015-09-19 12:11:41'),
(9, 30, 0, '116.74.6.185', 1, 0, '2015-09-19 12:55:06'),
(10, 30, 0, '66.249.65.154', 1, 0, '2015-09-19 18:15:58'),
(11, 24, 0, '180.76.15.25', 1, 0, '2015-09-19 19:02:30'),
(12, 36, 0, '66.249.65.168', 1, 0, '2015-09-20 02:37:48'),
(13, 29, 0, '68.180.228.102', 1, 0, '2015-09-20 04:18:21'),
(14, 24, 0, '64.74.215.54', 1, 0, '2015-09-20 04:37:22'),
(15, 29, 0, '64.74.215.54', 1, 0, '2015-09-20 04:40:57'),
(16, 27, 0, '64.74.215.54', 1, 0, '2015-09-20 04:43:23'),
(17, 33, 0, '180.76.15.14', 1, 0, '2015-09-20 06:09:23'),
(18, 29, 0, '157.55.39.211', 1, 0, '2015-09-20 12:51:48'),
(19, 23, 4, '', 1, 0, '2015-09-21 06:05:36'),
(20, 23, 0, '89.145.95.40', 1, 0, '2015-09-21 06:05:45'),
(21, 23, 0, '148.251.245.105', 1, 0, '2015-09-21 06:06:16'),
(22, 27, 4, '', 1, 0, '2015-09-21 06:06:44'),
(23, 25, 4, '', 1, 0, '2015-09-21 06:06:44'),
(24, 25, 0, '89.145.95.39', 1, 0, '2015-09-21 06:06:55'),
(25, 34, 4, '', 1, 0, '2015-09-21 06:15:38'),
(26, 27, 0, '14.141.22.198', 1, 0, '2015-09-21 06:25:40'),
(27, 25, 0, '14.141.22.198', 1, 0, '2015-09-21 06:25:46'),
(28, 34, 0, '173.193.17.201', 1, 0, '2015-09-21 07:17:05'),
(29, 23, 2, '', 1, 0, '2015-09-21 07:33:50'),
(30, 28, 0, '180.76.15.26', 1, 0, '2015-09-21 09:56:42'),
(31, 23, 0, '122.177.209.206', 1, 0, '2015-09-21 12:57:42'),
(32, 27, 0, '180.76.15.19', 1, 0, '2015-09-21 13:51:05'),
(33, 33, 0, '68.180.230.219', 1, 0, '2015-09-21 23:49:28'),
(34, 23, 0, '68.180.230.219', 1, 0, '2015-09-21 23:49:35'),
(35, 24, 0, '68.180.230.219', 1, 0, '2015-09-22 00:14:37'),
(36, 28, 0, '180.76.15.162', 1, 0, '2015-09-22 01:16:27'),
(37, 29, 0, '77.75.76.164', 1, 0, '2015-09-22 08:42:12'),
(38, 29, 0, '14.141.22.198', 1, 0, '2015-09-22 10:08:01'),
(39, 23, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:31'),
(40, 24, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:43'),
(41, 29, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:47'),
(42, 25, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:50'),
(43, 36, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:51'),
(44, 26, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:54'),
(45, 30, 0, '207.106.190.2', 1, 0, '2015-09-22 10:23:55'),
(46, 28, 0, '207.106.190.2', 1, 0, '2015-09-22 10:24:00'),
(47, 27, 0, '207.106.190.2', 1, 0, '2015-09-22 10:24:01'),
(48, 31, 0, '207.106.190.2', 1, 0, '2015-09-22 10:26:16'),
(49, 32, 0, '207.106.190.2', 1, 0, '2015-09-22 10:26:23'),
(50, 34, 0, '207.106.190.2', 1, 0, '2015-09-22 10:26:31'),
(51, 32, 0, '68.180.230.219', 1, 0, '2015-09-22 13:43:01'),
(52, 37, 0, '180.76.15.25', 1, 0, '2015-09-22 15:51:19'),
(53, 23, 0, '180.76.15.156', 1, 0, '2015-09-22 16:50:24'),
(54, 21, 0, '180.76.15.144', 1, 0, '2015-09-23 10:17:28'),
(55, 29, 0, '133.130.52.247', 1, 0, '2015-09-23 13:40:39'),
(56, 28, 0, '133.130.52.247', 1, 0, '2015-09-23 13:42:27'),
(57, 27, 0, '133.130.52.247', 1, 0, '2015-09-23 13:44:07'),
(58, 25, 0, '133.130.52.247', 1, 0, '2015-09-23 13:52:44'),
(59, 31, 0, '133.130.52.247', 1, 0, '2015-09-23 13:57:40'),
(60, 34, 0, '133.130.52.247', 1, 0, '2015-09-23 14:06:18'),
(61, 24, 0, '133.130.52.247', 1, 0, '2015-09-23 14:08:52'),
(62, 33, 0, '133.130.52.247', 1, 0, '2015-09-23 14:16:03'),
(63, 32, 0, '133.130.52.247', 1, 0, '2015-09-23 14:18:03'),
(64, 35, 0, '133.130.52.247', 1, 0, '2015-09-23 14:21:20'),
(65, 30, 0, '133.130.52.247', 1, 0, '2015-09-23 14:26:10'),
(66, 26, 0, '133.130.52.247', 1, 0, '2015-09-23 14:33:45'),
(67, 23, 0, '133.130.52.247', 1, 0, '2015-09-23 14:38:13'),
(68, 36, 0, '133.130.52.247', 1, 0, '2015-09-23 14:41:32'),
(69, 37, 0, '133.130.52.247', 1, 0, '2015-09-23 14:47:13'),
(70, 31, 0, '180.76.15.146', 1, 0, '2015-09-23 20:50:50'),
(71, 30, 0, '107.170.129.218', 1, 0, '2015-09-23 21:51:16'),
(72, 36, 0, '107.170.129.218', 1, 0, '2015-09-23 21:52:06'),
(73, 29, 0, '107.170.129.218', 1, 0, '2015-09-23 21:52:12'),
(74, 26, 0, '107.170.129.218', 1, 0, '2015-09-23 21:52:42'),
(75, 28, 0, '107.170.129.218', 1, 0, '2015-09-23 21:52:46'),
(76, 24, 0, '107.170.129.218', 1, 0, '2015-09-23 21:53:56'),
(77, 27, 0, '107.170.129.218', 1, 0, '2015-09-23 21:54:06'),
(78, 23, 0, '107.170.129.218', 1, 0, '2015-09-23 21:54:21'),
(79, 25, 0, '107.170.129.218', 1, 0, '2015-09-23 21:54:31'),
(80, 37, 0, '107.170.129.218', 1, 0, '2015-09-23 21:55:06'),
(81, 34, 0, '107.170.129.218', 1, 0, '2015-09-23 21:55:16'),
(82, 31, 0, '107.170.129.218', 1, 0, '2015-09-23 21:55:22'),
(83, 32, 0, '107.170.129.218', 1, 0, '2015-09-23 21:55:36'),
(84, 33, 0, '107.170.129.218', 1, 0, '2015-09-23 21:56:11'),
(85, 35, 0, '107.170.129.218', 1, 0, '2015-09-23 21:56:16'),
(86, 23, 5, '', 1, 0, '2015-09-24 06:54:28'),
(87, 24, 5, '', 1, 0, '2015-09-24 06:54:28'),
(88, 25, 5, '', 1, 0, '2015-09-24 06:54:31'),
(89, 24, 0, '89.145.95.39', 1, 0, '2015-09-24 06:56:59'),
(90, 24, 0, '14.141.22.198', 1, 0, '2015-09-24 07:01:18'),
(91, 30, 0, '66.249.65.161', 1, 0, '2015-09-24 07:37:07'),
(92, 29, 0, '66.249.65.154', 1, 0, '2015-09-24 13:08:23'),
(93, 25, 10, '', 1, 0, '2015-09-24 13:40:07'),
(94, 29, 0, '66.249.65.161', 1, 0, '2015-09-24 15:14:04'),
(95, 29, 0, '185.53.44.131', 1, 0, '2015-09-24 18:37:22'),
(96, 29, 0, '157.55.39.191', 1, 0, '2015-09-25 00:14:23'),
(97, 29, 0, '157.55.39.192', 1, 0, '2015-09-25 02:06:35'),
(98, 30, 0, '66.249.65.168', 1, 0, '2015-09-25 08:31:55'),
(99, 24, 0, '122.177.209.206', 1, 0, '2015-09-25 11:17:40'),
(100, 26, 0, '180.76.15.149', 1, 0, '2015-09-25 16:57:14'),
(101, 35, 0, '68.180.228.102', 1, 0, '2015-09-26 01:02:31'),
(102, 29, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:26'),
(103, 23, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:29'),
(104, 24, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:31'),
(105, 25, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:33'),
(106, 36, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:35'),
(107, 26, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:37'),
(108, 27, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:39'),
(109, 30, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:41'),
(110, 28, 0, '78.46.174.55', 1, 0, '2015-09-26 04:27:43'),
(111, 31, 0, '78.46.174.55', 1, 0, '2015-09-26 04:28:29'),
(112, 32, 0, '78.46.174.55', 1, 0, '2015-09-26 04:28:31'),
(113, 33, 0, '78.46.174.55', 1, 0, '2015-09-26 04:28:33'),
(114, 34, 0, '78.46.174.55', 1, 0, '2015-09-26 04:28:35'),
(115, 35, 0, '78.46.174.55', 1, 0, '2015-09-26 04:28:37'),
(116, 37, 0, '78.46.174.55', 1, 0, '2015-09-26 04:28:41'),
(117, 23, 0, '66.249.65.154', 1, 0, '2015-09-26 09:53:44'),
(118, 26, 0, '180.76.15.25', 1, 0, '2015-09-26 10:32:56'),
(119, 36, 0, '66.249.65.154', 1, 0, '2015-09-26 14:53:51'),
(120, 27, 0, '66.249.65.161', 1, 0, '2015-09-26 15:04:03'),
(121, 26, 0, '185.53.44.152', 1, 0, '2015-09-26 19:16:21'),
(122, 36, 0, '185.53.44.96', 1, 0, '2015-09-26 19:31:29'),
(123, 30, 0, '185.53.44.96', 1, 0, '2015-09-26 19:50:31'),
(124, 28, 0, '185.53.44.82', 1, 0, '2015-09-26 20:16:04'),
(125, 25, 0, '185.53.44.92', 1, 0, '2015-09-26 20:48:56'),
(126, 23, 0, '185.53.44.62', 1, 0, '2015-09-26 20:56:02'),
(127, 25, 0, '185.53.44.67', 1, 0, '2015-09-26 21:01:17'),
(128, 35, 0, '185.53.44.63', 1, 0, '2015-09-26 21:04:39'),
(129, 24, 0, '66.249.65.154', 1, 0, '2015-09-26 21:09:23'),
(130, 34, 0, '185.53.44.124', 1, 0, '2015-09-26 21:09:53'),
(131, 23, 0, '185.53.44.202', 1, 0, '2015-09-26 21:09:55'),
(132, 36, 0, '185.53.44.157', 1, 0, '2015-09-26 21:12:19'),
(133, 26, 0, '185.53.44.63', 1, 0, '2015-09-26 21:14:48'),
(134, 32, 0, '185.53.44.178', 1, 0, '2015-09-26 21:17:11'),
(135, 33, 0, '185.53.44.51', 1, 0, '2015-09-26 21:18:13'),
(136, 27, 0, '185.53.44.149', 1, 0, '2015-09-26 21:18:31'),
(137, 24, 0, '66.249.65.168', 1, 0, '2015-09-26 21:34:11'),
(138, 31, 0, '185.53.44.177', 1, 0, '2015-09-26 21:49:40'),
(139, 24, 0, '185.53.44.178', 1, 0, '2015-09-26 21:54:01'),
(140, 27, 0, '185.53.44.187', 1, 0, '2015-09-26 22:00:08'),
(141, 24, 0, '185.53.44.131', 1, 0, '2015-09-26 22:00:58'),
(142, 28, 0, '185.53.44.186', 1, 0, '2015-09-26 22:15:20'),
(143, 37, 0, '68.180.228.102', 1, 0, '2015-09-26 23:53:50'),
(144, 36, 0, '66.249.65.161', 1, 0, '2015-09-27 00:16:46'),
(145, 26, 0, '180.76.15.32', 1, 0, '2015-09-27 10:43:30'),
(146, 30, 0, '180.76.15.151', 1, 0, '2015-09-27 13:27:04'),
(147, 24, 0, '180.76.15.156', 1, 0, '2015-09-27 15:55:01'),
(148, 32, 0, '68.180.228.102', 1, 0, '2015-09-27 18:12:25'),
(149, 30, 0, '180.76.15.18', 1, 0, '2015-09-27 20:13:41'),
(150, 23, 0, '68.180.228.102', 1, 0, '2015-09-27 23:52:50'),
(151, 27, 2, '', 1, 0, '2015-09-28 06:14:35'),
(152, 26, 2, '', 1, 0, '2015-09-28 06:17:51'),
(153, 24, 0, '122.177.68.218', 1, 0, '2015-09-28 08:00:58'),
(154, 24, 0, '68.180.228.102', 1, 0, '2015-09-28 09:42:47'),
(155, 23, 0, '122.177.68.218', 1, 0, '2015-09-28 10:23:35'),
(156, 32, 0, '180.76.15.6', 1, 0, '2015-09-28 11:35:42'),
(157, 26, 0, '14.141.22.198', 1, 0, '2015-09-28 12:29:28'),
(158, 24, 0, '75.126.28.194', 1, 0, '2015-09-29 11:16:24'),
(159, 34, 0, '68.180.228.102', 1, 0, '2015-09-29 12:11:17'),
(160, 25, 0, '122.177.68.218', 1, 0, '2015-09-29 12:53:08'),
(161, 35, 12, '', 1, 0, '2015-09-29 13:06:26'),
(162, 35, 0, '122.177.68.218', 1, 0, '2015-09-29 13:09:54'),
(163, 24, 0, '66.249.65.161', 1, 0, '2015-09-29 14:39:06'),
(164, 31, 0, '68.180.228.102', 1, 0, '2015-09-29 21:25:45'),
(165, 29, 0, '157.55.39.157', 1, 0, '2015-09-30 04:51:39'),
(166, 29, 0, '66.102.6.253', 1, 0, '2015-09-30 04:58:47'),
(167, 26, 0, '68.180.230.219', 1, 0, '2015-09-30 07:08:49'),
(168, 30, 0, '68.180.230.219', 1, 0, '2015-09-30 07:10:54'),
(169, 27, 0, '68.180.230.219', 1, 0, '2015-09-30 07:11:04'),
(170, 36, 0, '68.180.230.219', 1, 0, '2015-09-30 07:26:41'),
(171, 25, 0, '68.180.230.219', 1, 0, '2015-09-30 07:27:42'),
(172, 28, 0, '68.180.230.219', 1, 0, '2015-09-30 07:28:45'),
(173, 34, 0, '180.76.15.144', 1, 0, '2015-09-30 17:12:42'),
(174, 26, 0, '185.53.44.62', 1, 0, '2015-09-30 22:18:20'),
(175, 36, 0, '185.53.44.63', 1, 0, '2015-09-30 22:36:28'),
(176, 30, 0, '185.53.44.53', 1, 0, '2015-09-30 22:55:42'),
(177, 28, 0, '185.53.44.176', 1, 0, '2015-09-30 23:18:08'),
(178, 25, 0, '185.53.44.45', 1, 0, '2015-09-30 23:49:31'),
(179, 23, 0, '185.53.44.85', 1, 0, '2015-10-01 00:01:52'),
(180, 25, 0, '185.53.44.203', 1, 0, '2015-10-01 00:02:17'),
(181, 35, 0, '185.53.44.186', 1, 0, '2015-10-01 00:10:36'),
(182, 23, 0, '185.53.44.51', 1, 0, '2015-10-01 00:14:25'),
(183, 33, 0, '185.53.44.119', 1, 0, '2015-10-01 00:19:25'),
(184, 26, 0, '185.53.44.96', 1, 0, '2015-10-01 00:21:08'),
(185, 27, 0, '185.53.44.177', 1, 0, '2015-10-01 00:22:09'),
(186, 32, 0, '185.53.44.115', 1, 0, '2015-10-01 00:25:16'),
(187, 30, 0, '185.53.44.148', 1, 0, '2015-10-01 00:53:22'),
(188, 31, 0, '185.53.44.152', 1, 0, '2015-10-01 00:54:11'),
(189, 27, 0, '185.53.44.53', 1, 0, '2015-10-01 01:04:13'),
(190, 28, 0, '185.53.44.62', 1, 0, '2015-10-01 01:18:28'),
(191, 31, 0, '14.141.22.198', 1, 0, '2015-10-01 08:16:55'),
(192, 32, 0, '14.141.22.198', 1, 0, '2015-10-01 09:36:57'),
(193, 23, 0, '::1', 1, 0, '2015-10-27 09:59:42'),
(194, 25, 0, '::1', 1, 0, '2015-10-27 10:07:42'),
(195, 24, 0, '::1', 1, 0, '2015-10-27 11:02:19'),
(196, 30, 0, '::1', 1, 0, '2015-10-27 11:02:32'),
(197, 34, 0, '::1', 1, 0, '2015-10-27 11:02:46'),
(198, 37, 0, '::1', 1, 0, '2015-10-27 11:03:36'),
(199, 26, 0, '::1', 1, 0, '2015-10-27 12:32:43'),
(200, 23, 11, '', 1, 0, '2015-10-28 10:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `resale_property_list`
--

CREATE TABLE IF NOT EXISTS `resale_property_list` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `floor_plan_id` int(11) NOT NULL,
  `pruchased_for` int(2) NOT NULL,
  `purchase_date` date NOT NULL,
  `unit` int(3) NOT NULL,
  `floor` int(3) NOT NULL,
  `tower` int(3) NOT NULL,
  `basic_price` int(11) NOT NULL,
  `other_expenses` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `goal_amount` int(11) NOT NULL,
  `loan_status` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `is_approved` int(1) NOT NULL,
  `is_delete` int(1) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resale_property_list`
--

INSERT INTO `resale_property_list` (`id`, `project_id`, `user_id`, `floor_plan_id`, `pruchased_for`, `purchase_date`, `unit`, `floor`, `tower`, `basic_price`, `other_expenses`, `total_price`, `goal_amount`, `loan_status`, `is_active`, `is_approved`, `is_delete`, `date_created`) VALUES
(1, 23, 11, 15, 1, '2015-07-10', 5, 7, 4, 5000000, 100000, 5100000, 7000000, 1, 1, 0, 0, '2015-10-06'),
(2, 23, 11, 15, 1, '2015-07-10', 5, 7, 4, 5000000, 100000, 5100000, 7000000, 1, 1, 0, 0, '2015-10-06'),
(3, 24, 11, 22, 2, '2015-06-10', 5000, 5, 88, 5555, 88, 5, 8, 1, 1, 0, 0, '2015-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `is_active`, `is_delete`, `date_created`, `last_updated`) VALUES
(1, 'hjfjhfhjeeettii', 1, 1, '2015-05-26 14:17:38', '2015-07-04 08:35:57'),
(2, 'Biharrrr', 1, 1, '2015-06-05 09:49:02', '2015-07-04 08:35:57'),
(3, 'Biharrrr', 1, 1, '2015-06-05 09:50:19', '2015-07-04 08:35:57'),
(4, 'Biharrrrnew', 1, 1, '2015-06-05 11:17:20', '2015-07-04 08:35:57'),
(5, 'Dd', 1, 1, '2015-06-06 11:18:24', '2015-07-04 08:35:57'),
(6, 'Sfgdsf', 1, 1, '2015-06-06 11:19:05', '2015-07-04 08:35:57'),
(7, 'Haryana', 1, 1, '2015-07-04 08:36:20', '2015-07-04 08:46:38'),
(8, 'U.P', 1, 1, '2015-07-04 08:37:14', '2015-07-04 08:46:38'),
(9, 'Harayana', 1, 1, '2015-07-04 08:52:53', '2015-07-04 08:53:04'),
(10, 'Hryana', 1, 1, '2015-07-04 08:53:26', '2015-07-04 08:53:35'),
(11, '--', 1, 1, '2015-07-04 08:54:38', '2015-07-04 08:56:36'),
(12, 'Uttar Pradesh', 1, 1, '2015-07-04 08:58:12', '2015-07-04 10:47:06'),
(13, 'Uttarakhand', 1, 0, '2015-07-04 09:00:32', '2015-07-04 09:00:32'),
(14, 'Delhi', 1, 0, '2015-07-04 09:01:09', '2015-07-04 09:01:09'),
(15, 'U.Pradesh', 1, 1, '2015-07-04 11:03:11', '2015-07-08 11:09:32'),
(16, 'Uttar Pradesh', 1, 0, '2015-07-08 11:09:11', '2015-07-08 11:09:11'),
(17, 'Punjab', 1, 0, '2015-07-08 11:10:03', '2015-07-08 11:10:46'),
(18, 'Abc', 1, 1, '2015-07-08 11:10:55', '2015-07-08 11:11:02'),
(19, '---', 1, 1, '2015-07-08 11:11:35', '2015-07-09 11:05:13'),
(20, '-', 1, 1, '2015-07-08 11:12:03', '2015-07-09 11:05:09'),
(21, 'Haryana', 1, 0, '2015-07-09 11:05:01', '2015-07-09 11:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `comment`, `image`, `is_active`, `is_delete`) VALUES
(1, 'user 1', '<p>here will be the comment of user 1</p>', '770_people-img-1.jpg', 1, 0),
(2, 'user 2', '<p>here will be the comment of user 1</p>', '415_people-img-2.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE IF NOT EXISTS `userlist` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `salt_key` varchar(50) NOT NULL,
  `fb_login` int(1) NOT NULL DEFAULT '0',
  `gmail_login` int(1) NOT NULL DEFAULT '0',
  `is_admin` int(1) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `is_delete` int(1) NOT NULL DEFAULT '0',
  `is_verified` int(1) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`id`, `username`, `useremail`, `mobile`, `password`, `salt_key`, `fb_login`, `gmail_login`, `is_admin`, `is_active`, `is_delete`, `is_verified`, `date_created`) VALUES
(12, 'Arvind Jha', 'arvindjha304@gmail.com', 0, 'cGFzc3dvcmQ=xs+Z0M8ktCs=', 'xs+Z0M8ktCs=', 0, 1, 0, 1, 0, 1, '2015-09-29 13:05:57'),
(11, 'Arvind', 'arvind@discoverysolutions.in', 0, 'bmV3cGFzc3dvcmQ=e94sABq6yzs=', 'e94sABq6yzs=', 0, 1, 1, 1, 0, 1, '2015-09-28 09:13:59'),
(13, 'akash', 'akash.bharadwaj590@gmail.com', 2147483647, 'YXNmZHM=ID9VYW3P7VY=', 'ID9VYW3P7VY=', 0, 0, 0, 1, 0, 0, '2015-10-26 07:02:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenity_type_list`
--
ALTER TABLE `amenity_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bannerlist`
--
ALTER TABLE `bannerlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banner_type` (`banner_type`);

--
-- Indexes for table `banner_type_list`
--
ALTER TABLE `banner_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `builders`
--
ALTER TABLE `builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `callback_interested_users`
--
ALTER TABLE `callback_interested_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `enquired_projects`
--
ALTER TABLE `enquired_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepagebanners`
--
ALTER TABLE `homepagebanners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_detail`
--
ALTER TABLE `news_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_floor_plan`
--
ALTER TABLE `project_floor_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_category`
--
ALTER TABLE `property_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recently_viewed_project`
--
ALTER TABLE `recently_viewed_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resale_property_list`
--
ALTER TABLE `resale_property_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `amenity_type_list`
--
ALTER TABLE `amenity_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bannerlist`
--
ALTER TABLE `bannerlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `banner_type_list`
--
ALTER TABLE `banner_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `builders`
--
ALTER TABLE `builders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `callback_interested_users`
--
ALTER TABLE `callback_interested_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `enquired_projects`
--
ALTER TABLE `enquired_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `homepagebanners`
--
ALTER TABLE `homepagebanners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `home_page`
--
ALTER TABLE `home_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news_detail`
--
ALTER TABLE `news_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `project_floor_plan`
--
ALTER TABLE `project_floor_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `property_category`
--
ALTER TABLE `property_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `recently_viewed_project`
--
ALTER TABLE `recently_viewed_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `resale_property_list`
--
ALTER TABLE `resale_property_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bannerlist`
--
ALTER TABLE `bannerlist`
  ADD CONSTRAINT `bannerlist_banner_type_fk` FOREIGN KEY (`banner_type`) REFERENCES `banner_type_list` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
