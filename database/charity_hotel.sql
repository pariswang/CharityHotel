-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2020-02-22 20:09:19
-- 服务器版本： 5.7.26
-- PHP 版本： 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `charity_hotel`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Dashboard', 'fa-bar-chart', '/', NULL, NULL, NULL),
(2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL, NULL),
(3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL, NULL),
(4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, NULL),
(5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, NULL),
(6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, NULL),
(7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_operation_log`
--

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'GET', '::1', '[]', '2020-02-22 02:29:16', '2020-02-22 02:29:16'),
(2, 1, 'admin/auth/logout', 'GET', '::1', '{\"_pjax\":\"#pjax-container\"}', '2020-02-22 03:32:41', '2020-02-22 03:32:41'),
(3, 1, 'admin', 'GET', '::1', '[]', '2020-02-22 03:33:04', '2020-02-22 03:33:04');

-- --------------------------------------------------------

--
-- 表的结构 `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '2020-02-22 02:27:40', '2020-02-22 02:27:40');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$J1qbZ6OLbWNbQKgnVM488uBqCG2YDi1e0k5Ly6LekFxHioznOAOzm', 'Administrator', NULL, 'LviNCXniRV4m3ZQx8ydepcHXcrYBzhh4ynuzVs2slfJ80Vi8NwEkMcTahhxt', '2020-02-22 02:27:40', '2020-02-22 02:27:40');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user_permissions`
--

CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_04_173148_create_admin_tables', 1);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `wh_hospital`
--

