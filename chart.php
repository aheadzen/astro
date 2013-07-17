<?php
/*
Plugin Name: Chart
Plugin URI: http://wwww.as-oracle.com
Description: Collect user information and generates charts.
Version: 0.0.1
Author: Tapan Sodagar.
Author URI: http://wwww.as-oracle.com
*/
?>
<?php
class chartMain
{
	var $month;
	var $country;
	function __construct()
	{
		add_action('wp_enqueue_scripts', array(&$this, 'display_plugin_scripts'));
		add_shortcode('chart_form', array(&$this, 'display_two_step_chart_form'));
		add_action('wp_footer', array(&$this, 'display_plugin_scripts_in_footer'));
		add_action('init', array(&$this, 'init_action_for_chart'));
		add_shortcode('chart_listing', array(&$this, 'display_chart_listing'));
		
	}

	
	
	function display_chart_listing()
	{
		include "chart_listing.php";
	}
	function init_action_for_chart()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "country";
		$insert_countries = "INSERT INTO wp_country (`country_code`, `country_name`) VALUES ('AD', 'Andorra'), ('AE', 'United Arab Emirates'), ('AF','Afghanistan'), ('AG', 'Antigua and Barbuda'), ('AI', 'Anguilla'), ('AL', 'Albania'), ('AM', 'Armenia'), ('AN','Netherlands Antilles'), ('AO', 'Angola'), ('AQ', 'Antarctica'), ('AR', 'Argentina'), ('AS', 'American Samoa'), ('AT','Austria'), ('AU', 'Australia'), ('AW', 'Aruba'), ('AX', 'Aland Islands'), ('AZ', 'Azerbaijan'), ('BA', 'Bosnia and Herzegovina'), ('BB', 'Barbados'), ('BD', 'Bangladesh'), ('BE', 'Belgium'), ('BF', 'Burkina Faso'), ('BG','Bulgaria'), ('BH', 'Bahrain'), ('BI', 'Burundi'), ('BJ', 'Benin'), ('BL', 'Saint Barthélemy'), ('BM', 'Bermuda'),('BN', 'Brunei'), ('BO', 'Bolivia'), ('BR', 'Brazil'), ('BS', 'Bahamas'), ('BT', 'Bhutan'), ('BV', 'Bouvet Island'),('BW', 'Botswana'), ('BY', 'Belarus'), ('BZ', 'Belize'), ('CA', 'Canada'), ('CC', 'Cocos Islands'), ('CD', 'Congo -Kinshasa'), ('CF', 'Central African Republic'), ('CG', 'Congo - Brazzaville'), ('CH', 'Switzerland'), ('CI', 'IvoryCoast'), ('CK', 'Cook Islands'), ('CL', 'Chile'), ('CM', 'Cameroon'), ('CN', 'China'), ('CO', 'Colombia'), ('CR','Costa Rica'), ('CU', 'Cuba'), ('CV', 'Cape Verde'), ('CX', 'Christmas Island'), ('CY', 'Cyprus'), ('CZ', 'CzechRepublic'), ('DE', 'Germany'), ('DJ', 'Djibouti'), ('DK', 'Denmark'), ('DM', 'Dominica'), ('DO', 'DominicanRepublic'), ('DZ', 'Algeria'), ('EC', 'Ecuador'), ('EE', 'Estonia'), ('EG', 'Egypt'), ('EH', 'Western Sahara'),('ER', 'Eritrea'), ('ES', 'Spain'), ('ET', 'Ethiopia'), ('FI', 'Finland'), ('FJ', 'Fiji'), ('FK', 'FalklandIslands'), ('FM', 'Micronesia'), ('FO', 'Faroe Islands'), ('FR', 'France'), ('GA', 'Gabon'), ('GB', 'UnitedKingdom'), ('GD', 'Grenada'), ('GE', 'Georgia'), ('GF', 'French Guiana'), ('GG', 'Guernsey'), ('GH', 'Ghana'),
('GI', 'Gibraltar'), ('GL', 'Greenland'), ('GM', 'Gambia'), ('GN', 'Guinea'), ('GP', 'Guadeloupe'), ('GQ', 'Equatorial
Guinea'), ('GR', 'Greece'), ('GS', 'South Georgia and the South Sandwich Islands'), ('GT', 'Guatemala'), ('GU',
'Guam'), ('GW', 'Guinea-Bissau'), ('GY', 'Guyana'), ('HK', 'Hong Kong'), ('HM', 'Heard Island and McDonald Islands'),
('HN', 'Honduras'), ('HR', 'Croatia'), ('HT', 'Haiti'), ('HU', 'Hungary'), ('ID', 'Indonesia'), ('IE', 'Ireland'),
('IL', 'Israel'), ('IM', 'Isle of Man'), ('IN', 'India'), ('IO', 'British Indian Ocean Territory'), ('IQ', 'Iraq'),
('IR', 'Iran'), ('IS', 'Iceland'), ('IT', 'Italy'), ('JE', 'Jersey'), ('JM', 'Jamaica'), ('JO', 'Jordan'), ('JP',
'Japan'), ('KE', 'Kenya'), ('KG', 'Kyrgyzstan'), ('KH', 'Cambodia'), ('KI', 'Kiribati'), ('KM', 'Comoros'), ('KN',
'Saint Kitts and Nevis'), ('KP', 'North Korea'), ('KR', 'South Korea'), ('KW', 'Kuwait'), ('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'), ('LA', 'Laos'), ('LB', 'Lebanon'), ('LC', 'Saint Lucia'), ('LI', 'Liechtenstein'), ('LK', 'Sri
Lanka'), ('LR', 'Liberia'), ('LS', 'Lesotho'), ('LT', 'Lithuania'), ('LU', 'Luxembourg'), ('LV', 'Latvia'), ('LY',
'Libya'), ('MA', 'Morocco'), ('MC', 'Monaco'), ('MD', 'Moldova'), ('ME', 'Montenegro'), ('MF', 'Saint Martin'),
('MG', 'Madagascar'), ('MH', 'Marshall Islands'), ('MK', 'Macedonia'), ('ML', 'Mali'), ('MM', 'Myanmar'), ('MN',
'Mongolia'), ('MO', 'Macao'), ('MP', 'Northern Mariana Islands'), ('MQ', 'Martinique'), ('MR', 'Mauritania'), ('MS',
'Montserrat'), ('MT', 'Malta'), ('MU', 'Mauritius'), ('MV', 'Maldives'), ('MW', 'Malawi'), ('MX', 'Mexico'), ('MY',
'Malaysia'), ('MZ', 'Mozambique'), ('NA', 'Namibia'), ('NC', 'New Caledonia'), ('NE', 'Niger'), ('NF', 'Norfolk
Island'), ('NG', 'Nigeria'), ('NI', 'Nicaragua'), ('NL', 'Netherlands'), ('NO', 'Norway'), ('NP', 'Nepal'), ('NR',
'Nauru'), ('NU', 'Niue'), ('NZ', 'New Zealand'), ('OM', 'Oman'), ('PA', 'Panama'), ('PE', 'Peru'), ('PF', 'French
Polynesia'), ('PG', 'Papua New Guinea'), ('PH', 'Philippines'), ('PK', 'Pakistan'), ('PL', 'Poland'), ('PM', 'Saint
Pierre and Miquelon'), ('PN', 'Pitcairn'), ('PR', 'Puerto Rico'), ('PS', 'Palestinian Territory'), ('PT', 'Portugal'),
('PW', 'Palau'), ('PY', 'Paraguay'), ('QA', 'Qatar'), ('RE', 'Reunion'), ('RO', 'Romania'), ('RS', 'Serbia'), ('RU',
'Russia'), ('RW', 'Rwanda'), ('SA', 'Saudi Arabia'), ('SB', 'Solomon Islands'), ('SC', 'Seychelles'), ('SD',
'Sudan'), ('SE', 'Sweden'), ('SG', 'Singapore'), ('SH', 'Saint Helena'), ('SI', 'Slovenia'), ('SJ', 'Svalbard and Jan
Mayen'), ('SK', 'Slovakia'), ('SL', 'Sierra Leone'), ('SM', 'San Marino'), ('SN', 'Senegal'), ('SO', 'Somalia'),
('SR', 'Suriname'), ('ST', 'Sao Tome and Principe'), ('SV', 'El Salvador'), ('SY', 'Syria'), ('SZ', 'Swaziland'),
('TC', 'Turks and Caicos Islands'), ('TD', 'Chad'), ('TF', 'French Southern Territories'), ('TG', 'Togo'), ('TH',
'Thailand'), ('TJ', 'Tajikistan'), ('TK', 'Tokelau'), ('TL', 'East Timor'), ('TM', 'Turkmenistan'), ('TN',
'Tunisia'), ('TO', 'Tonga'), ('TR', 'Turkey'), ('TT', 'Trinidad and Tobago'), ('TV', 'Tuvalu'), ('TW', 'Taiwan'),
('TZ', 'Tanzania'), ('UA', 'Ukraine'), ('UG', 'Uganda'), ('UM', 'United States Minor Outlying Islands'), ('US', 'United
States'), ('UY', 'Uruguay'), ('UZ', 'Uzbekistan'), ('VA', 'Vatican'), ('VC', 'Saint Vincent and the Grenadines'),
('VE', 'Venezuela'), ('VG', 'British Virgin Islands'), ('VI', 'U.S. Virgin Islands'), ('VN', 'Vietnam'), ('VU',
'Vanuatu'), ('WF', 'Wallis and Futuna'), ('WS', 'Samoa'), ('YE', 'Yemen'), ('YT', 'Mayotte'), ('ZA', 'South
Africa'), ('ZM', 'Zambia'), ('ZW', 'Zimbabwe'), ('CS', 'Serbia and Montenegro');";
		$countries_inserted = $wpdb->query($insert_countries);
		
		$this->month = array(1 => 'january',2 => 'february',3 => 'march',4 => 'april',5 => 'may',6 => 'june',7 => 'july',8 => 'august',
		9 => 'september',10 => 'october',11 => 'november',12 => 'december');
		
		$this->country = $wpdb->get_results("select * from $table_name",OBJECT);
		
		register_post_type( 'chart',
        	array(
            	'labels' => array(
                'name' => __('chart'),
                'singular_name' => __('chart')
            	),
		        'public' => true,
        		'has_archive' => true,
        	)	
    	);	
		
	}
	function install_plugin_resources()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "country";
		$create_table_country = "CREATE TABLE IF NOT EXISTS $table_name (`country_code` varchar(3) NOT NULL,`country_name` varchar(50) NOT NULL,PRIMARY KEY (`country_code`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";		
		$create_table_chart_details = "CREATE TABLE IF NOT EXISTS `wp_user_birth_details` ( `user_birth_chart_id` int(11) NOT NULL AUTO_INCREMENT, `user_birth_user_id` int(11) NOT NULL, `user_birth_report_name` varchar(255) NOT NULL, `user_birth_sex_type` varchar(20) NOT NULL,`user_birth_year` int(11) NOT NULL, `user_birth_month` int(11) NOT NULL, `user_birth_day` int(11) NOT NULL, `user_birth_city`
varchar(100) NOT NULL, `user_birth_country` varchar(100) NOT NULL, `user_birth_hour` int(11) NOT NULL, `user_birth_minute` int(11) NOT NULL, `user_birth_am_pm` varchar(20) NOT NULL, `user_timezone_hour` int(11) NOT NULL, `user_timezone_min` int(11) NOT NULL, `user_timezone_direction` varchar(20) NOT NULL, `user_longitude_degree` int(11) NOT NULL, `user_longitude_min` int(11) NOT NULL, `user_longitude_direction` varchar(20) NOT NULL, `user_latitude_degree` int(11) NOT NULL, `user_latitude_min` int(11) NOT NULL, `user_latitude_direction` varchar(20) NOT NULL, PRIMARY KEY (`user_birth_chart_id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12;";
		$create_table_page_info = "CREATE TABLE IF NOT EXISTS `wp_page_information` (`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`page_id` INT(11) NOT NULL ,`page_name` VARCHAR( 200 ) NOT NULL) ENGINE = MYISAM";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($create_table_country);
		dbDelta($create_table_chart_details);
		dbDelta($create_table_page_info);
		
		$chart_listing = array(
			'slug' => 'chart-list',
			'title' => 'Chart Listing',
			'content' => "[chart_listing]"
		);
		$chart_listing_id = wp_insert_post( array(
			'post_title' => $chart_listing['title'],
			'post_type' 	=> 'page',
			'post_name'	 => $chart_listing['slug'],
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			'post_content' => $chart_listing['content'],
			'post_status' => 'publish',
			'post_author' => 1,
			'menu_order' => 0
		));
		if(isset($chart_listing_id) && $chart_listing_id != "")
		{
			$wpdb->insert(
				'wp_page_information',
				array(
				'page_id' => $chart_listing_id,
				'page_name' => $chart_listing['slug']
				)
			);
		}
		$chart_form = array(
			'slug' => 'chart-form',
			'title' => 'Chart Form',
			'content' => "[chart_form]"
		);
		$chart_form_id = wp_insert_post( array(
			'post_title' => $chart_form['title'],
			'post_type' 	=> 'page',
			'post_name'	 => $chart_form['slug'],
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			'post_content' => $chart_form['content'],
			'post_status' => 'publish',
			'post_author' => 1,
			'menu_order' => 0
		));
		if(isset($chart_form_id) && $chart_form_id != "")
		{
			$wpdb->insert(
				'wp_page_information',
				array(
				'page_id' => $chart_form_id,
				'page_name' => $chart_form['slug']
				)
			);
		}
	}
	function display_two_step_chart_form()
	{
		include "chart_form.php";
	}
	function display_plugin_scripts()
	{
		if(!is_admin())
		{
			wp_enqueue_script('jquery');
			wp_register_style('chart-style', plugins_url('css/chart.css', __FILE__));
			wp_enqueue_style('chart-style');
		}
	}
	function display_plugin_scripts_in_footer()
	{
		if(!is_admin())
		{
			wp_register_script('chart-script', plugins_url('js/chart.js', __FILE__ ));
			wp_enqueue_script('chart-script');
		}
	}
	function insert_chart_details()
	{
		global $wpdb;
		if(!function_exists('wp_get_current_user'))
		{
			include(ABSPATH . "wp-includes/pluggable.php");
		}
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$user_chart_details = $_POST;
		$custom_table_user_details = $wpdb->prefix . "user_birth_details";
		$wpdb->insert('wp_user_birth_details',
		  array('user_birth_user_id' => $user_id, 'user_birth_report_name' => $user_chart_details['chart_report_name'], 'user_birth_sex_type' => $user_chart_details['sex'], 'user_birth_year' => $user_chart_details['chart_year'], 'user_birth_month' => $user_chart_details['chart_month'], 'user_birth_day' => $user_chart_details['chart_day'], 'user_birth_city' => $user_chart_details['chart_city'], 'user_birth_country' => $user_chart_details['chart_country'], 'user_birth_hour' => $user_chart_details['chart_hour'], 'user_birth_minute' => $user_chart_details['chart_min'], 'user_birth_am_pm' => $user_chart_details['chart_amORpm'], 'user_timezone_hour' => $user_chart_details['tz_hours'], 'user_timezone_min' => $user_chart_details['tz_min'], 'user_timezone_direction' => $user_chart_details['e_w_tz'], 'user_longitude_degree' => $user_chart_details['lon_degrees'], 'user_longitude_direction' => $user_chart_details['e_w'],'user_longitude_min' => $user_chart_details['lon_min'], 'user_latitude_degree' => $user_chart_details['lat_degrees'], 'user_latitude_direction' => $user_chart_details['n_s'], 'user_latitude_min' => $user_chart_details['lat_min']));
		 $last_inserted_chart_id = $wpdb->insert_id;
		
		
		$page_name = $user_chart_details['chart_report_name'] . " chart-" . $last_inserted_chart_id;
		$page_slug = $user_chart_details['chart_report_name'] . "-chart-" . $last_inserted_chart_id;
		$new_chart_page = array(
								'post_title' => $page_name,
								'post_content' => '',
								'post_status' => 'publish',
								'post_author' => 1,
								'post_name' => $page_slug,
								'post_type' => 'chart',
								);
		$chart_post_id = wp_insert_post($new_chart_page);

		if(!empty($chart_post_id))
		{
			add_post_meta($chart_post_id, 'chart_id', $last_inserted_chart_id);
		}
	}
	
	function edit_chart_entry()
	{
		global $wpdb;
		if(!function_exists('wp_get_current_user'))
		{
			include(ABSPATH . "wp-includes/pluggable.php");
		}
		
		$current_user = wp_get_current_user();
		$user_id = $_GET['did'];
		$user_details = $_POST;
		$custom_table_user_details = $wpdb->prefix . "user_birth_details";
		
		$wpdb->update('wp_user_birth_details',
		 array(
            'user_birth_report_name' => $user_details['chart_report_name'],
			'user_birth_sex_type' => $user_details['sex'],
			'user_birth_year' => $user_details['chart_year'],
			'user_birth_month' => $user_details['chart_month'],
			'user_birth_day' => $user_details['chart_day'],
			'user_birth_city' => $user_details['chart_city'],
			'user_birth_country' => $user_details['chart_country'],
			'user_birth_hour' => $user_details['chart_hour'],
			'user_birth_minute' => $user_details['chart_min'],
			'user_birth_am_pm' => $user_details['chart_amORpm'],
			'user_timezone_hour' => $user_details['tz_hours'],
			'user_timezone_min' => $user_details['tz_min'],
			'user_timezone_direction' => $user_details['e_w_tz'],
			'user_longitude_degree' => $user_details['lon_degrees'],
			'user_longitude_min' => $user_details['lon_min'],
			'user_longitude_direction' => $user_details['e_w'],
			'user_latitude_degree' => $user_details['lat_degrees'],
			'user_latitude_min' => $user_details['lat_min'],
			'user_latitude_direction' => $user_details['n_s']
			 ),
        array('user_birth_chart_id' => $user_id));
	}
	

	function delete_chart_entry()
	{
		global $wpdb;
		$chart_id = $_GET['did'];
		$custom_table_user_details = $wpdb->prefix . "user_birth_details";
		$query_delete_user_details = "delete from " . $custom_table_user_details . " where user_birth_chart_id = " . $chart_id;
		$wpdb->query($query_delete_user_details);
	}
	function prefix_on_deactivate() 
	{
		//$table_name = $wpdb->prefix . "user_birth_details";
		global $table_prefix, $user_level, $wpdb;
		// Drop MySQL Tables
		$page_id = "SELECT * FROM wp_page_information";
		$page_id =  $wpdb->get_results($page_id,ARRAY_A);
		//print_r($page_id);
		foreach($page_id as $key => $val)
		{
			wp_delete_post( $val['page_id'], true);
		}
		
		$SQL = "DROP TABLE ".$table_prefix."user_birth_details";
		$SQLc = "DROP TABLE ".$table_prefix."country";
		$SQLp = "DROP TABLE ".$table_prefix."page_information";
		
		mysql_query($SQL) or die("An unexpected error occured.".mysql_error());
		mysql_query($SQLc) or die("An unexpected error occured.".mysql_error());
		mysql_query($SQLp) or die("An unexpected error occured.".mysql_error());
		
		  $args = array (
			'post_type' => 'chart',
			'nopaging' => true
		  );
		  $query = new WP_Query ($args);
		  while ($query->have_posts ()) {
			$query->the_post ();
			$id = get_the_ID ();
			wp_delete_post ($id, true);
		  }
		  wp_reset_postdata ();		
		
		
	}
}
$chartmain = new chartMain();
if(class_exists('chartMain'))
{
	register_activation_hook( __FILE__, array(&$chartmain, 'install_plugin_resources'));
	register_deactivation_hook(__FILE__, array(&$chartmain, 'prefix_on_deactivate'));

	if(isset($_POST['hid_submitted']) && $_POST['hid_submitted'] == "add")
	{
		$post_data = $chartmain->insert_chart_details();
	}
	if(isset($_GET['info']) && $_GET['info'] == "delete")
	{
		$post_data = $chartmain->delete_chart_entry();
	}
	if(isset($_POST['update_submitted']) && $_POST['update_submitted'] == "update")
	{
		$post_data = $chartmain->edit_chart_entry();
		
	}
	if(isset($_GET['action']) && $_GET['action'] == "view")
	{
		//$post_data = $chartmain->view_chart_entry();
	}
}
?>