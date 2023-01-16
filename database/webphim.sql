/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100611
 Source Host           : 127.0.0.1:3306
 Source Schema         : webphim

 Target Server Type    : MySQL
 Target Server Version : 100611
 File Encoding         : 65001

 Date: 14/01/2023 15:58:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `position` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Phim Netflix', 'Phim netflix cập nhật hằng ngày', 1, 'phim-netflix', 1);
INSERT INTO `categories` VALUES (4, 'Phim Lẻ', 'Phim Lẻ cập nhật hằng ngày', 1, 'phim-le', 2);
INSERT INTO `categories` VALUES (5, 'Phim Bộ', 'Phim Bộ cập nhật hằng ngày', 1, 'phim-bo', 3);
INSERT INTO `categories` VALUES (6, 'Phim Chiếu Rạp', 'Phim Chiếu Rạp cập nhật hằng ngày', 1, 'phim-chieu-rap', 0);

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'NULL',
  `status` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `position` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES (1, 'Việt Nam', 'Phim Việt Nam cập nhật hằng ngày', 1, 'viet-nam', 1);
INSERT INTO `countries` VALUES (2, 'Trung Quốc', 'Phim Trung Quốc cập nhật hằng ngày', 1, 'trung-quoc', 10);
INSERT INTO `countries` VALUES (3, 'Ấn Độ', 'Phim Ấn Độ cập nhật hằng ngày', 1, 'an-do', 1);
INSERT INTO `countries` VALUES (4, 'Mỹ', 'Phim Mỹ cập nhật hằng ngày', 1, 'my', 2);
INSERT INTO `countries` VALUES (5, 'Hồng Kông', 'Phim Hồng Kông cập nhật hằng ngày', 1, 'hong-kong', 3);
INSERT INTO `countries` VALUES (6, 'Nhật Bản', 'Phim Nhật Bản cập nhật hằng ngày', 1, 'nhat-ban', 0);
INSERT INTO `countries` VALUES (7, 'Trung Quốc', 'Phim Trung Quốc cập nhật hằng ngày', 1, 'trung-quoc', 5);
INSERT INTO `countries` VALUES (8, 'Hàn Quốc', 'Phim Hàn Quốc cập nhật hằng ngày', 1, 'han-quoc', 6);
INSERT INTO `countries` VALUES (9, 'Đài Loan', 'Phim Đài Loan cập nhật hằng ngày', 1, 'dai-loan', 7);
INSERT INTO `countries` VALUES (10, 'Thái Lan', 'Phim Thái Lan cập nhật hằng ngày', 1, 'thai-lan', 8);
INSERT INTO `countries` VALUES (11, 'Philippin', 'Phim Philippin cập nhật hằng ngày', 1, 'philippin', 9);

