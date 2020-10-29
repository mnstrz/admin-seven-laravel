/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP3
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : admin_seven

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 13/09/2020 18:46:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
INSERT INTO `theme` VALUES (1, 'bg-pink', 'light bg-maroon', 'bg-maroon', 'bg-info', 'bg-pink', '0000-00-00 00:00:00', '2020-09-13 11:45:39', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0);

SET FOREIGN_KEY_CHECKS = 1;
