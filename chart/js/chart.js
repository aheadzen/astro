/*$('#chk_male_new').change(function() {
	alert("male new");
});*/
$(document).ready(function(){
    /*$('input[type="checkbox"]').click(function(){
		alert("checked");
	});*/
	$('#chk_male_new').change(function() {
		$('#frm_chart').toggle();
		if($('#frm_chart').length)
		{			
			$("#rd_gender_male").prop("checked", true);
		}
	});

	$('#chk_female_new').change(function() {
		$('#frm_chart').toggle();
		if($('#frm_chart').length)
		{			
			$("#rd_gender_female").prop("checked", true);
		}
	});

});