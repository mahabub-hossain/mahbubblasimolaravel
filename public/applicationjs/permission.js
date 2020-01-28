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
                      <button class="btn btn-outline-primary permissionshow" data-id="`+data.id+`" data-toggle="modal" data-target="#exampleModal1"><i class="ti-arrow-circle-right"></i></button>
                    <button type="button" class="btn btn-outline-success editpermission" data-permissionname="`+data.name+`"  data-id="`+data.id+`" data-toggle="modal" data-target="#exampleModal"><i class="icon-pencil"></i></button>
                    <button type="button" class="btn btn-outline-danger btn-icon-text deletepermission"  data-id="`+data.id+`">
                      <i class="icon-trash"></i>                                                       
                    </button>
                    </td>
                </tr>`);
                toastr.success('Permission was Created successfully');
                $('#permission').trigger('reset');
         }
      })
  });
  $(document).on('click','.permissionshow',function(e){
    e.preventDefault();
     var id = $(this).data('id');
      var type ='show';
    $.ajax({
      url:config.routes.permissionsshow,
      type: "get", 
      data: {  
          id: id, 
          type:type,
      },
      success: function(data) {
        //console.log(data);
        $('#exampleModal1 .permission-name').text(data.name);
         $('#exampleModal1 .permission-for').text(data.permission_for);
      }
    })
  })
   $(document).on('click','.editpermission',function(e){
    e.preventDefault();
     var id = $(this).data('id');
     var name = $(this).data('permissionname');
     var si =  $(this).data('serial');
     //console.log(si);
    var type ='edit';
    $.ajax({
      url:config.routes.permissionsshow,
      type: "get", 
      data: {  
          id: id, 
          type:type,
      },
      success: function(data) {
      $('#permissionedit').find('#name').val(data.name);
      $('#permissionedit').find('#id').val(id);
      $('#permissionedit').find('#si').val(si);
       $('#permissionedit').find('#permission_for').append(`<option value="`+data.permission_for+`" selected="selected">`+data.permission_for+`</option>`);
      }
    });
  })
  $(document).on('submit','#permissionedit',function(e){
    e.preventDefault();
      var si = $('#permissionedit').find('#si').val();
        $.ajax({
            url:config.routes.permissionupdate,
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
            $('.unqpermission'+data.id).replaceWith(`<tr class="unqpermission`+data.id+`">
                     <td>`+si+`</td>
                    <td>`+data.name+`</td>
                    <td>`+data.permission_for+`</td>                                                                               
                    <td>
                      <button class="btn btn-outline-primary permissionshow" data-id="`+data.id+`" data-toggle="modal" data-target="#exampleModal1"><i class="ti-arrow-circle-right"></i></button>
                    <button type="button" class="btn btn-outline-success editpermission" data-permissionname="`+data.name+`"  data-id="`+data.id+`" data-toggle="modal" data-target="#exampleModal"><i class="icon-pencil"></i></button>
                    <button type="button" class="btn btn-outline-danger btn-icon-text deletepermission"  data-id="`+data.id+`">
                      <i class="icon-trash"></i>                                                       
                    </button>
                    </td>
                </tr>`);
            toastr.success('Permission was Updated successfully');
            setTimeout(function() {$('#exampleModal').modal('hide');}, 1500);
            $('#permissionedit').trigger('reset');
        }
    })
  })
 