<?php
	global $wpdb;
	global $current_user;
	global $wp_roles;
			
	if(isset($_REQUEST['info']) && $_REQUEST['info']=="view")
	{
		echo "View your Chart here";
	}
	else
	{
	if (is_user_logged_in())
	{
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID; 
		$user_roles = $current_user->roles;
		$ul = $current_user->user_login;
		
		if($user_roles['0'] == "administrator") 
		{
			?>
			<form name="submit_form" action="<?php the_permalink() ?>" method="post">
				<input type="text" name="serach_username" id="search_username" />
				<input type="submit" name="searh" id="search" value="search"  />
			</form>
			<?php
			
			if (isset($_POST['searh'])) 
			{	
				global $wpdb, $table_name ;
				wp_register_style('demo_table.css', plugin_dir_url(__FILE__) . 'css/demo_table.css');
				wp_enqueue_style('demo_table.css');
				wp_register_script('jquery.dataTables.js', plugin_dir_url(__FILE__) . 'js/jquery.dataTables.js', array('jquery'));
				wp_enqueue_script('jquery.dataTables.js');

				$search_uername = $_POST['serach_username'];
				//print_r ($_POST);
				$main_user =  $wpdb->get_results('SELECT * FROM wp_users where user_login or user_nicename LIKE "%'.$search_uername.'%"', ARRAY_A);
				
				$main_user_id = array();
				$k = 0;
				foreach($main_user as $key => $val)
				{
					$main_user_id[$k] = $val['ID'];
					$k++;
				}

				$main_user_id = implode(",", $main_user_id);
				
				$get_userdetailsby_id = 'SELECT * FROM wp_user_birth_details where user_birth_user_id IN ('.$main_user_id.')';

				$assoc_user =  $wpdb->get_results($get_userdetailsby_id);
				$page_id = "SELECT * FROM wp_page_information where page_name = 'chart-form'";
				$page_id =  $wpdb->get_results($page_id,ARRAY_A);
				$page_id_for_form = $page_id[0]['page_id'];
			?>
				<script type="text/javascript">
					/* <![CDATA[ */
				jQuery(document).ready(function(){
					jQuery('#memberlist').dataTable({
						"bPaginate": true,
						"bSort": false
					});
				});
				/* ]]> */
				</script>
				<div style="width:900px;">
				<table width='100%' class="wp-list-table widefat fixed " id="memberlist">
					<thead>
						<tr>
							<th>ID</th>
							<th>Full Name</th>
							<th>Gender</th>
							<th>Delete</th>
							<th>Edit</th>
							<th>View</th>
						</tr>
					</thead>
				<tbody>	
				<?php				
						
				if(count($assoc_user) > 0)
				{
					foreach($assoc_user as $key => $array)
					{
						$val = get_object_vars($array);

						$arr_params_for_edit = array('did' => $val['user_birth_chart_id'], 'info' => 'edit','page_id' => $page_id_for_form);
						$arr_params_for_view = array('did' => $val['user_birth_chart_id'], 'info' => 'view');
						$arr_params_for_delete = array('did' => $val['user_birth_chart_id'], 'info' => 'delete');
						
						$edit_chart_details = add_query_arg($arr_params_for_edit, get_permalink());
						$view_chart_details = add_query_arg($arr_params_for_view, get_permalink());
						$delete_chart_details = add_query_arg($arr_params_for_delete, get_permalink());
						
						$get_post_id_for_chart =  $wpdb->get_results("SELECT post_id from wp_postmeta where meta_key = 'chart_id' AND meta_value = '".$val['user_birth_chart_id']."'", ARRAY_A);
						$post_id_from_meta = $get_post_id_for_chart[0]['post_id'];						
				?>
						<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $val['user_birth_report_name']; ?></td>
							<td><?php echo $val['user_birth_sex_type']; ?></td>
							<td><a href="<?php echo $delete_chart_details ?>">Delete</a></td>
							<td><a href="<?php echo $edit_chart_details ?>">Edit</a></td>
							<td><a href="<?php echo $view_chart_details ?>">View</a> | <a href="<?php echo get_permalink($post_id_from_meta); ?>">View Chart</a></td>
							
						</tr>
				<?php
					}
				}
				else
				{
					echo "<tr ><td colspan='5'>No Records</td></tr>";
				}
				?>
				</tbody>
				</table>
				</div>	
		<?php
			}
		}
		
		if($user_roles['0'] != "administrator")
		{
			wp_register_style('demo_table.css', plugin_dir_url(__FILE__) . 'css/demo_table.css');
			wp_enqueue_style('demo_table.css');
			wp_register_script('jquery.dataTables.js', plugin_dir_url(__FILE__) . 'js/jquery.dataTables.js', array('jquery'));
			wp_enqueue_script('jquery.dataTables.js');
			
			if(!function_exists('wp_get_current_user'))
			{
				include(ABSPATH . "wp-includes/pluggable.php");
			}

			$assoc_user = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}user_birth_details where user_birth_user_id=".$user_id, ARRAY_A);
				$page_id = "SELECT * FROM wp_page_information where page_name = 'chart-form'";
				$page_id =  $wpdb->get_results($page_id,ARRAY_A);
				$page_id_for_form = $page_id[0]['page_id'];

		?>
			<script type="text/javascript">
				/* <![CDATA[ */
				jQuery(document).ready(function(){
					jQuery('#memberlist').dataTable({
						"bPaginate": true,
						"bSort": false
					});
				});
				/* ]]> */
			</script>
			<div style="width:900px;">
			<table width='100%' class="wp-list-table widefat fixed " id="memberlist">
				<thead>
				<tr>
					<th>ID</th>
					<th>Full Name</th>
					<th>Gender</th>
					<th>Delete</th>
					<th>Edit</th>
					<th>View</th>
				</tr>
				</thead>
				<tbody>	
				<?php
				if(count($assoc_user) > 0)
				{
					foreach($assoc_user as $key => $val)
					{
						$arr_params_for_edit = array('did' => $val['user_birth_chart_id'], 'info' => 'edit','page_id' => $page_id_for_form);
						$arr_params_for_view = array('did' => $val['user_birth_chart_id'], 'info' => 'view',);
						$arr_params_for_delete = array('did' => $val['user_birth_chart_id'], 'info' => 'delete');
						
						$edit_chart_details = add_query_arg($arr_params_for_edit, get_permalink());
						$view_chart_details = add_query_arg($arr_params_for_view, get_permalink());
						$delete_chart_details = add_query_arg($arr_params_for_delete, get_permalink());
					?>
					<tr>
						<td><?php echo ++$key; ?></td>
						<td><?php echo $val['user_birth_report_name']; ?></td>
						<td><?php echo $val['user_birth_sex_type']; ?></td>
						<td><a href="<?php echo $delete_chart_details ?>">Delete</a></td>
						<td><a href="<?php echo $edit_chart_details ?>">Edit</a></td>
						<td><a href="<?php echo $view_chart_details ?>">View</a></td>
					</tr>
					<?php
					}
				}
				else
				{
				?>
				<tr ><td colspan='5'>No Records</td></tr>
				<?php
				}
				?>
				</tbody>
				</table>
				</div>	
		 		<?php
		}
		
	}
	else
	{
		echo "Login to view Listing";				
	}
	}
		
		?>