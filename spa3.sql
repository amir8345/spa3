-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 01:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spa3`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colorful` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `binding` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `title2`, `lang`, `city`, `age`, `isbn`, `format`, `size`, `weight`, `cover`, `paper`, `pages`, `colorful`, `binding`, `about`, `created_at`, `updated_at`) VALUES
(1, 'من پیش از تو', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'آقای سفیر', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'تختت را مرتب کن', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'اندیشه هگل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `book_numbers`
-- (See below for the actual view)
--
CREATE TABLE `book_numbers` (
`book_id` bigint(20) unsigned
,`score` decimal(12,1)
,`suggestions` bigint(21)
,`debate` decimal(42,0)
,`read` bigint(21)
,`want` bigint(21)
,`reading` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `book_shelf`
--

CREATE TABLE `book_shelf` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `shelf_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_shelf`
--

INSERT INTO `book_shelf` (`id`, `book_id`, `shelf_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(3, 2, 2, NULL, NULL),
(4, 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_user`
--

CREATE TABLE `book_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_user`
--

INSERT INTO `book_user` (`id`, `book_id`, `user_id`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'publisher', NULL, NULL),
(2, 1, 4, 'writer', NULL, NULL),
(3, 3, 1, 'publisher', NULL, NULL),
(4, 4, 2, 'publisher', NULL, NULL),
(5, 4, 3, 'writer', NULL, NULL),
(6, 4, 6, 'writer', NULL, NULL),
(7, 2, 1, 'publisher', NULL, NULL),
(8, 2, 3, 'translate', NULL, NULL),
(9, 2, 3, 'editor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `commented_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commented_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `commented_type`, `commented_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 4, 'book', 2, 'this is a comment from user4 on book2', NULL, NULL),
(2, 4, 'user', 2, 'this is a comment by user4 on user2 page', NULL, NULL),
(3, 3, 'comment', 2, 'this is a comment by user4 on comment2', NULL, NULL),
(4, 6, 'comment', 3, 'fdnksl', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contributors`
--

CREATE TABLE `contributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `death` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contributors`
--

INSERT INTO `contributors` (`id`, `user_id`, `birth`, `death`, `calender_type`, `original_name`, `created_at`, `updated_at`) VALUES
(1, 4, '1358', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower` bigint(20) NOT NULL,
  `following` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower`, `following`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'a', NULL, NULL),
(2, 6, 1, 'a', NULL, NULL),
(3, 2, 6, 'a', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `liked_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `liked_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `liked_type`, `liked_id`, `created_at`) VALUES
(1, 4, 'post', 2, NULL),
(2, 6, 'comment', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_03_122355_create_books_table', 1),
(6, '2022_06_03_122423_create_book_user_table', 1),
(7, '2022_06_03_122439_create_book_shelf_table', 1),
(8, '2022_06_03_122502_create_comments_table', 1),
(9, '2022_06_03_122517_create_posts_table', 1),
(10, '2022_06_03_122534_create_contributors_table', 1),
(11, '2022_06_03_122547_create_follows_table', 1),
(12, '2022_06_03_122559_create_likes_table', 2),
(13, '2022_06_03_122623_create_scores_table', 2),
(14, '2022_06_03_122635_create_shelves_table', 2),
(15, '2022_06_03_122655_create_social_medias_table', 2),
(16, '2022_06_03_122710_create_suggesions_table', 2),
(17, '2022_06_03_135401_publishers', 3),
(19, '2022_06_03_135426_create_publishers_table', 4),
(20, '2022_06_04_061710_create_readers_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `posted_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posted_id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `posted_type`, `posted_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 2, 'book', 2, 'this is a title from user 2 on book 2', 'this is post\'s body from user 2 on book2 ', NULL, NULL),
(2, 3, 'book', 2, 'this is title from user 3 on book2', 'this is body from user 3 on book2', NULL, NULL),
(3, 3, 'user', 1, 'this is a post title by user3 on publisher1', 'this is a post body by user3 on publisher1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE `readers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `readers`
--

INSERT INTO `readers` (`id`, `user_id`, `city`, `created_at`, `updated_at`) VALUES
(1, 3, 'tehran', NULL, NULL),
(2, 6, 'esfahan', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `reader_numbers`
-- (See below for the actual view)
--
CREATE TABLE `reader_numbers` (
`user_id` bigint(20) unsigned
,`followers` bigint(21)
,`library_books` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `book_id`, `score`, `reason`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 6, NULL, NULL, NULL),
(2, 6, 2, 9, NULL, NULL, NULL),
(3, 3, 1, 10, NULL, NULL, NULL),
(4, 4, 1, 10, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shelves`
--

CREATE TABLE `shelves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shelves`
--

INSERT INTO `shelves` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 3, 'باحال ترین کتابهای عمرم', NULL, NULL),
(2, 3, 'read', NULL, NULL),
(3, 3, 'want', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_medias`
--

CREATE TABLE `social_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_medias`
--

INSERT INTO `social_medias` (`id`, `user_id`, `name`, `address`) VALUES
(1, 2, 'twitter', 'twitter.com/ney_publication'),
(2, 2, 'facebook', 'facebook.com/ney_publication');

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`id`, `user_id`, `book_id`, `receiver`, `reason`, `public`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'all nature lovers', 'this is a really good book bro!', 1, NULL, NULL),
(2, 6, 2, '5', 'read this and go dareto bezar', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `timeline`
-- (See below for the actual view)
--
CREATE TABLE `timeline` (
`user_id` decimal(20,0)
,`type` varchar(255)
,`type_id` varchar(255)
,`table` varchar(11)
,`id` bigint(20) unsigned
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 'نشر نی', '', NULL, NULL, NULL),
(2, '', 'نشر چشمه', '', NULL, NULL, NULL),
(3, '', 'محمد', '', NULL, NULL, NULL),
(4, '', 'رضا امیرخانی', '', NULL, NULL, NULL),
(5, '', 'جوجو مویز', '', NULL, NULL, NULL),
(6, '', 'احسان', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_help`
-- (See below for the actual view)
--
CREATE TABLE `user_help` (
`user_id` bigint(20) unsigned
,`username` varchar(255)
,`name` varchar(255)
,`followers` bigint(21)
,`followings` bigint(21)
,`books` bigint(21)
,`type` varchar(11)
);

-- --------------------------------------------------------

--
-- Structure for view `book_numbers`
--
DROP TABLE IF EXISTS `book_numbers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_numbers`  AS SELECT `books`.`id` AS `book_id`, `score_table`.`score` AS `score`, `suggestion_table`.`suggestions` AS `suggestions`, `debate_table`.`debate` AS `debate`, `popular_table`.`read` AS `read`, `popular_table`.`want` AS `want`, `popular_table`.`reading` AS `reading` FROM ((((`books` left join (select `scores`.`book_id` AS `book_id`,round(avg(`scores`.`score`),1) AS `score` from `scores` group by `scores`.`book_id`) `score_table` on(`books`.`id` = `score_table`.`book_id`)) left join (select `suggestions`.`book_id` AS `book_id`,count(`suggestions`.`book_id`) AS `suggestions` from `suggestions` group by `suggestions`.`book_id`) `suggestion_table` on(`books`.`id` = `suggestion_table`.`book_id`)) left join (select `post_comment_table`.`book_id` AS `book_id`,sum(`post_comment_table`.`num`) AS `debate` from (select `posts`.`posted_id` AS `book_id`,count(`posts`.`posted_id`) AS `num` from `posts` where `posts`.`posted_type` = 'book' group by `posts`.`posted_id` union all select `comments`.`commented_id` AS `book_id`,count(`comments`.`commented_id`) AS `num` from `comments` where `comments`.`commented_type` = 'book' group by `comments`.`commented_id`) `post_comment_table` group by `post_comment_table`.`book_id`) `debate_table` on(`books`.`id` = `debate_table`.`book_id`)) left join (select `table1`.`book_id` AS `book_id`,max(case when `table1`.`name` = 'read' then `table1`.`num` else 0 end) AS `read`,max(case when `table1`.`name` = 'want' then `table1`.`num` else 0 end) AS `want`,max(case when `table1`.`name` = 'reading' then `table1`.`num` else 0 end) AS `reading` from (select `book_shelf`.`book_id` AS `book_id`,`shelves`.`name` AS `name`,count(`shelves`.`name`) AS `num` from (`book_shelf` left join `shelves` on(`book_shelf`.`shelf_id` = `shelves`.`id`)) group by `book_shelf`.`book_id`,`shelves`.`name`) `table1` group by `table1`.`book_id`) `popular_table` on(`books`.`id` = `popular_table`.`book_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `reader_numbers`
--
DROP TABLE IF EXISTS `reader_numbers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reader_numbers`  AS SELECT `readers`.`user_id` AS `user_id`, `follower_table`.`followers` AS `followers`, `library`.`library_books` AS `library_books` FROM ((`readers` left join (select `follows`.`following` AS `user_id`,count(`follows`.`follower`) AS `followers` from `follows` group by `follows`.`following`) `follower_table` on(`readers`.`user_id` = `follower_table`.`user_id`)) left join (select `library_table`.`user_id` AS `user_id`,count(`library_table`.`book_id`) AS `library_books` from (select distinct `shelves`.`user_id` AS `user_id`,`book_shelf`.`book_id` AS `book_id` from (`shelves` left join `book_shelf` on(`shelves`.`id` = `book_shelf`.`shelf_id`))) `library_table` group by `library_table`.`user_id`) `library` on(`readers`.`user_id` = `library`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `timeline`
--
DROP TABLE IF EXISTS `timeline`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `timeline`  AS SELECT `shelves`.`user_id` AS `user_id`, 'book' AS `type`, `book_shelf`.`book_id` AS `type_id`, 'book_shelf' AS `table`, `book_shelf`.`id` AS `id`, `book_shelf`.`created_at` AS `created_at` FROM (`book_shelf` join `shelves` on(`book_shelf`.`shelf_id` = `shelves`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `user_help`
--
DROP TABLE IF EXISTS `user_help`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_help`  AS SELECT `users`.`id` AS `user_id`, `users`.`username` AS `username`, `users`.`name` AS `name`, `follower_table`.`followers` AS `followers`, `following_table`.`followings` AS `followings`, `book_table`.`books` AS `books`, CASE WHEN (select `publishers`.`id` from `publishers` where `publishers`.`user_id` = `users`.`id`) THEN 'publisher' WHEN (select `contributors`.`id` from `contributors` where `contributors`.`user_id` = `users`.`id`) THEN 'contributor' WHEN (select `readers`.`id` from `readers` where `readers`.`user_id` = `users`.`id`) THEN 'reader' END AS `type` FROM (((`users` left join (select `follows`.`following` AS `user_id`,count(`follows`.`follower`) AS `followers` from `follows` group by `follows`.`following`) `follower_table` on(`users`.`id` = `follower_table`.`user_id`)) left join (select `follows`.`follower` AS `user_id`,count(`follows`.`following`) AS `followings` from `follows` group by `follows`.`follower`) `following_table` on(`users`.`id` = `following_table`.`user_id`)) left join (select `book_user`.`user_id` AS `user_id`,count(`book_user`.`book_id`) AS `books` from `book_user` group by `book_user`.`user_id`) `book_table` on(`users`.`id` = `book_table`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_shelf`
--
ALTER TABLE `book_shelf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_user`
--
ALTER TABLE `book_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commented_type_commented_id_index` (`commented_type`,`commented_id`);

--
-- Indexes for table `contributors`
--
ALTER TABLE `contributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_liked_type_liked_id_index` (`liked_type`,`liked_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_posted_type_posted_id_index` (`posted_type`,`posted_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shelves`
--
ALTER TABLE `shelves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_medias`
--
ALTER TABLE `social_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book_shelf`
--
ALTER TABLE `book_shelf`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book_user`
--
ALTER TABLE `book_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contributors`
--
ALTER TABLE `contributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `readers`
--
ALTER TABLE `readers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shelves`
--
ALTER TABLE `shelves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_medias`
--
ALTER TABLE `social_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
