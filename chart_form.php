<?php 
	if(isset($_POST['update']))
	{
		echo "Welcome to update";
	}
	
	global $wpdb;
	$table_name = $wpdb->prefix . "country";
	$this->month = array(1 => 'january',2 => 'february',3 => 'march',4 => 'april',5 => 'may',6 => 'june',7 => 'july',8 => 'august',
	9 => 'september',10 => 'october',11 => 'november',12 => 'december');
	
	$this->country = $wpdb->get_results("select * from $table_name",OBJECT);

	if (is_user_logged_in())
	{
		if(isset($_REQUEST['info']) && $_REQUEST['info']=="edit")
		{
			global $wpdb;
			$user_id =  $_GET['did'];	
			$assoc_user =  $wpdb->get_results('SELECT * FROM wp_user_birth_details where user_birth_chart_id='.$user_id, ARRAY_A);
			foreach ($assoc_user as $key => $value) 
			{	
		?>
			<div id="chart-form" class="chart-form">
			<form id="form_update" name="form_update" action="" method="post">
			<div id="step1_chart_details" class="step1_chart_details">
	    	<h1 class="btmspace"><a title="Birth Chart" rel="bookmark" href="">Enter Birth Details</a></h1>
		    <p><label>Report Name</label>
			<input type="text" id="chart_report_name" name="chart_report_name" class="required" value="<?php echo $value['user_birth_report_name']; ?>" />
			</p>
      <p>
        <label>Sex<br>
        </label>
        <input type="radio" value="male" id="chart_sex" name="sex" <?php if($value['user_birth_sex_type'] == "male"){ echo "checked";} ?>>	Male
        <input type="radio" value="female" id="chart_sex" name="sex" <?php if($value['user_birth_sex_type'] == "female"){ echo "checked";} ?>>
        Female </p>
      <p id="formElements">
        <label>Birthday<br>
        </label>
      </p>
      <table>
        <tbody>
          <tr>
            <td>
			<select name="chart_month">
            	<option value="0">--Month--</option>
                <?php 
					foreach($this->month as $key => $val)
					{
				?>
					<option value="<?php echo $key ?>" <?php if($key == $value['user_birth_month']) { echo 'selected'; } ?>><?php echo ucwords(strtolower($val)) ?></option>
				<?php
					}
					
					?>
              </select>
			  
            </td>
            <td><select name="chart_day">
                <option value="0">--Day--</option>
                 <?php 
				 	for($i=1;$i<=31;$i++)
					{
				?>
					<option value="<?php echo $i ?>" <?php if($i ==  $value['user_birth_day']) { echo 'selected';} ?>><?php echo $i ?></option>
                 <?php
				 	}
				?>			 
                </select>
            </td>
            <td><input type="text" id="chart_year" name="chart_year" value="<?php echo $value['user_birth_year']; ?>"/>
            </td>
          </tr>
          <tr>
            <td><b>Month</b></td>
            <td><b>Day</b></td>
            <td><b>Year - 4 digits (E.g. - 1958)</b></td>
          </tr>
        </tbody>
      </table>
      <p id="formElements">
        <label>Place of Birth<br>
        </label>
      </p>
      <table>
        <tbody>
          <tr>
            <td width="70%"><input type="text" name="chart_city" value="<?php echo $value['user_birth_city']; ?>"></td>
            <td><select name="chart_country">
				<?php 
					foreach($this->country as $countries)
					{
				?>
                <option value="<?php echo $countries->country_code ?>" <?php if(($countries->country_code) ==  $value['user_birth_country']) { echo 'selected';} ?>><?php echo $countries->country_name ?></option>
                <?php
				 	}
				?>
               </select>
			</td>
          </tr>
          <tr>
            <td><b>City (E.g. : London)</b></td>
            <td><b>Country</b></td>
          </tr>
        </tbody>
      </table>
      <p id="formElements">
        <label>Birth Time<br>
        </label>
      </p>
      <table>
        <tbody>
          <tr>
            <td><select name="chart_hour">
                <option value="-1">--Hour--</option>
				<?php 
					for($hour=0;$hour<=11;$hour++)
					{
				?>							 
                <option value="<?php echo $hour ?>" <?php if($hour ==  $value['user_birth_hour']) { echo 'selected';} ?> ><?php echo $hour ?></option>
                <?php
				 	}
				?>
				</select>
            </td>
            <td><select name="chart_min">
                <option value="-1">--Minutes--</option>
                <?php 
					for($min=0;$min<=59;$min++)
					{
				?>
                <option value="<?php echo $min ?>" <?php if($min ==  $value['user_birth_minute']) { echo 'selected';} ?>><?php echo $min ?></option>
                <?php 
					}
				?>										
									 
              </select>
            </td>
            <td><select name="chart_amORpm">
                <option value="am" <?php if($value['user_birth_am_pm'] == 'am') { echo 'selected';} ?> >AM</option>
                <option value="pm" <?php if($value['user_birth_am_pm'] == 'pm') { echo 'selected';} ?>>PM</option>
                <br />
              </select>
            </td>
          </tr>
          <tr>
            <td><b>Hour</b></td>
            <td><b>Minutes</b></td>
            <td><b>AM/PM</b></td>
          </tr>
        </tbody>
      </table>
      <p>
        <input type="button" id="btn_next_step" name="btn_next_step" value="Update Birth Details &raquo;" />
      </p>
    </div>
    <div id="step2_chart_details" class="step2_chart_details">
    <h1 class="btmspace"> <a title="Birth Chart" rel="bookmark" href="">Birth Location and Time Zone</a> </h1>
	<ul id="formElements">
      <li><strong>dsfsfdsf</strong></li>
      <li><strong>July 13, 1990</strong></li>
      <li><strong>9:13 AM</strong></li>
      <li><strong>fwrfewrf, Iceland</strong></li>
    </ul>
    <p>Please enter coordinates and timezone for <strong>fwrfewrf</strong></p>
    <div>
    <small>Note - Daylight Saving Time (Summer Time) changes have been taken into account, wherever applicable. Please feel free to make changes if you find any error here.</small>
    <table>
    <tbody>
      <tr>
        <td>&nbsp;</td>
        <td>hours</td>
        <td>minutes</td>
        <td>&nbsp;</td>
      <tr>
      <tr>
        <td class="right">Time zone :</td>
        <td><input type="text" id="tz_hours" name="tz_hours" value="<?php echo $value['user_timezone_hour']; ?>" ></td>
        <td><input type="text" id="tz_min" name="tz_min" value="<?php echo $value['user_timezone_min']; ?>"></td>
        <td><select name="e_w_tz">
            <option value="E" <?php if($value['user_timezone_direction'] == 'E') { echo 'selected';} ?>>East of GMT</option>
            <option value="W" <?php if($value['user_timezone_direction'] == 'W') { echo 'selected';} ?>>West of GMT</option>
          </select></td>
      </tr>
    </tbody>
    <table>
    <table>
      <tbody>
        <tr>
          <td>&nbsp;</td>
          <td>degrees</td>
          <td>&nbsp;</td>
          <td>minutes</td>
        </tr>
        <tr>
          <td class="right">Longitude :</td>
          <td><input type="text" value="<?php echo $value['user_longitude_degree']; ?>" id="lon_degrees" name="lon_degrees"></td>
          <td><select name="e_w">
              <option value="E" <?php if($value['user_longitude_direction'] == 'E') { echo 'selected';} ?>>E</option>
              <option value="W" <?php if($value['user_longitude_direction'] == 'W') { echo 'selected';} ?>>W</option>
            </select></td>
          <td><input type="text" value="<?php echo $value['user_longitude_min']; ?>" class="number" id="lon_min" name="lon_min"></td>
        </tr>
        <tr>
          <td class="right">Latitude :</td>
          <td><input type="text" value="<?php echo $value['user_latitude_degree']; ?>" id="lat_degrees" name="lat_degrees"></td>
          <td><select name="n_s">
              <option value="N" <?php if($value['user_latitude_direction'] == 'N') { echo 'selected';} ?>>N</option>
              <option value="S" <?php if($value['user_latitude_direction'] == 'S') { echo 'selected';} ?>>S</option>
            </select></td>
          <td><input type="text" value="<?php echo $value['user_latitude_min']; ?>" id="lat_min" name="lat_min"></td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="update_submitted" id="update_submitted" value="update"/>
    <p>
      <input type="submit" value="update" id="update" name="update">
    </p>
    </div>
    </div>
  </form>
</div>
			<?php
		}
		}
		else
		{
	?>
	<div id="chart-form" class="chart-form">
	
  <form id="frm_chart_details" name="frm_chart_details" action="" method="post">
    <div id="step1_chart_details" class="step1_chart_details">
      <h1 class="btmspace"><a title="Birth Chart" rel="bookmark" href="">Enter Birth Details</a></h1>
      <p>
        <label>Report Name</label>
        <input type="text" id="chart_report_name" name="chart_report_name" class="required" />
      </p>
      <p>
        <label>Sex<br>
        </label>
        <input type="radio" value="male" id="chart_sex" name="sex">
        Male
        <input type="radio" value="female" id="chart_sex" name="sex">
        Female </p>
      <p id="formElements">
        <label>Birthday<br>
        </label>
      </p>
      <table>
        <tbody>
          <tr>
            <td>
			<select name="chart_month">
                <option value="0">--Month--</option>
                <?php 
					foreach($this->month as $key => $value)
					{
				?>
					<option value="<?php echo $key ?>"><?php echo ucwords(strtolower($value)) ?></option>
				<?php
					}
					?>
              </select>
            </td>
            <td><select name="chart_day">
                <option value="0">--Day--</option>
                 <?php 
				 	for($i=1;$i<=31;$i++)
					{
				?>
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
                 <?php
				 	}
				?>			 
                </select>
            </td>
            <td><input type="text" id="chart_year" name="chart_year"/>
            </td>
          </tr>
          <tr>
            <td><b>Month</b></td>
            <td><b>Day</b></td>
            <td><b>Year - 4 digits (E.g. - 1958)</b></td>
          </tr>
        </tbody>
      </table>
      <p id="formElements">
        <label>Place of Birth<br>
        </label>
      </p>
      <table>
        <tbody>
          <tr>
            <td width="70%"><input type="text" name="chart_city"></td>
            <td><select name="chart_country">
				<?php 
					foreach($this->country as $countries)
					{
				?>
                <option value="<?php echo $countries->country_code ?>"><?php echo $countries->country_name ?></option>
                <?php
				 	}
				?>
               </select>
			</td>
          </tr>
          <tr>
            <td><b>City (E.g. : London)</b></td>
            <td><b>Country</b></td>
          </tr>
        </tbody>
      </table>
      <p id="formElements">
        <label>Birth Time<br>
        </label>
      </p>
      <table>
        <tbody>
          <tr>
            <td><select name="chart_hour">
                <option value="-1">--Hour--</option>
				<?php 
					for($hour=0;$hour<=11;$hour++)
					{
				?>							 
                <option value="<?php echo $hour ?>"><?php echo $hour ?></option>
                <?php
				 	}
				?>
				</select>
            </td>
            <td><select name="chart_min">
                <option value="-1">--Minutes--</option>
                <?php 
					for($min=0;$min<=59;$min++)
					{
				?>
                <option value="<?php echo $min ?>"><?php echo $min ?></option>
                <?php 
					}
				?>										
									 
              </select>
            </td>
            <td><select name="chart_amORpm">
                <option value="am">AM</option>
                <option value="pm">PM</option>
                <br />
              </select>
            </td>
          </tr>
          <tr>
            <td><b>Hour</b></td>
            <td><b>Minutes</b></td>
            <td><b>AM/PM</b></td>
          </tr>
        </tbody>
      </table>
      <p>
        <input type="button" id="btn_next_step" name="btn_next_step" value="Verify Birth Details &raquo;" />
      </p>
    </div>
    <div id="step2_chart_details" class="step2_chart_details">
    <h1 class="btmspace"> <a title="Birth Chart" rel="bookmark" href="">Birth Location and Time Zone</a> </h1>
	<ul id="formElements">
      <li><strong>dsfsfdsf</strong></li>
      <li><strong>July 13, 1990</strong></li>
      <li><strong>9:13 AM</strong></li>
      <li><strong>fwrfewrf, Iceland</strong></li>
    </ul>
    <p>Please enter coordinates and timezone for <strong>fwrfewrf</strong></p>
    <div>
    <small>Note - Daylight Saving Time (Summer Time) changes have been taken into account, wherever applicable. Please feel free to make changes if you find any error here.</small>
    <table>
    <tbody>
      <tr>
        <td>&nbsp;</td>
        <td>hours</td>
        <td>minutes</td>
        <td>&nbsp;</td>
      <tr>
      <tr>
        <td class="right">Time zone :</td>
        <td><input type="text" value="" id="tz_hours" name="tz_hours"></td>
        <td><input type="text" value="" id="tz_min" name="tz_min"></td>
        <td><select name="e_w_tz">
            <option value="E">East of GMT</option>
            <option value="W">West of GMT</option>
          </select></td>
      </tr>
    </tbody>
    <table>
    <table>
      <tbody>
        <tr>
          <td>&nbsp;</td>
          <td>degrees</td>
          <td>&nbsp;</td>
          <td>minutes</td>
        </tr>
        <tr>
          <td class="right">Longitude :</td>
          <td><input type="text" value="" id="lon_degrees" name="lon_degrees"></td>
          <td><select name="e_w">
              <option value="E">E</option>
              <option value="W">W</option>
            </select></td>
          <td><input type="text" value="" class="number" id="lon_min" name="lon_min"></td>
        </tr>
        <tr>
          <td class="right">Latitude :</td>
          <td><input type="text" value="" id="lat_degrees" name="lat_degrees"></td>
          <td><select name="n_s">
              <option value="N">N</option>
              <option value="S">S</option>
            </select></td>
          <td><input type="text" value="" id="lat_min" name="lat_min"></td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="hid_submitted" id="hid_submitted" value="add"/>
    <p>
      <input type="submit" value="Done! See Your Report &raquo;" id="submit" name="wp-submit">
    </p>
    </div>
    </div>
  </form>
</div>
	<?php
	}
	}	
	else 
	{
		echo "Please Login to view Chart form";
	}	
?>
