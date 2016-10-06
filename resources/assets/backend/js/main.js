
$(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".editorBootstrap").wysihtml5();

    // Datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format : 'dd/mm/yyyy'
    });

    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false
    });

    // Overwrite the default Alert System Function
    window.alert = function(message) {
        bootbox.alert(message);
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });


    //delete item and remove it from list
    $('.confirm-delete').click(function(){
        var messageData=$(this).attr('data-message');
        var element_id = $(this).attr('data-id');
        var element_path = $(this).attr('data-element');


      //  console.log(element_id+ ' '+element_path);

        bootbox.confirm(messageData, function(confirmed) {
            if(confirmed){

                $.ajax({
                    type: 'POST',
                    data: {_method: 'DELETE', id: element_id},
                    url: element_path,
                    success: function (data) {
                        //remove row from table
                        if($('#tr-'+element_id).length){
                            $('#tr-'+element_id).fadeOut();
                        }
                    },
                    error: function (data) {

                        console.log(data.status);
                        if(data.status=403)
                        alert('403 - Access forbidden');
                    }
                });
            }
        });

    });


});
