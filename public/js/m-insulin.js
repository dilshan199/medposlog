// $(document).ready(function() {
//     $('#mInsulin').click(function() {
//         var m_drug_name = $('#m_drug_name').val();
//         var m_dose_1 = $('#m_dose_1').val();
//         var m_dose_2 = $('#m_dose_2').val();
//         var m_frequency_1 = $('#m_frequency_1').val();
//         var m_frequency_2 = $('#m_frequency_2').val();

//         // Sending AJAX request
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         $.ajax({
//             type: 'POST',
//             url: 'mixtard-insulin',
//             data: {'m_drug_name': m_drug_name, 'm_dose_1': m_dose_1, 'm_dose_2': m_dose_2, 'm_frequency_1': m_frequency_1, 'm_frequency_2': m_frequency_2},
//             success:function(data){
//                 location.reload();
//             }
//         });
//     });
// });

$(document).ready(function() {
    $('.click-insulin').click(function() {
        var drug_id = $(this).attr('id');
        var m_drug_name = $('#drugName_'+drug_id).val();
        var m_dose_1 = $('#dose_'+drug_id).val();
        var m_dose_2 = $('#dose_2_'+drug_id).val();
        var m_frequency_1 = $('#frequency_'+drug_id).val();
        var m_frequency_2 = $('#frequency_2_'+drug_id).val();

        // Sending AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'mixtard-insulin',
            data: {'drug_id': drug_id, 'm_drug_name': m_drug_name, 'm_dose_1': m_dose_1, 'm_dose_2': m_dose_2, 'm_frequency_1': m_frequency_1, 'm_frequency_2': m_frequency_2},
            success:function(data){
                location.reload();
            }
        });
    });
});
