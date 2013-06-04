<?php
/*
Plugin Name: Kundali Chart
Plugin URI: http://www.squareonewebsolutions.com
Description: Uses a short code to display chart interface for male and female for match making.
Author: Tapan Sodagar
Version: 1.0
Author URI: http://www.squareonewebsolutions.com
*/
?>
<?php
class frontendchart
{
	function display_chart_interface()
	{
		$month = array('January','February','March','April','May','June','July','August','September','October','November','December');
		

		$create_chart_ui = '<div style="float:left;width:600px;">';
		
			$create_chart_ui .= '<div style="float:left;width:600px;">';
				$create_chart_ui .= '<div style="float:left;width:275px;">';
				$create_chart_ui .= '<h1>Male</h1>';
				$create_chart_ui .= '<input type="checkbox" name="chk_male_new" id="chk_male_new"> Create New <br/>';
				$create_chart_ui .= '</div>';
				
				$create_chart_ui .= '<div style="float:left;width:50px;">&nbsp;';
				$create_chart_ui .= '</div>';
				
				$create_chart_ui .= '<div style="float:left;width:275px;">';
				$create_chart_ui .= '<h1>Female</h1>';
				$create_chart_ui .= '<input type="checkbox" name="chk_female_new" id="chk_female_new"> Create New <br/>';
				$create_chart_ui .= '</div>';
			$create_chart_ui .= '</div>';
			
			$create_chart_ui .= '<div style="float:left;width:600px;">&nbsp;</div>';

			$create_chart_ui .= '<form id="frm_chart" name="frm_chart" method="post" action="'.get_permalink().'" style="display:none;">';
			
			$create_chart_ui .= '<div style="float:left;width:600px;">';
			$create_chart_ui .= '<h1>Enter Birth Details</h1>';
			$create_chart_ui .= 'Report Name&nbsp;&nbsp;<input type="text" name="txt_report_name" id="txt_report_name"><br/><br/>';
			$create_chart_ui .= 'Sex&nbsp;&nbsp;<input type="radio" name="rd_gender" id="rd_gender_male">Male <input type="radio" name="rd_gender" id="rd_gender_female">Female<br/><br/>';
			
			$create_chart_ui .= 'Birthday&nbsp;&nbsp;';

			$create_chart_ui .= '<select id="sel_year" name="sel_year">';
			$create_chart_ui .= '<option value="0">--Year--</option>';
			for($j=1950;$j<=date('Y');$j++)
			{
				$create_chart_ui .= '<option value="'.$j.'">' . $j . '</option>';
			}
			$create_chart_ui .= '</select>';

			$create_chart_ui .= '&nbsp;&nbsp;<select id="sel_month" name="sel_month">';
			$create_chart_ui .= '<option value="0">--Month--</option>';
			for($j=0;$j<count($month);$j++)
			{
				$create_chart_ui .= '<option value="'.($j+1).'">' . $month[$j] . '</option>';
			}
			$create_chart_ui .= '</select>';
			
			$create_chart_ui .= '&nbsp;&nbsp;<select id="sel_day" name="sel_day">';
			$create_chart_ui .= '<option value="0">--Day--</option>';
			for($j=1;$j<=31;$j++)
			{
				$create_chart_ui .= '<option value="'.$j.'">' . $j . '</option>';
			}
			$create_chart_ui .= '</select>';
			
			$create_chart_ui .= '</div>';
			$create_chart_ui .= '<div style="float:left;width:600px;">&nbsp;</div>';
			
			
			$create_chart_ui .= '<div style="float:left;width:600px;">';
			$create_chart_ui .= '<h4>Place of Birth</h4>';
			$create_chart_ui .= 'City &nbsp;&nbsp;<input type="text" name="txt_city_name" id="txt_city_name">';
			
			$countries = $this->GetCountries();
		
			if( !empty( $country ) )
				$selected = $country;

	
			$create_chart_ui .= '&nbsp;&nbsp;Country&nbsp;&nbsp;<select name="sel_country" id="sel_country" style="width:150px;">';
				foreach($countries as $country)
				{
					if($country['country_code'] == $selected)
					{
						$create_chart_ui .= '<option value="'. $country['country_code'] .'" selected="selected">' . $country['country_name'] . '</option>';
					}
					else
					{
						$create_chart_ui .= '<option value="'. $country['country_code'] .'">' . $country['country_name'] . '</option>';
					}
				}
			$create_chart_ui .= '</select>';
			$create_chart_ui .= '</div>';
			
			$create_chart_ui .= '<div style="float:left;width:600px;">&nbsp;</div>';
			
			$create_chart_ui .= '<div style="float:left;width:600px;">';
			$create_chart_ui .= '<h4>Birth Time</h4>';
			$create_chart_ui .= 'Hour &nbsp;&nbsp;';
			$create_chart_ui .= '<select id="sel_hour" name="sel_hour">';
				$create_chart_ui .= '<option>--Hour--</option>';
					for($j=0;$j<=11;$j++)
					{
						$create_chart_ui .= '<option value="'.$j.'">'. $j .'</option>';
					}
			$create_chart_ui .= '</select>';
			$create_chart_ui .= '&nbsp;&nbsp; Minutes &nbsp;&nbsp;';
			$create_chart_ui .= '<select id="sel_minutes" name="sel_minutes">';
				$create_chart_ui .= '<option>--Minutes--</option>';
					for($j=0;$j<=59;$j++)
					{
						$create_chart_ui .= '<option value="'.$j.'">'. $j .'</option>';
					}
			$create_chart_ui .= '</select>';
			$create_chart_ui .= '&nbsp;&nbsp; AM/PM &nbsp;&nbsp;';
			$create_chart_ui .= '<select id="sel_am_pm" name="sel_am_pm">';
				$create_chart_ui .= '<option value="am">AM</option>';
				$create_chart_ui .= '<option value="pm">PM</option>';
			$create_chart_ui .= '</select>';
			$create_chart_ui .= '</div>';
				
			$create_chart_ui .= '<div style="float:left;width:600px;">&nbsp;</div>';
			
			$create_chart_ui .= '<div style="float:left;width:600px;">';
				$create_chart_ui .= '<input type="submit" name="submit" value="Create Charts >>">';
			$create_chart_ui .= '</div>';
			
		$create_chart_ui .= '</div>';
		$create_chart_ui .= '</form>';
		return $create_chart_ui;
	}
	function chart_add_custom_scripts()
	{
		if(!is_admin())
		{
		   wp_deregister_script('jquery');
		   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false, '1.7.1');
		   wp_enqueue_script('custom-chart-script', plugins_url('js/chart.js', __FILE__), array('jquery'));
		   wp_enqueue_script('jquery');
		}
	}
	public static function GetCountries()
	{
		global $wpdb;
		return $wpdb->get_results('SELECT * FROM wp_country ORDER BY country_name', ARRAY_A);
	}
	function remove_chart_shortcode($content)
	{		
		$pattern = $this->mte_get_unused_shortcode_regex();
		$content .= preg_replace_callback('/'. $pattern .'/s', 'strip_shortcode_tag', $content);
		
		$content = '<div style="float:left;width:600px;">';
		$content .= '<h1>Birth Location and Time Zone</h1>';
		$content .= '<ul id="formElements">';
		$content .= '<li><strong>'. $_POST['txt_report_name'] .'</strong></li>';
		$content .= '<li><strong>'.date("F j, Y", $this->getBirthTS($_POST)).'</strong></li>';
		$content .= '<li><strong>'.date("g:i A", $this->getBirthTS($_POST)).'</strong></li>';
		$content .= '<li><strong>'.$_POST['txt_city_name'].', ' . $this->GetCountryByCode($_POST['sel_country']) . '</strong></li>';
		$content .= '</ul>';
		
		$content .= '</div>';
		
		return $content;
	}
	function mte_get_unused_shortcode_regex()
	{
		global $shortcode_tags;
		$tagnames = array_keys($shortcode_tags);
		$tagregexp = join( '|', array_map('preg_quote', $tagnames) );
		$regex = '\\[(\\[?)';
		$regex .= "(?!$tagregexp)";
		$regex .= '\\b([^\\]\\/]*(?:\\/(?!\\])[^\\]\\/]*)*?)(?:(\\/)\\]|\\](?:([^\\[]*+(?:\\[(?!\\/\\2\\])[^\\[]*+)*+)\\[\\/\\2\\])?)(\\]?)';
		return $regex; 
	}
	function getBirthTS($reportdata)
	{
		if($reportdata['am_pm'] == 'pm')
		{
			$birthtime = ($reportdata['sel_hour']+12) . ':' . $reportdata['sel_minutes'] . ':00';
		}	
		else
		{
			$birthtime = $reportdata['sel_hour'] . ':' . $reportdata['sel_minutes'] . ':00';
		}	
		$birthDateTime = $reportdata['sel_year'] . '-' . $reportdata['sel_month'] . '-' . $reportdata['sel_day'] . ' ' . $birthtime;
		return strtotime($birthDateTime);
	}
	
	function GetCountryByCode($reportdata)
	{
		global $wpdb;
		return $wpdb->get_var("SELECT country_name FROM wp_country WHERE country_code='$reportdata'");
	}
}
$frontend_chart = new frontendchart();
add_action('wp_enqueue_scripts', array($frontend_chart, 'chart_add_custom_scripts'));
if($_POST)
{
	add_filter('the_content', array($frontend_chart, 'remove_chart_shortcode'));
	
}
else
{
	add_shortcode('chart', array($frontend_chart, 'display_chart_interface'));
}
?>