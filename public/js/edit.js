$(function() {
    $('[data-category]').on('click', editCategoryModal);
    $('[data-level]').on('click', editLevelModal);
    $('[data-demand]').on('click', demandShow);
});

function editCategoryModal() {
    // id
    var category_id = $(this).data('category');
    $('#category_id').val(category_id);
    // name
    var category_name = $(this).parent().prev().text().trim();
    $('#category_name').val(category_name);
    // show
    $('#modalEditCategory').modal('show');
}

function editLevelModal() {
    // id
    var level_id = $(this).data('level');
    $('#level_id').val(level_id);
    // name
    var level_name = $(this).parent().prev().text().trim();
    $('#level_name').val(level_name);
    // show
    $('#modalEditLevel').modal('show');
}

function demandShow() {
    // id
    var id = $(this).data('demand');
    location.href = '/demands/'+id;
}

/* function demandTake() {
    // id
    var clerk_id = $(this).data('department');
    location.href = '/demands/'+clerk_id;
} */