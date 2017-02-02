/**
 * Created by jhon9 on 21/01/2017.
 */

$(document).ready(function () {
    $(window).load(function () {
        $('body').addClass('loaded');
    });
    $('.tb-delete').click(function (e) {
        e.preventDefault();
        var self = $(this);
        swal({
                title: "Esta seguro?",
                text: "No podrá recuperar este registro después de borrarlo!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            },
            function () {
                self.parent().submit();
            });
    });
    $('.tb-delete-mail').click(function (e) {
        e.preventDefault();
        var self = $(this);
        swal({
                title: "Esta seguro que desea eliminar este mensaje?",
                text: "No podrá recuperarlo después de borrarlo!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            },
            function () {
                self.parent().submit();
            });
    });
    $('#create-user-form input[type=file]').on('change', function (evt) {
        var file = evt.target.files[0];
        var reader = new FileReader();
        var img;
        reader.onload = function (e) {
            img = e.target.result;
            if (img) {
                $('#create-user-form .preview-img').attr('src', img);
            }

        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            $('.preview-img').attr('src', '/img/user_profile.png');
        }
    });
    $('#update-photo-form input[type=file]').on('change', function (evt) {
        var file = evt.target.files[0];
        var reader = new FileReader();
        var img;
        var userImg = $('#update-photo-form #userImg').val();
        reader.onload = function (e) {
            img = e.target.result;
            if (img) {
                $('.preview-img').attr('src', img);
            }

        };
        if (file) {
            reader.readAsDataURL(file);
        } else {
            $('.preview-img').attr('src', userImg);
        }
    });
    $('#create-mail #btn-send').click(function () {
        $('#create-mail #mail_state').val('inbox');
    });
    $('#create-mail #btn-draft').click(function () {
        $('#create-mail #mail_state').val('drafts');
    });
    //Plugins
    var table = $('.dtable').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles.",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
    //Initialize Select2 Elements
    $(".data-select").select2();
    $(".editor").wysihtml5({locale: "es-AR"});
    //    $(document).idleTimer(180000); //3 min
    //    $(document).on("idle.idleTimer", function (event, elem, obj) {
    //        console.log('3 min inactivity');
    //    });
});
