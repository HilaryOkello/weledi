 $(document).ready(function(){

 var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
 removeItemButton: true,
 maxItemCount:100,
 searchResultLimit:5,
 renderChoiceLimit:5
 });


 });

$('.deposit').click(function(e){
    e.preventDefault();
    var baseUrl = $(this).attr('baseUrl');
    $.get(baseUrl+'/deposit/deposit',function(data){
        $('#deposit').modal('show')
             .find('#depositContent')
             .html(data);
});
});