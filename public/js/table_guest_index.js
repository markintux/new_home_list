$(document).ready(function() {
    $('#guestsTable').DataTable({});

    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        var confirmed = confirm('Are you sure you want to delete this guest?');
        if(confirmed){
            this.submit();
        }
    });
});