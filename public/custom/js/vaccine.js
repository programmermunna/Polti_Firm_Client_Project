$(document).ready(function(){
    $('.vaccineBtn').on('click', function(){

        var ID = $(this).data('id');

        if(ID != null){
            $.ajax({
                url: '/get/cow/vaccine/' + ID,
                type: 'GET',
                success: function(response){
                    console.log(response);
                    showVaccineModal(response.vaccines);
                },
                error: function(error){
                    console.log(error);
                }
            });
        }else{
            alert('Please select an ID');
        }
    });

    function showVaccineModal(vaccines) {
        $('#showVaccineModal .modal-body ul').empty();

        vaccines.forEach(function(vaccines) {
            $('#showVaccineModal .modal-body ul').append('<li>' + vaccines.vaccine.name + ' : ' + vaccines.remarks + '</li>');
        });

        $('#showVaccineModal').modal('show');
    }
});
