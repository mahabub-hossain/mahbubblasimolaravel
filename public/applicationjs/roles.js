$("#role").validate({
      rules: {
        name: {
          required: true,
        },
        'permission[]': {
          required: "#permissionchk:checked",
        },
      },
      messages: {
        name: {
          required: "Please enter a name",
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
$(document).on('submit','#role', function(event){
        event.preventDefault();
        $.ajax({
            url:config.routes.rolestore,
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
            $('#roleappend').prepend(`<tr class="unqrole`+data.id+`">
                 <td>0</td>
                <td>`+data.name+`</td>
                <td>`+data.created_at+`</td>                                                                               
                <td>
                  <button class="btn btn-outline-primary roleshow" data-id="`+data.id+`" data-toggle="modal" data-target="#exampleModal1"><i class="ti-arrow-circle-right"></i></button>
                  <button type="button" class="btn btn-outline-success editrole" data-rolename="`+data.name+`"  data-id="`+data.id+`" data-toggle="modal" data-target="#exampleModal"><i class="icon-pencil"></i></button>
                  <button type="button" class="btn btn-outline-danger btn-icon-text"  data-id="`+data.id+`">
                    <i class="icon-trash"></i>                                                       
                  </button>
                </td>
            </tr>`);
            toastr.success('Role was Created successfully');
            $('#role').trigger('reset');
         }
      })
  });
  $(document).on('click','.roleshow',function(e){
    e.preventDefault();
     var id = $(this).data('id');
      var type ='show';
    $.ajax({
      url:config.routes.roleshow,
      type: "get", 
      data: {  
          id: id, 
          type:type,
      },
      success: function(data) {
         $('.permission-list').empty();
         $('.role-name').empty();
        $('#exampleModal1 .role-name').text(data.role.name);
        let permissions=[];
        $.each(data.rolepermission,function(index, permission){
          permissions.push(permission.name);
        });
         $('.permission-list').append(`<li class="per_app">`+permissions+`</li>`);
      }
    });

  })
   $(document).on('click','.editrole',function(e){
    e.preventDefault();
     var id = $(this).data('id');
     var name = $(this).data('rolename');
      var type ='edit';
    $.ajax({
      url:config.routes.roleshow,
      type: "get", 
      data: {  
          id: id, 
          type:type,
      },
      success: function(data) {
        //$('#roleedit').find('#name').val(data.role.name);
      //   myArray = new Array("php", "tutor");
      // if( $.inArray("php", myArray) !== -1 ) {

      //     //console.log('found');
      // }
      $('#roleedit').find('#name').val(name);
      $('.permissionlistapp').html(data);
        //console.log(data);
      }
    });
  })