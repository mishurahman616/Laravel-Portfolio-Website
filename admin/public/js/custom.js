$(document).on('click', '#addNewServiceButton', function () {
    $('#addServiceModal').modal('show');
});

$(document).on('click', '#serviceAddConfirmation', function (event) {
    var title = $('#addServiceTitle').val();
    var desc = $('#addServiceDesc').val();
    var image = $('#addServiceImage').val();
    addService(title, desc, image);

});

function addService( title, desc, image) {
    if(title.trim().length==0){
        toastr.error("Title should not be empty");
    }else if(desc.trim().length==0){
        toastr.error("Description should not be empty");
    }else if(image.trim().length < 10){
        toastr.error("Image Link error");
    }else{
         //changing the text of Edit button to a loading icon
        $('#serviceAddConfirmation').html("<div class='spinner-border text-light' role='status'></div>");
  
        axios.post('/addService', {title: title, desc: desc, image: image }).then(function (response) {
            if(response.status==200){
                if (response.data == 1) {
                    $('#serviceAddForm :input').val('');

                    $('#addServiceModal').modal('hide');

                    /* A toastr message. */
                    toastr.success('Service Added Successfully');
                   
                    /* A function that is used to get all the services from database and show them in the table. */
                    getServiceData();
                } else {
                    $('#addServiceModal').modal('hide');

                    /* A toastr message. */
                    toastr.error('Service Add Fail.');
                    /* A function that is used to get all the services from database and show them in the table. */
                    getServiceData();
                }
            }else{
                $('#addServiceModal').modal('hide');

                /* A toastr message. */
                toastr.error('Service Add Fail.');
            }
        }).catch(function (error) {
            $('#addServiceModal').modal('hide');

            toastr.error('Something went wrong.');
    
        });

        //changing the loading icon of Edit button to text Save
        $('#serviceAddConfirmation').html("Save");
    }
    
}