CREATE TABLE `wh_hospital` (
  `id` bigint(20) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `hospital_name` varchar(128) DEFAULT NULL COMMENT '医院名称',
  `region_id` int(11) DEFAULT NULL COMMENT '区域'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='医院名称';

--
-- 转存表中的数据 `wh_hospital`
--

INSERT INTO `wh_hospital` (`id`, `create_date`, `hospital_name`, `region_id`) VALUES
(1231059782408544257, '2020-02-22 11:34:59', '蔡甸区妇幼保健院', 1),
(1231059782773448705, '2020-02-22 11:34:59', '蔡甸区中医院', 1),
(1231059783129964545, '2020-02-22 11:34:59', '华中科技大学同济医学院附属协和医院西院', 1),
(1231059783482286082, '2020-02-22 11:34:59', '华中科技大学同济医学院附属同济医院中法新城院区', 1),
(1231059783876550658, '2020-02-22 11:34:59', '武汉经济技术开发区妇幼保健院', 1),
(1231059784228872194, '2020-02-22 11:34:59', '武汉市蔡甸区人民医院', 1),
(1231059784610553858, '2020-02-22 11:34:59', '武汉市经济开发区妇幼保健院', 1),
(1231059784967069697, '2020-02-22 11:34:59', '武汉市五和中医院', 1),
(1231059785327779842, '2020-02-22 11:34:59', '武汉天爱医院', 1),
(1231059785675907073, '2020-02-22 11:35:00', '光谷医院', 2),
(1231059786032422913, '2020-02-22 11:35:00', '汉口学院-医院', 2),
(1231059786422493185, '2020-02-22 11:35:00', '湖北经济学院医院', 2),
(1231059786766426113, '2020-02-22 11:35:00', '中南财经政法大学医院', 2),
(1231059787118747649, '2020-02-22 11:35:00', '安康医院', 3),
(1231059787475263489, '2020-02-22 11:35:00', '协和东西湖医院', 3),
(1231059787844362242, '2020-02-22 11:35:00', '金银湖医院', 3),
(1231059788435759106, '2020-02-22 11:35:00', '武汉参象匙城中医医院', 3),
(1231059788800663554, '2020-02-22 11:35:00', '武汉东西湖区第二人民医院', 3),
(1231059789228482562, '2020-02-22 11:35:00', '武汉科技大学医学院临床教学医院', 3),
(1231059789576609794, '2020-02-22 11:35:00', '武汉市金银潭医院', 3),
(1231059789937319938, '2020-02-22 11:35:01', '武汉太康医院', 3),
(1231059790298030082, '2020-02-22 11:35:01', '武汉同人康中医医院', 3),
(1231059790641963009, '2020-02-22 11:35:01', '武汉仲景东西湖中医医院', 3),
(1231059790985895938, '2020-02-22 11:35:01', '汉南区中医院', 4),
(1231059791342411778, '2020-02-22 11:35:01', '武汉大学人民医院汉南医院', 4),
(1231059791724093441, '2020-02-22 11:35:01', '武汉东苑中西医结合医院', 4),
(1231059792135135233, '2020-02-22 11:35:01', '武汉后官湖医院', 4),
(1231059792483262466, '2020-02-22 11:35:01', '武汉市汉南区妇幼保健所', 4),
(1231059792827195394, '2020-02-22 11:35:01', '武汉市汉南区红十字会医院', 4),
(1231059793179516929, '2020-02-22 11:35:01', '武汉市汉南区中医医院', 4),
(1231059793527644162, '2020-02-22 11:35:01', '武汉市新城医院', 4),
(1231059793900937217, '2020-02-22 11:35:02', '慈安医院', 5),
(1231059794253258754, '2020-02-22 11:35:02', '九州通医院', 5),
(1231059794597191682, '2020-02-22 11:35:02', '武汉汉沙医院', 5),
(1231059794945318914, '2020-02-22 11:35:02', '武汉济安医院', 5),
(1231059795285057538, '2020-02-22 11:35:02', '武汉龙阳医院', 5),
(1231059795633184769, '2020-02-22 11:35:02', '武汉市第五医院', 5),
(1231059795981312001, '2020-02-22 11:35:02', '武汉市第五医院（显正街）', 5),
(1231059796321050626, '2020-02-22 11:35:02', '武汉市汉阳医院', 5),
(1231059796698537986, '2020-02-22 11:35:02', '武汉市中医医院（二桥分院）', 5),
(1231059797046665217, '2020-02-22 11:35:02', '武汉市中医医院（汉阳院区）', 5),
(1231059797403181058, '2020-02-22 11:35:02', '武汉亚心总医院', 5),
(1231059797747113986, '2020-02-22 11:35:02', '华中科技大学同济医学院附属协和医院（西院区）', 5),
(1231059798091046913, '2020-02-22 11:35:03', '长康妇产科医院', 5),
(1231059798439174146, '2020-02-22 11:35:03', '洪山街社区卫生服务中心', 6),
(1231059798783107074, '2020-02-22 11:35:03', '洪山区和平医院', 6),
(1231059799131234305, '2020-02-22 11:35:03', '湖北六七二中西医结合骨科医院', 6),
(1231059799475167233, '2020-02-22 11:35:03', '湖北省荣军医院', 6),
(1231059799827488770, '2020-02-22 11:35:03', '湖北省中医院（光谷院区）', 6),
(1231059800179810305, '2020-02-22 11:35:03', '湖北中医药大学黄家湖医院', 6),
(1231059800548909058, '2020-02-22 11:35:03', '华中科技大学同济医学院附属同济医院（光谷院区）', 6),
(1231059800901230594, '2020-02-22 11:35:03', '华中科技大学医院', 6),
(1231059801240969218, '2020-02-22 11:35:03', '华中师范大学医院', 6),
(1231059801584902145, '2020-02-22 11:35:03', '江南脑科医院（欢乐大道）', 6),
(1231059801933029378, '2020-02-22 11:35:03', '武汉东亭医院', 6),
(1231059802276962305, '2020-02-22 11:35:04', '武汉方泰医院', 6),
(1231059802625089537, '2020-02-22 11:35:04', '武汉广华医院', 6),
(1231059802969022465, '2020-02-22 11:35:04', '武汉厚德康医院', 6),
(1231059803317149698, '2020-02-22 11:35:04', '武汉理工大学医院', 6),
(1231059803665276929, '2020-02-22 11:35:04', '武汉美吉医院', 6),
(1231059804013404162, '2020-02-22 11:35:04', '武汉南大门综合医院', 6),
(1231059804353142786, '2020-02-22 11:35:04', '武汉市第三医院（光谷院区）', 6),
(1231059804692881410, '2020-02-22 11:35:04', '武汉市东湖医院', 6),
(1231059805041008641, '2020-02-22 11:35:04', '武汉市洪山区妇幼保健所', 6),
(1231059805489799169, '2020-02-22 11:35:04', '武汉市洪山区中医医院', 6),
(1231059805842120706, '2020-02-22 11:35:04', '武汉市普仁医院光谷体验中心', 6),
(1231059806190247937, '2020-02-22 11:35:04', '武汉体育学院医院', 6),
(1231059806534180865, '2020-02-22 11:35:05', '武汉血液中心江南分中心', 6),
(1231059806873919490, '2020-02-22 11:35:05', '武汉长动医院', 6),
(1231059807217852418, '2020-02-22 11:35:05', '御医堂爱心医院', 6),
(1231059807561785346, '2020-02-22 11:35:05', '中建光谷医院', 6),
(1231059807905718273, '2020-02-22 11:35:05', '黄陂区人民医院（盘龙城院区）', 7),
(1231059808253845505, '2020-02-22 11:35:05', '黄陂区人民医院盘龙城院区-内儿科楼', 7),
(1231059808597778433, '2020-02-22 11:35:05', '黄陂区医院（盘龙城院区）', 7),
(1231059808954294274, '2020-02-22 11:35:05', '黄陂区中医院', 7),
(1231059809294032898, '2020-02-22 11:35:05', '前川街道卫生院', 7),
(1231059809637965825, '2020-02-22 11:35:05', '群光医院', 7),
(1231059809977704449, '2020-02-22 11:35:05', '彤百堂中医院', 7),
(1231059810309054466, '2020-02-22 11:35:05', '武汉慈惠医院', 7),
(1231059810699124738, '2020-02-22 11:35:06', '武汉二八八医院', 7),
(1231059811038863362, '2020-02-22 11:35:06', '百步亭中医院', 8),
(1231059811378601986, '2020-02-22 11:35:06', '湖北省中西医结合医院（中山分院）', 8),
(1231059811781255170, '2020-02-22 11:35:06', '解放军第四五七医院', 8),
(1231059812125188097, '2020-02-22 11:35:06', '商职医院（堤角分院）', 8),
(1231059812473315329, '2020-02-22 11:35:06', '圣爱中医馆（兴业馆）', 8),
(1231059812813053954, '2020-02-22 11:35:06', '武汉百佳妇产医院', 8),
(1231059813161181185, '2020-02-22 11:35:06', '武汉岱山医院', 8),
(1231059813521891329, '2020-02-22 11:35:06', '武汉德福医院', 8),
(1231059813861629953, '2020-02-22 11:35:06', '武汉堤角爱康中西医结合医院', 8),
(1231059814213951490, '2020-02-22 11:35:06', '武汉和谐中西结合医院', 8),
(1231059814553690114, '2020-02-22 11:35:06', '武汉黄浦中西医结合医院', 8),
(1231059814893428737, '2020-02-22 11:35:07', '武汉金药堂中医院', 8),
(1231059815233167362, '2020-02-22 11:35:07', '武汉康骨中医院', 8),
(1231059815581294593, '2020-02-22 11:35:07', '武汉科德中医医院', 8),
(1231059815925227521, '2020-02-22 11:35:07', '武汉老肖家春林医院', 8),
(1231059816256577538, '2020-02-22 11:35:07', '武汉仁博医院', 8),
(1231059816600510466, '2020-02-22 11:35:07', '武汉市第八医院', 8),
(1231059816936054786, '2020-02-22 11:35:07', '武汉市第六医院', 8),
(1231059817275793409, '2020-02-22 11:35:07', '武汉市妇女儿童医疗保健中心', 8),
(1231059817623920641, '2020-02-22 11:35:07', '武汉市汉口医院', 8),
(1231059817988825090, '2020-02-22 11:35:07', '武汉市汉口医院（东区）', 8),
(1231059818345340929, '2020-02-22 11:35:07', '武汉市中心医院（后湖院区）', 8),
(1231059818710245377, '2020-02-22 11:35:07', '武汉市中心医院（南京路院区）', 8),
(1231059819070955522, '2020-02-22 11:35:08', '武汉市中医医院（台北分院）', 8),
(1231059819423277058, '2020-02-22 11:35:08', '武汉市中医院（台北分院）', 8),
(1231059819775598594, '2020-02-22 11:35:08', '武汉兴业医院', 8),
(1231059820157280257, '2020-02-22 11:35:08', '武汉中瑞中医院', 8),
(1231059820501213186, '2020-02-22 11:35:08', '长江航运总医院', 8),
(1231059820878700546, '2020-02-22 11:35:08', '长江水利委员会长江医院', 8),
(1231059821214244866, '2020-02-22 11:35:08', '中国人民解放军空降兵军医院', 8),
(1231059821600120834, '2020-02-22 11:35:08', '中国人民解放军中部战区总医院（汉口院区）', 8),
(1231059821939859458, '2020-02-22 11:35:08', '中医院（台北分院）', 8),
(1231059822279598082, '2020-02-22 11:35:08', '楚天医院', 9),
(1231059822623531010, '2020-02-22 11:35:08', '湖北省中西医结合医院', 9),
(1231059822959075330, '2020-02-22 11:35:08', '湖北省中西医结合医院（江北分部）', 9),
(1231059823303008257, '2020-02-22 11:35:09', '湖北夏小中医院', 9),
(1231059823646941185, '2020-02-22 11:35:09', '华中科技大学同济医学院附属协和医院', 9),
(1231059823982485506, '2020-02-22 11:35:09', '武汉爱尔眼科医院汉口医院', 9),
(1231059824334807041, '2020-02-22 11:35:09', '武汉百姓医院', 9),
(1231059824674545665, '2020-02-22 11:35:09', '武汉楚天医院', 9),
(1231059825022672897, '2020-02-22 11:35:09', '武汉第一口腔医院', 9),
(1231059825383383042, '2020-02-22 11:35:09', '武汉和谐医院养医合作医院', 9),
(1231059825739898881, '2020-02-22 11:35:09', '武汉江汉华进医院', 9),
(1231059826079637506, '2020-02-22 11:35:09', '武汉麻塘中医院', 9),
(1231059826436153345, '2020-02-22 11:35:09', '武汉市第十一医院', 9),
(1231059826813640706, '2020-02-22 11:35:09', '武汉市红十字会医院', 9),
(1231059827149185025, '2020-02-22 11:35:09', '武汉市江汉区常青医院', 9),
(1231059827493117954, '2020-02-22 11:35:10', '武汉市商业职工医院', 9),
(1231059827841245185, '2020-02-22 11:35:10', '武汉市怡和医院', 9),
(1231059828176789505, '2020-02-22 11:35:10', '武汉市优抚医院', 9),
(1231059828537499649, '2020-02-22 11:35:10', '武汉市中医医院', 9),
(1231059828877238273, '2020-02-22 11:35:10', '武汉协和医院', 9),
(1231059829221171201, '2020-02-22 11:35:10', '武汉新特中医院', 9),
(1231059829569298433, '2020-02-22 11:35:10', '武汉亚洲心脏病医院', 9),
(1231059829913231362, '2020-02-22 11:35:10', '武汉中阳中医医院', 9),
(1231059830252969985, '2020-02-22 11:35:10', '协和武汉红十字会医院', 9),
(1231059830592708610, '2020-02-22 11:35:10', '江夏区第一人民医院', 10),
(1231059830936641537, '2020-02-22 11:35:10', '江夏区中医医院', 10),
(1231059831276380161, '2020-02-22 11:35:10', '江夏区中医院城北门诊部', 10),
(1231059831624507394, '2020-02-22 11:35:11', '庙山威鹏医院', 10),
(1231059831972634625, '2020-02-22 11:35:11', '瑞恩医院', 10),
(1231059832341733377, '2020-02-22 11:35:11', '省人民医院东院', 10),
(1231059832685666306, '2020-02-22 11:35:11', '武汉大学人民医院东院', 10),
(1231059834044620802, '2020-02-22 11:35:11', '武汉东湖学院-医院', 10),
(1231059834388553729, '2020-02-22 11:35:11', '武汉汉派中医医院', 10),
(1231059834724098049, '2020-02-22 11:35:11', '武汉江夏区雷神山医院', 10),
(1231059835072225282, '2020-02-22 11:35:11', '武汉民泰医院', 10),
(1231059835407769601, '2020-02-22 11:35:11', '武汉侨亚博爱康复医院', 10),
(1231059835755896834, '2020-02-22 11:35:11', '武汉市广宁医院', 10),
(1231059836108218369, '2020-02-22 11:35:12', '武汉市江夏华山医院', 10),
(1231059836460539906, '2020-02-22 11:35:12', '武汉市江夏区雷神山医院', 10),
(1231059836804472834, '2020-02-22 11:35:12', '武汉铁路职业技术学院-校医院', 10),
(1231059837140017154, '2020-02-22 11:35:12', '国营七五二医院', 11),
(1231059837492338690, '2020-02-22 11:35:12', '华中科技大学附属普爱医院', 11),
(1231059837878214658, '2020-02-22 11:35:12', '吉田社区卫生服务中心', 11),
(1231059838217953281, '2020-02-22 11:35:12', '利济医院', 11),
(1231059838553497602, '2020-02-22 11:35:12', '仁民医院', 11),
(1231059838897430529, '2020-02-22 11:35:12', '融济中医院', 11),
(1231059839237169153, '2020-02-22 11:35:12', '武汉市第四医院西院区', 11),
(1231059839581102081, '2020-02-22 11:35:12', '同普医院', 11),
(1231059839925035009, '2020-02-22 11:35:12', '武汉南威医院', 11),
(1231059840268967938, '2020-02-22 11:35:13', '武汉仁爱医院', 11),
(1231059840612900866, '2020-02-22 11:35:13', '武汉市第四医院（武胜路）', 11),
(1231059840969416706, '2020-02-22 11:35:13', '武汉市第一医院', 11),
(1231059841334321154, '2020-02-22 11:35:13', '武汉市硚口区妇幼保健院', 11),
(1231059841669865473, '2020-02-22 11:35:13', '武汉市融济中医院', 11),
(1231059842017992706, '2020-02-22 11:35:13', '武汉顺园中医医院', 11),
(1231059842357731330, '2020-02-22 11:35:13', '武汉天一中医医院', 11),
(1231059842705858562, '2020-02-22 11:35:13', '宗关社区卫生服务中心', 11),
(1231059843079151618, '2020-02-22 11:35:13', '华润武钢总医院', 12),
(1231059843414695937, '2020-02-22 11:35:13', '青山区儿童医院', 12),
(1231059843758628865, '2020-02-22 11:35:13', '青山区妇幼保健院', 12),
(1231059844115144705, '2020-02-22 11:35:13', '市武钢二医院', 12),
(1231059844463271937, '2020-02-22 11:35:14', '武汉科技大学附属汉阳医院百沐仁和中医医院', 12),
(1231059844811399170, '2020-02-22 11:35:14', '武汉普仁青船医院', 12),
(1231059845159526402, '2020-02-22 11:35:14', '武汉市第九医院', 12),
(1231059845516042241, '2020-02-22 11:35:14', '武汉市普仁医院', 12),
(1231059845855780865, '2020-02-22 11:35:14', '武汉市普仁医院利平分院', 12),
(1231059846233268225, '2020-02-22 11:35:14', '武汉市石化医院', 12),
(1231059846573006849, '2020-02-22 11:35:14', '武冶医院', 12),
(1231059846908551170, '2020-02-22 11:35:14', '湖北大学医院', 13),
(1231059847256678401, '2020-02-22 11:35:14', '湖北大中医院', 13),
(1231059847600611329, '2020-02-22 11:35:14', '湖北大中中医院', 13),
(1231059847936155649, '2020-02-22 11:35:14', '湖北神农中医医院', 13),
(1231059848284282881, '2020-02-22 11:35:14', '湖北省第三人民医院', 13),
(1231059848628215809, '2020-02-22 11:35:15', '湖北省妇幼保健院', 13),
(1231059848976343041, '2020-02-22 11:35:15', '湖北省直属机关医院', 13),
(1231059849316081665, '2020-02-22 11:35:15', '湖北省中医院（凤凰门诊部）', 13),
(1231059849660014594, '2020-02-22 11:35:15', '湖北省中医院（花园山院区）', 13),
(1231059850003947521, '2020-02-22 11:35:15', '湖北中医药大学国医堂', 13),
(1231059850364657665, '2020-02-22 11:35:15', '湖北中医药大学教学医院', 13),
(1231059850716979201, '2020-02-22 11:35:15', '华中科技大学同济医学院附属梨园医院', 13),
(1231059851065106434, '2020-02-22 11:35:15', '解放军中部战区总医院', 13),
(1231059851417427970, '2020-02-22 11:35:15', '蓝湖医院', 13),
(1231059851761360898, '2020-02-22 11:35:15', '南大门中医医院', 13),
(1231059852096905217, '2020-02-22 11:35:15', '南湖医院', 13),
(1231059852440838146, '2020-02-22 11:35:15', '普航医院​​​', 13),
(1231059852776382465, '2020-02-22 11:35:16', '武昌区妇幼保健院（首义四巷）', 13),
(1231059853120315393, '2020-02-22 11:35:16', '武昌区惠民医院', 13),
(1231059853468442625, '2020-02-22 11:35:16', '武汉安达迅医疗救护站', 13),
(1231059853833347073, '2020-02-22 11:35:16', '武汉大学人民医院', 13),
(1231059854189862913, '2020-02-22 11:35:16', '武汉大学医学院同仁医院', 13),
(1231059854533795842, '2020-02-22 11:35:16', '武汉大学医院', 13),
(1231059854894505985, '2020-02-22 11:35:16', '武汉大学中南医院', 13),
(1231059855230050305, '2020-02-22 11:35:16', '武汉道一堂中医医院', 13),
(1231059855599149057, '2020-02-22 11:35:16', '武汉恒春和中医医院', 13),
(1231059855938887682, '2020-02-22 11:35:16', '武汉华夏医院', 13),
(1231059856278626306, '2020-02-22 11:35:16', '武汉甲康医院', 13),
(1231059856626753538, '2020-02-22 11:35:16', '武汉科技大学附属天佑医院', 13),
(1231059856974880770, '2020-02-22 11:35:17', '武汉蓝湖医院', 13),
(1231059857343979521, '2020-02-22 11:35:17', '武汉理工大学医院（余家头分院）', 13),
(1231059857696301057, '2020-02-22 11:35:17', '武汉马应龙中西结合医院​​​​​​​​', 13),
(1231059858052816897, '2020-02-22 11:35:17', '武汉瑞华医院', 13),
(1231059858396749826, '2020-02-22 11:35:17', '武汉市第七医院​​​', 13),
(1231059858753265666, '2020-02-22 11:35:17', '武汉市第三医院（首义院区）', 13),
(1231059859197861889, '2020-02-22 11:35:17', '武汉市第三医院医联体医院', 13),
(1231059859537600514, '2020-02-22 11:35:17', '武汉市武昌医院（南湖院区）', 13),
(1231059859898310657, '2020-02-22 11:35:17', '武汉市武昌医院（西区）', 13),
(1231059860233854978, '2020-02-22 11:35:17', '武汉武锅医院', 13),
(1231059860581982210, '2020-02-22 11:35:17', '武汉雄楚中西医结合医院', 13),
(1231059860925915138, '2020-02-22 11:35:17', '武汉中原医院', 13),
(1231059861303402497, '2020-02-22 11:35:18', '武警湖北省总队医院', 13),
(1231059861693472769, '2020-02-22 11:35:18', '中国人民解放军中部战区总医院', 13),
(1231059862045794306, '2020-02-22 11:35:18', '紫荆医院', 13),
(1231059862389727234, '2020-02-22 11:35:18', '武汉佳人医院', 14),
(1231059862725271554, '2020-02-22 11:35:18', '武汉市新洲区妇幼保健院', 14),
(1231059863069204481, '2020-02-22 11:35:18', '武汉市新洲区人民医院', 14),
(1231059863408943105, '2020-02-22 11:35:18', '新洲区中医医院', 14);

-- --------------------------------------------------------

--
-- 表的结构 `wh_hotel`
--

CREATE TABLE `wh_hotel` (
  `id` bigint(20) NOT NULL COMMENT 'ID',
  `user_id` bigint(20) DEFAULT NULL COMMENT '关联用户 申请人',
  `phone` varchar(20) DEFAULT NULL COMMENT '酒店登录账号',
  `pwd` varchar(32) DEFAULT NULL COMMENT '酒店登录密码',
  `region_id` bigint(20) DEFAULT NULL COMMENT '区域ID',
  `hotel_name` varchar(128) DEFAULT NULL COMMENT '酒店名称',
  `simple_name` varchar(128) DEFAULT NULL COMMENT '简称',
  `classify` varchar(32) DEFAULT NULL COMMENT '类型',
  `meal` varchar(128) DEFAULT NULL COMMENT '早中晚餐饮',
  `address` varchar(256) DEFAULT NULL COMMENT '地址',
  `uname` varchar(128) DEFAULT NULL COMMENT '联系人',
  `wechat` varchar(64) DEFAULT NULL COMMENT '微信',
  `room_count` int(11) DEFAULT NULL COMMENT '可安排房间数',
  `use_room_count` int(11) DEFAULT NULL COMMENT '已使用房间数',
  `medical_staff_free` tinyint(2) DEFAULT NULL COMMENT '医务人员是否免费',
  `expropriation` tinyint(2) DEFAULT NULL COMMENT '是否愿意被征用',
  `discount_price` double(10,2) DEFAULT NULL COMMENT '优惠房价',
  `reception` tinyint(2) DEFAULT NULL COMMENT '是否有接待',
  `cleaning` tinyint(2) DEFAULT NULL COMMENT '是否有清洁',
  `collocation_description` varchar(1024) DEFAULT NULL COMMENT '房间搭配说明',
  `description` varchar(1024) DEFAULT NULL COMMENT '酒店说明',
  `create_date` timestamp NULL DEFAULT NULL COMMENT '创建日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='酒店表';

-- --------------------------------------------------------

--
-- 表的结构 `wh_hotel_hospital`
--

CREATE TABLE `wh_hotel_hospital` (
  `hotel_id` int(11) NOT NULL DEFAULT '0' COMMENT '酒店',
  `hospital_id` int(11) NOT NULL DEFAULT '0' COMMENT '医院',
  `distance` int(11) DEFAULT NULL COMMENT '距离',
  `hospital_name` varchar(100) DEFAULT NULL COMMENT '注释',
  `hospital_addr` varchar(200) DEFAULT NULL COMMENT '类名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='酒店医院关联表';

-- --------------------------------------------------------

--
-- 表的结构 `wh_region`
--

CREATE TABLE `wh_region` (
  `id` bigint(20) NOT NULL,
  `region_name` varchar(64) DEFAULT NULL COMMENT '区域',
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='区域表';

--
-- 转存表中的数据 `wh_region`
--

INSERT INTO `wh_region` (`id`, `region_name`, `create_date`) VALUES
(1, '蔡甸区', '2020-02-22 11:26:07'),
(2, '东湖高新', '2020-02-22 11:26:07'),
(3, '东西湖区', '2020-02-22 11:26:07'),
(4, '汉南区', '2020-02-22 11:26:07'),
(5, '汉阳区', '2020-02-22 11:26:07'),
(6, '洪山区', '2020-02-22 11:26:07'),
(7, '黄陂区', '2020-02-22 11:26:07'),
(8, '江岸区', '2020-02-22 11:26:07'),
(9, '江汉区', '2020-02-22 11:26:07'),
(10, '江夏区', '2020-02-22 11:26:07'),
(11, '硚口区', '2020-02-22 11:26:07'),
(12, '青山区', '2020-02-22 11:26:07'),
(13, '武昌区', '2020-02-22 11:26:07'),
(14, '新洲区', '2020-02-22 11:26:07'),
(15, '武汉经济开发区', '2020-02-22 11:26:07');

-- --------------------------------------------------------

--
-- 表的结构 `wh_subscribe`
--

CREATE TABLE `wh_subscribe` (
  `id` int(11) NOT NULL COMMENT '编号',
  `user_id` bigint(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `conn_person` varchar(12) DEFAULT NULL COMMENT '联系人',
  `conn_phone` varchar(30) DEFAULT NULL COMMENT '联系电话',
  `conn_type` int(11) DEFAULT NULL COMMENT '身份信息:1=医护人员,2=志愿者,3=后勤保障',
  `checkin_num` int(11) DEFAULT NULL COMMENT '入住人数',
  `checked` smallint(2) DEFAULT '0' COMMENT '是否核实',
  `date_begin` date DEFAULT NULL COMMENT '开始日期',
  `date_end` date DEFAULT NULL COMMENT '结束日期',
  `region_id` int(11) DEFAULT NULL COMMENT '区域ID',
  `hope_addr` varchar(100) DEFAULT NULL COMMENT '希望地点',
  `checkin_reson` varchar(100) DEFAULT NULL COMMENT '入住原因',
  `remark` varchar(200) DEFAULT NULL COMMENT '其他说明',
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `hotel_id` bigint(20) DEFAULT NULL COMMENT '酒店ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入住申请';

-- --------------------------------------------------------

--
-- 表的结构 `wh_user`
--

CREATE TABLE `wh_user` (
  `id` bigint(20) NOT NULL,
  `phone` varchar(20) DEFAULT '' COMMENT '手机号',
  `uname` varchar(128) DEFAULT NULL COMMENT '姓名',
  `wechat` varchar(64) DEFAULT NULL COMMENT '微信号',
  `phonenumber` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `position` varchar(32) DEFAULT NULL COMMENT '岗位（用户自己填写，医护人员，后勤保障，其他）',
  `company` varchar(256) DEFAULT NULL COMMENT '公司',
  `role` tinyint(2) DEFAULT NULL COMMENT '4=志愿者，3=酒店人员，2=求助者 1=管理人员',
  `state` tinyint(2) DEFAULT NULL COMMENT '状态：1=已核实，0=未知，2=禁用',
  `create_date` timestamp NULL DEFAULT NULL,
  `openid` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转储表的索引
--

--
-- 表的索引 `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- 表的索引 `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_name_unique` (`name`),
  ADD UNIQUE KEY `admin_permissions_slug_unique` (`slug`);

--
-- 表的索引 `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_name_unique` (`name`),
  ADD UNIQUE KEY `admin_roles_slug_unique` (`slug`);

--
-- 表的索引 `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`);

--
-- 表的索引 `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- 表的索引 `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`);

--
-- 表的索引 `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- 表的索引 `admin_user_permissions`
--
ALTER TABLE `admin_user_permissions`
  ADD KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`);

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 表的索引 `wh_hospital`
--
ALTER TABLE `wh_hospital`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wh_hotel`
--
ALTER TABLE `wh_hotel`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wh_hotel_hospital`
--
ALTER TABLE `wh_hotel_hospital`
  ADD KEY `hotel_id_hospital_id` (`hotel_id`,`hospital_id`);

--
-- 表的索引 `wh_region`
--
ALTER TABLE `wh_region`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wh_subscribe`
--
ALTER TABLE `wh_subscribe`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wh_user`
--
ALTER TABLE `wh_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `wh_hospital`
--
ALTER TABLE `wh_hospital`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1231059863408943106;

--
-- 使用表AUTO_INCREMENT `wh_hotel`
--
ALTER TABLE `wh_hotel`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `wh_region`
--
ALTER TABLE `wh_region`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `wh_subscribe`
--
ALTER TABLE `wh_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
