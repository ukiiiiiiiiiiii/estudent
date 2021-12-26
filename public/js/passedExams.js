$(document).ready(function () {
    function fetch_data(query, program_id) {
        $.ajax({
            url:"/employee/fetch_passedExams_data?query="+query,
            success: function (data) {
                $('#fetch_passedExams_data').html('');
                $('#fetch_passedExams_data').html(data);
            }
        });
    }

    $(document).on('keyup', '#search', function () {
        var query = $('#search').val();
        fetch_data(query);
    });
});
