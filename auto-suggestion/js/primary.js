$(document).ready(function() {
    $('#city').keyup(function() {
        var _that = $(this);
        var searchText = $(this).val();

        $.post('ajax/search.php', { search_term: searchText }, function(data) {
            $("#result").html(data);
            $("#result >a").click(function(event) {
                event.preventDefault();
                var _this = $(this);
                var txt = _this.find('h4').text();

                _that.val(txt);
                _this.parent().empty();
            });
        });
    });
});