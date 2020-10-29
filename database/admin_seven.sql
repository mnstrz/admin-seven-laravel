/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : admin_seven

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 01/09/2020 02:29:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fake_table
-- ----------------------------
DROP TABLE IF EXISTS `fake_table`;
CREATE TABLE `fake_table`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fake_table
-- ----------------------------
INSERT INTO `fake_table` VALUES (1, 'Luhung Mahendra S.Farm', 'pangestu.kasusra@zulaika.co.id', 'Ds. Basoka No. 776, Pangkal Pinang 86552, SumBar', '0299 5629 514', '2020-01-22 20:34:04', '2020-01-25 07:57:55');
INSERT INTO `fake_table` VALUES (2, 'Zulfa Kamaria Novitasari S.H.', 'lanang34@wijayanti.mil.id', 'Kpg. Baabur Royan No. 732, Tanjung Pinang 64107, PapBar', '0506 4594 645', '2020-03-19 14:50:07', '2019-09-13 22:18:37');
INSERT INTO `fake_table` VALUES (3, 'Wulan Melani', 'riyanti.hamzah@yahoo.com', 'Ki. HOS. Cjokroaminoto (Pasirkaliki) No. 74, Padang 77955, NTB', '(+62) 26 1052 3023', '2020-06-03 19:34:38', '2020-04-08 08:51:48');
INSERT INTO `fake_table` VALUES (4, 'Caket Tampubolon', 'ufujiati@winarsih.go.id', 'Jr. Baja No. 581, Tangerang Selatan 67450, Banten', '(+62) 28 4555 543', '2019-09-24 14:27:36', '2019-11-30 23:55:41');
INSERT INTO `fake_table` VALUES (5, 'Tami Wastuti M.Kom.', 'kuswandari.sakti@gmail.co.id', 'Psr. Suprapto No. 10, Padang 68438, JaTim', '0245 7605 771', '2019-08-27 11:32:38', '2020-06-23 08:35:46');
INSERT INTO `fake_table` VALUES (6, 'Nabila Puspita', 'suryono.shakila@habibi.asia', 'Psr. Muwardi No. 247, Manado 15119, SumBar', '020 4160 7119', '2020-06-07 06:55:14', '2019-09-01 02:07:37');
INSERT INTO `fake_table` VALUES (7, 'Timbul Mitra Jailani', 'nasyidah.wira@yahoo.co.id', 'Psr. Bara No. 180, Tanjungbalai 22576, KalTim', '021 2177 436', '2020-08-14 09:42:10', '2020-05-28 16:00:03');
INSERT INTO `fake_table` VALUES (8, 'Dagel Pranowo', 'prastuti.belinda@yahoo.com', 'Dk. Kyai Gede No. 910, Pematangsiantar 37298, DIY', '(+62) 403 1858 5663', '2020-03-19 17:28:54', '2020-02-27 14:15:20');
INSERT INTO `fake_table` VALUES (9, 'Estiawan Prayoga S.Pt', 'taufan.lailasari@gmail.co.id', 'Gg. Abang No. 530, Salatiga 77153, NTT', '0798 8705 0751', '2020-02-09 13:56:20', '2020-05-19 15:22:34');
INSERT INTO `fake_table` VALUES (10, 'Mutia Puspita', 'anggraini.ratna@tampubolon.desa.id', 'Jr. Bagonwoto  No. 5, Tanjung Pinang 90657, KepR', '023 2344 7561', '2020-07-04 02:21:36', '2020-05-05 16:35:56');
INSERT INTO `fake_table` VALUES (11, 'Endra Hutasoit', 'wpratama@gmail.co.id', 'Ds. Flora No. 267, Mojokerto 15239, NTB', '0704 3472 1851', '2019-11-16 22:34:02', '2020-03-02 04:21:21');
INSERT INTO `fake_table` VALUES (12, 'Reksa Natsir', 'ljanuar@yahoo.com', 'Ki. Sentot Alibasa No. 536, Gorontalo 80159, JaTim', '(+62) 28 4027 726', '2019-09-06 17:46:09', '2020-05-19 05:31:55');
INSERT INTO `fake_table` VALUES (13, 'Paramita Nuraini S.Sos', 'siregar.narji@marbun.net', 'Jr. Batako No. 263, Administrasi Jakarta Utara 26122, SumBar', '0758 4841 179', '2019-10-01 13:52:34', '2019-08-25 02:01:21');
INSERT INTO `fake_table` VALUES (14, 'Jamil Samosir', 'tasnim.prasasta@gmail.co.id', 'Gg. Yos No. 106, Dumai 70685, Bali', '022 2098 050', '2020-01-17 03:47:25', '2019-12-14 14:54:11');
INSERT INTO `fake_table` VALUES (15, 'Oman Saragih S.Pt', 'wahyudin.salwa@safitri.ac.id', 'Kpg. Cihampelas No. 612, Bima 41141, Bali', '0514 4391 899', '2019-10-23 16:41:24', '2020-04-29 11:23:50');
INSERT INTO `fake_table` VALUES (16, 'Labuh Simanjuntak', 'nova.oktaviani@yahoo.co.id', 'Jr. Setia Budi No. 186, Ambon 58736, DKI', '0434 7464 9973', '2019-12-02 11:01:36', '2020-04-12 15:11:30');
INSERT INTO `fake_table` VALUES (17, 'Vanesa Yulianti M.Pd', 'ina49@gmail.co.id', 'Gg. Tambak No. 32, Cimahi 32169, KalBar', '0823 0630 3896', '2019-12-26 00:09:03', '2020-03-19 16:19:43');
INSERT INTO `fake_table` VALUES (18, 'Eva Rahayu', 'pardi.prasetyo@yahoo.co.id', 'Dk. Baik No. 859, Banjar 44612, SumUt', '(+62) 28 9822 230', '2020-04-21 20:51:10', '2020-07-13 03:01:17');
INSERT INTO `fake_table` VALUES (19, 'Pangestu Maheswara S.IP', 'wzulkarnain@hastuti.or.id', 'Psr. Suprapto No. 504, Malang 94484, KalUt', '(+62) 686 3400 4149', '2019-11-25 01:04:20', '2020-01-28 07:41:41');
INSERT INTO `fake_table` VALUES (20, 'Himawan Uwais', 'djailani@gmail.co.id', 'Psr. Sudirman No. 941, Makassar 38922, SumUt', '022 9544 394', '2020-02-24 03:18:11', '2019-12-28 04:30:57');
INSERT INTO `fake_table` VALUES (21, 'Jinawi Sirait', 'dacin.dongoran@yahoo.com', 'Kpg. Acordion No. 586, Banjarmasin 28203, KalBar', '(+62) 501 3050 927', '2020-07-02 20:21:01', '2019-12-05 04:47:07');
INSERT INTO `fake_table` VALUES (22, 'Dono Cager Sihombing', 'uli65@habibi.in', 'Dk. Raden No. 140, Pagar Alam 74334, SumSel', '(+62) 427 2077 7794', '2020-01-13 12:34:16', '2020-03-14 23:44:08');
INSERT INTO `fake_table` VALUES (23, 'Kamila Malika Oktaviani', 'ida63@gmail.co.id', 'Jln. Raya Ujungberung No. 231, Kendari 43973, KalBar', '0735 5065 566', '2020-06-07 15:56:17', '2020-04-24 00:05:37');
INSERT INTO `fake_table` VALUES (24, 'Zizi Maida Lestari S.E.I', 'wardi44@yahoo.co.id', 'Jln. Mahakam No. 79, Batu 17078, PapBar', '(+62) 828 6126 7091', '2020-05-14 08:28:15', '2020-04-18 04:43:16');
INSERT INTO `fake_table` VALUES (25, 'Hasna Puspita', 'hhastuti@yahoo.co.id', 'Jr. Yos Sudarso No. 721, Jayapura 82491, Bali', '0450 6392 2796', '2019-09-16 00:15:42', '2020-01-06 09:09:07');
INSERT INTO `fake_table` VALUES (26, 'Safina Prastuti', 'whasanah@yahoo.com', 'Jr. Adisucipto No. 99, Tidore Kepulauan 58754, JaBar', '(+62) 823 2804 3160', '2020-02-04 12:48:29', '2019-12-24 19:03:54');
INSERT INTO `fake_table` VALUES (27, 'Respati Wijaya', 'prabawa.usada@yahoo.co.id', 'Dk. Adisucipto No. 454, Pariaman 78385, SulUt', '(+62) 500 8298 551', '2020-07-20 15:37:26', '2019-10-07 13:17:57');
INSERT INTO `fake_table` VALUES (28, 'Bagya Hutagalung', 'kairav86@aryani.ac.id', 'Kpg. Bazuka Raya No. 477, Tidore Kepulauan 47838, SumUt', '(+62) 203 9645 9167', '2020-02-03 17:53:57', '2020-06-13 18:18:23');
INSERT INTO `fake_table` VALUES (29, 'Lembah Waluyo', 'wulandari.ozy@gmail.co.id', 'Gg. Sumpah Pemuda No. 943, Ternate 93493, SulSel', '(+62) 588 4609 4656', '2019-11-27 20:17:17', '2020-01-17 10:35:15');
INSERT INTO `fake_table` VALUES (30, 'Putri Riyanti', 'oktaviani.tasdik@iswahyudi.in', 'Ki. Panjaitan No. 439, Manado 23060, NTB', '0873 6882 673', '2020-08-04 06:55:00', '2019-10-28 00:26:38');
INSERT INTO `fake_table` VALUES (31, 'Kusuma Kayun Sirait S.E.I', 'prakasa.padmi@yolanda.asia', 'Ds. Sumpah Pemuda No. 943, Gorontalo 48848, JaTeng', '(+62) 21 2164 5551', '2020-07-25 00:46:37', '2019-11-14 06:41:11');
INSERT INTO `fake_table` VALUES (32, 'Zelda Dian Oktaviani', 'yolanda.rahmi@gmail.co.id', 'Jr. Wora Wari No. 239, Tangerang Selatan 68599, Gorontalo', '(+62) 508 0753 9349', '2019-10-21 00:59:11', '2020-03-20 04:24:11');
INSERT INTO `fake_table` VALUES (33, 'Diah Jamalia Pertiwi', 'cornelia17@gmail.co.id', 'Ds. Yoga No. 945, Metro 10739, DIY', '0505 6167 387', '2020-02-19 21:37:12', '2020-04-02 18:56:11');
INSERT INTO `fake_table` VALUES (34, 'Natalia Pratiwi', 'gsaefullah@gmail.co.id', 'Jln. Asia Afrika No. 360, Yogyakarta 59962, SumBar', '(+62) 916 8922 0551', '2020-08-14 01:01:58', '2020-04-27 12:45:26');
INSERT INTO `fake_table` VALUES (35, 'Cengkal Wacana', 'kayun65@yahoo.com', 'Gg. Wahid No. 634, Batam 70016, KalTim', '0515 6648 022', '2020-05-12 00:51:36', '2019-09-21 14:58:23');
INSERT INTO `fake_table` VALUES (36, 'Syahrini Susanti', 'spermadi@nugroho.asia', 'Jr. HOS. Cjokroaminoto (Pasirkaliki) No. 721, Kediri 58577, MalUt', '0792 4563 206', '2020-04-28 14:38:52', '2020-04-18 22:11:37');
INSERT INTO `fake_table` VALUES (37, 'Gatot Widodo', 'kuswoyo.azalea@prasetya.desa.id', 'Psr. Hang No. 549, Bengkulu 60268, KalTim', '(+62) 243 5994 1729', '2020-05-08 15:33:34', '2020-06-20 01:00:56');
INSERT INTO `fake_table` VALUES (38, 'Jumari Anggriawan', 'maheswara.yunita@gmail.co.id', 'Dk. Katamso No. 17, Gunungsitoli 22448, Gorontalo', '0980 2075 7508', '2020-06-07 08:48:27', '2020-03-14 22:14:26');
INSERT INTO `fake_table` VALUES (39, 'Fitriani Elvina Nurdiyanti S.Psi', 'usada.indra@prabowo.my.id', 'Gg. Barasak No. 466, Tual 30389, SumBar', '(+62) 622 2563 742', '2020-05-30 15:12:57', '2020-08-18 13:12:47');
INSERT INTO `fake_table` VALUES (40, 'Banawi Karna Manullang', 'nyana.haryanti@yahoo.com', 'Ki. Halim No. 975, Administrasi Jakarta Pusat 31222, Jambi', '0768 1600 892', '2020-07-02 22:00:16', '2020-06-09 09:17:07');
INSERT INTO `fake_table` VALUES (41, 'Malik Nainggolan', 'teddy97@wulandari.net', 'Gg. Setia Budi No. 776, Padang 33477, PapBar', '(+62) 851 9119 7204', '2020-03-08 12:50:11', '2019-10-31 18:30:16');
INSERT INTO `fake_table` VALUES (42, 'Victoria Pertiwi M.M.', 'simbolon.kairav@wasita.com', 'Gg. Achmad Yani No. 835, Malang 24695, PapBar', '0223 4149 6881', '2020-04-23 20:37:10', '2020-07-07 01:38:45');
INSERT INTO `fake_table` VALUES (43, 'Cornelia Anggraini', 'anita.nurdiyanti@gmail.com', 'Ds. Baranang Siang No. 821, Bima 45480, Bengkulu', '0881 954 389', '2020-07-02 07:43:55', '2019-09-23 09:13:52');
INSERT INTO `fake_table` VALUES (44, 'Eli Nasyidah M.Pd', 'tirta.yolanda@santoso.co', 'Jr. Bacang No. 560, Tegal 80166, NTB', '0904 6069 152', '2020-06-15 17:55:26', '2019-10-04 08:49:49');
INSERT INTO `fake_table` VALUES (45, 'Talia Rahmawati S.T.', 'anggraini.ida@utami.mil.id', 'Psr. Pelajar Pejuang 45 No. 77, Padangpanjang 12694, KepR', '(+62) 676 2929 1098', '2019-10-26 11:06:56', '2020-06-17 14:24:29');
INSERT INTO `fake_table` VALUES (46, 'Suci Rini Agustina', 'purnawati.wasis@wacana.biz', 'Ds. Basudewo No. 726, Metro 88300, Aceh', '025 2588 638', '2020-05-27 19:48:30', '2020-08-19 06:03:40');
INSERT INTO `fake_table` VALUES (47, 'Vanya Kusmawati', 'adriansyah.nardi@gmail.com', 'Ki. Radio No. 133, Bukittinggi 26228, Lampung', '0357 9028 138', '2020-07-04 15:12:30', '2020-04-23 05:53:33');
INSERT INTO `fake_table` VALUES (48, 'Jelita Fitria Wulandari', 'reza40@kurniawan.id', 'Ki. Babakan No. 664, Cirebon 71528, Jambi', '(+62) 799 8304 355', '2019-11-10 23:51:58', '2020-01-16 02:17:49');
INSERT INTO `fake_table` VALUES (49, 'Salimah Rahimah S.Ked', 'maya01@padmasari.ac.id', 'Kpg. Umalas No. 935, Banjarmasin 35443, SulSel', '(+62) 734 6841 5427', '2019-10-16 15:50:08', '2019-10-22 00:11:52');
INSERT INTO `fake_table` VALUES (50, 'Lutfan Saka Mansur', 'tira.wijayanti@gmail.com', 'Dk. Juanda No. 73, Bitung 35377, MalUt', '0862 2644 257', '2019-12-06 14:20:14', '2019-08-23 05:51:12');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES (1, 'Administrator', '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group` VALUES (2, 'Others Group', '2020-08-19 04:24:43', '2020-08-19 04:24:43');

-- ----------------------------
-- Table structure for group_menu
-- ----------------------------
DROP TABLE IF EXISTS `group_menu`;
CREATE TABLE `group_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` int(10) UNSIGNED NULL DEFAULT NULL,
  `menu` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `group_ibfk_3`(`group`) USING BTREE,
  INDEX `menu_ibfk_1`(`menu`) USING BTREE,
  CONSTRAINT `group_ibfk_3` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group_menu
-- ----------------------------
INSERT INTO `group_menu` VALUES (1, 1, 1, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (2, 1, 2, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (3, 1, 3, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (4, 1, 4, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (5, 1, 5, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (6, 1, 6, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (7, 1, 7, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (8, 1, 8, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (9, 1, 9, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (10, 1, 10, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `group_menu` VALUES (11, 2, 1, '2020-08-19 04:24:43', '2020-08-19 04:24:43');

-- ----------------------------
-- Table structure for group_permission
-- ----------------------------
DROP TABLE IF EXISTS `group_permission`;
CREATE TABLE `group_permission`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` int(10) UNSIGNED NULL DEFAULT NULL,
  `permission` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `group_ibfk_2`(`group`) USING BTREE,
  INDEX `permission_ibfk_1`(`permission`) USING BTREE,
  CONSTRAINT `group_ibfk_2` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`permission`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group_permission
-- ----------------------------
INSERT INTO `group_permission` VALUES (1, 1, 1, '2020-08-19 04:24:44', '2020-08-19 04:24:44');
INSERT INTO `group_permission` VALUES (2, 1, 2, '2020-08-19 04:24:44', '2020-08-19 04:24:44');
INSERT INTO `group_permission` VALUES (3, 1, 3, '2020-08-19 04:24:44', '2020-08-19 04:24:44');
INSERT INTO `group_permission` VALUES (4, 1, 4, '2020-08-19 04:24:44', '2020-08-19 04:24:44');
INSERT INTO `group_permission` VALUES (5, 1, 5, '2020-08-19 04:24:44', '2020-08-19 04:24:44');
INSERT INTO `group_permission` VALUES (6, 2, 5, '2020-08-19 04:24:44', '2020-08-19 04:24:44');

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `media_model_type_model_id_index`(`model_type`, `model_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `member_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, NULL, 'Dashboard', '/', 'dashboard', 1, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (2, NULL, 'Data Master', '#!', 'database', 2, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (3, NULL, 'Template', '#!', 'circle', 3, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (4, 2, 'User', 'user', 'user', 4, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (5, 2, 'Permission', 'permission', 'key', 5, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (6, 2, 'Group', 'group', 'users', 6, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (7, 2, 'Menu', 'menu', 'list', 7, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (8, 3, 'Form', 'form', 'circle-o', 8, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (9, 3, 'Table', 'table', 'circle-o', 9, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `menu` VALUES (10, 3, 'Document Editor', 'document', 'circle-o', 10, '2020-08-19 04:24:43', '2020-08-19 04:24:43');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2011_10_12_000000_create_group', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_09_20_161425_create_media_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_09_28_094659_create_permission', 1);
INSERT INTO `migrations` VALUES (6, '2019_09_28_122826_fake_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_09_28_165521_menu', 1);
INSERT INTO `migrations` VALUES (8, '2019_12_28_094447_create_group_permission', 1);
INSERT INTO `migrations` VALUES (9, '2019_12_28_094556_create_group_menu', 1);
INSERT INTO `migrations` VALUES (10, '2019_12_29_054802_create_member', 1);
INSERT INTO `migrations` VALUES (11, '2020_02_26_014241_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_02_26_201709_create_failed_jobs_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (1, 'config-menu', '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `permission` VALUES (2, 'config-user', '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `permission` VALUES (3, 'config-group', '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `permission` VALUES (4, 'config-permission', '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `permission` VALUES (5, 'dashboard', '2020-08-19 04:24:43', '2020-08-19 04:24:43');

-- ----------------------------
-- Table structure for theme
-- ----------------------------
DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme`  (
  `id` int(11) NOT NULL,
  `navbar_skin` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NULL DEFAULT NULL,
  `sidebar_skin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `brand_skin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `accent_skin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `card_skin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `is_no_navbar_border` tinyint(1) NULL DEFAULT NULL,
  `is_body_small` tinyint(1) NULL DEFAULT NULL,
  `is_navbar_small` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_small` tinyint(1) NULL DEFAULT NULL,
  `is_footer_small` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_flat` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_legacy` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_compact` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_child_indent` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_child_hide` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_disable_expand` tinyint(1) NULL DEFAULT NULL,
  `is_brand_small` tinyint(1) NULL DEFAULT NULL,
  `is_fixed_navbar` tinyint(1) NULL DEFAULT NULL,
  `is_fixed_footer` tinyint(1) NULL DEFAULT NULL,
  `is_sidebar_default_collapse` tinyint(1) NULL DEFAULT NULL,
  `is_boxed` tinyint(1) NULL DEFAULT NULL,
  `is_fixed_sidebar` tinyint(1) NULL DEFAULT NULL,
  `is_top_nav` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of theme
-- ----------------------------
INSERT INTO `theme` VALUES (1, 'bg-teal', 'light bg-danger', 'bg-teal', 'bg-info', 'bg-navy', '0000-00-00 00:00:00', '2020-08-31 17:54:10', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` int(10) UNSIGNED NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `group_ibfk_1`(`group`) USING BTREE,
  CONSTRAINT `group_ibfk_1` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'superadministrator', 'superadministrator@backend.com', '$2y$10$H2XgZ0k9ehQdpLsD4of0..ugtbOPAC9ismPb0cDsODyQArs4sH8NC', NULL, '2020-08-19 04:24:43', '2020-08-19 04:24:43');
INSERT INTO `users` VALUES (2, 1, 'admin', 'admin@admin.com', '$2y$10$ElI0vQ44g/vVIzTclrAAeuXoMwlboN8RkYzIYNJFiDkA75/EiU/ye', NULL, '2020-08-19 04:24:43', '2020-08-19 04:24:43');

SET FOREIGN_KEY_CHECKS = 1;
