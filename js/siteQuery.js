
$(function(){
  $('#build').click(function()
  {
    if($.isNumeric($('#areaX').val()) && $.isNumeric($('#areaY').val()))
    {
      areaX = areaY = 0;
      areaX=parseInt($('#areaX').val());
      areaY=parseInt($('#areaY').val());
      if((areaX<0 ||areaX>maxX)||(areaY<0 || areaY>maxY)) alert( "Input Out of Bound. ")
      else if($.isNumeric($('#intialX').val()) && $.isNumeric($('#intialY').val()) ) alert( "Initial value must be a number." );
      else
      {
        $('#areaX,#areaY').prop('disabled', true); 
        $('#build').prop('disabled', true);
        
        // Start moving the robot
        moveRobot();
      }      
    }
    else alert("Non-Numeric Input Not Allowed. ");
    return false;
  });
  
  //
  $(document).on('click', '#btn--add', function(e){
    e.preventDefault();
    var controlForm = $('.repetitive__input:first'),
        currentDiv = $('.repetitive__container:first'),
        newEntry = $(controlForm.clone()).appendTo(currentDiv);

        newEntry.find('input').val('');
    })
})