function showProfile() {
    jQuery.ajax({
       url: '/profile',
       type: 'get',
       success: function (data) {
           console.log(data);

           var user_fullname = data.name;
           var user_email = data.email;
           $('.user-fullname').html(user_fullname);
           $('.user-email').html(user_email);

           $('#modal-profile').modal();
       },
        error: function (error) {
            console.log(error)
        },
        dataType: 'json' // json/xml/text
    });
}