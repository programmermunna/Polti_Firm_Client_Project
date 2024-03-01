$(document).ready(function(){
    $('#shedId').on('click', function(){
        var shedId = $(this).val();
        $.ajax({
            url: '/get/shed/cows/' + shedId,
            type: 'GET',
            success: function(response){
                console.log(response);
                var cows = response;
                $('#cowId').empty();
                $('#cowId').append('<option value="">Select</option>');
                $.each(cows, function(index, cow){
                    $('#cowId').append('<option value="' + cow.id + '">' + cow.tag + '</option>');
                });
            },
            error: function(error){
                console.log(error);
            }
        });
    });

    $('.feedBtn').on('click', function(){
        var ID = $(this).data('id');

        if(ID != null){
            $.ajax({
                url: '/get/cow/feed/' + ID,
                type: 'GET',
                success: function(response){
                    console.log(response);
                    showFeedModal(response.feeds);
                },
                error: function(error){
                    console.log(error);
                }
            });
        }else{
            alert('Please select an ID');
        }
    });

    function showFeedModal(feeds) {
        $('#feedModal .modal-body ul').empty();

        feeds.forEach(function(feed) {
            $('#feedModal .modal-body ul').append('<li>' + feed.food.name + ' : ' + feed.food_quantity + '-' + feed.unit.name + '</li>');
        });

        $('#feedModal').modal('show');
    }
});
