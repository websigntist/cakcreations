<?php /*include('include/header.php'); */?><!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                $.ajax({
                    url: site_url + '/page/get_results',
                    method: 'POST',
                    data: {query: query},
                    success: function (data) {
                        $('#result').html(data);
                    }
                });
            } else {
                $('#result').html('');
            }
        });
    });
</script>

<input type="text" id="search" placeholder="Enter search term"/>
<div id="result"></div>


--><?php /*include('include/footer.php'); */?>
