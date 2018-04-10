//Dashboard

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

//tooltip

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

// Star raiting
$(
  function () {
    $('.li-config').on('click', function() {
      var selectedCssClass = 'selected';
      var $this = $(this);
      $this.siblings('.' + selectedCssClass).removeClass(selectedCssClass);
      $this
      .addClass(selectedCssClass)
      .parent().addClass('vote-cast');
  });
}
);

// Flip card

$(document).ready(function () {
  $('.flipButton').bind("click", function() {
    $(this).next().toggleClass('hover');
})
});



/* Checkbox panel professional */

$('.checkbox-wrapper').on('click', function() {

  $(this).toggleClass('checked');

  if ($(this).hasClass('checked')) {
    $('input[type="checkbox"]', this).prop('checked', true);
} else {
    $('input[type="checkbox"]', this).prop('checked', false);
}

})

/* textarea panel profesional add query */

$(document).ready(function(){
    $("#show-textarea").click(function(){
        $("#textarea-edit").slideDown("fast");
    });
    $("#show-textarea1").click(function(){
        $("#textarea-edit").slideUp("fast");
    });
});


$(document).ready(function(){
    $("#show-question3").click(function(){
        $("#show-question").slideDown("fast");
    });
    $("#show-question2").click(function(){
        $("#show-question").slideUp("fast");
    });
});


$(document).ready(function(){
    $("#show-question7").click(function(){
        $("#test-laboratory").slideDown("fast");
    });
    $("#show-question6").click(function(){
        $("#test-laboratory").slideUp("fast");
    });
});

/* register medic step 3*/


$(document).ready(function(){
    $("#show-question5").click(function(){
        $("#panel-insurance").slideDown("fast");
    });
    $("#show-question4").click(function(){
        $("#panel-insurance").slideUp("fast");
    });
});
