jQuery(document).ready(function($){
    $("#frequency").change(function () {
      $(this).data("changed",true);
      $("#submit").click();
    });
    $('#prescriptionForm').on('submit', function (ev) {
      ev.preventDefault();
      alert('searching');
    });
  });
