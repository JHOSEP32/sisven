/**
 * Created by jhon9 on 4/02/2017.
 */

$(document).ready(function () {

    var cliselect = $('.clients-data-select').select2();
    var prodselect = $('.products-data-select').select2();
    $(cliselect).on('select2:select', function (evt) {
        var value = evt['target']['value'];
        if (value != '') {
            $.ajax({
                url: '/ajax/client/' + value,
                success: function (data) {
                    $('#prod_nombre').val(data.name + ' ' + data.lastname);
                    $('#prod_descripcion').html(data.description);
                    $('#prod_precio').val(data.price);
                    $('#prod_stock').val(data.stock);
                }
            });
        } else {
            $('#prod_descripcion').html('');
            $('#prod_precio').val('');
            $('#prod_nombre').val('');
            $('#prod_stock').val('');
        }
    });
    $(prodselect).on('select2:select', function (evt) {
        var value = evt['target']['value'];
        if (value != '') {
            $.ajax({
                url: '/ajax/product/',
                data: {
                    id: value
                },
                success: function (data) {
                    //document.write(data);
                    $('#prod_nombre').val(data.name);
                    $('#prod_descripcion').html(data.description);
                    $('#prod_precio').val(data.price);
                    $('#prod_stock').val(data.stock);
                }
            });
        } else {
            $('#prod_nombre').val('');
            $('#prod_descripcion').html('');
            $('#prod_precio').val('');
            $('#prod_stock').val('');
        }
    });

    $('#addProductBtn').click(addProduct);

    function addProduct() {
        var products = $('#products-list tbody').find('tr').length + 1;
        if ($('#producto').val() != '' && $('#prod_descripcion').html() != '' && $('#prod_precio').val() != '' && $('#prod_stock').val() != '') {
            $('#products-list tbody').append(
                '<tr>' +
                '<td>' + products + '</td>' +
                '<td>' +
                '<input type="number" value="1" min="1" ' +
                'class="form-control input-sm input-table">' +
                '<td>' + $('#prod_nombre').val() + '</td>' +
                '<td data-value="' + $('#prod_precio') + '">$' + $('#prod_precio').val() + '</td>' +
                '<td data-value="' + $('#prod_precio') + '">$' + $('#prod_precio').val() + '</td>' +
                '<td><button type="button" class="btn btn-xs btn-danger" ' +
                'data-toggle="tooltip" data-placement="top" ' +
                'title="Eliminar">' +
                '<span class="fa fa-trash"></span>' +
                '</button></td>' +
                '</td>' +
                '</tr>'
            );
        }
    }


});