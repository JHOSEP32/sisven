/**
 * Created by jhon9 on 4/02/2017.
 */

$(document).ready(function () {
    var w = window.location.toString();
    var n = w.includes('/sale/create');
    if (n) {
        //Verify
        checkSale();
        //Variables and functions
        var sale_id;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var cliselect = $('.clients-data-select').select2();
        var prodselect = $('.products-data-select').select2();
        $('#addProductBtn').click(addProduct);
        $('#btn-clean-list').click(cleanList);
        $(cliselect).on('select2:select', function (evt) {
            var value = evt['target']['value'];
            if (value != '') {
                $.ajax({
                    url: '/ajax/client/get',
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: value
                    },
                    success: function (data) {
                        $('#prod_nombre').val(data.name + ' ' + data.lastname);
                        $('#prod_descripcion').html(data.description);
                        $('#prod_precio').val(data.price);
                        $('#prod_stock').val(data.stock);
                    }
                });
                updateSaleClient();
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
                    url: '/ajax/product/get',
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: value
                    },
                    success: function (data) {
                        $('#prod_descripcion').html(data.description);
                        $('#prod_precio').val(data.price);
                        $('#prod_stock').val(data.stock);
                    }
                });
            } else {
                $('#prod_descripcion').html('');
                $('#prod_precio').val('');
                $('#prod_stock').val('');
            }
        });

        function checkSale() {
            swal({
                    title: "Abrir caja",
                    text: "Desea abrir caja para iniciar una nueva venta ?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-info",
                    confirmButtonText: "Abrir",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        createSale();
                    } else {
                        window.location = '/sale';
                    }
                });
        }

        function createSale() {
            $.ajax({
                url: '/ajax/sale/create',
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    sale_id = data;
                    $('#fac_id').html(data);
                }
            });
        }

        function addProduct() {
            if ($('#producto').val() != '') {
                $.ajax({
                    url: '/ajax/product/create',
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: $('#producto').val(),
                        sale_id: sale_id,
                        cant: $('#prod_cant').val(),
                        desc: $('#prod_desc').val()
                    },
                    success: function (data) {
                        $('#prod_descripcion').html('');
                        $('#producto').val('');
                        $('#prod_precio').val('');
                        $('#prod_stock').val('');
                        $('#prod_desc').val('0');
                        $('#prod_cant').val('1');
                        getDetails();
                    }
                });
            }
        }

        function updateSaleClient() {
            $.ajax({
                url: '/ajax/sale/update/client',
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    sale_id: sale_id,
                    client_id: $('#cliente').val()
                },
                success: function (data) {

                }
            });
        }

        function getDetails() {
            $.ajax({
                url: '/ajax/sale/details',
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    sale_id: sale_id
                },
                success: function (data) {
                    updateTable(data);
                }
            });
        }

        function updateTable(details) {
            var table = $('#products-list tbody');
            table.find('tr').remove();
            var cont = 1;
            details.forEach(function (item) {
                table.append(
                    '<tr>' +
                    '<td>' + cont + '</td>' +
                    '<td>' + item.name + '</td>' +
                    '<td>' + item.price + '</td>' +
                    '<td>' + item.quantity + '</td>' +
                    '<td>' + item.discount + '</td>' +
                    '<td>' + item.subtotal + '</td>' +
                    '<td>' + '<button type="button" class="btn btn-danger btn-xs btn-remove-list" data-id="' + item.id + '" title="Eliminar"><span class="fa fa-trash"></span></button>' + '</td>' +
                    '</tr>'
                );
                cont++;
            });
            $('.btn-remove-list').on('click', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: '/ajax/sale/detail/delete',
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function (data) {
                        getDetails();
                    }
                });
            });
        }

        function cleanList() {
            swal({
                    title: "Limpiar lista",
                    text: "Esto borrara todos los productos de la lista ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "Limpiar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '/ajax/sale/details/delete',
                            method: 'POST',
                            data: {
                                _token: CSRF_TOKEN,
                                sale_id: sale_id
                            },
                            success: function (data) {
                                getDetails();
                            }
                        });
                    }
                });
        }

    }
});