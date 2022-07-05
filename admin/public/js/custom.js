/* A jQuery function that is used to make sure that the HTML document is fully loaded before running
the script. */
$(document).ready(function () {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


/**
 * It gets service data from the database and displays it in a table.
 */
function getServiceData() {
    axios.get('/getServiceData')
        .then(function (response) {
            if (response.status == 200) {
                var services = response.data;
                $('#service-table-body').empty();
                $.each(services, function (i, item) {
                    $('#service-table-body').append($('<tr>').html(
                        /*"+services[i].service_image+"*/
                        "<td>" + i + "</td>" +
                        "<td><img class='table_img' src=" + services[i].service_image + "></td>" +
                        "<td>" + item.service_title + "</td>" +
                        "<td>" + item.service_desc + "</td>" +
                        "<td><a ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a data-id=" + item.id + " data-title='" + item.service_title + "' class='deleteService'><i class='fas fa-trash-alt'></i></a></td>"
                    ));
                });
                /*If data comes from database, hiding the loader and error message and showing the table. */
                $('#service-table-main').removeClass('d-none');
                $('#service-table-loader').addClass('d-none');
                $('#service-table-fail').addClass('d-none');

            /* A jQuery function that is used to delete a service using modal. When click on deleteService class i.e. delete icon, modal opens */
                $('.deleteService').click(function () {
                    var id = $(this).data('id');
                    var title = $(this).data('title');
                    $('#deleteTitle').html(title);
                    $('#serviceDeleteConfirmation').attr('data-id', id);
                    $('#deleteModal').modal('show');
                });
                
                /* A jQuery function that is used to delete a service using modal. When click
                serviceDeleteConfirmation class, Request sends to database using axios. */
                $('#serviceDeleteConfirmation').click(function () {
                    var id = $('#serviceDeleteConfirmation').attr('data-id');
                    $('#deleteModal').modal('hide');

                    deleteSevice(id);
                });
            } else {
                /* If data not loaded then hiding the table and showing the error message. */
                $('#service-table-main').addClass('d-none');
                $('#service-table-main').addClass('d-none');
                $('#service-table-fail').removeClass('d-none');
            }

        })
        .catch(function (error) {
            /* If error occured then hiding the table and showing the error message. */
            $('#service-table-main').addClass('d-none');
            $('#service-table-main').addClass('d-none');
            $('#service-table-fail').removeClass('d-none');
        });
};


/**
 * It's a function that takes an id as a parameter, and then it makes an axios post request to the
 * server, and then delete the service with the id.
 * @param id - id
 */
function deleteSevice(id) {
    axios.post('/deleteService', { id: id }).then(function (response) {
        if (response.data == 1) {
            toastr.info('Successfully deleted');
            getServiceData();
        } else {
            toastr.error('Cannot delete.');
            getServiceData();
        }
    }).catch(function (error) {
        console.log(error.message.data);

    });
}
/*
function test(){
    console.log("This is text message");
};
*/