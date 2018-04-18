//Dashboard

$(document).ready(function(){
  $("#show").click(function(){
    // $("#dashboard").fadeToggle(200);
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

/* textarea panel profesional general */

/* Add query */

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

$(document).ready(function(){
    $("#show-question9").click(function(){
        $("#diagnosis").slideDown("fast");
    });
    $("#show-question8").click(function(){
        $("#diagnosis").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#show-question2").click(function(){
        $("#panel-insurance").slideDown("fast");
    });
    $("#show-question1").click(function(){
        $("#panel-insurance").slideUp("fast");
    });
});

/* note emergencies */

$(document).ready(function(){
    $("#open2").click(function(){
        $("#open01").slideDown("fast");
    });
    $("#open1").click(function(){
        $("#open01").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open4").click(function(){
        $("#open02").slideDown("fast");
    });
    $("#open3").click(function(){
        $("#open02").slideUp("fast");
    });
});


$(document).ready(function(){
    $("#open6").click(function(){
        $("#open03").slideDown("fast");
    });
    $("#open5").click(function(){
        $("#open03").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open8").click(function(){
        $("#open04").slideDown("fast");
    });
    $("#open7").click(function(){
        $("#open04").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open10").click(function(){
        $("#open05").slideDown("fast");
    });
    $("#open9").click(function(){
        $("#open05").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open12").click(function(){
        $("#open06").slideDown("fast");
    });
    $("#open11").click(function(){
        $("#open06").slideUp("fast");
    });
});
