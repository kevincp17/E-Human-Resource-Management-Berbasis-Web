$(document).ready(function() {
    $( "#name" ).autocomplete({

        source: function(request, response) {
            $.ajax({
                url: "{{ route('autocomplete.fetch') }}",
                data: {
                    term : request.term
                },
                dataType: "json",
                success: function(data){
                    var resp = $.map(data,function(obj){
                        return obj.name;
                    });

                    response(resp);
                }
            });
        },
        minLength: 2
    });
});
