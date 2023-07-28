$(function() {
	
	$('#select-department').on('change', onSelectDepartmentChange);

});

function onSelectDepartmentChange() {
	var department_id = $(this).val();

	if (! department_id) {
		$('#select-level').html('<option value="">Seleccione nivel</option>');
		return;
	}

	// AJAX
	$.get('/api/department/'+department_id+'/niveles', function (data) {
		var html_select = '<option value="">Seleccione nivel</option>';
		for (var i=0; i<data.length; ++i)
			html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
		$('#select-level').html(html_select);
	});
}