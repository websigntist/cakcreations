(function ($) {
    $(document).ready(function () {

        /* agree with terms and condition on checkout form */
        $('#agreement').submit(function (event) {
            if ($('#termsCond').is(':checked') == false) {
                event.preventDefault();
                $.notify('Please check the box that you are agree with all Terms & Conditions.', {type: 'danger'});
                return false;
            }
        });

        /* auto hide div */
        setTimeout(function() {
            $('#msg_hide').fadeOut('fast');
        }, 3000); // <-- time in milliseconds

        /* ajax live search */
        $('#live_search').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: site_url + '/page/get_results',
                    method: 'POST',
                    data: {query: query},
                    success: function (data) {
                        $('#live_search_result').html(data);
                    }
                });
            } else {
                $('#live_search_result').html('');
            }
        });


    });
})(jQuery)