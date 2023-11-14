function getNormalDrugs(id){
    var drug_id_1 = $('#drug_id_'+id).val();
    var drug_name_1 = $('#drug_'+id).val();

    // Display input values
    $('#drug_id_ori').val(drug_id_1);
    $('#drugName').val(drug_name_1);
}

function getSpecialDrugs(s_id){
    var drug_id_2 = $('#drug_id_2_'+s_id).val();
    var drug_name_2 = $('#drug_'+s_id).val();

    // Display input values
    $('#drug_id_ori').val(drug_id_2);
    $('#drug_name_3').val(drug_name_2);
}
