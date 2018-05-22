$(function() {

    $("a.btnAjourner").click(function () {
        $('#myModalLabel').html("Voulez-vous vraiment ajourner l'élève " + $(this).data('name') + "?");
        $('#ajournerForm').attr('action', $(this).data('path'));
        $('#ajourneModal').modal('show');
    });

    $("a.btnAutoriser").click(function () {
        $('#myModalLabelAutoriseMatricule').html("Matricule: " + $(this).data('matricule'));
        $('#myModalLabelAutoriseText').html("Voulez-vous vraiment autoriser l'élève " + $(this).data('name') + " à se réinscrire dans un autre pays?");
        $('#autoriserForm').attr('action', $(this).data('path'));
        $('#autoriseModal').modal('show');
    });

    $("a.btnMotif").click(function () {
        $('#myModalLabelMotif').html($(this).data('name'));
        $('#motifAjourne').html($(this).data('motif'));
        $('#motifAjourneModal').modal('show');
    })

});


//init();



function hideBtnSaveVacation() {
    $("#submitVacationForm").addClass('hide');
    $("#divRefreshVacationHours").show();
}


function addAgent() {
    if($('select#agent_id').val() != ''){
        var agent_id = $('select#agent_id').val();
        var agent_name = $('select#agent_id  option:selected').text();



        var ligne_agent = '<tr><td>';


        ligne_agent += '<span>' + agent_name + '</span> &nbsp;&nbsp;';

        ligne_agent += '<button type="button" class="btn btn-xs btn-danger pull-right delete_agent_row" onclick="deleteAgent(this);">Supprimer</button></td>';

        ligne_agent += '<td><input value="' + agent_id + '" type="hidden" class="agent_id"/></td>';

        ligne_agent += '</tr>';

        $('#table_agents_tbody').append(ligne_agent);

        $('input#selectedAgentsIds').val($('input#selectedAgentsIds').val() + '#' + agent_id);

    }
}

function deleteAgent(elem) {

    $(elem).parent().parent().remove();

    var nb_elem = $('#table_agents_tbody').children().length;

    if(nb_elem == 0){

        location.reload();

    }else{
        $('input#selectedAgentsIds').val('');

        $('#table_agents_tbody > tr').each(function (i, el) {
            var agent_id = $(this).children().eq(1).children().val();
            $('input#selectedAgentsIds').val($('input#selectedAgentsIds').val() + '#' + agent_id);
        })
    }

}