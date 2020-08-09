
$.fn.editable.mode = 'inline';       // or popover
$.fn.editable.defaults.ajaxOptions= {type: 'PUT'};

$(document).ready(function(){
    // controles 
    $(".set-guide-number").editable({
        mode: 'inline',
    });
    $(".select-status").editable({
        mode : 'inline',
        source : [
            {value : 'creado', text: 'Creado'},
            {value : 'enviado', text: 'Enviado'},
            {value : 'recibido', text: 'Recibido'},
        ]
    });

    $(".add-to-cart").on("submit", function (event) {
        event.preventDefault();

        form = $(this);
        button = form.find("[type='submit']");
        // myData = $('form').find('input[name="product_id"]').val();  // no codificado
        $.ajax({
            url : form.attr("action"),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : form.attr("method"),
            data : form.serialize(),
            dataType: "JSON",
            beforeSend : function () {
                button.val("Cargando...");
            },
            success : function () {
                button.css({backgroundColor:'#19611a'}).val("Agregado");
                setTimeout(() => {
                    resetButton(button);
                }, 2000);
            },
            error : function (err) {
                console.log(err);
                button.css({backgroundColor:'#911810'}).val("Error al agregar");
            }
        });
        return false
    });
    function resetButton($button) {
        $button.val("Agregar al carrito").attr("style","")
    }
});

