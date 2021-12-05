$(document).ready(function () {
    function fetch_data(query) {
        $.ajax({
            url:"/employee/fetch_users_data?query="+query,
            success: function (data) {
                $('#fetch_users_data').html('');
                $('#fetch_users_data').html(data);
            }
        });
    }

    $(document).on('keyup', '#search', function () {
        var query = $('#search').val();
        fetch_data(query);
    });
});
