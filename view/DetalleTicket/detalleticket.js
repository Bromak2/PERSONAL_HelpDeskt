function init(){

}

$(document).ready(function(){
    var tick_id = getUrlParameter ('ID');
    listardetalle(tick_id);

    $.post("../../controller/ticket.php?op=listardetalle", { tick_id : tick_id}, function(data){
        $('#lbldetalle').html(data);
    });

    $.post("../../controller/ticket.php?op=mostrar", { tick_id : tick_id}, function(data){
        data = JSON.parse(data);
        $('#lbltipo').html(data.tipo_nom);
        $('#lblestado').html(data.tick_estado);
        $('#lblnomusuario').html(data.usu_nom +' '+ data.usu_ape);
        $('#lblfechcrea').html(data.fech_crea);
        $('#lblnomidticket').html("Detalle Ticket -" + data.tick_id);
        $('#lblcategoria').val(data.cat_nom);
        $('#lbltitulo').val(data.tick_titulo);
        $('#lbldescrip').summernote('code',data.tick_descrip);

        if(data.tick_estado_texto=="Cerrado"){
            $('#pnldetalle').hide();
        }
       
        
    });
    
    $('#tickd_descrip').summernote({
        height: 400,
        lang:"es-ES",
        popover: {
            image:[],
            link:[],
            air:[]
        },

    });

    $('#lbldescrip').summernote({
        height: 400,
        lang:"es-ES",
        popover: {
            image:[],
            link:[],
            air:[]
        },

    });

    $('#lbldescrip').summernote('disable');
    
});

var getUrlParameter = function getUrlParameter(sParam){
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split ('=');

        if (sParameterName[0] === sParam){
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }

    }
}

$(document).on("click","#btnenviar",function(){
    if ($('#tickd_descrip').summernote('isEmpty')){
        swal("Advertencia!","Campo Vacio","warning"); 
    }else{
        var tick_id = getUrlParameter ('ID');
        var usu_id = $('#user_idx').val();
        var tickd_descrip = $('#tickd_descrip').val();
        
        $.post("../../controller/ticket.php?op=insertdetalle", {tick_id :tick_id,usu_id:usu_id,tickd_descrip:tickd_descrip}, function(data){
            listardetalle(tick_id);
            $('#tickd_descrip').summernote('reset');
            swal("Correcto!","Registrado Correctamente","success");
        });
    }
});

$(document).on("click","#btncerrarticket",function(){
    swal({
        title: "¿Esta seguro de Cerrar este Ticket?",
        text: "Una vez cerrado no podrá enviar mas actualizaciones.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "si",
        cancelButtonText: "No",
        closeOnConfirm: false,
    },
    function(isConfirm) {
        if (isConfirm) {
            var tick_id = getUrlParameter ('ID');
            var usu_id = $('#user_idx').val();
            $.post("../../controller/ticket.php?op=update", { tick_id : tick_id, usu_id : usu_id}, function(data){  
            });

            listardetalle(tick_id);

            swal({
                title: "Cerrado",
                text: "El Ticket ha sido cerrado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } else {

        }
    });
});

function listardetalle(tick_id){
    $.post("../../controller/ticket.php?op=listardetalle", { tick_id : tick_id}, function(data){
        $('#lbldetalle').html(data);
    });

    $.post("../../controller/ticket.php?op=mostrar", { tick_id : tick_id}, function(data){
        data = JSON.parse(data);
        $('#lblestado').html(data.tick_estado);
        $('#lblnomusuario').html(data.usu_nom +' '+ data.usu_ape);
        $('#lblfechcrea').html(data.fech_crea);
        $('#lblnomidticket').html("Detalle Ticket -" + data.tick_id);
        $('#lblcategoria').val(data.cat_nom);
        $('#lbltitulo').val(data.tick_titulo);
        $('#lbldescrip').summernote('code',data.tick_descrip);

        if(data.tick_estado_texto=="Cerrado"){
            $('#pnldetalle').hide();
        }
       
        
    });

    
}

init();