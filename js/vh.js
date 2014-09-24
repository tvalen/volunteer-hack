$(document).ready(function() {
	$('div.org-content').hide();
});

// Shows/hides the appropriate div on the organization page
function searchVolunteerButton() {
	$('div.org-content').hide();
	var target_div = "div#"+$(this).data('div-id');
	$(target_div).show();
}

$('button.choice').on('click', searchVolunteerButton);

$.ajax({
	type: "GET",
	url: "http://volunteer-hack-enpicket.15.126.231.221.xip.io/get_skills_data.php",
	success: function(response) {
		console.log(response);
	}
});
