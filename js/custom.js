//Checking If email already Exists
$(document).ready(function () {

    $('.checking_email').keyup(function (e) {
        
        var email = $('.checking_email').val();
        $.ajax({
            type: "POST",
            url: "alertify_backend.php",
            data: {
                "check_email_submit_btn": 1,
                "email_id": email,
            },
            success: function (response) {
                // alert(response);
                $('.error_email').text(response);
            }
        });
    });

});
//Checking  If Contact Number already Exists
$(document).ready(function () {

    $('.checking_contactnumber').keyup(function (e) {
        
        var cnumber = $('.checking_contactnumber').val();
        $.ajax({
            type: "POST",
            url: "alertify_backend.php",
            data: {
                "check_cnumber_submit_btn": 1,
                "contactnumber_id": cnumber,
            },
            success: function (response) {
                // alert(response);
                $('.error_cnumber').text(response);
            }
        });
    });

});
// Data Confirmation on user_info page
$(document).ready(function (){

  $('.delete_btn_ajax').click(function (e){
    e.preventDefault();
  
    var deleteid = $(this).closest("tr").find('.delete_id_value').val();
    var img_del_front = $(this).closest("tr").find('.del_res_front').val();
    var img_del_back = $(this).closest("tr").find('.del_res_back').val();
    // console.log(deleteid);
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
  
          $.ajax({
            type: "POST",
            url: "alertify_backend.php",
            data: {
              "delete_btn_set": 1,
              "delete_id": deleteid,
              "del_img_front": img_del_front,
              "del_img_back": img_del_back,
            },
            
            success: function (response) {
              swal({
                text:"Data Delete Successfully.!" ,
                  icon: "success",
              }).then((result) => {
                location.reload();
              });
            }
          });
        }
      });
  });
});