<?php
/**
 * Plugin Name: Dev Tools: Snippets - Mxp.TW
 * Plugin URI: https://tw.wordpress.org/plugins/mxp-dev-tools/
 * Description: 整合 GitHub 中常用的程式碼片段。請注意，並非所有網站都適用全部的選項，有進階需求可以透過設定 wp-config.php 中此外掛預設常數，啟用或停用部分功能。
 * Requires at least: 4.6
 * Requires PHP: 5.6
 * Tested up to: 6.6
 * Stable tag: 3.2.7
 * Version: 3.2.7
 * Author: Chun
 * Author URI: https://www.mxp.tw/contact/
 * License: GPL v3
 */

namespace MxpDevTools;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
// 是否顯示此外掛於外掛清單上
if (!defined('MDT_SNIPPETS_DISPLAY')) {
	if (defined('MDT_DISALLOW_FILE_MODS') && MDT_DISALLOW_FILE_MODS == true) {
		define('MDT_SNIPPETS_DISPLAY', false);
	} else {
		define('MDT_SNIPPETS_DISPLAY', true);
	}
}
// 接收網站發生錯誤時的通知信收件人
if (!defined('MDT_RECOVERY_MODE_EMAIL')) {
	define('MDT_RECOVERY_MODE_EMAIL', get_option('admin_email'));
}
// 影像大小限制，預設 500kb
if (!defined('MDT_IMAGE_SIZE_LIMIT')) {
	define('MDT_IMAGE_SIZE_LIMIT', 500);
}
// 預設不刪除 xmlrpc.php 檔案
if (!defined('MDT_DELETE_XMLRPC_PHP')) {
	define('MDT_DELETE_XMLRPC_PHP', false);
}
// 預設刪除 install.php 檔案
if (!defined('MDT_DELETE_INSTALL_PHP')) {
	define('MDT_DELETE_INSTALL_PHP', true);
}
// 停用縮圖機制
if (!defined('MDT_DISABLE_IMAGE_SIZE')) {
	define('MDT_DISABLE_IMAGE_SIZE', true);
}
// 上傳圖片補上 meta
if (!defined('MDT_ADD_IMAGE_CONTENT')) {
	define('MDT_ADD_IMAGE_CONTENT', true);
}
// 留言隱藏留言人網址
if (!defined('MDT_HIDE_COMMENT_URL')) {
	define('MDT_HIDE_COMMENT_URL', true);
}
// 停用自己 ping 自己網站的功能
if (!defined('MDT_DISABLE_SELF_PING')) {
	define('MDT_DISABLE_SELF_PING', true);
}
// 停用 xmlrpc.php 功能
if (!defined('MDT_XMLRPC_DISABLE')) {
	define('MDT_XMLRPC_DISABLE', true);
}
// 停用 REST API 首頁顯示 API 功能
if (!defined('MDT_DISABLE_REST_INDEX')) {
	define('MDT_DISABLE_REST_INDEX', true);
}
// 停用沒授權的存取 REST API Users API 功能
if (!defined('MDT_DISABLE_NO_AUTH_ACCESS_REST_USER')) {
	define('MDT_DISABLE_NO_AUTH_ACCESS_REST_USER', true);
}
// 啟用安全性 HTTP 標頭功能
if (!defined('MDT_ENABLE_SECURITY_HEADERS')) {
	define('MDT_ENABLE_SECURITY_HEADERS', true);
}
// 隱藏前端作者連結
if (!defined('MDT_HIDE_AUTHOR_LINK')) {
	define('MDT_HIDE_AUTHOR_LINK', true);
}
// 隱藏前端作者名稱
if (!defined('MDT_HIDE_AUTHOR_NAME')) {
	define('MDT_HIDE_AUTHOR_NAME', true);
}
// 隱藏前端作者名稱的預設顯示名
if (!defined('MDT_AUTHOR_DISPLAY_NAME')) {
	define('MDT_AUTHOR_DISPLAY_NAME', '小編');
}
// 關閉全球大頭貼功能
if (!defined('MDT_DISABLE_AVATAR')) {
	define('MDT_DISABLE_AVATAR', true);
}
// 最佳化主題相關功能
if (!defined('MDT_ENABLE_OPTIMIZE_THEME')) {
	define('MDT_ENABLE_OPTIMIZE_THEME', true);
}
// 關閉網站狀態工具功能
if (!defined('MDT_DISABLE_SITE_HEALTH')) {
	define('MDT_DISABLE_SITE_HEALTH', false);
}
// 預設不啟用全部信件轉寄功能
if (!defined('MDT_OVERWRITE_EMAIL')) {
	define('MDT_OVERWRITE_EMAIL', false);
}
// 全部信件轉寄給指定信箱
if (!defined('MDT_OVERWRITE_EMAIL_RECEIVER')) {
	define('MDT_OVERWRITE_EMAIL_RECEIVER', '');
}
// 關閉後台檔案形式操作
if (!defined('MDT_DISALLOW_FILE_MODS')) {
	define('MDT_DISALLOW_FILE_MODS', true);
}
// 單獨給指定的管理員開啟後台檔案形式操作，陣列指定管理員ID
if (!defined('MDT_DISALLOW_FILE_MODS_ADMINS')) {
	define('MDT_DISALLOW_FILE_MODS_ADMINS', array(1));
}
// 顯示後台內容的系統編號
if (!defined('MDT_SHOW_IDS')) {
	define('MDT_SHOW_IDS', true);
}
// 登入畫面的LOGO替換
if (!defined('MDT_LOGINPAGE_LOGO_URL')) {
	define('MDT_LOGINPAGE_LOGO_URL', '');
}
// 鎖定與更新管理員信箱
if (!defined('MDT_ADMIN_EMAIL')) {
	define('MDT_ADMIN_EMAIL', '');
}
// 預設關閉使用者註冊，把這功能交給其他會員外掛處理
if (!defined('MDT_USER_CAN_REG')) {
	define('MDT_USER_CAN_REG', 0);
}
// 預設關閉自動回報功能，打開此設定需要重新啟用外掛
if (!defined('MDT_SITE_HEALTH_REPORT_CRON')) {
	define('MDT_SITE_HEALTH_REPORT_CRON', false);
}
// 預設顯示使用者註冊時間排序功能
if (!defined('MDT_ENABLE_RECENTLY_REGISTERED')) {
	define('MDT_ENABLE_RECENTLY_REGISTERED', true);
}
// 預設對非管理員隱藏「自訂」連結
if (!defined('MDT_HIDE_CUSTOMIZE_LINK')) {
	define('MDT_HIDE_CUSTOMIZE_LINK', true);
}
// 預設對非管理員隱藏前端 Admin Bar 選項
if (!defined('MDT_HIDE_FRONTEND_ADMIN_BAR')) {
	define('MDT_HIDE_FRONTEND_ADMIN_BAR', true);
}
// 執行 CRON 任務的時候順便自動更新外掛
if (!defined("MDT_ENABLE_CRON_AUTO_UPDATE")) {
	define('MDT_ENABLE_CRON_AUTO_UPDATE', true);
}
// 預設開啟使用者封鎖登入功能
if (!defined("MDT_ENABLE_BLOCK_USER_FUNCTION")) {
	define('MDT_ENABLE_BLOCK_USER_FUNCTION', true);
}
// 預設開啟所有連線請求
if (!defined("MDT_BLOCK_ALL_NETWORK_FUNCTION")) {
	define('MDT_BLOCK_ALL_NETWORK_FUNCTION', false);
}
// 預設開啟登入後分權限轉址
if (!defined("MDT_ENABLE_LOGIN_REDIRECT")) {
	define('MDT_ENABLE_LOGIN_REDIRECT', true);
}
// 開啟子主題下的 languages 目錄繼承翻譯 mo 檔案的功能
if (!defined("MDT_ENABLE_OVERWRITE_I18N_MO_FILE")) {
	define('MDT_ENABLE_OVERWRITE_I18N_MO_FILE', true);
}
// 預設啟用移除資源自帶版本號的功能
if (!defined("MDT_ENABLE_REMOVE_VERSION_QUERY")) {
	define('MDT_ENABLE_REMOVE_VERSION_QUERY', true);
}
// 預設啟用防止留言機器人的功能
if (!defined("MDT_ENABLE_COMMENT_SPAM_FUCKOFF")) {
	define('MDT_ENABLE_COMMENT_SPAM_FUCKOFF', true);
}
// 前端給留言機器人看的字串
if (!defined("COMMENT_SPAM_FUCKOFF_DISPLAY_TEXT")) {
	define('COMMENT_SPAM_FUCKOFF_DISPLAY_TEXT', 'FUCK OFF SPAM! If you are not a comment bot, please find a way to contact the site administrator. 如果你不是留言機器人，請想辦法聯繫網站管理員。');
}