-- ----------------------------
-- Table structure for episodes
-- ----------------------------
DROP TABLE IF EXISTS `episodes`;
CREATE TABLE `episodes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NULL DEFAULT NULL,
  `linkphim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `episode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `movie_id`(`movie_id` ASC) USING BTREE,
  INDEX `episode`(`episode` ASC) USING BTREE,
  CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of episodes
-- ----------------------------
INSERT INTO `episodes` VALUES (7, 2, '<iframe width=\"100%\" height=\"500\" src=\"https://www.youtube.com/embed/SC7BfxpWieM\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '1', '2022-08-13 16:39:21', '2022-08-13 16:39:21');
INSERT INTO `episodes` VALUES (11, 10, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/Bf95eoTfM\" width=\"100%\"></iframe></p>', 'HD', '2022-08-16 16:01:14', '2022-08-16 16:01:14');
INSERT INTO `episodes` VALUES (12, 6, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/1cX0REvDv\" width=\"100%\"></iframe></p>', 'HD', '2022-08-16 16:11:02', '2022-08-16 16:11:02');
INSERT INTO `episodes` VALUES (14, 3, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/OvRaAbho-\" width=\"100%\"></iframe></p>', 'HD', '2022-08-16 16:20:31', '2022-08-16 16:20:31');
INSERT INTO `episodes` VALUES (15, 11, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/E44YIAMYA\" width=\"100%\"></iframe></p>', '1', '2022-08-16 16:36:24', '2022-08-16 16:36:24');
INSERT INTO `episodes` VALUES (16, 11, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/6ACe_UYY1\" width=\"100%\"></iframe></p>', '2', '2022-08-16 16:37:07', '2022-08-16 16:37:07');
INSERT INTO `episodes` VALUES (17, 11, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/-eSNEtfQr\" width=\"100%\"></iframe></p>', '3', '2022-08-16 16:37:41', '2022-08-16 16:37:41');
INSERT INTO `episodes` VALUES (18, 11, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/cUKpluGuP\" width=\"100%\"></iframe></p>', '4', '2022-08-16 16:38:13', '2022-08-16 16:38:13');
INSERT INTO `episodes` VALUES (19, 11, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/BeISPTdYB\" width=\"100%\"></iframe></p>', '6', '2022-08-16 16:40:06', '2022-08-16 16:40:06');
INSERT INTO `episodes` VALUES (20, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/b0-CMdFl4\" width=\"100%\"></iframe></p>', '1', '2022-08-16 22:52:51', '2022-08-16 22:52:51');
INSERT INTO `episodes` VALUES (21, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/AOD7GFfhX\" width=\"100%\"></iframe></p>', '2', '2022-08-16 22:55:33', '2022-08-16 22:55:33');
INSERT INTO `episodes` VALUES (22, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/4pOdGcwSkn\" width=\"100%\"></iframe></p>', '3', '2022-08-16 22:56:38', '2022-08-16 22:56:38');
INSERT INTO `episodes` VALUES (23, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/pSjDqUiNL\" width=\"100%\"></iframe></p>', '4', '2022-08-16 22:57:06', '2022-08-16 22:57:06');
INSERT INTO `episodes` VALUES (24, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/Vk-zI-JlH\" width=\"100%\"></iframe></p>', '5', '2022-08-16 22:57:42', '2022-08-16 22:57:42');
INSERT INTO `episodes` VALUES (25, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/ADb3NNuNa\" width=\"100%\"></iframe></p>', '6', '2022-08-16 22:58:16', '2022-08-16 22:58:16');
INSERT INTO `episodes` VALUES (26, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/Y2Af_wYfu\" width=\"100%\"></iframe></p>', '7', '2022-08-16 22:58:41', '2022-08-16 22:58:41');
INSERT INTO `episodes` VALUES (27, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/oBtxncMvS\" width=\"100%\"></iframe></p>', '8', '2022-08-16 22:59:04', '2022-08-16 22:59:04');
INSERT INTO `episodes` VALUES (28, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/mi7AoWgyy\" width=\"100%\"></iframe></p>', '9', '2022-08-16 22:59:29', '2022-08-16 22:59:29');
INSERT INTO `episodes` VALUES (29, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/Ige_N8LlKU\" width=\"100%\"></iframe></p>', '10', '2022-08-16 22:59:57', '2022-08-16 22:59:57');
INSERT INTO `episodes` VALUES (30, 12, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/toUrF0IAU\" width=\"100%\"></iframe></p>', '11', '2022-08-16 23:00:26', '2022-08-16 23:00:26');
INSERT INTO `episodes` VALUES (31, 13, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/AsChlko4h\" width=\"100%\"></iframe></p>', 'HD', '2022-08-16 23:17:00', '2022-08-16 23:17:00');
INSERT INTO `episodes` VALUES (32, 9, '<p><iframe allowfullscreen frameborder=\"0\" height=\"360\" scrolling=\"0\" src=\"https://short.ink/TGJ87GUJZ\" width=\"100%\"></iframe></p>', 'HD', '2022-08-18 18:01:39', '2022-08-18 18:01:39');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `position` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of genres
-- ----------------------------
INSERT INTO `genres` VALUES (1, 'Tâm lý', 'Tâm lý cập nhật thường xuyên', 1, 'tam-ly', 0);
INSERT INTO `genres` VALUES (2, 'Tình Cảm', 'Tình Cảm  cập nhật thường xuyên', 1, 'tinh-cam', 10);
INSERT INTO `genres` VALUES (3, 'Hành động', 'Hành động cập nhật thường xuyên', 1, 'hanh-dong', 2);
INSERT INTO `genres` VALUES (4, 'Viễn Tưởng', 'Viễn Tưởng cập nhật thường xuyên', 1, 'vien-tuong', 2);
INSERT INTO `genres` VALUES (5, 'Hoạt Hình', 'Hoạt Hình cập nhật thường xuyên', 1, 'hoat-hinh', 3);
INSERT INTO `genres` VALUES (6, 'Kinh Dị', 'Kinh Dị cập nhật thường xuyên', 1, 'kinh-di', 1);
INSERT INTO `genres` VALUES (7, 'Hài Hước', 'Hài Hước cập nhật thường xuyên', 1, 'hai-huoc', 5);
INSERT INTO `genres` VALUES (8, 'Hình Sự', 'Hình Sự cập nhật thường xuyên', 1, 'hinh-su', 6);
INSERT INTO `genres` VALUES (9, 'Võ Thuật', 'Võ Thuật cập nhật thường xuyên', 1, 'vo-thuat', 7);
INSERT INTO `genres` VALUES (10, 'Cổ Trang', 'Cổ Trang cập nhật thường xuyên', 1, 'co-trang', 8);
INSERT INTO `genres` VALUES (11, 'Phim Ma', 'Phim Ma cập nhật thường xuyên', 1, 'phim-ma', 9);
INSERT INTO `genres` VALUES (12, 'Tình Cảm', 'Tình Cảm cập nhật thường xuyên', 1, 'tinh-cam', 11);
INSERT INTO `genres` VALUES (13, 'Thể Thao Âm Nhạc', 'Thể Thao Âm Nhạc cập nhật thường xuyên', 1, 'the-thao-am-nhac', 12);
INSERT INTO `genres` VALUES (14, 'Thần Thoại', 'Thần Thoại cập nhật thường xuyên', 1, 'than-thoai', 13);
INSERT INTO `genres` VALUES (15, 'Tài Liệu', 'Tài Liệu cập nhật thường xuyên', 1, 'tai-lieu', 14);
INSERT INTO `genres` VALUES (16, 'Phiêu Lưu', 'Phiêu Lưu cập nhật thường xuyên', 1, 'phieu-luu', 15);
INSERT INTO `genres` VALUES (17, 'Gia Đình', 'Gia Đình cập nhật thường xuyên', 1, 'gia-dinh', 16);
INSERT INTO `genres` VALUES (18, 'Chiến Tranh', 'Chiến Tranh cập nhật thường xuyên', 1, 'chien-tranh', 17);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for movie_category
-- ----------------------------
DROP TABLE IF EXISTS `movie_category`;
CREATE TABLE `movie_category`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `movie_id`(`movie_id` ASC) USING BTREE,
  CONSTRAINT `movie_category_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of movie_category
