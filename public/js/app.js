$(function () {
	$('#list-of-departments').on('change', onNewDepartmentSelected);
});

function onNewDepartmentSelected() {
	var department_id = $(this).val();
	location.href = '/seleccionar/Departments/'+department_id;
}
