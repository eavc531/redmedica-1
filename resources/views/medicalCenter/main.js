$(document).ready(function(){
    $("#show").click(function(){
        $("#dashboard").fadeToggle(200);
    });
	$("#filter").click(function(){
	    $("#panel").slideToggle(200);
	});
});

$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});


/* Jquery */

$('#tooltip').tooltip(options)
