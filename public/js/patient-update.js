$(document).ready(function() {
    $('body').on('click', '#editButton', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            $('#editModal').show();
            $('#patient_id_2').val(data.patient_id);
            $('#title_2').val(data.title);
            $('#name_2').val(data.name);
            $('#nic_2').val(data.nic);
            $('#contact_no_2').val(data.contact_no);
            $('#address_2').val(data.address);
            $('#age_2').val(data.age);
        })
     });

     $('#updateCategory').click(function() {
        var patient_id = $('#patient_id_2').val();
        var title = $('#title_2').val();
        var name = $('#name_2').val();
        var nic = $('#nic_2').val();
        var contact_no = $('#contact_no_2').val();
        var address = $('#address_2').val();
        var age = $('#age_2').val();
        var _token = $('#_token').val();
        var url = 'update/'+patient_id;

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Send form data using ajax
        $.ajax({
            type: 'POST',
            url: url,
            data: {'_token': _token, 'patient_id': patient_id, 'title': title, 'name': name, 'nic': nic, 'contact_no': contact_no, 'address' : address, 'age': age},
            success: function(data){
                alert("Record updated successfully...");
                location.reload();
            },
            error: function(data){
                alert('Sorry! Can\'t update record...');
                location.reload();
            }
        });

     });

     $('#closeBtn').click(function() {
        $('#editModal').hide();
     });

     $('#closeBtn_2').click(function() {
        $('#editModal').hide();
     });
});
