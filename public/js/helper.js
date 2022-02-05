$(document).ready(function() {
    $('.select2').select2();
    $('#notification').fadeOut(5000).delay(1000).fadeOut("slow");
    $('.duallistbox').bootstrapDualListbox({
        filterTextClear: 'Mostrar tudo',
        filterPlaceHolder: 'Filtro',
        moveSelectedLabel: 'Mover selecionado',
        moveAllLabel: 'Mover todos',
        removeSelectedLabel: 'Remover selecionado',
        removeAllLabel: 'Remover tudo',
        infoTextEmpty: 'Lista vazia',
        infoText: 'Mostrando todo(s) {0}',
        infoTextFiltered: "<span class='badge badge-success'>Filtrando</span> {0} de {1}",
    });
    let dualListContainer = $('.duallistbox').bootstrapDualListbox('getContainer');
    dualListContainer.find('.moveall').html('<i class="fa fa-angle-double-right"></i>');
    dualListContainer.find('.removeall').html('<i class="fa fa-angle-double-left"></i>');
});
