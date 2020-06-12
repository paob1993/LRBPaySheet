function waitingSpinner() {
    return '<center><img src="'+currentSpace()+'/assets/img/Waiting.gif"></img></center>';
}

function loadSearchAuto(id,url,length) {
    $(id).autocomplete({
        source: url,
        minLength: length
    });
}

function cargarMunicipios(entidad_id,id) {
    $.ajax({
        url: currentSpace()+'/getMunicipios/'+entidad_id,
        async: true,
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){$('#hora_sistema').html(waitingSpinner());},
        success: function(municipios) {
            try {
                var html = "";
                $.each(municipios,function(index,municipio){
                    html+="<option value='"+municipio.id+"'>"+municipio.nombre+"</option>";
                });
                $(id).html(html);
            }
            catch(Exception) {
                $(id).html();
            }
        },
        error: function() {
            $(id).html();
        }
    });
}