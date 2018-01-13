

// ----------------------------------------------------------------------
// reset form classroom modal 1
$('#Modal1').on('hidden.bs.modal', function (e) {
  $('#error').hide();
  $(this)
    .find("input")
       .val('')
       .end()
});

// ----------------------------------------------------------------------
// reset form classroom modal 2
$('#Modal2').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input")
       .val('')
       .end()
});


// ----------------------------------------------------------------------
// Disabled till nothing filled in modal 1 form
var $input = $('#text');
var $button = $('#finish_button');

setInterval(function(){
if($input.val().length > 0 ){
    $button.attr('disabled', false);

}else{
  $button.attr('disabled', true);

}
}, 100);

// Disabled till nothing filled in modal 1 form
var $input = $('#text1');
var $button = $('#finish_button');

setInterval(function(){
if($input.val().length > 0 ){
    $button.attr('disabled', false);

}else{
  $button.attr('disabled', true);

}
}, 100);


// ----------------------------------------------------------------------
// Create new classroom
$(function(){

  $('#start_button').click(function()
  {

    //inserting claas name and program name
    //---------------------------------------------
    var class_name=$('#text').val().toUpperCase();
    var program_name=$('#selected').val();


  });

  $('#finish_button').click(function() {
     $(".card_body").clone().appendTo(".clonecontainer");
     // window.location="classroom.php";
  });
});




// ----------------------------------------------------------------------
// Fetching Classroom
$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();


//destroying cookie while logout
  $('#logout').click(function() {
    document.cookie ='token=; expires=Thu, 01 Jan 1970 00:00:00 GMT;';
    window.location="index.php";
  });


});