-- ----------------------------
INSERT INTO `movie_category` VALUES (1, 13, 4);
INSERT INTO `movie_category` VALUES (2, 13, 6);
INSERT INTO `movie_category` VALUES (3, 12, 1);
INSERT INTO `movie_category` VALUES (5, 11, 5);
INSERT INTO `movie_category` VALUES (6, 10, 4);
INSERT INTO `movie_category` VALUES (7, 10, 6);
INSERT INTO `movie_category` VALUES (8, 9, 4);
INSERT INTO `movie_category` VALUES (9, 9, 6);
INSERT INTO `movie_category` VALUES (10, 6, 4);
INSERT INTO `movie_category` VALUES (11, 6, 6);
INSERT INTO `movie_category` VALUES (12, 3, 4);
INSERT INTO `movie_category` VALUES (13, 3, 6);
INSERT INTO `movie_category` VALUES (14, 12, 5);
INSERT INTO `movie_category` VALUES (16, 2, 1);

-- ----------------------------
-- Table structure for movie_genre
-- ----------------------------
DROP TABLE IF EXISTS `movie_genre`;
CREATE TABLE `movie_genre`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NULL DEFAULT NULL,
  `genre_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `movie_id`(`movie_id` ASC) USING BTREE,
  CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of movie_genre
-- ----------------------------
INSERT INTO `movie_genre` VALUES (7, 9, 5);
INSERT INTO `movie_genre` VALUES (8, 9, 7);
INSERT INTO `movie_genre` VALUES (9, 9, 16);
INSERT INTO `movie_genre` VALUES (10, 6, 3);
INSERT INTO `movie_genre` VALUES (12, 3, 4);
INSERT INTO `movie_genre` VALUES (14, 3, 7);
INSERT INTO `movie_genre` VALUES (15, 2, 1);
INSERT INTO `movie_genre` VALUES (17, 2, 16);
INSERT INTO `movie_genre` VALUES (18, 2, 18);
INSERT INTO `movie_genre` VALUES (19, 3, 5);
INSERT INTO `movie_genre` VALUES (20, 10, 4);
INSERT INTO `movie_genre` VALUES (21, 10, 16);
INSERT INTO `movie_genre` VALUES (22, 10, 17);
INSERT INTO `movie_genre` VALUES (23, 6, 4);
INSERT INTO `movie_genre` VALUES (24, 6, 16);
INSERT INTO `movie_genre` VALUES (25, 11, 8);
INSERT INTO `movie_genre` VALUES (26, 11, 9);
INSERT INTO `movie_genre` VALUES (27, 12, 5);
INSERT INTO `movie_genre` VALUES (28, 12, 7);
INSERT INTO `movie_genre` VALUES (29, 13, 3);
INSERT INTO `movie_genre` VALUES (30, 13, 7);
INSERT INTO `movie_genre` VALUES (31, 13, 16);

-- ----------------------------
-- Table structure for movies
-- ----------------------------
DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `duration_movie` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` int NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `genre_id` int NULL DEFAULT NULL,
  `country_id` int NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `movie_hot` int NULL DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `resolution` int NULL DEFAULT 0,
  `sub_movie` int NULL DEFAULT 0,
  `date_created` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_update` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `year` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tags_movie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `topview` int NULL DEFAULT 0 COMMENT 'null',
  `season` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `episodes` int NULL DEFAULT 1,
  `thuocphim` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `director` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `score_imdb` float NULL DEFAULT NULL,
  `cast_movie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `view_count` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `genre_id`(`genre_id` ASC) USING BTREE,
  INDEX `movies_ibfk_category_id`(`category_id` ASC) USING BTREE,
  INDEX `movies_ibfk_country_id`(`country_id` ASC) USING BTREE,
  CONSTRAINT `movies_ibfk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `movies_ibfk_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `movies_ibfk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC STATS_PERSISTENT = 0;

-- ----------------------------
-- Records of movies
-- ----------------------------
INSERT INTO `movies` VALUES (2, 'Con Cừu Non', '114 Phút', 'Con Cừu Non', 1, 'thumbnail835.jpg', 1, 1, 6, 'con-cuu-non', 0, 'Con Cừu Non', 4, 0, NULL, '2023-01-14 14:18:16', '2010', '43,44', 2, '0', 'hB_JdXDnZVQ', 2, 'phimbo', NULL, NULL, NULL, 4);
INSERT INTO `movies` VALUES (3, 'LIGHTYEAR: CẢNH SÁT VŨ TRỤ', '113 Phút', 'Lightyear: Cảnh Sát Vũ Trụ, Lightyear 2022 HD Vietsub\r\nViết tiếp loạt series câu chuyện đồ chơi cũng có thể nói đây là phần phim Toy Story 5. Phim có diễn biến: Trong khi dành nhiều năm cố gắng trở về nhà, Space Ranger Buzz Lightyear đầy ma mãnh chạm trán với một đội quân robot tàn nhẫn do Zurg chỉ huy đang cố gắng ăn cắp nguồn nhiên liệu của anh ta.', 1, 'lightyear-canh-sat-vu-tru-91838-thumbnail3084.jpg', 6, 7, 4, 'lightyear-canh-sat-vu-tru', 0, 'LIGHTYEAR: UNIVERSAL POLICE', 0, 0, NULL, '2023-01-14 14:17:53', '2021', 'xem phim Cảnh Sát Vũ Trụ Lightyear vietsub, phim Lightyear vietsub, xem Cảnh Sát Vũ Trụ Lightyear vietsub online tap 1, tap 2, tap 3, tap 4, phim Lightyear ep 5, ep 6, ep 7, ep 8, ep 9, ep 10, xem Cảnh Sát Vũ Trụ Lightyear tập 11, tập 12, tập 13, tập 14, tập 15, phim Cảnh Sát Vũ Trụ Lightyear tap 16, tap 17, tap 18, tap 19, tap 20, xem phim Cảnh Sát Vũ Trụ Lightyear tập 21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, Cảnh Sát Vũ Trụ Lightyear tap cuoi, Lightyear vietsub tron bo, review Cảnh Sát Vũ Trụ Lightyear netflix, Cảnh Sát Vũ Trụ Lightyear wetv, Cảnh Sát Vũ Trụ Lightyear phimmoi, Cảnh Sát Vũ Trụ Lightyear youtube, Cảnh Sát Vũ Trụ Lightyear dongphym, Cảnh Sát Vũ Trụ Lightyear vieon, phim keeng, bilutv, biphim, hdvip, hayghe, motphim, tvhay, zingtv, fptplay, phim1080, luotphim, fimfast, dongphim, fullphim, phephim, vtvgiaitri Cảnh Sát Vũ Trụ Lightyear full, Lightyear online, Cảnh Sát Vũ Trụ Lightyear Thuyết Minh, Cảnh Sát Vũ Trụ Lightyear Vietsub, Cảnh Sát Vũ Trụ Lightyear Lồng Tiếng', 1, '0', 'hB_JdXDnZVQ', 1, 'phimle', 'Jonathan Del Val', 5.8, 'Chris Evans, Keke Palmer, Peter Sohn', 3);
INSERT INTO `movies` VALUES (6, 'NGƯỜI NHỆN: KHÔNG CÒN NHÀ', '148 phút', 'Người Nhện: Không Còn Nhà - Spider-Man: No Way Home, Spider-Man: No Way Home 2021 CAM Với Danh Tính Của Người Nhện Giờ đã được Tiết Lộ, Peter Nhờ Doctor Strange Giúp đỡ. Khi Một Câu Thần Chú Bị Sai, Những Kẻ Thù Nguy Hiểm Từ Các Thế Giới Khác Bắt đầu Xuất Hiện, Buộc Peter Phải Khám Phá Ra ý Nghĩa Thực Sự Của Việc Trở Thành Người Nhện.', 1, 'nguoi-nhen-khong-con-nha-58642-thumbnail-250x3508015.jpg', 1, 1, 4, 'nguoi-nhen-khong-con-nha', 1, 'Spider-Man: No Way Home (2021)', 0, 0, '2022-08-08 16:57:10', '2022-08-17 05:05:00', '2021', 'xem phim Người Nhện: Không Còn Nhà viesub, xem Bí Người Nhện: Không Còn Nhà vietsub online tap 1, tap 2, tap 3, tap 4, tap 5 phim Spider-Man: No Way Home ep 5, ep 6, ep 7, ep 8, ep 9, ep 10, Lịch chiếu phim Người Nhện: Không Còn Nhà, xem Người Nhện: Không Còn Nhà tập 11, tập 12, tập 13, tập 14, tập 15, phim Người Nhện: Không Còn Nhà tap 16, tap 17, tap 18, tap 19, tap 20, xem phim Người Nhện: Không Còn Nhà tập 21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, Người Nhện: Không Còn Nhà tap cuoi, Spider-Man: No Way Home vietsub tron bo, Người Nhện: Không Còn Nhà phim3s, Người Nhện: Không Còn Nhà motphim,vtv16, khoaitv, phimgi, hatdetv, xemphimso, hdo, topphimhd, khoaitv, vungtv, dongphim, fptplay, zingtv, xemphimgi Người Nhện: Không Còn Nhà youtube,vietsubtv, bomtan, Người Nhện: Không Còn Nhà phimmoi, hdonline, phimbathu, bilutv, banhtv, goldphim, bongngotv, bilutvs, phimmoizz, fullphim, 247phim, dongphym, xemphimvui, phimhay.co, galaxyplay, fptplay, hdviet, hdonline, hdo.tv, netflix, xemphimplus, VTVGiaitri, PhimHD7, Hplus, Kphim, Cliptv, yeuphimmoi, Vietsubtv, Bomtan, Biphim, Khophimplus, Người Nhện: Không Còn Nhà full, Spider-Man: No Way Home online, Người Nhện: Không Còn Nhà Thuyết Minh, Người Nhện: Không Còn Nhà Vietsub, Người Nhện: Không Còn Nhà Lồng Tiếng', 0, NULL, 'rt-2cxAiPJk', 1, 'phimle', 'BRAD ABLESON, Kyle Balda', 8.3, 'Tom Holland, ZendayaBenedict, Cumberbatch', 7);
INSERT INTO `movies` VALUES (9, 'Kẻ Cắp Mặt Trăng 4 : Sự Trỗi Dậy Của Gru', '88 phút', 'Kẻ Cắp Mặt Trăng 4 : Sự Trỗi Dậy Của Gru Minions: The Rise Of Gru 2022 Full HD Vietsub Thuyết Minh Tiếp nối bộ phim ke cap mat trang 3 năm 2015 , lần này ở trung tâm của thập niên 1970, Felonius Gru mười hai tuổi đang lớn lên ở vùng ngoại ô. Một fanboy của một nhóm giám sát được gọi là Vicy 6, Gru ấp ủ một kế hoạch trở thành ác quỷ đủ để tham gia cùng họ. Khi Vicy 6 sa thải thủ lĩnh của họ, chiến binh huyền thoại Wild Knuckles, Gru phỏng vấn để trở thành thành viên mới nhất của họ.\r\nMọi chuyện không suôn sẻ, và mọi thứ chỉ trở nên tồi tệ hơn sau khi Gru đánh cắp chúng với sự giúp đỡ của Kevin, Stuart, Bob, Otto và các Minion khác và đột nhiên thấy mình là kẻ thù không đội trời chung của ác quỷ. Trên đường chạy trốn, Gru và Minions sẽ chuyển sang một nguồn không thể để được hướng dẫn, chính Wild Knuckles và phát hiện ra rằng ngay cả những kẻ xấu cũng cần một chút giúp đỡ từ bạn bè của họ.\r\nĐến ác nhân cũng có những nỗi đau khôn nguôi... theo dõi kẻ trộm mặt trăng 4 Minions: Sự trỗi dậy của Gru trên phimmoi', 1, 'minion2848.jpg', 6, 1, 4, 'ke-cap-mat-trang-4-su-troi-day-cua-gru', 1, 'Minions: The Rise Of Gru (2022)', 4, 1, '2022-08-10 16:44:29', '2023-01-14 14:34:34', '2022', 'minions su troi day cua gru, minions the rise of gru, 43', 0, NULL, 'SC7BfxpWieM', 1, 'phimle', 'Kyle Balda, Brad Ableson, Jonathan Del Val', 7.2, 'Steve Carell, Lucy Lawless, Michelle Yeoh', 11);
INSERT INTO `movies` VALUES (10, 'DORAEMON: NOBITA VÀ CUỘC CHIẾN VŨ TRỤ TÍ HON', '108 phút', 'Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon 2021 Doraemon: Nobita no Little Wars 2021 2022 Full HD Vietsub Thuyết Minh Nobita đã có thể nhìn thấy một người ngoài hành tinh hình người tên là Papi. Anh rời nơi anh sống để đến Trái đất nhằm trốn thoát khỏi đội quân PCIA độc ác mà anh đến. Doraemon và những người bạn của mình rất ngạc nhiên về kích thước nhỏ bé của cậu bạn, nhưng nhờ có Đèn thu nhỏ mà họ đã có thể chơi cùng nhau. Chiến hạm đuổi theo và tấn công những người ở bên kia địa cầu. Papi tự trách mình vì đã khiến mọi người rơi vào trận chiến, nhưng cô vẫn cố gắng chiến đấu chống lại quân đội PCIA để bảo vệ cô và hành tinh.Nobita và cuộc chiến vũ trụ tí hon 2021 là một bộ phim điện ảnh của Nhật Bản Doraemon thứ 41 trong loạt phim do Yamaguchi Susumu đạo diễn, Theo dõi ngay trên phimmoi để trải nghiệm đầu tiên', 1, 'doraemon-nobita-va-cuoc-chien-vu-tru-ti-hon-102736-thumbnail3029.jpg', 5, 1, 6, 'doraemon-nobita-va-cuoc-chien-vu-tru-ti-hon', 1, 'Doraemon: Nobita no Little Wars (2022)', 0, 0, '2022-08-16 14:14:39', '2022-08-17 05:04:33', '2021', 'xem phim Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon viesub, xem Bí Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon vietsub online tap 1, tap 2, tap 3, tap 4, tap 5 phim Doraemon: Nobita no Little Wars ep 5, ep 6, ep 7, ep 8, ep 9, ep 10, Lịch chiếu phim Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon, xem Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon tập 11, tập 12, tập 13, tập 14, tập 15, phim Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon tap 16, tap 17, tap 18, tap 19, tap 20, xem phim Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon tập 21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon tap cuoi, Doraemon: Nobita no Little Wars vietsub tron bo, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon phim3s, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon motphim,vtv16, khoaitv, phimgi, hatdetv, xemphimso, hdo, topphimhd, khoaitv, vungtv, dongphim, fptplay, zingtv, xemphimgi Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon youtube,vietsubtv, bomtan, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon phimmoi, hdonline, phimbathu, bilutv, banhtv, goldphim, bongngotv, bilutvs, phimmoizz, fullphim, 247phim, dongphym, xemphimvui, phimhay.co, galaxyplay, fptplay, hdviet, hdonline, hdo.tv, netflix, xemphimplus,phimmoiz, iphimmoi, phimchill, xemphimchill, ephimmoi, ezphimmoi, azphimmoi, phimmoichill, phimgii, xemphimgii, billuu, bichill, motchill, khophim18, zaphim, 2phimhay, iphimhay, iphim, VTVGiaitri, PhimHD7, Hplus, Kphim, Cliptv, yeuphimmoi, Vietsubtv, Bomtan, Biphim, Khophimplus, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon full, Doraemon: Nobita no Little Wars online, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon Thuyết Minh, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon Vietsub, Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon Lồng Tiếng', 0, '0', 'dd_R1GQwKlY', 1, 'phimle', 'Yamaguchi Susumu', 6.6, 'Subaru Kimura, Seki Tomokazu, Megumi Oohara, Kakazu Yumi', 5);
INSERT INTO `movies` VALUES (11, 'Big Mouth(2022)', '60 phút/tập', 'Big Mouth là bộ phim đánh dấu màn tái xuất chính thức của mỹ nam \"đẹp hơn hoa\" Lee Jong Suk sau một thười gian \"mất tích\" vì nhập ngũ (trước đó anh có xuất hiện với một vai diễn ngắn ngủi ở phim điện ảnh Sát Thủ Nhân Tạo 2). Trong phim, anh vào vai Park Chang Ho, một luật sư với tỷ lệ thắng cực kỳ thấp, được biết đến với cái tên \"Big Mouth\" nghĩa là kẻ chỉ có mồm mép. Cuộc đời anh gặp trắc trở cũng chính vì cái tên này.\r\n\r\nBig mouth được chấp bút bởi bộ đôi biên kịch Vagabond đình đám Jang Young Chul - Jung Kyung Soo và chỉ đạo diễn xuất bởi đạo diễn Oh Chung Hwan - người đã từng đóng góp không ít cho thành công của Hotel de Luna. Bộ phim khai thác đề tài pháp luật chính trị - một đề tài không quá mới mẻ của phim Hàn.\r\n\r\nNam chính Park Chang Ho (do Lee Jong Suk thủ vai) là một luật sư hạng ba đầy những thiếu sót với biệt danh Big mouth vì anh chỉ giỏi ăn nói chứ khi hành động lại chẳng được tích sự gì. Câu chuyện bắt đầu trở nên kịch tính khi anh bị nhầm với một tên lừa đảo có biệt danh Big mouse. Để bảo vệ bản thân, gia đình và cả người vợ thân yêu Go Mi Ho (do YoonA -SNSD thủ vai), anh buộc phải chiến đấu và từng bước thâm nhập vào giới thượng lưu.', 1, '62e48ebbdbb6c6372.jpg', 5, 9, 8, 'big-mouth2022', 1, 'Big Mouth', 0, 0, '2022-08-16 16:35:09', '2022-08-17 05:04:15', '2022', NULL, 0, '0', 'Z3OMssCwMjA', 16, 'phimbo', 'Oh Chung Hwan', 8.2, 'Lee Jong-SukIm, Yoon-ahKim, Joo-Heon', 3);
INSERT INTO `movies` VALUES (12, 'Kung Fu Panda: Hiệp Sĩ Rồng (Phần 1)', '25 phút/tập', 'Chiến binh huyền thoại Po bắt tay với một hiệp sĩ Anh ưu tú trong nhiệm vụ có quy mô toàn cầu để giành lại các vũ khí ma thuật, rửa sạch thanh danh và cứu thế giới!', 1, 'kung-pu-panda662.jpg', 5, 7, 4, 'kung-fu-panda-hiep-si-rong-phan-1', 1, 'Kung Fu Panda: The Dragon Knight (Season 1)', 4, 0, '2022-08-16 22:52:21', '2022-08-17 06:21:04', '2022', NULL, 0, '1', 'Aftg630D6X8', 11, 'phimbo', NULL, 5.9, 'Rita OraJack, BlackChris, Geere', 13);
INSERT INTO `movies` VALUES (13, 'Trụ Sở Bí Mật', '104 phút', 'Căn Cứ Bí Mật Secret Headquarters 2022 Full HD Vietsub Thuyết Minh Một đứa trẻ phát hiện ra trụ sở bí mật của một siêu anh hùng mạnh mẽ ẩn bên dưới ngôi nhà của mình và phải bảo vệ nó cùng với nhóm bạn của mình khi những kẻ xấu tấn công.', 1, 'Secret Headquarters(2022)4934.jpg', 6, 1, 3, 'tru-so-bi-mat', 1, 'Secret Headquarters (2022)', 0, 0, '2022-08-16 23:16:37', '2022-08-18 06:58:22', '2022', 'can cu bi mat, tru so bi mat', 0, '0', 'JR2hwFpllz4', 1, 'phimle', 'Henry Joost, Ariel Schulman,', 4.4, 'Stars Owen Wilson, Jesse Williams, Walker Scobell,', 71);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('nhatlong2356@gmail.com', '$2y$10$9lbemY17yZJLh8QVIosrWeQmJbfmexPY9p1KQeiBzsbXwYbncI8DW', '2022-07-22 12:07:05');
INSERT INTO `password_resets` VALUES ('admin@gmail.com', '$2y$10$sQEBHp63LVSVU/vMRkzxsO07dyGhMtBENAl6sO75n7hAcFYGSd5dq', '2023-01-13 08:51:29');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for ratings
-- ----------------------------
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings`  (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NULL DEFAULT NULL,
  `rating` int NULL DEFAULT NULL,
  `ip_rating` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`rating_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ratings
-- ----------------------------
INSERT INTO `ratings` VALUES (1, 3, 1, NULL);
INSERT INTO `ratings` VALUES (2, 3, 2, NULL);
INSERT INTO `ratings` VALUES (3, 3, 3, NULL);
INSERT INTO `ratings` VALUES (4, 3, 4, NULL);
INSERT INTO `ratings` VALUES (5, 3, 5, NULL);
INSERT INTO `ratings` VALUES (6, 3, 4, NULL);
INSERT INTO `ratings` VALUES (7, 3, 5, NULL);
INSERT INTO `ratings` VALUES (8, 3, 4, NULL);
INSERT INTO `ratings` VALUES (9, 3, 4, NULL);
INSERT INTO `ratings` VALUES (10, 3, 1, NULL);
INSERT INTO `ratings` VALUES (11, 3, 1, NULL);
INSERT INTO `ratings` VALUES (12, 3, 1, NULL);
INSERT INTO `ratings` VALUES (13, 3, 1, NULL);
INSERT INTO `ratings` VALUES (14, 3, 1, NULL);
INSERT INTO `ratings` VALUES (15, 3, 1, NULL);
INSERT INTO `ratings` VALUES (16, 3, 1, NULL);
INSERT INTO `ratings` VALUES (17, 3, 1, NULL);
INSERT INTO `ratings` VALUES (18, 3, 3, NULL);
INSERT INTO `ratings` VALUES (19, 3, 3, NULL);
INSERT INTO `ratings` VALUES (20, 3, 3, NULL);
INSERT INTO `ratings` VALUES (21, 3, 3, NULL);
INSERT INTO `ratings` VALUES (22, 3, 3, NULL);
INSERT INTO `ratings` VALUES (23, 3, 3, NULL);
INSERT INTO `ratings` VALUES (24, 3, 3, NULL);
INSERT INTO `ratings` VALUES (25, 3, 3, NULL);
INSERT INTO `ratings` VALUES (26, 3, 3, NULL);
INSERT INTO `ratings` VALUES (27, 3, 5, NULL);
INSERT INTO `ratings` VALUES (28, 9, 1, NULL);
INSERT INTO `ratings` VALUES (29, 3, 5, NULL);
INSERT INTO `ratings` VALUES (30, 3, 1, NULL);
INSERT INTO `ratings` VALUES (31, 9, 5, NULL);
INSERT INTO `ratings` VALUES (32, 9, 5, NULL);
INSERT INTO `ratings` VALUES (33, 9, 1, NULL);
INSERT INTO `ratings` VALUES (34, 9, 1, NULL);
INSERT INTO `ratings` VALUES (35, 9, 1, NULL);
INSERT INTO `ratings` VALUES (36, 9, 1, NULL);
INSERT INTO `ratings` VALUES (37, 9, 1, NULL);
INSERT INTO `ratings` VALUES (38, 9, 3, NULL);
INSERT INTO `ratings` VALUES (39, 9, 3, NULL);
INSERT INTO `ratings` VALUES (40, 9, 1, NULL);
INSERT INTO `ratings` VALUES (41, 9, 5, NULL);
INSERT INTO `ratings` VALUES (42, 9, 5, NULL);
INSERT INTO `ratings` VALUES (43, 9, 5, NULL);
INSERT INTO `ratings` VALUES (44, 9, 5, NULL);
INSERT INTO `ratings` VALUES (45, 9, 5, NULL);
INSERT INTO `ratings` VALUES (46, 11, 5, NULL);
INSERT INTO `ratings` VALUES (47, 2, 4, NULL);
INSERT INTO `ratings` VALUES (48, 2, 3, NULL);
INSERT INTO `ratings` VALUES (49, 2, 2, NULL);
INSERT INTO `ratings` VALUES (50, 2, 2, NULL);
INSERT INTO `ratings` VALUES (51, 2, 5, NULL);
INSERT INTO `ratings` VALUES (52, 2, 3, NULL);
INSERT INTO `ratings` VALUES (53, 2, 4, NULL);
INSERT INTO `ratings` VALUES (54, 2, 5, NULL);
INSERT INTO `ratings` VALUES (55, 2, 5, NULL);
INSERT INTO `ratings` VALUES (56, 2, 5, NULL);
INSERT INTO `ratings` VALUES (57, 2, 5, NULL);
INSERT INTO `ratings` VALUES (58, 2, 5, NULL);
INSERT INTO `ratings` VALUES (59, 2, 5, NULL);
INSERT INTO `ratings` VALUES (60, 9, 4, NULL);
INSERT INTO `ratings` VALUES (61, 13, 5, NULL);
INSERT INTO `ratings` VALUES (62, 13, 5, NULL);
INSERT INTO `ratings` VALUES (63, 13, 1, NULL);
INSERT INTO `ratings` VALUES (64, 13, 4, NULL);
INSERT INTO `ratings` VALUES (65, 13, 5, NULL);
INSERT INTO `ratings` VALUES (66, 13, 5, NULL);
INSERT INTO `ratings` VALUES (67, 13, 1, NULL);
INSERT INTO `ratings` VALUES (68, 13, 1, NULL);
INSERT INTO `ratings` VALUES (69, 13, 1, NULL);
INSERT INTO `ratings` VALUES (70, 6, 5, NULL);
INSERT INTO `ratings` VALUES (71, 13, 5, '127.0.0.1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'long', 'nhatlong2356@gmail.com', NULL, '$2y$10$ejlOEY92OTqirIe4X0iZu.KUm.zgU7Ke9Wc4aYUTFcJLeYErvWNjC', 'GgXw2DwDXdqzw7Mw3YvTHdJ3yjPXTtbcQN1B7mxRdCrSNvCTpKw5p9ey5jMt', '2022-07-20 08:23:42', '2022-07-20 08:23:42');
INSERT INTO `users` VALUES (2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$XpAfm4tTJkIufx0uo3brCuoq.ZyvaLZo43qV6WwPU7KpLWhpPkX3K', '8W8OWkI6bEuIESpFELJ30in0CFrQ9LvSEuA8xmApCIFgFWlP6vE21fl15Jpr', '2022-07-21 11:02:52', '2022-07-21 11:02:52');
INSERT INTO `users` VALUES (3, 'root', 'root@gmail.com', NULL, '$2y$10$dAge/yAd5I07ORYb1RtRBO3lnPPlwq3.QelwElywBtAWQGhBEMg3K', NULL, '2023-01-14 05:57:37', '2023-01-14 05:57:37');

-- ----------------------------
-- Table structure for visitors
-- ----------------------------
DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors`  (
  `id_visitors` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_visitor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 0,
  PRIMARY KEY (`id_visitors`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of visitors
-- ----------------------------
INSERT INTO `visitors` VALUES (5, '127.0.0.1', '2022-08-20', 0);
INSERT INTO `visitors` VALUES (6, '127.0.2', '2022-08-20', 0);

SET FOREIGN_KEY_CHECKS = 1;