class MDTSnippets {
	public function __construct() {
		// 註冊程式碼片段的勾點
		$this->add_hooks();
	}

	public function add_hooks() {
		add_action('plugins_loaded', array($this, 'plugins_loaded_action'));
		add_filter('plugin_action_links', array($this, 'modify_action_link'), 11, 4);
		// 隱藏 Freemius 的擾人通知
		if (class_exists('Freemius')) {
			remove_all_actions('admin_notices');
			remove_all_actions('network_admin_notices');
			remove_all_actions('all_admin_notices');
			remove_all_actions('user_admin_notices');
		}
		add_action('pre_current_active_plugins', array($this, 'plugin_display_none'));
		add_filter('site_transient_update_plugins', array($this, 'disable_this_plugin_updates'), 11, 1);
		// 有其他外掛加入自動更新時也一並加入
		add_filter("pre_update_site_option_auto_update_plugins", array($this, 'pre_update_site_option_auto_update_plugins'), 11, 4);
		// v5.8.0 後提供的客製化更新勾點
		// add_filter("update_plugins_snippets.dev.mxp.tw", array($this, 'update_plugins_snippets'), 11, 4);

		if (MDT_ENABLE_OPTIMIZE_THEME) {
			// 主題相關最佳化
			add_action('after_setup_theme', array($this, 'optimize_theme_setup'));
		}
		if (MDT_DISABLE_IMAGE_SIZE) {
			// 取消縮圖機制
			add_filter('wp_get_attachment_metadata', array($this, 'remove_attachment_metadata_size'), 11, 2);
			add_filter('intermediate_image_sizes', '__return_empty_array');
			add_filter('intermediate_image_sizes_advanced', '__return_empty_array');
			add_filter('fallback_intermediate_image_sizes', '__return_empty_array');
			// 禁用 WC 背景縮圖功能
			add_filter('woocommerce_background_image_regeneration', '__return_false');
		}
		// 取消預設 2560 寬高限制
		add_filter('big_image_size_threshold', '__return_false');
		if (MDT_ADD_IMAGE_CONTENT) {
			// 上傳檔案時判斷為圖片時自動加上標題、替代標題、摘要、描述等內容
			add_action('add_attachment', array($this, 'set_image_meta_upon_image_upload'));
		}
		// 修改「網站遭遇技術性問題」通知信收件人
		add_filter('recovery_mode_email', array($this, 'change_recovery_mode_email'), 11, 2);
		// 去除有管理權限之外人的通知訊息
		add_action('admin_head', array($this, 'hide_update_msg_non_admins'), 1);
		// 開啟隱私權頁面修改權限
		add_filter('map_meta_cap', array($this, 'add_privacy_page_edit_cap'), 10, 4);
		// Contact Form 7 強化功能
		add_action('admin_init', array($this, 'cf7_optimize'));
		// 刪除文章前的防呆提醒機制
		add_action('admin_footer', array($this, 'delete_post_confirm_action'));
		// 限制上傳大小以及轉正JPG影像（如果有EXIF資訊的話）https://www.mxp.tw/9318/
		add_filter('wp_handle_upload_prefilter', array($this, 'image_size_and_image_orientation'));
		// 預設不直接更新大版本，僅安全性版本更新
		add_filter('allow_major_auto_core_updates', '__return_false');
		// 每次更新完後檢查 xmlrpc.php | install.php 還在不在，在就砍掉，避免後患
		add_action('upgrader_process_complete', array($this, 'check_files_after_upgrade_action'), 10, 2);
		if (MDT_HIDE_COMMENT_URL) {
			// 遮蔽所有留言中留言人提供的網址
			add_filter('get_comment_author_url', array($this, 'hide_comment_author_url'), 11, 3);
		}
		// 使用者登入後轉址回指定位置
		add_action('template_redirect', array($this, 'redirect_to_after_login'), -1);
		if (MDT_DISABLE_SELF_PING) {
			// 停用自己站內的引用
			add_action('pre_ping', array($this, 'disable_self_ping'), 11, 3);
		}
		if (MDT_XMLRPC_DISABLE) {
			//預設關閉 XML_RPC
			add_filter('xmlrpc_enabled', '__return_false');
		}
		if (MDT_ENABLE_SECURITY_HEADERS) {
			// 輸出 X-Frame-Options HTTP Header
			add_action('send_headers', 'send_frame_options_header', 10, 0);
			// 輸出安全性的 HTTP 標頭
			add_filter('wp_headers', array($this, 'add_security_headers'));
		}
		// 關閉 HTTP Header 中出現的 Links
		add_filter('oembed_discovery_links', '__return_null');
		remove_action('wp_head', 'rest_output_link_wp_head', 10);
		remove_action('template_redirect', 'rest_output_link_header', 11);
		remove_action('template_redirect', 'wp_shortlink_header', 11);
		if (MDT_DISABLE_REST_INDEX) {
			// 關閉 wp-json 首頁顯示的 API 清單
			add_filter('rest_index', array($this, 'rest_response_empty_array'), 11, 1);
		}
		if (MDT_HIDE_AUTHOR_LINK) {
			// 預設前端作者的連結都不顯示
			add_filter('author_link', array($this, 'hide_author_link'), 3, 100);
		}
		if (MDT_HIDE_AUTHOR_NAME) {
			// add_filter('the_author_posts_link', array($this, 'hide_author_name'), 11, 1);
			add_filter('the_author', array($this, 'hide_author_name'), 11, 1);
		}
		if (MDT_DISABLE_AVATAR) {
			// 取消站內的全球大頭貼功能，全改為預設大頭貼
			add_filter('pre_get_avatar_data', array($this, 'empty_avatar_data'), PHP_INT_MAX, 2);
		}
		// 內對外請求管制方法
		add_filter("pre_http_request", array($this, "block_external_request"), 11, 3);
		if (MDT_DISABLE_SITE_HEALTH) {
			// 關閉 site health 檢測功能
			add_filter('site_status_tests', '__return_empty_array', 100, 1);
			add_filter('debug_information', '__return_empty_array', 100, 1);
		}
		if (MDT_OVERWRITE_EMAIL) {
			// 全部信件轉寄功能
			add_filter('wp_mail', array($this, 'overwrite_wp_mail_receiver'), 11, 1);
		}
		// 給內建的檔案編輯鎖多一點彈性，可以指定管理員開放
		add_action('init', array($this, 'overwrite_file_mods'));
		add_filter('file_mod_allowed', array($this, 'filter_file_mod_allowed'), 9999999, 2);
		// 鎖定對總管理員的保護操作
		add_filter('user_row_actions', array($this, 'filter_user_row_actions'), 11, 2);
		add_filter('ms_user_row_actions', array($this, 'filter_user_row_actions'), 11, 2);
		add_filter('get_edit_user_link', array($this, 'get_edit_user_link'), 11, 2);
		if (MDT_SHOW_IDS) {
			// 客製化CPT等的ID
			add_action('admin_init', array($this, 'add_custom_object_ids'));
			// 文章的ID
			add_filter('manage_posts_columns', array($this, 'add_ids_column'));
			add_action('manage_posts_custom_column', array($this, 'add_ids_value'), 10, 2);
			// 頁面的ID
			add_filter('manage_pages_columns', array($this, 'add_ids_column'));
			add_action('manage_pages_custom_column', array($this, 'add_ids_value'), 10, 2);
			// 媒體庫的ID
			add_filter('manage_media_columns', array($this, 'add_ids_column'));
			add_action('manage_media_custom_column', array($this, 'add_ids_value'), 10, 2);
			// For Link Management.
			add_filter('manage_link-manager_columns', array($this, 'add_ids_column'));
			add_action('manage_link_custom_column', array($this, 'add_ids_value'), 10, 2);
			// 分類的ID
			add_action('manage_edit-link-categories_columns', array($this, 'add_ids_column'));
			add_filter('manage_link_categories_custom_column', array($this, 'add_return_ids_value'), 10, 3);
			// 使用者的ID
			add_action('manage_users_columns', array($this, 'add_ids_column'));
			add_filter('manage_users_custom_column', array($this, 'add_return_ids_value'), 10, 3);
			// 留言的ID
			add_action('manage_edit-comments_columns', array($this, 'add_ids_column'));
			add_action('manage_comments_custom_column', array($this, 'add_ids_value'),
				10, 2);
		}
		// 預設改變登入上方帶入連結與文字標題
		add_filter('login_headerurl', array($this, 'login_page_url'));
		add_filter('login_headertext', array($this, 'login_page_url_title'));
		if (MDT_ENABLE_LOGIN_REDIRECT) {
			add_filter('login_redirect', array($this, 'login_redirect'), 11, 3);
		}
		if (!empty(MDT_LOGINPAGE_LOGO_URL) && filter_var(MDT_LOGINPAGE_LOGO_URL, FILTER_VALIDATE_URL)) {
			add_action('login_enqueue_scripts', array($this, 'login_css_enqueues'));
		}
		// 快速更改系統管理員信箱
		if (MDT_ADMIN_EMAIL != '' && filter_var(MDT_ADMIN_EMAIL, FILTER_VALIDATE_EMAIL)) {
			delete_option("adminhash");
			delete_option("new_admin_email");
			add_filter('send_site_admin_email_change_email', '__return_false', 11, 3);
			if (get_option('admin_email') != MDT_ADMIN_EMAIL) {
				add_action('init', array($this, 'update_admin_email'));
			}
		}
		// 預設關閉使用者註冊
		if (MDT_USER_CAN_REG != get_option('users_can_register')) {
			update_option('users_can_register', MDT_USER_CAN_REG !== 0 ? 1 : 0);
		}
		// 設定 Cron 來回報網站狀態
		add_filter('cron_schedules', array($this, 'add_cron_schedules'));
		add_action('mxp_site_health_report_cron', array($this, 'mxp_site_health_report_cron_action'));
		// 顯示使用者帳號的註冊時間，移植此款外掛 https://tw.wordpress.org/plugins/recently-registered/
		if (MDT_ENABLE_RECENTLY_REGISTERED) {
			add_action('admin_init', array($this, 'recently_registered'));
		}
		if (MDT_HIDE_CUSTOMIZE_LINK) {
			add_action('admin_menu', array($this, 'remove_customize_link'));
		}
		if (MDT_HIDE_FRONTEND_ADMIN_BAR) {
			add_action('admin_bar_menu', array($this, 'hide_frontend_admin_bar'), 99999, 1);
		}

		// 清除 OPCache 快取方法
		if ((isset($_REQUEST['opcache_reset']) || isset($_REQUEST['flush_opcache']) || isset($_REQUEST['opcache_flush']) || isset($_REQUEST['debug'])) && function_exists('opcache_reset')) {
			opcache_reset();
		}
		if (defined('MDT_DISALLOW_FILE_MODS_ADMINS') && is_array(MDT_DISALLOW_FILE_MODS_ADMINS)) {
			add_filter('users_list_table_query_args', array($this, 'filter_user_query_qrgs'), 99999, 1);
			add_filter('map_meta_cap', array($this, 'restrict_user_editing'), 99999, 4);
			add_filter('pre_count_users', array($this, 'filter_user_counts'), 99999, 3);
		}
		if (MDT_ENABLE_OVERWRITE_I18N_MO_FILE) {
			add_filter('load_textdomain_mofile', array($this, 'load_custom_translation_mo_file'), 12, 2);
		}
		if (MDT_ENABLE_COMMENT_SPAM_FUCKOFF) {
			// 前端加入關鍵字
			add_action('comment_form', array($this, 'comment_form_frontend_hack'));
			// 後端判斷是否有經過前端的處理，沒處理就阻擋
			add_action('init', array($this, 'mxp_custom_comment_intercept'));
		}

	}

