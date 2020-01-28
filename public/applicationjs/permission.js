 $("#permission").validate({
      rules: {
        name: {
          required: true,
        },
        permission_for: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "Please enter a name",
        },
        permission_for: {
          required: "Please select an option",
        },
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    //Permission Form
    $(document).on('submit','#permission', function(event){
     event.preventDefault();
        $.ajax({
            url:config.routes.permissionstore,
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            { 
                console.log(data);
                 toastr.options = {
                           "debug": false,
                           "positionClass": "toast-bottom-right",
                           "onclick": null,
                           "fadeIn": 300,
                           "fadeOut": 2000,
                           "timeOut": 2000,
                           "extendedTimeOut": 2000
                         };
                $('#permissionappend').prepend(`<tr class="unqpermission`+data.id+`">
                     <td>0</td>
                    <td>`+data.name+`</td>
                    <td>`+data.permission_for+`</td>                                                                               
                    <td>
                        <button class="btn btn-outline-primary">View</button>
                    </td>
                </tr>`);
                toastr.success('Permission was Created successfully');
                $('#permission').trigger('reset');
         }
      })
  });