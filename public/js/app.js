$(function () {
	$('#list-of-departments').on('change', onNewDepartmentSelected);
});

function onNewDepartmentSelected() {
	var department_id = $(this).val();
	if(! department_id){
		location.href = '/home'
	}else{
		location.href = '/seleccionar/Departments/'+department_id;
	}
} 