	public function plugins_loaded_action() {
		// 針對有管理使用者權限的角色開放封鎖功能
		if (MDT_ENABLE_BLOCK_USER_FUNCTION) {
			add_filter('wp_authenticate_user', array($this, 'block_user_login'), 100, 2);
			if (current_user_can(apply_filters('mxp_dev_overwrite_block_user_function_cap', 'create_users'))) {
				add_action('show_user_profile', array($this, 'add_user_meta_fields'));
				add_action('edit_user_profile', array($this, 'add_user_meta_fields'));
				add_action('personal_options_update', array($this, 'save_user_meta_fields'));
				add_action('edit_user_profile_update', array($this, 'save_user_meta_fields'));
			}
		}
		// 沒登入的使用者都無法呼叫 wp/users 這隻 API。不建議完全封鎖掉，會導致有些後台功能運作失靈
		if (function_exists('get_current_user_id') && get_current_user_id() == 0 && MDT_DISABLE_NO_AUTH_ACCESS_REST_USER) {
			// 要影響 Query 結果的話這邊不能傳入空值，要改寫，但下方勾點還可以處理，先放著
			// add_filter('rest_user_query', '__return_empty_array');
			add_filter('rest_prepare_user', '__return_empty_array');
		}
	}

	public function comment_form_frontend_hack($post_id) {
		echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          document.body.addEventListener('click', function(event) {
						let commentPostIDFields = document.querySelectorAll('input[type=\"hidden\"][name=\"comment_post_ID\"]');
						commentPostIDFields.forEach(function(field) {
							if (field.value.indexOf('|mxp_tw') === -1){
						  		field.setAttribute('value', field.value + '|mxp_tw');
						  		console.log('Updated value:', field.value);
						  	}
						});
					});
        });
        </script>";
	}

	public function mxp_custom_comment_intercept() {
		// 檢查是否為留言提交請求
		if (isset($_POST['comment']) && isset($_POST['comment_post_ID'])) {
			$parts = explode('|', $_POST['comment_post_ID']);
			if (count($parts) != 2) {
				wp_die(COMMENT_SPAM_FUCKOFF_DISPLAY_TEXT, '403 Forbidden', array('response' => 403));
			} else {
				$_POST['comment_post_ID'] = intval($parts[0]);
			}
		}
	}

	public function load_custom_translation_mo_file($mofile, $domain) {
		$overwrite_textdomains = apply_filters("mxp_dev_overwrite_i18n_textdomains", array('woocommerce'));
		if (is_array($overwrite_textdomains) && in_array($domain, $overwrite_textdomains)) {
			$theme_mofile = get_stylesheet_directory() . '/languages/' . $domain . '-' . get_locale() . '.mo';
			if (file_exists($theme_mofile)) {
				return $theme_mofile;
			}
		}
		return $mofile;
	}

	public function add_custom_object_ids() {

		// For Custom Taxonomies.
		$taxonomies = get_taxonomies(array('public' => true), 'names');
		foreach ($taxonomies as $custom_taxonomy) {
			if (isset($custom_taxonomy)) {
				add_action('manage_edit-' . $custom_taxonomy . '_columns', array($this, 'add_ids_column'));
				add_filter('manage_' . $custom_taxonomy . '_custom_column', array($this, 'add_return_ids_value'), 10, 3);
			}
		}

		// For Custom Post Types.
		$post_types = get_post_types(array('public' => true), 'names');
		foreach ($post_types as $post_type) {
			if (isset($post_type)) {
				add_action('manage_edit-' . $post_type . '_columns', array($this, 'add_ids_column'));
				add_filter('manage_' . $post_type . '_custom_column', array($this, 'add_return_ids_value'), 10, 3);
			}
		}
	}

	public function add_ids_column($cols) {
		$cols['mdt-show-ids'] = 'ID';
		return $cols;
	}

	public function add_ids_value($column_name, $id) {
		if ('mdt-show-ids' === $column_name) {
			echo esc_html($id);
		}
	}

	public function add_return_ids_value($value, $column_name, $id) {
		if ('mdt-show-ids' === $column_name) {
			$value = $id;
		}

		return $value;
	}

	public function block_user_login($user, $password) {
		if (is_wp_error($user)) {
			return $user;
		}
		$block_user_check = get_user_meta($user->ID, '_mxp_dev_block_user_check', true);
		$block_user_msg = get_user_meta($user->ID, '_mxp_dev_block_user_msg', true);
		if ($block_user_check == 1) {
			$message = empty($block_user_msg) ? '違反網站相關規定，禁止登入作業，如有問題請聯繫網站管理員。' : $block_user_msg;
			$manager = \WP_Session_Tokens::get_instance($user->ID);
			$manager->destroy_all();
			wp_destroy_current_session();
			return new \WP_Error('loggedin_restricted', $message);
		}
		// $manager = WP_Session_Tokens::get_instance($user->ID);
		// $count   = count($manager->get_all());
		// $reached = $count >= 1;
		// $message = '超過限制的登入次數，請從其他裝置登出後再次登入。';
		// if ($reached) {
		//     return new WP_Error('loggedin_reached_limit', $message);
		// }
		return $user;
	}

	public function add_user_meta_fields($user) {
		// 使用者禁止登入設定功能
		$block_user_check = get_user_meta($user->ID, '_mxp_dev_block_user_check', true);
		$block_user_msg = get_user_meta($user->ID, '_mxp_dev_block_user_msg', true);
		if (empty($block_user_msg)) {
			$block_user_msg = '違反網站相關規定，禁止登入作業，如有問題請聯繫網站管理員。';
		}
		echo '<h3>封鎖用戶設定</h3><table class="form-table"><tr><th><label for="_mxp_dev_block_user_check">封鎖使用者</label></th><td><input type="checkbox" name="_mxp_dev_block_user_check" id="_mxp_dev_block_user_check" value="1" class="regular-text" ' . checked($block_user_check, 1, false) . '/></td></tr>
            <tr><th><label for="_mxp_dev_block_user_msg">登入顯示封鎖提示</label></th><td><input type="text" name="_mxp_dev_block_user_msg" id="_mxp_dev_block_user_msg" value="' . esc_attr($block_user_msg) . '" class="regular-text" /></td></tr></table>';
	}

	public function save_user_meta_fields($user_id) {
		$user = get_user_by('id', $user_id);
		if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-user_' . $user_id)) {
			return;
		}
		$current_user = wp_get_current_user();
		//限制角色操作功能
		$allowed_roles = apply_filters('mxp_dev_block_user_roles', array('administrator', 'shop_manager'));
		if (array_intersect($allowed_roles, $current_user->roles)) {
			update_user_meta($user_id, '_mxp_dev_block_user_check', intval($_POST['_mxp_dev_block_user_check']));
			update_user_meta($user_id, '_mxp_dev_block_user_msg', sanitize_text_field($_POST['_mxp_dev_block_user_msg']));
		}
	}

	public function remove_customize_link() {
		$user = wp_get_current_user();
		$allowed_roles = apply_filters('mxp_dev_show_menu_customize_link_roles', array('administrator'));
		//不是管理員，都把下面的設定選項移除
		if (!array_intersect($allowed_roles, $user->roles)) {
			$customize_url = add_query_arg('return', urlencode(remove_query_arg(wp_removable_query_args(), wp_unslash($_SERVER['REQUEST_URI']))), 'customize.php');
			remove_submenu_page('themes.php', $customize_url);
		}
	}

	public function rest_response_empty_array($response) {
		$new_response = new \WP_REST_Response();
		// 將空資料設定給 WP_REST_Response 物件
		$new_response->set_data(array());
		// 回傳 WP_REST_Response 物件
		return $new_response;
	}

	public function recently_registered() {
		if (is_admin()) {
			add_filter('manage_users_columns', function ($columns) {
				$columns['registerdate'] = '註冊時間';
				return $columns;
			});
			add_action('manage_users_custom_column', function ($value, $column_name, $user_id) {
				global $mode;
				$list_mode = empty($_REQUEST['mode']) ? 'list' : sanitize_text_field($_REQUEST['mode']);

				if ('registerdate' !== $column_name) {
					return $value;
				} else {
					$user = get_userdata($user_id);
					if (is_multisite() && ('list' === $list_mode)) {
						$formated_date = 'Y/m/d';
					} else {
						$formated_date = 'Y/m/d g:i:s a';
					}
					$registered = strtotime(get_date_from_gmt($user->user_registered));
					// If the date is negative or in the future, then something's wrong, so we'll be unknown.
					if (($registered <= 0) || (time() <= $registered)) {
						$registerdate = '<span class="recently-registered invalid-date">未知時間</span>';
					} else {
						$registerdate = '<span class="recently-registered valid-date">' . date_i18n($formated_date, $registered) . '</span>';
					}
					return $registerdate;
				}
			}, 10, 3);
			add_filter('manage_users_sortable_columns', function ($columns) {
				$custom = array(
					// meta column id => sortby value used in query
					'registerdate' => 'registered',
				);
				return wp_parse_args($custom, $columns);
			});
			add_filter('request', function ($vars) {
				if (isset($vars['orderby']) && 'registerdate' == $vars['orderby']) {
					$new_vars = array(
						'meta_key' => 'registerdate',
						'orderby' => 'meta_value',
					);
					$vars = array_merge($vars, $new_vars);
				}
				return $vars;
			});
		}
	}

	public function mxp_site_health_report_cron_action() {
		$diagnostic_info = $this->wp_diagnostic_info();
		$admin_email = get_option('admin_email');
		$req = array(
			'domain' => parse_url($diagnostic_info['site_url'], PHP_URL_HOST),
			'php' => $diagnostic_info['PHP'],
			'mysql' => $diagnostic_info['MySQL'],
			'wp' => $diagnostic_info['WordPress'],
			'theme' => $diagnostic_info['Active_Theme']['Name'] . "_" . $diagnostic_info['Active_Theme']['Version'],
			'parent_theme' => $diagnostic_info['Parent_Theme']['Name'] . "_" . $diagnostic_info['Parent_Theme']['Version'],
			'json' => json_encode($diagnostic_info),
			'version' => '1.3',
			'knockers' => apply_filters('mxpdev_site_health_report_cate_id', 0), //站點分類
			'email' => apply_filters('mxpdev_site_health_report_email', $admin_email), //比對異常時的通知人，可改其他通知人。「,」分隔多重聯絡人，總長度不得超過 100 字元
		);
		$response = wp_remote_post('https://api.undo.im/wp-json/mxp_knockers/v1/app/register', array(
			'method' => 'POST',
			'timeout' => 10,
			'redirection' => 5,
			'httpversion' => '1.1',
			'blocking' => false,
			'headers' => array('Content-Type' => 'application/json'),
			'body' => wp_json_encode($req),
			'cookies' => array(),
			'sslverify' => false,
			'data_format' => 'body',
		)
		);

		if (is_wp_error($response)) {
			$error_message = $response->get_error_message();
			if (defined('WP_DEBUG') && WP_DEBUG == true) {
				error_log($req['domain'] . "_CRONJOB_ERROR: $error_message");
			}
		}
		if (defined('WP_DEBUG') && WP_DEBUG == true) {
			error_log($req['domain'] . "_CRONJOB_DONE");
		}
		// 執行自動更新
		if (MDT_ENABLE_CRON_AUTO_UPDATE) {
			if (!function_exists('wp_update_plugins')) {
				require_once ABSPATH . 'wp-includes/update.php';
			}
			// 先檢查外掛更新
			wp_update_plugins(array('timestamp'));
			// 取得要更新的外掛列表快取資訊
			$plugin_updates = apply_filters('mxp_dev_update_plugins', get_site_transient('update_plugins'));
			// 取得自動更新的外掛清單
			$auto_update_list = apply_filters('mxp_dev_auto_update_plugins', array('mxp-dev-tools/index.php'));
			// 取得全部需要更新的外掛
			if ($plugin_updates && !empty($plugin_updates->response)) {
				include_once ABSPATH . 'wp-admin/includes/file.php';
				include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				remove_action('upgrader_process_complete', 'wp_version_check');
				remove_action('upgrader_process_complete', 'wp_update_plugins');
				remove_action('upgrader_process_complete', 'wp_update_themes');
				foreach ($plugin_updates->response as $plugin_file => $plugin_data) {
					if (in_array($plugin_file, $auto_update_list, true)) {
						// 判斷 PHP 版本有沒有符合升級要素前提，確定不滿足就跳開，否則繼續升級程序
						if (isset($plugin_data->requires_php) && isset($diagnostic_info['PHP']) && version_compare($diagnostic_info['PHP'], $plugin_data->requires_php, '<')) {
							continue;
						}
						$skin = new \WP_Ajax_Upgrader_Skin();
						$upgrader = new \Plugin_Upgrader($skin);
						$plugin_download_link = apply_filters('mxp_dev_update_plugin_download_link', $plugin_data->package, $plugin_file, $plugin_data);
						$update_result = $upgrader->install($plugin_download_link, array('overwrite_package' => true));
						if (is_wp_error($update_result)) {
							$error_message = $update_result->get_error_message();
							if (defined('WP_DEBUG') && WP_DEBUG == true) {
								error_log("更新 {$plugin_file} 外掛失敗：$error_message");
							}
						} else {
							if (defined('WP_DEBUG') && WP_DEBUG == true) {
								// 更新成功
								error_log("更新 {$plugin_file} 外掛成功。");
							}
						}
					}
				}
				if (!function_exists('wp_clean_plugins_cache')) {
					include_once ABSPATH . 'wp-admin/includes/plugin.php';
				}
				// Force refresh of plugin update information.
				wp_clean_plugins_cache();
			}
		}
	}

	public function add_cron_schedules($schedules) {
		$schedules['mxpdev_2h'] = array(
			'interval' => 7200, // 兩小時檢查一次變化
			'display' => "Every 2 Hours",
		);
		return $schedules;
	}

	public function update_admin_email() {
		update_option('admin_email', MDT_ADMIN_EMAIL);
	}

	public function login_css_enqueues() {
		echo '<style type="text/css">' . $this->admin_login_page_css(MDT_LOGINPAGE_LOGO_URL) . '</style>';

	}

	public function admin_login_page_css($image) {
		$headers = !empty($image) && ini_get('allow_url_fopen') ? @get_headers($image) : '';
		if (!empty($image) && $headers && (strpos($headers[0], '404') === false) && (strpos($headers[0],
			'403') === false) && ini_get('allow_url_fopen')) {
			$img_id = attachment_url_to_postid($image);
			if ($img_id) {
				// First we check if the image has been uploaded on WordPress
				$img_meta = wp_get_attachment_metadata($img_id);
				if (isset($img_meta['width']) && isset($img_meta['height'])) {
					$dimensions = array(
						$img_meta['width'],
						$img_meta['height'],
					);
				} else {
					$dimensions = array(
						'',
						'',
					);
				}
			} else {
				// If not (could be an external URL)
				$dimensions = getimagesize($image);
			}
		} else {
			$dimensions = array(
				'',
				'',
			);
		}
		list($width, $height) = $dimensions; // Get the uploaded image's width and height
		if ($width != '' && $height != '' && $width < 321) {
			// If width is recognized, use it
			$w = $width . 'px auto';
			$h = 'height: ' . $height . 'px;';
		} elseif ($width > 320) {
			// but if it's more than 320 pixels, force it to 320px
			$r = ($width / $height); // calculate ratio
			$w = '320px auto';
			$h = 'height: ' . (320 / $r) . 'px;';
		} else {
			$w = 'auto 80px';
			$h = '';
		}
		$output = 'body.login div#login h1 a {
                background-image: url(' . $image . ');
                background-size: ' . $w . ';'
			. $h .
			'width: 100%;
                background-position: bottom;
            }';

		return $output;
	}

	public function login_redirect($redirect_to, $request, $user) {
		$admins = false;
		if (is_wp_error($user)) {
			return $redirect_to;
		}
		if (isset($user) && is_array($user->roles)) {
			$allowed_roles = apply_filters('mxp_dev_admin_roles', array('editor', 'administrator', 'author', 'shop_manager'));
			$intersection = array_intersect($user->roles, $allowed_roles);
			if (!empty($intersection)) {
				$admins = true;
			}
		}
		if ($admins) {
			return admin_url();
		} else {
			return $redirect_to;
		}
	}

	public function login_page_url_title() {
		return esc_attr(get_bloginfo('name', 'display'));
	}

	public function login_page_url() {
		return get_bloginfo('url');
	}

	public function get_edit_user_link($link, $user_id) {
		if (is_array(MDT_DISALLOW_FILE_MODS_ADMINS) && in_array($user_id, MDT_DISALLOW_FILE_MODS_ADMINS) && get_current_user_id() != $user_id) {
			return '#';
		}
		return $link;
	}

	public function filter_user_row_actions(array $actions, \WP_User $user) {
		if (is_array(MDT_DISALLOW_FILE_MODS_ADMINS) && in_array($user->ID, MDT_DISALLOW_FILE_MODS_ADMINS) && get_current_user_id() != $user->ID) {
			if (isset($actions['switch_to_user'])) {
				unset($actions['switch_to_user']);
			}
			if (isset($actions['delete'])) {
				unset($actions['delete']);
			}
			if (isset($actions['edit'])) {
				unset($actions['edit']);
			}
			if (isset($actions['resetpassword'])) {
				unset($actions['resetpassword']);
			}
		}
		return $actions;
	}

	public function modify_action_link($actions, $plugin_file, $plugin_data, $context) {
		if (strpos($plugin_file, 'mxp-dev-tools') === 0 && isset($actions['delete'])) {
			unset($actions['delete']);
			return $actions;
		} else {
			return $actions;
		}
	}

	public function plugin_display_none() {
		global $wp_list_table;
		$h = array('mxp-dev-tools/mxp-snippets.php');
		$myplugins = $wp_list_table->items;
		foreach ($myplugins as $key => $val) {
			if (in_array($key, $h) && !MDT_SNIPPETS_DISPLAY) {
				unset($wp_list_table->items[$key]);
			}
		}
	}

	public function disable_this_plugin_updates($value) {
		$pluginsNotUpdatable = [
			'mxp-dev-tools/mxp-snippets.php',
		];
		if (isset($value) && is_object($value)) {
			foreach ($pluginsNotUpdatable as $plugin) {
				if (isset($value->response[$plugin])) {
					unset($value->response[$plugin]);
				}
			}
		}
		return $value;
	}

	public function pre_update_site_option_auto_update_plugins($auto_updates, $old_value, $option = '', $network_id = '') {
		if (is_array($auto_updates) && !in_array('mxp-dev-tools/index.php', $auto_updates, true)) {
			$auto_updates[] = 'mxp-dev-tools/index.php';
		}
		return $auto_updates;
	}

	//最佳化主題樣式相關
	public function optimize_theme_setup() {
		//整理head資訊
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_shortlink_wp_head');
		add_filter('the_generator', '__return_false');
		//管理員等級的角色不要隱藏 admin bar
		$user = wp_get_current_user();
		$allowed_roles = apply_filters('mxp_dev_show_admin_bar_roles', array('editor', 'administrator', 'author', 'shop_manager'));
		if (!array_intersect($allowed_roles, $user->roles)) {
			add_filter('show_admin_bar', '__return_false');
		}
		remove_action('wp_head', 'feed_links_extra', 3);

		add_filter('style_loader_src', array($this, 'remove_version_query'), 999);
		add_filter('script_loader_src', array($this, 'remove_version_query'), 999);
		add_filter('widget_text', 'do_shortcode');
		// 讓主題支援使用 WC 的方法
		if (class_exists('WooCommerce')) {
			// add_theme_support('woocommerce');
			// add_theme_support('wc-product-gallery-zoom');
			// add_theme_support('wc-product-gallery-lightbox');
			// add_theme_support('wc-product-gallery-slider');
		}
	}
	// 隱藏非管理員的前端上方控制選單
	public function hide_frontend_admin_bar($wp_admin_bar) {
		if (is_admin()) {
			// 後台不設限，僅針對前台
			return;
		}
		$user = wp_get_current_user();
		$allowed_roles = apply_filters('mxp_dev_show_frontend_admin_bar_roles', array('administrator'));
		if (!array_intersect($allowed_roles, $user->roles)) {
			$all_list = $wp_admin_bar->get_nodes();
			$allow_list = apply_filters('mxp_dev_show_frontend_admin_bar_nodes', array("my-account", "search", "logout", "edit-profile", "user-info", "user-actions", "switch-back", "site-name", "dashboard", "top-secondary", "mxp_dev_hooks_usage"));
			if (is_singular() || is_page() || is_single()) {
				$allow_list[] = "edit";
			}
			foreach ($all_list as $node_id => $node_obj) {
				if (!in_array($node_id, $allow_list)) {
					$wp_admin_bar->remove_node($node_id);
				}
			}
			add_filter('elementor/frontend/admin_bar/settings', function ($settings) {
				unset($settings['elementor_edit_page']);
				return $settings;
			}, 99999, 1);
		}
	}

	//移除css, js資源載入時的版本資訊
	public function remove_version_query($src) {
		if (empty($src)) {
			return $src;
		}
		if (strpos($src, 'ver=') && strpos($src, 'mxp-dev-tools') === false && MDT_ENABLE_REMOVE_VERSION_QUERY) {
			$src = remove_query_arg('ver', $src);
		}
		return $src;
	}
	//阻止縮圖浪費空間
	public function remove_attachment_metadata_size($data, $attachment_id) {
		if (isset($data['sizes'])) {
			// 清空設定的大小，強迫輸出原圖
			$data['sizes'] = array();
		}
		return $data;
	}
	//上傳檔案時判斷為圖片時自動加上標題、替代標題、摘要、描述等內容
	public function set_image_meta_upon_image_upload($post_ID) {

		if (wp_attachment_is_image($post_ID)) {
			$my_image_title = get_post($post_ID)->post_title;
			$my_image_title = preg_replace('%\s*[-_\s]+\s*%', ' ', $my_image_title);
			$my_image_title = ucwords(strtolower($my_image_title));
			$my_image_meta = array(
				'ID' => $post_ID,
				'post_title' => $my_image_title,
				'post_excerpt' => $my_image_title,
				'post_content' => $my_image_title,
			);
			update_post_meta($post_ID, '_wp_attachment_image_alt', $my_image_title);
			wp_update_post($my_image_meta);
		}
	}
	//修改「網站遭遇技術性問題」通知信收件人
	public function change_recovery_mode_email($email, $url) {
		$email['to'] = MDT_RECOVERY_MODE_EMAIL; //收件人
		// $email['subject'] //主旨
		// $email['message'] //內文
		// $email['headers'] //信件標頭
		return $email;
	}
	// 去除有管理權限之外人的通知訊息
	public function hide_update_msg_non_admins() {
		$user = wp_get_current_user();
		if (!in_array('administrator', (array) $user->roles)) {
			// non-admin users
			echo '<style>#setting-error-tgmpa>.updated settings-error notice is-dismissible, .update-nag, .updated { display: none; }</style>';
		}
		// 隱藏非管理人員的更新通知
		if (!current_user_can('update_core')) {
			remove_action('admin_notices', 'update_nag', 3);
		}
	}
	// 開啟隱私權頁面修改權限
	public function add_privacy_page_edit_cap($caps, $cap, $user_id, $args) {
		if ('manage_privacy_options' === $cap) {
			$manage_name = is_multisite() ? 'manage_network' : 'manage_options';
			$caps = array_diff($caps, [$manage_name]);
		}
		return $caps;
	}
	// Contact Form 7 強化功能
	public function cf7_optimize() {
		add_filter('wpcf7_form_elements', 'do_shortcode');
		add_filter('wpcf7_autop_or_not', '__return_false');
	}

	// 刪除文章前的防呆提醒機制
	public function delete_post_confirm_action() {
		?>
    <script>
jQuery(document).ready(function(){
    jQuery(".submitdelete").click(function() {
        if (!confirm("確定要刪除嗎？")){
            return false;
        }
    });
    jQuery("#doaction").click(function(){
        var top_action = jQuery("#bulk-action-selector-top").val();
        if ("trash"==top_action){
            if (!confirm("確定要刪除嗎？")){
                return false;
            }
        }
    });
    jQuery("#doaction2").click(function(){
        var bottom_action = jQuery("#bulk-action-selector-bottom").val();
        if ("trash"==bottom_action){
            if (!confirm("確定要刪除嗎？")){
                return false;
            }
        }
    });
    jQuery("#delete_all").click(function(){
        if (!confirm("確定要清空嗎？此動作執行後無法回復。")){
            return false;
        }
    });
});
</script>
<?php
}
	// 限制上傳大小以及轉正JPG影像（如果有EXIF資訊的話）https://www.mxp.tw/9318/
	public function image_size_and_image_orientation($file) {
		$limit = MDT_IMAGE_SIZE_LIMIT; // 500kb 上限
		$size = $file['size'] / 1024;
		if (!version_compare(get_bloginfo('version'), '5.3', '>=')) {
			// v5.3 後已經內建 https://developer.wordpress.org/reference/classes/wp_image_editor_imagick/maybe_exif_rotate/
			$this->apply_new_orientation($file['tmp_name']);
		}
		$is_image = strpos($file['type'], 'image') !== false;
		if ($is_image && $size > $limit) {
			$file['error'] = "上傳的影像大小請小於 {$limit}kb";
		}
		return $file;
	}

	public function apply_new_orientation($path_to_jpg) {
		// 使用 GD 函式庫，沒的話就算了不處理
		if (!extension_loaded('gd') ||
			!function_exists('gd_info') ||
			!function_exists('exif_imagetype') ||
			!function_exists('imagecreatefromjpeg') ||
			!function_exists('exif_read_data') ||
			!function_exists('imagerotate') ||
			!function_exists('imagejpeg') ||
			!function_exists('imagedestroy')) {
			return false;
		}
		if (exif_imagetype($path_to_jpg) == IMAGETYPE_JPEG) {
			$image = @imagecreatefromjpeg($path_to_jpg);
			$exif = exif_read_data($path_to_jpg);
			if (!empty($exif['Orientation'])) {
				switch ($exif['Orientation']) {
				case 3:
					$image = imagerotate($image, 180, 0);
					break;
				case 6:
					$image = imagerotate($image, 90, 0);
					break;
				case 8:
					$image = imagerotate($image, -90, 0);
					break;
				}
			}
			if ($image) {
				imagejpeg($image, $path_to_jpg);
				imagedestroy($image);
			}
		}
	}
	// 每次更新完後檢查 xmlrpc.php | install.php 還在不在，在就砍掉，避免後患
	public function check_files_after_upgrade_action($upgrader_object, $options) {
		// if ($options['action'] == 'update' && $options['type'] == 'plugin') {
		//     foreach ($options['plugins'] as $each_plugin) {
		//         if ($each_plugin == $current_plugin_path_name) {
		//             // 比對當前外掛的更新
		//         }
		//     }
		// }
		$abspath = str_replace('/', DIRECTORY_SEPARATOR, ABSPATH);
		if (file_exists($abspath . 'xmlrpc.php') && MDT_DELETE_XMLRPC_PHP) {
			unlink($abspath . 'xmlrpc.php');
		}
		if (file_exists($abspath . 'wp-admin' . DIRECTORY_SEPARATOR . 'install.php') && MDT_DELETE_INSTALL_PHP) {
			unlink($abspath . 'wp-admin' . DIRECTORY_SEPARATOR . 'install.php');
		}
	}
	// 遮蔽所有留言中留言人提供的網址提供的網址
	public function hide_comment_author_url($url, $id, $comment) {
		return "";
	}
	// 使用者登入後轉址回指定位置
	public function redirect_to_after_login() {
		if (!is_user_logged_in()) {
			$redirect_to = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : '';
			if (strpos($redirect_to, get_site_url()) === 0) {
				setcookie('mxp_redirect_to', $redirect_to);
				setcookie('mxp_redirect_to_count', 0);
			}
		} else {
			if (isset($_COOKIE['mxp_redirect_to']) && $_COOKIE['mxp_redirect_to'] != '' && isset($_COOKIE['mxp_redirect_to_count']) && $_COOKIE['mxp_redirect_to_count'] != 0) {
				setcookie("mxp_redirect_to", "", time() - 3600);
				setcookie('mxp_redirect_to_count', 1);
				wp_redirect($_COOKIE['mxp_redirect_to']);
				exit;
			}
		}
	}
	// 停用自己站內的引用
	public function disable_self_ping(&$post_links, &$pung, $post_id) {
		$home = get_option('home');
		foreach ($post_links as $l => $link) {
			if (0 === strpos($link, $home)) {
				unset($post_links[$l]);
			}
		}
	}

	// 輸出安全性的 HTTP 標頭
	public function add_security_headers($headers) {
		$headers['X-XSS-Protection'] = '1; mode=block';
		$headers['X-Content-Type-Options'] = 'nosniff';
		$headers['X-Content-Security-Policy'] = "default-src 'self'; script-src 'self'; connect-src 'self'";
		$headers['X-Permitted-Cross-Domain-Policies'] = "none";
		$headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains; preload';
		return $headers;
	}

	// 預設作者的連結都不顯示
	public function hide_author_link($link, $author_id, $author_nicename) {
		return '#';
	}

	// 預設不顯示出系統輸出的作者連結與頁面，避免資安問題
	public function hide_author_name($name) {
		if (is_admin()) {
			return $name;
		}
		global $authordata;
		if (is_object($authordata)) {
			return ($authordata->display_name != $authordata->user_login) ? $authordata->display_name : MDT_AUTHOR_DISPLAY_NAME;
		}
		return MDT_AUTHOR_DISPLAY_NAME;
	}

	// 取消站內的全球大頭貼功能，全改為預設大頭貼
	public function empty_avatar_data($args, $id_or_email) {
		//email md5 wordpress.gravatar@mxp.tw
		if (is_ssl()) {
			$url = 'https://secure.gravatar.com/avatar/fcb68cd8e48d96e2bc306b17422e34ea?s=192&d=mm&r=g';
		} else {
			$url = 'http://0.gravatar.com/avatar/fcb68cd8e48d96e2bc306b17422e34ea?s=192&d=mm&r=g';
		}
		$args['url'] = $url;
		return $args;
	}
	// 內對外請求管制方法
	public function block_external_request($preempt, $parsed_args, $url) {
		$domains = array();
		if (MDT_BLOCK_ALL_NETWORK_FUNCTION) {
			$domains[0] = '*';
		}
		$block_urls = apply_filters('mxp_dev_block_urls', $domains);
		$block_urls = array_map('strtolower', $block_urls);
		$localhost = strtolower(parse_url(get_home_url(), PHP_URL_HOST));
		$allow_urls = array();
		$allow_urls[] = $localhost;
		$allow_urls[] = 'localhost';
		$allow_urls[] = '127.0.0.1';
		$allow_urls[] = 'api.wordpress.org';
		$allow_urls[] = 'downloads.wordpress.org';
		$allow_urls = apply_filters('mxp_dev_allow_urls', $allow_urls);
		$allow_urls = array_map('strtolower', $allow_urls);
		$request_domain = strtolower(parse_url($url, PHP_URL_HOST));
		if (count($block_urls) == 1 && $block_urls[0] == '*') {
			if (!in_array($request_domain, $allow_urls, true)) {
				return new \WP_Error('http_request_block', '不允許的對外請求路徑' . "\n:: {$url}", $url);
			}
		} else {
			if (in_array($request_domain, $block_urls, true) && !in_array($request_domain, $allow_urls, true)) {
				return new \WP_Error('http_request_block', '不允許的對外請求路徑' . "\n:: {$url}", $url);
			}
		}
		return $preempt;
	}
	// 給發信標題全都加上請勿回覆字樣
	public function overwrite_wp_mail_receiver($atts) {
		if (MDT_OVERWRITE_EMAIL_RECEIVER != '' && filter_var(MDT_OVERWRITE_EMAIL_RECEIVER, FILTER_VALIDATE_EMAIL)) {
			$atts['to'] = MDT_OVERWRITE_EMAIL_RECEIVER;
		}
		return $atts;
	}
	// 給內建的檔案編輯鎖多一點彈性，可以指定管理員開放
	public function overwrite_file_mods() {
		if (MDT_DISALLOW_FILE_MODS && !defined('DISALLOW_FILE_MODS')) {
			if (empty(MDT_DISALLOW_FILE_MODS_ADMINS)) {
				define('DISALLOW_FILE_MODS', true);
			} elseif (is_array(MDT_DISALLOW_FILE_MODS_ADMINS) && in_array(get_current_user_id(), MDT_DISALLOW_FILE_MODS_ADMINS)) {
				define('DISALLOW_FILE_MODS', false);
			} else {
				define('DISALLOW_FILE_MODS', true);
			}
			if (!defined('DISALLOW_FILE_EDIT')) {
				define('DISALLOW_FILE_EDIT', true);
			}
		}
	}

	public function filter_file_mod_allowed($disallow, $context) {
		if (defined('MDT_DISALLOW_FILE_MODS') && MDT_DISALLOW_FILE_MODS === true) {
			if (defined('MDT_DISALLOW_FILE_MODS_ADMINS') && is_array(MDT_DISALLOW_FILE_MODS_ADMINS) && in_array(get_current_user_id(), MDT_DISALLOW_FILE_MODS_ADMINS)) {
				return MDT_DISALLOW_FILE_MODS;
			}
			return !MDT_DISALLOW_FILE_MODS;
		}
		return $disallow;
	}

	public function mxp_get_plugin_details($plugin_path, $suffix = '') {
		if (!function_exists('get_plugin_data')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin_data = get_plugin_data($plugin_path);
		if (empty($plugin_data['Name'])) {
			return basename($plugin_path);
		}
		return array("Name" => $plugin_data['Name'], "Version" => $plugin_data['Version'], "Author" => strip_tags($plugin_data['AuthorName']), "plugin_path" => $plugin_path);
	}

	public function filter_user_query_qrgs($args) {
		//Exclude superusers if the current user is not a superuser.
		$super_users = MDT_DISALLOW_FILE_MODS_ADMINS;
		if (empty($super_users)) {
			return $args;
		}

		if (!in_array(get_current_user_id(), MDT_DISALLOW_FILE_MODS_ADMINS)) {
			$args['exclude'] = array_merge(
				isset($args['exclude']) ? $args['exclude'] : array(),
				$super_users
			);

			//Exclude hidden users even if specifically included. This can happen
			//when looking at the "None" view on the "Users" page (this view shows
			//users that have no role on the current site).
			if (isset($args['include']) && !empty($args['include'])) {
				$args['include'] = array_diff($args['include'], $super_users);
				if (empty($args['include'])) {
					unset($args['include']);
				}
			}
		}

		return $args;
	}

	public function restrict_user_editing($required_caps, $capability, $this_user_id, $args) {
		static $edit_user_caps = array('edit_user', 'delete_user', 'promote_user', 'remove_user');
		if (!in_array($capability, $edit_user_caps) || !isset($args[0])) {
			return $required_caps;
		}

		/** @var int The user that might be edited or deleted. */
		$that_user_id = intval($args[0]);
		$this_user_id = intval($this_user_id);

		if (in_array($that_user_id, MDT_DISALLOW_FILE_MODS_ADMINS) && !in_array($this_user_id, MDT_DISALLOW_FILE_MODS_ADMINS)) {
			return array_merge($required_caps, array('do_not_allow'));
		}

		return $required_caps;
	}

	public function filter_user_counts($result = null, $strategy = 'time', $site_id = null) {
		// 避免無限重複執行導致記憶體被吃光的問題
		remove_filter('pre_count_users', array($this, 'filter_user_counts'), 99999, 3);

		//Perform this filtering only on the "Users" page.
		if (!isset($GLOBALS['parent_file']) || ($GLOBALS['parent_file'] !== 'users.php')) {
			return $result;
		}

		if (in_array(get_current_user_id(), MDT_DISALLOW_FILE_MODS_ADMINS)) {
			//This user can see other hidden users.
			return $result;
		}

		$super_users = array();
		foreach (MDT_DISALLOW_FILE_MODS_ADMINS as $index => $user_id) {
			$user_obj = get_user_by('id', $user_id);
			if ($user_obj) {
				$super_users[] = $user_obj;
			}
		}
		//Note the $site_id. We want the roles that each user has on the specified site.
		//This should normally be the current site, but it doesn't have to be.

		if (empty($super_users)) {
			//There are no users that need to be hidden.
			return $result;
		}

		$result = count_users($strategy, $site_id);

		//Adjust the total number of users.
		$result['total_users'] -= count($super_users);

		//For each hidden user, subtract one from each of the roles that the user has.
		foreach ($super_users as $user) {
			if (!empty($user->roles) && is_array($user->roles)) {
				foreach ($user->roles as $roleId) {
					if (isset($result['avail_roles'][$roleId])) {
						$result['avail_roles'][$roleId]--;
						if ($result['avail_roles'][$roleId] <= 0) {
							unset($result['avail_roles'][$roleId]);
						}
					}
				}
			} else if (isset($result['avail_roles']['none'])) {
				$result['avail_roles']['none']--;
			}
		}

		return $result;
	}

	public function wp_diagnostic_info() {
		global $table_prefix;
		global $wpdb;
		$diagnostic_info = array();
		/*
			                     * WordPress & Server Environment
		*/

		$diagnostic_info['site_url'] = site_url();
		$diagnostic_info['home_url'] = home_url();
		$diagnostic_info['WordPress'] = get_bloginfo('version', 'display');
		$diagnostic_info['Web_Server'] = !empty($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
		$diagnostic_info['PHP'] = "";
		if (function_exists('phpversion')) {
			$diagnostic_info['PHP'] = phpversion();
		}
		$diagnostic_info['MySQL'] = $wpdb->db_version();
		$diagnostic_info['ext_mysqli'] = empty($wpdb->use_mysqli) ? 'no' : 'yes';
		$diagnostic_info['PHP_Memory_Limit'] = "";
		if (function_exists('ini_get')) {
			$diagnostic_info['PHP_Memory_Limit'] = ini_get('memory_limit');
		}
		$diagnostic_info['WP_MEMORY_LIMIT'] = WP_MEMORY_LIMIT;
		$diagnostic_info['Memory_Usage'] = size_format(memory_get_usage(true));

		$diagnostic_info['WP_HTTP_BLOCK_EXTERNAL'] = "";
		if (!defined('WP_HTTP_BLOCK_EXTERNAL') || !WP_HTTP_BLOCK_EXTERNAL) {
			$diagnostic_info['WP_MEMORY_LIMIT'] = "none";
		} else {
			$accessible_hosts = (defined('WP_ACCESSIBLE_HOSTS')) ? WP_ACCESSIBLE_HOSTS : '';
			if (empty($accessible_hosts)) {
				$diagnostic_info['WP_ACCESSIBLE_HOSTS'] = "all";
			} else {
				$diagnostic_info['WP_ACCESSIBLE_HOSTS'] = $accessible_hosts;
			}
		}
		$diagnostic_info['WP_Locale'] = get_locale();
		$diagnostic_info['WP_UPLOADS_BY_MY'] = get_option('uploads_use_yearmonth_folders') ? 'Enabled' : 'Disabled';
		$diagnostic_info['WP_DEBUG'] = (defined('WP_DEBUG') && WP_DEBUG) ? 'Yes' : 'No';
		$diagnostic_info['WP_DEBUG_LOG'] = (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) ? 'Yes' : 'No';
		$diagnostic_info['WP_DEBUG_DISPLAY'] = (defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY) ? 'Yes' : 'No';
		$diagnostic_info['SCRIPT_DEBUG'] = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? 'Yes' : 'No';
		$diagnostic_info['WP_MAX_UPLOAD_SIZE'] = size_format(wp_max_upload_size());
		$diagnostic_info['PHP_max_execution_time'] = "";
		if (function_exists('ini_get')) {
			$diagnostic_info['PHP_max_execution_time'] = ini_get('max_execution_time');
		}
		$diagnostic_info['WP_CRON'] = (defined('DISABLE_WP_CRON') && DISABLE_WP_CRON) ? 'Disabled' : 'Enabled';

		$diagnostic_info['allow_url_fopen'] = "";
		$allow_url_fopen = "";
		if (function_exists('ini_get')) {
			$allow_url_fopen = ini_get('allow_url_fopen');
		}
		if (empty($allow_url_fopen)) {
			$diagnostic_info['allow_url_fopen'] = "Disabled";
		} else {
			$diagnostic_info['allow_url_fopen'] = "Enabled";
		}

		$diagnostic_info['OpenSSL'] = "";
		if (defined('OPENSSL_VERSION_TEXT')) {
			$diagnostic_info['OpenSSL'] = OPENSSL_VERSION_TEXT;
		} else {
			$diagnostic_info['OpenSSL'] = "Disabled";
		}

		$diagnostic_info['PHP_GD'] = "";
		if (extension_loaded('gd') && function_exists('gd_info')) {
			$gd_info = gd_info();
			$diagnostic_info['PHP_GD'] = isset($gd_info['GD Version']) ? $gd_info['GD Version'] : 'Enabled';
		} else {
			$diagnostic_info['PHP_GD'] = 'Disabled';
		}

		$diagnostic_info['Imagick'] = "";
		if (extension_loaded('imagick') && class_exists('Imagick') && class_exists('ImagickPixel')) {
			$diagnostic_info['Imagick'] = 'Enabled';
		} else {
			$diagnostic_info['Imagick'] = 'Disabled';
		}

		/*
			                     * Settings
		*/

		$theme_info = wp_get_theme();
		$diagnostic_info['Active_Theme'] = array();
		$diagnostic_info['Parent_Theme'] = array();
		if (!empty($theme_info) && is_a($theme_info, 'WP_Theme')) {
			if (file_exists($theme_info->get_stylesheet_directory())) {
				$diagnostic_info['Active_Theme']['Name'] = $theme_info->get('Name');
				$diagnostic_info['Active_Theme']['Version'] = $theme_info->get('Version');
				$diagnostic_info['Active_Theme']['Folder'] = $theme_info->get_stylesheet();
			}
			if (is_child_theme()) {
				$parent_info = $theme_info->parent();
				if (!empty($parent_info) && is_a($parent_info, 'WP_Theme')) {
					$diagnostic_info['Parent_Theme']['Name'] = $parent_info->get('Name');
					$diagnostic_info['Parent_Theme']['Version'] = $parent_info->get('Version');
					$diagnostic_info['Parent_Theme']['Folder'] = $parent_info->get_stylesheet();
				}
			} else {
				$diagnostic_info['Parent_Theme']['Name'] = "";
				$diagnostic_info['Parent_Theme']['Version'] = "";
				$diagnostic_info['Parent_Theme']['Folder'] = "";
			}
		}

		$diagnostic_info['Active_Plugins'] = array();
		$diagnostic_info['MU_Plugins'] = array();
		$active_plugins = (array) get_option('active_plugins', array());
		if (is_multisite()) {
			$network_active_plugins = wp_get_active_network_plugins();
			$active_plugins = array_map(function ($path) {
				$plugin_dir = trailingslashit(WP_PLUGIN_DIR);
				$plugin = str_replace($plugin_dir, '', $path);
				return $plugin;
			}, $network_active_plugins);
		}

		foreach ($active_plugins as $plugin) {
			$diagnostic_info['Active_Plugins'][] = $this->mxp_get_plugin_details(WP_PLUGIN_DIR . '/' . $plugin);
		}

		$mu_plugins = wp_get_mu_plugins();
		if ($mu_plugins) {
			foreach ($mu_plugins as $mu_plugin) {
				$diagnostic_info['MU_Plugins'][] = $this->mxp_get_plugin_details($mu_plugin);
			}
		}

		return $diagnostic_info;
	}

	public static function cron_scheduled() {
		if (MDT_SITE_HEALTH_REPORT_CRON) {
			if (!wp_next_scheduled('mxp_site_health_report_cron')) {
				wp_schedule_event(time(), 'mxpdev_2h', 'mxp_site_health_report_cron');
			}
		} else {
			wp_clear_scheduled_hook('mxp_site_health_report_cron');
		}
	}

	public static function activated() {
		$asset = 'mxp-dev-tools/index.php';
		$option = 'auto_update_plugins';
		if (!function_exists('get_plugins')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$all_items = apply_filters('all_plugins', get_plugins());
		if (array_key_exists($asset, $all_items)) {
			$auto_updates = (array) get_site_option($option, array());
			$auto_updates[] = $asset;
			$auto_updates = array_unique($auto_updates);
			update_site_option($option, $auto_updates);
		}
	}

	public static function deactivated() {
		wp_clear_scheduled_hook('mxp_site_health_report_cron');
	}
}

$mxp_dev_snippets = new MDTSnippets();
add_action('plugins_loaded', array($mxp_dev_snippets, 'cron_scheduled'));
register_activation_hook(__FILE__, array($mxp_dev_snippets, 'activated'));
register_deactivation_hook(__FILE__, array($mxp_dev_snippets, 'deactivated'));
