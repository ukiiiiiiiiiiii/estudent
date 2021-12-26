$(document).ready(function () {
    function fetch_data(query, program_id) {
        $.ajax({
            url:"/employee/showRegisteredExams2/"+program_id+"/fetch_registeredExams2_data?query="+query,
            success: function (data) {
                $('#fetch_registeredExams2_data').html('');
                $('#fetch_registeredExams2_data').html(data);
            }
        });
    }

    $(document).on('keyup', '#search', function () {
        var query = $('#search').val();
        var program_id = $('#program_id').val();
        fetch_data(query, program_id);
    });
});
