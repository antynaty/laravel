
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
});

