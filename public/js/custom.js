
/* sidenav starts here */
function getData()
{
  alert('hello');
  /* 
  $.post(url_getHostelData,{hostelId:hostelId, _token:token}, function(data){
    alert(data);
  }); */
}
function openNav() 
{
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("data").style.display = "none";
}
  
  function closeNav() 
  {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("data").style.display = "block";
  }

  /**
   * Add room fields
   */
  function test()
  {
    document.getElementById('myForm').style.display = 'none';
  }

  function hideAddRoomFields()
  {
    var x = document.getElementById('myForm');
    var y = document.getElementById('myBtn');
    
    if(x.style.display === 'none')
    {
      x.style.display = 'block';
      y.nodeValue = 'Hide'
    }
    else if(x.style.display === 'block')
    {
      x.style.display = 'none';
      y.nodeValue = 'Show';
    }

    if(y.nodeValue === 'Show')
    {
      y.innerText = 'Hide';
    }
    else if(y.nodeValue === 'Hide')
    {
      y.innerText = 'Show';
    }
  }

  
  /**
   * This method displays the edit mess menu form
   */
  function showEditMessForm(id)
  {
    $.post(url,{id:id});
  }



  /**
   * This method is called when the window is loaded
   */

  $(document).ready(function() 
  {
     $('#breakfast').hide();
     $('#lunch').hide();
     $('#dinner').hide();
     $('#registerQuery').hide();

     // hiding hostelregistration hostel information form
     //$('#hostelInformation').hide();
     // hiding the hostel information form
     $('#hostelFacilities').hide();
    // hiding the hostel information2 form
    $('#hostelInformation2').hide();
    // hiding hostel information save button
    $('#saveBtn').hide();
    // hiding the save hostel image button
    $('#submitHostelImageBtn').hide();
    // hiding hostel manager delete alert
    $('#hostelManagerDeleteAlert').hide();
    // hiding the hostel room delete alert
    $('#hostelRoomDeleteAlert').hide();
    // hiding the remaining rules
    $('#showRules').hide();

    // hiding manage room data
    $('#addHostellerForm').hide();

    // hiding hostel images at hostelimformation
    $('#hostelImages').hide();

    // uer registration
    $('#validateUserRegistrationBtn').hide();

    // hiding add hostel image form
    $('#addHostelImageForm').hide();

    // hiding the dues save button
    $('#duesSaveBtn').hide();
    $('#duesSave2Btn').hide();
    $('#payableAmountLessDiv').hide();
    $('#payableAmountMoreDiv').hide();

    // update booking
    $('#updateBookingForm').hide();
    $('#cancelBookingAlert').hide();

    // hostel info
    $('#deleteHostelAlert').hide();

    // loader
    $('#myLoader').hide();

    // edit profile
    $('#deleteAccountAlert').hide();

    // check room availability
    $('#checkAvailabilityCloseBtn').hide();

    // hostel manager leave
    $('#hostelManagerLeaveYesBtn').hide();

    var hostelDuesUserId = $('input[name = hostelDuesUserId]').val();
    $('#hostelDuesHostellerName').val(hostelDuesUserId);


     $('#breakfastBtn').click(function(){
        $('#breakfast').show();
        $('#lunch').hide();
        $('#dinner').hide();
        $('#success').hide();
     });

     $('#lunchBtn').click(function(){
      $('#breakfast').hide();
      $('#lunch').show();
      $('#dinner').hide();
      $('#success').hide();
   });

   $('#dinnerBtn').click(function(){
      $('#breakfast').hide();
      $('#lunch').hide();
      $('#dinner').show();
      $('#success').hide();
   });
  /**
   * onclick method of registerd and my Queries
   */
  $('#myQueryShow').click(function(){
    $('#registerQuery').show();
  });

  function show()
  {
    $('#registerQuery').show();
  }


  $('#addLunchMenuBtn').click(function(){
    $('#lunch').show();
  });

   });
/* sidenav ends here */

/**
 * AJAX REQUESTS
 */
/**
 * This methods ajax request to update room facilities
 */
/**
 * This method gets the query replies
 */

 // ********************************** Query **********************************************
    /*
      This method validate the query and send to the controller through ajax request
    */
   /**
    * Query Registration
    */
    $('#registerQueryBtn').click(function(){

        var hostelId = $('input[name = hostelId]').val();
        var userId = $('input[name = userId]').val();
        var query = $('textarea[name = query]').val();
        var token = $('input[name = token]').val();
        var message = '<div class="alert alert-success mt-5" role="alert">Query is successfully registered, hope soon  you will get a reply</div>';
        var error = false;
        
        if(query == '')
        {
            $('#querySpan').html('Please enter query');
            error = true;
        }
        else
        {
          if(isNaN(query))
          {
            if(query.length < 10)
            {
              $('#querySpan').html('Query should contain atleast 10 characters');
              error = true;
            }
            else
            {
              $('#querySpan').html('');
            }
          }
          else
          {
            $('#querySpan').html('Query should not contain only digits');
            error = true;
          }
        }
        
        if(!error)
        {
          // creating a json array
          myQuery = {
            'hostelId': hostelId,
            'userId':userId,
            'query':query
          }

          $.post(url_registerQuery, {myQuery:myQuery, _token:token}, function(data){
              $('#que').val('');
              $('#success').html(message);
          });  
        }
    
    });

/**
 * update query method
 */
$('#editQueryBtn').click(function(){
    
    var query = $('textarea[name = query]').val();
    var queryId = $('input[name = queryId]').val();
    var message = '<div class="alert alert-danger mt-5" role="alert">Query updated successfully</div>';
    var token = $('input[name = token]').val();
    var error = false;
    
    if(query === '')
    {
        $('#querySpan').html('Please enter query');
    }
    else
    {
      if(isNaN(query))
      {
        if(query.length < 10)
        {
          $('#querySpan').html('Query should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#querySpan').html('');
        }
      }
      else
      {
        $('#querySpan').html('Query should not contain only digits');
        error = true;
      }
    }

    if(!error)
    {
      myQuery = {
        'queryId':queryId,
        'query':query
      }
      $.post(url_updateQuery, {myQuery:myQuery, _token:token}, function(data){
          $('textarea[name = query]').val('');
          $('#success').html(message);
        });
    }
});

/**
 * Replying query
 */
$('#queryReplyBtn').click(function(){

  var reply = $('textarea[name = reply]').val();
  var queryId = $('input[name = queryId]').val();
  var message = '<div class="alert alert-danger mt-5" role="alert">Reply sent succesfully</div>';
  var token = $('input[name = token]').val();
  var error = false;

  if(reply === '')
  {
      $('#replySpan').html('Please enter reply');
      error = true;
  }
  else
  {
    if(isNaN(reply))
    {
      if(reply.length < 10)
      {
        $('#replySpan').html('Reply should contain minimum 10 characters');
        error = true;
      }
      else
      {
        $('#replySpan').html('');
      }
    }
    else
    {
      $('#replySpan').html('Reply should contain character also');
      error = true;
    }
  }
  
  if(!error)
  {

    $('#myLoader').show();
    // creating jason array
    queryReply = {
      'queryId':queryId,
      'reply':reply
    }

    $.post(url_replyQuery, {queryReply:queryReply, _token:token}, function(data){
        $('#myLoader').hide();
        $('textarea').val('');
        $('#success').html(message);
      });
  }

});

/**
 * get query reply
 */
function getQueryReply(id)
{
  var queryId = id;
  var token = $('input[name = token]').val();
  var message = '<h4 class="pt-3">Reply</h4>';

  $.post(url_getQueryReply, { queryId:queryId,  _token:token }, function(data){
      $('#reply').html(message+data);
      $('#reply').show();
   });
}
/**
 * User Registration
 
$('#validateUserRegistrationBtn').click(function(){

  var email = $('input[name = email]').val();
  var name = $('input[name = name]').val();
  var password = $('input[name = password]').val();
  var conPassword = $('input[name = password_confirmation]').val();
  var token = $('input[name = token]').val();
  var error = false;
  if(email == "")
  {
    $('#emailSpan').html('enter email address');
    error = true;
  }
  if(name == "")
  {
    $('#nameSpan').html('enter name');
    error = true;
  }
  if(password == "")
  {
    $('#emailSpan').html('enter email address');
    error = true;
  }
  if(conPassword == "")
  {
    $('#conSpan').html('enter confirmation password');
    error = true;
  }
  
  if(!error)
  {

    $.post(url_validateUser, { email:email,  _token:token }, function(data){
      
      if(data == 1)
      {
        $('#success').html('<div class="alert alert-danger mt-3" role="alert">user with that email already exist, please try another one</div>');
      }
      else
      {
        $('#emailSpan').html('');
        $('#emailSpan').html('');
        $('#nameSpan').html('');
        $('#conSpan').html('');
        $('#userRegisterBtn').show();
      }
      
   });
  }
});*/

$('#userRegisterBtn').click(function(){
  $('#myLoader').show();
});

// ********************************** Review ***********************************************
  /*
    This method stores review into the database
  */
  $(".btnrating").on('click',(function(e) {
        
    var previous_value = $("#selected_rating").val();
    var selected_value = $(this).attr("data-attr");
    $("#selected_rating").val(selected_value);
    
    $(".selected-rating").empty();
    $(".selected-rating").html(selected_value);
    
    for (i = 1; i <= selected_value; ++i) 
    {
      $("#rating-star-"+i).toggleClass('btn-warning');
      $("#rating-star-"+i).toggleClass('btn-default');
    }
    
    for (ix = 1; ix <= previous_value; ++ix) 
    {
      $("#rating-star-"+ix).toggleClass('btn-warning');
      $("#rating-star-"+ix).toggleClass('btn-default');
    }
  }));

  function registerReview()
  {
      var rating = $('input[name = selected_rating]').val();
      var hostelId = $('input[name = hostelId]').val();
      var userId = $('input[name = userId]').val();
      var review = $('textarea[name = review]').val();
      var token = $('input[name = token]').val();
      var error = false;
      
      if(rating == '')
      {
        $('#ratingSpan').html('Please rate hostel');
        error = true;
      }
      else
      {
        $('#ratingSpan').html('');
      }

      if(review === '')
      {
          $('#reviewSpan').html('Please enter review');
          error = true;
      }
      else
      {
        if(isNaN(review))
        {
          if(review.length < 10)
          {
            $('#reviewSpan').html('Review should contain atleast 10 characters');
            error = true;
          }
          else
          {
            $('#reviewSpan').html('');
          }
        }
        else
        {
          $('#reviewSpan').html('Review should not be only digist');
          error = true;
        }
      }
      
      if(!error) 
      {
        reviewData = {
          'hostelId':hostelId,
          'userId':userId,
          'rating':rating,
          'review':review
        }

        $.post(url_registerHostelReview, {reviewData:reviewData, _token:token}, function(data){
          $('textarea').val('');
          $('#successMessage').html(data);
        });  
      } 
  }

  /**
   * This method sends ajax request to the update review 
   * method of controller
   */
  function updateReview()
  {
      var rating = $('input[name = selected_rating]').val();
      var review = $('textarea[name = review]').val();
      var reviewId = $('input[name = reviewId]').val();
      var token = $('input[name = token]').val();
      var message = '<div class="alert alert-danger" role="alert">Review updated successfully</div>';
      var error = false;

      if(review === '')
      {
          $('#reviewSpan').html('Please enter review');
          error = true;
      }
      else
      {
        if(isNaN(review))
        {
          if(review.length < 10)
          {
            $('#reviewSpan').html('Review should contain atleast 10 characters');
            error = true;
          }
          else
          {
            $('#reviewSpan').html('');
          }
        }
        else
        {
          $('#reviewSpan').html('Review should not be only digist');
          error = true;
        }
      }

      if(rating === '')
      {
          $('#ratingSpan').html('Please rate the hostel');
          error = true;
      }
      else
      {
        $('#ratingSpan').html('');
      }
     
      if(!error)
      {
        reviewData = {
          'reviewId':reviewId,
          'rating':rating,
          'review': review
        }

          $.post(url_updateReview, {reviewData:reviewData, _token:token}, function(data){
              $('#success').html(message);
           });
      }
  }

// ********************************** Complaint ***********************************
/**
 * Complaint registration
 */
$('#registerComplaintBtn').click(function(){
  
  var hostelId = $('input[name = hostelId]').val();
  var userId = $('input[name = userId]').val();
  var complaint = $('textarea[name = complaint]').val();
  var token = $('input[name = token]').val();
  var message = '<div class="alert alert-success mt-5" role="alert">Complaint is successfully registered</div>';
  var error = false;
 

  if(complaint === '')
  {
    $('#complaintSpan').html('Please enter complaint');
    error = true;
  }
  else
  {
    if(isNaN(complaint))
    {
      if(complaint.length < 10)
      {
        $('#complaintSpan').html('Complaint should contain atleast ten characters');
        error = true;
      }
      else
      {
        $('#complaintSpan').html('');
      }
    }
    else
    {
      $('#complaintSpan').html('Complaint should not contain only digits');
      error = true;
    }
  }

  if(!error)
  {
     // creating a json array
    myComplaint = {
      'hostelId':hostelId,
      'userId':userId,
      'complaint':complaint
    }

    $.post(url_registerComplaint,{myComplaint:myComplaint, _token:token}, function(data){
      $('textarea').val('');
      $('#success').html(message);
    });  
  }

});

// UPDATE COMPLAINT
$('#editComplaintBtn').click(function(){

  var complaint = $('textarea[name = complaint]').val();
  var complaintId = $('input[name = complaintId]').val();
  var message = '<div class="alert alert-danger mt-5" role="alert">Complaint updated successfully</div>';
  var token = $('input[name = token]').val();

  if(complaint === '')
  {
      $('#complaintSpan').html('Please enter complaint');
  }
  else
  {
    if(isNaN(complaint))
    {
      if(complaint.length < 10)
      {
        $('#complaintSpan').html('Complaint should contain atleast ten characters');
        error = true;
      }
      else
      {
        $('#complaintSpan').html('');
      }
    }
    else
    {
      $('#complaintSpan').html('Complaint should not contain only digits');
      error = true;
    }
  }

  if(!error)
  {
    // creating json array
    myComplaint = {
      'complaintId':complaintId,
      'complaint':complaint
    }

    $.post(url_editComplaint, {myComplaint:myComplaint, _token:token}, function(data){
        $('textarea[name = complaint]').val('');
        $('#success').html(message);
      });
  }

});

// GETTING COMPLAINT REPLY
function getComplaintReply(id)
{
  var message = '<h4 class="pt-3">Reply</h4>';
  var token = $('input[name = token]').val();
  var complaintId = id;
  $.post(url_getComplaintReply, {complaintId:complaintId, _token:token}, function(data){
    $('#reply').html(message+data);
    $('#reply').show();
  });
}

$('#replyComplaintBtn').click(function(){

  var message = '<div class="alert alert-danger mt-2" role="alert">Reply is sent successfully</div>';
  var reply = $('textarea[name = reply]').val();
  var complaintId = $('input[name = complaintId]').val();
  var token = $('input[name = token]').val();
  var error =false;

  if(reply == "")
  {
    $('#replySpan').html('Please enter complaint reply');
    error = true;
  }
  else
  {
    if(isNaN(reply))
    {
      if(reply.length < 10)
      {
        $('#replySpan').html('Reply should contain atleast 10 characters');
        error = true;
      }
      else
      {
        $('#replySpan').html('');
      }
    }
    else
    {
      $('#replySpan').html('Reply should not be a number');
      error = true;
    }
  }

  if(!error)
  {
    $('#myLoader').show();
    replyData = {
      'complaintId':complaintId,
      'reply':reply
    }

    $.post(url_replyComplaint, {replyData:replyData, _token:token}, function(data){
      $('#myLoader').hide();
      $('textarea').val('');
      $('#success').html(message);
    });

  }

});

 // ************************************** USERS ****************************************************
// displaying the delete hostel manager alert message
$('#hostelManagerRemoveBtn').click(function(){

  $('#hostelManagerDeleteAlert').show();
});

// hiding again the delete alert message
$('#hostelManagerDeleteAlertNo').click(function(){

  $('#hostelManagerDeleteAlert').hide();
});

 // ********************************** Room ****************************************************
// showing the hostel room delete alert
$('#hostelRoomRemoveBtn').click(function(){
  $('#hostelRoomDeleteAlert').show();
  $('#addHostellerForm').hide();
});

// hiding the room delete alert
$('#hostelRoomDeleteAlertNo').click(function()
{
  $('#hostelRoomDeleteAlert').hide();
});

  // ********************************** Rules *****************************************
 // showing the remaining rules
 $('#showMoreRulesBtn').click(function(){
   $('#showMoreRulesBtn').hide();
   $('#showRules').show();
 });
  $('#addRuleBtn').click(function(){
    
    var rule1 = $('textarea[name = rule1]').val();
    var rule2 = $('textarea[name = rule2]').val();
    var rule3 = $('textarea[name = rule3]').val();
    var rule4 = $('textarea[name = rule4]').val();
    var rule5 = $('textarea[name = rule5]').val();
    var rule6 = $('textarea[name = rule6]').val();
    var rule7 = $('textarea[name = rule7]').val();
    var rule8 = $('textarea[name = rule8]').val();
    var rule9 = $('textarea[name = rule9]').val();
    var rule10 = $('textarea[name = rule10]').val();
    var rule11 = $('textarea[name = rule11]').val();
    var rule12 = $('textarea[name = rule12]').val();
    var rule13 = $('textarea[name = rule13]').val();
    var rule14 = $('textarea[name = rule14]').val();
    var rule15 = $('textarea[name = rule15]').val();
    var message = '<div class="alert alert-success mt-3" role="alert">Rules successfully added</div>';
    var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
    var token = $('input[name = token]').val();
    var hostelId = $('input[name = hostelId]').val();
    var error = false;
    var entered = false;

    if(rule1 != '')
    {
      if(isNaN(rule1))
      {
        if(rule1.length < 10)
        {
          $('#rule1Span').html('Rule 1 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule1Span').html('');
        }
      }
      else
      {
        $('#rule1Span').html('Rule 1 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule2 != '')
    {
      if(isNaN(rule2))
      {
        if(rule2.length < 10)
        {
          $('#rule2Span').html('Rule 2 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule2Span').html('');
        }
      }
      else
      {
        $('#rule2Span').html('Rule 2 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule3 != '')
    {
      if(isNaN(rule3))
      {
        if(rule3.length < 10)
        {
          $('#rule3Span').html('Rule 3 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule3Span').html('');
        }
      }
      else
      {
        $('#rule3Span').html('Rule 3 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule4 != '')
    {
      if(isNaN(rule4))
      {
        if(rule4.length < 10)
        {
          $('#rule4Span').html('Rule 4 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule4Span').html('');
        }
      }
      else
      {
        $('#rule4Span').html('Rule 4 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule5 != '')
    {
      if(isNaN(rule5))
      {
        if(rule5.length < 10)
        {
          $('#rule5Span').html('Rule 5 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule5Span').html('');
        }
      }
      else
      {
        $('#rule5Span').html('Rule 5 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule6 != '')
    {
      if(isNaN(rule6))
      {
        if(rule6.length < 10)
        {
          $('#rule6Span').html('Rule 6 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule6Span').html('');
        }
      }
      else
      {
        $('#rule6Span').html('Rule 6 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule7 != '')
    {
      if(isNaN(rule7))
      {
        if(rule7.length < 10)
        {
          $('#rule7Span').html('Rule 7 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule7Span').html('');
        }
      }
      else
      {
        $('#rule7Span').html('Rule 7 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule8 != '')
    {
      if(isNaN(rule8))
      {
        if(rule8.length < 10)
        {
          $('#rule8Span').html('Rule 8 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule8Span').html('');
        }
      }
      else
      {
        $('#rule8Span').html('Rule 8 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule9 != '')
    {
      if(isNaN(rule9))
      {
        if(rule9.length < 10)
        {
          $('#rule9Span').html('Rule 9 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule9Span').html('');
        }
      }
      else
      {
        $('#rule9Span').html('Rule 9 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule10 != '')
    {
      if(isNaN(rule10))
      {
        if(rule10.length < 10)
        {
          $('#rule10Span').html('Rule 10 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule10Span').html('');
        }
      }
      else
      {
        $('#rule10Span').html('Rule 10 should not contain only numbers');
        error = true;
      }
      entered = true;
    } 

    if(rule11 != '')
    {
      if(isNaN(rule11))
      {
        if(rule11.length < 10)
        {
          $('#rule11Span').html('Rule 11 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule11Span').html('');
        }
      }
      else
      {
        $('#rule11Span').html('Rule 11 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule12 != '')
    {
      if(isNaN(rule12))
      {
        if(rule12.length < 10)
        {
          $('#rul2e1Span').html('Rule 12 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule12Span').html('');
        }
      }
      else
      {
        $('#rule12Span').html('Rule 12 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule13 != '')
    {
      if(isNaN(rule1))
      {
        if(rule13.length < 10)
        {
          $('#rule13Span').html('Rule 13 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule13Span').html('');
        }
      }
      else
      {
        $('#rule13Span').html('Rule 13 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule14 != '')
    {
      if(isNaN(rule14))
      {
        if(rule14.length < 10)
        {
          $('#rule14Span').html('Rule 14 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule14Span').html('');
        }
      }
      else
      {
        $('#rule14Span').html('Rule 14 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(rule15 != '')
    {
      if(isNaN(rule15))
      {
        if(rule15.length < 10)
        {
          $('#rule15Span').html('Rule 15 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule15Span').html('');
        }
      }
      else
      {
        $('#rule15Span').html('Rule 15 should not contain only numbers');
        error = true;
      }
      entered = true;
    }

    if(!error)
    {
      if(entered)
      {
        $('#myLoader').show();
        // creating json array
        hostelRules = {
          'hostelId':hostelId,
          'rule1':rule1,
          'rule2':rule2,
          'rule3':rule3,
          'rule4':rule4,
          'rule5':rule5,
          'rule6':rule6,
          'rule7':rule7,
          'rule8':rule8,
          'rule9':rule9,
          'rule10':rule10,
          'rule11':rule11,
          'rule12':rule12,
          'rule13':rule13,
          'rule14':rule14,
          'rule15':rule15
        }
        // ajax post request
        $.post(url_addHostelRule, {hostelRules:hostelRules, _token:token}, function(data){
          $('#myLoader').hide();
          $('#success').html(message);
        });
      }
      else
      {
        $('#success').html('<div class="alert alert-success mt-3" role="alert">Please enter atleast one rule</div>');
      }
    }
    else
    {
      $('#success').html(ErrorMessage);
    }
    
  });

// update rules

  $('#updateRuleBtn').click(function(){
    var rule1 = $('textarea[name = rule1]').val();
    var rule2 = $('textarea[name = rule2]').val();
    var rule3 = $('textarea[name = rule3]').val();
    var rule4 = $('textarea[name = rule4]').val();
    var rule5 = $('textarea[name = rule5]').val();
    var rule6 = $('textarea[name = rule6]').val();
    var rule7 = $('textarea[name = rule7]').val();
    var rule8 = $('textarea[name = rule8]').val();
    var rule9 = $('textarea[name = rule9]').val();
    var rule10 = $('textarea[name = rule10]').val();
    var rule11 = $('textarea[name = rule11]').val();
    var rule12 = $('textarea[name = rule12]').val();
    var rule13 = $('textarea[name = rule13]').val();
    var rule14 = $('textarea[name = rule14]').val();
    var rule15 = $('textarea[name = rule15]').val();
    var message = '<div class="alert alert-success mt-3" role="alert">Rules successfully updated</div>';
    var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
    var token = $('input[name = token]').val();
    var ruleId = $('input[name = ruleId]').val();
    var error = false;

    if(rule1 != '')
    {
      if(isNaN(rule1))
      {
        if(rule1.length < 10)
        {
          $('#rule1Span').html('Rule 1 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule1Span').html('');
        }
      }
      else
      {
        $('#rule1Span').html('Rule 1 should not contain only numbers');
        error = true;
      }
    }

    if(rule2 != '')
    {
      if(isNaN(rule2))
      {
        if(rule2.length < 10)
        {
          $('#rule2Span').html('Rule 2 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule2Span').html('');
        }
      }
      else
      {
        $('#rule2Span').html('Rule 2 should not contain only numbers');
        error = true;
      }
    }

    if(rule3 != '')
    {
      if(isNaN(rule3))
      {
        if(rule3.length < 10)
        {
          $('#rule3Span').html('Rule 3 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule3Span').html('');
        }
      }
      else
      {
        $('#rule3Span').html('Rule 3 should not contain only numbers');
        error = true;
      }
    }

    if(rule4 != '')
    {
      if(isNaN(rule4))
      {
        if(rule4.length < 10)
        {
          $('#rule4Span').html('Rule 4 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule4Span').html('');
        }
      }
      else
      {
        $('#rule4Span').html('Rule 4 should not contain only numbers');
        error = true;
      }
    }

    if(rule5 != '')
    {
      if(isNaN(rule5))
      {
        if(rule5.length < 10)
        {
          $('#rule5Span').html('Rule 5 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule5Span').html('');
        }
      }
      else
      {
        $('#rule5Span').html('Rule 5 should not contain only numbers');
        error = true;
      }
    }

    if(rule6 != '')
    {
      if(isNaN(rule6))
      {
        if(rule6.length < 10)
        {
          $('#rule6Span').html('Rule 6 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule6Span').html('');
        }
      }
      else
      {
        $('#rule6Span').html('Rule 6 should not contain only numbers');
        error = true;
      }
    }

    if(rule7 != '')
    {
      if(isNaN(rule7))
      {
        if(rule7.length < 10)
        {
          $('#rule7Span').html('Rule 7 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule7Span').html('');
        }
      }
      else
      {
        $('#rule7Span').html('Rule 7 should not contain only numbers');
        error = true;
      }
    }

    if(rule8 != '')
    {
      if(isNaN(rule8))
      {
        if(rule8.length < 10)
        {
          $('#rule8Span').html('Rule 8 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule8Span').html('');
        }
      }
      else
      {
        $('#rule8Span').html('Rule 8 should not contain only numbers');
        error = true;
      }
    }

    if(rule9 != '')
    {
      if(isNaN(rule9))
      {
        if(rule9.length < 10)
        {
          $('#rule9Span').html('Rule 9 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule9Span').html('');
        }
      }
      else
      {
        $('#rule9Span').html('Rule 9 should not contain only numbers');
        error = true;
      }
    }

    if(rule10 != '')
    {
      if(isNaN(rule10))
      {
        if(rule10.length < 10)
        {
          $('#rule10Span').html('Rule 10 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule10Span').html('');
        }
      }
      else
      {
        $('#rule10Span').html('Rule 10 should not contain only numbers');
        error = true;
      }
    } 

    if(rule11 != '')
    {
      if(isNaN(rule11))
      {
        if(rule11.length < 10)
        {
          $('#rule11Span').html('Rule 11 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule11Span').html('');
        }
      }
      else
      {
        $('#rule11Span').html('Rule 11 should not contain only numbers');
        error = true;
      }
    }

    if(rule12 != '')
    {
      if(isNaN(rule12))
      {
        if(rule12.length < 10)
        {
          $('#rul2e1Span').html('Rule 12 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule12Span').html('');
        }
      }
      else
      {
        $('#rule12Span').html('Rule 12 should not contain only numbers');
        error = true;
      }
    }

    if(rule13 != '')
    {
      if(isNaN(rule1))
      {
        if(rule13.length < 10)
        {
          $('#rule13Span').html('Rule 13 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule13Span').html('');
        }
      }
      else
      {
        $('#rule13Span').html('Rule 13 should not contain only numbers');
        error = true;
      }
    }

    if(rule14 != '')
    {
      if(isNaN(rule14))
      {
        if(rule14.length < 10)
        {
          $('#rule14Span').html('Rule 14 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule14Span').html('');
        }
      }
      else
      {
        $('#rule14Span').html('Rule 14 should not contain only numbers');
        error = true;
      }
    }

    if(rule15 != '')
    {
      if(isNaN(rule15))
      {
        if(rule15.length < 10)
        {
          $('#rule15Span').html('Rule 15 should contain atleast 10 characters');
          error = true;
        }
        else
        {
          $('#rule15Span').html('');
        }
      }
      else
      {
        $('#rule15Span').html('Rule 15 should not contain only numbers');
        error = true;
      }
    }

    if(!error)
    {
      $('#myLoader').show();
      // creating json array
      hostelRules = {
        'ruleId':ruleId,
        'rule1':rule1,
        'rule2':rule2,
        'rule3':rule3,
        'rule4':rule4,
        'rule5':rule5,
        'rule6':rule6,
        'rule7':rule7,
        'rule8':rule8,
        'rule9':rule9,
        'rule10':rule10,
        'rule11':rule11,
        'rule12':rule12,
        'rule13':rule13,
        'rule14':rule14,
        'rule15':rule15
      }
      // ajax post request
      $.post(url_updateHostelRule, {hostelRules:hostelRules, _token:token}, function(data){
        $('#myLoader').hide();
        $('#success').html(message);
      });

    }
    else
    {
      $('#success').html(ErrorMessage);
    }
  });



  // **************************************** HOSTEL ****************************************
  $('#deleteHostelBtn').click(function(){
    $('#deleteHostelAlert').show();
  });
  $('#deleteHostelAlertNoBtn').click(function(){
    $('#deleteHostelAlert').hide();
  });
  // showing hostel images at hostelinformation blade
  $('#viewHostelImageBtn').click(function(){
      $('#hostelImages').show();
      $('#deleteHostelAlert').hide();
  });

  // showing the add hostel image form
  $('#addHostelImageBtn').click(function(){
    $('#addHostelImageForm').show();
  });

  // validating hostel image
  $('#validateHostelImageBtn').click(function(){

    var hostelImage = $('input[name = hostelImage]').val();
    var imageExtension = hostelImage.substring(hostelImage.lastIndexOf('.') + 1).toLowerCase();
    var error = false;
    if(hostelImage == '')
    {
      $('#addHostelImageSpan').html('please select image');
      error = true;
    }
    else
    {
      if(!(imageExtension == "jpeg" || imageExtension == "jpg"))
      {
        $('#addHostelImageSpan').html('File extension should only be jpeg or jpg');
        error = true;
      }
    }

    if(!error)
    {
      $('#addHostelImageSpan').html('Image is ok, you can submit now');
      $('#submitHostelImageBtn').show();
    }

  });



  /**
   *  HOSTEL REGISTRATION FORM 
   */
  // click event of hostel information button
  $('#hostelInformationNextBtn').click(function(){

    var hostelName = $('input[name = hostelName]').val();
    var phoneNo = $('input[name = phoneNumber]').val();
    var street = $('input[name = streetAddress]').val();
    var addressLine = $('input[name = addressLine]').val();
    var error = false;

    if(hostelName == '')
    {
      $('#hostelNameSpan').html('please enter hostel name');
      error = true;
    }
    else
    {
      if((hostelName.length < 8) || (hostelName.length > 20))
      {
        $('#hostelNameSpan').html('Hostel name should be grater than 8 characters and less than 20 characters');
        error = true; 
      }
      else
      {
        $('#hostelNameSpan').html('');
      }
    }

    if(phoneNo == '')
    {
      $('#phoneNoSpan').html('Please enter phone number');
      error = true;
    }
    else
    {
      // phone no pattern
      var numberPattern = /^[0-9]{11}$/;
      var result = numberPattern.test(phoneNo);
      if(!result)
      {
        $('#phoneNoSpan').html('Phone number should contain 11 digits');
        error = true;
      }
      else
      {
        if(phoneNo.indexOf('0') != 0)
        {
          $('#phoneNoSpan').html('Phone number first letter should be zero');
          error = true;  
        }
        else
        {
          $('#phoneNoSpan').html('');
        }
        
      }
    }

    if(street == '')
    {
      $('#streetSpan').html('please enter hostel street');
      error = true;
    }
    else
    {
      if((street.length < 8) || (street.length > 30))
      {
        $('#streetSpan').html('Street address should contain more than 8 and less than 30 characters');
        error = true;
      }
      else
      {
        $('#streetSpan').html('');
      }
    }

    if(addressLine == '')
    {
      $('#addressLineSpan').html('Please enter address line');
      error = true;
    }
    else
    {
      if((addressLine.length < 8) || (addressLine.length > 30))
      {
        $('#addressLineSpan').html('Address line should contain more than 8 and less than 30 characters');
        error = true;
      }
      else
      {
        $('#addressLineSpan').html('');
      }
    }

    if(!error)
    {
      $('#hostelInformation').hide();
      $('#hostelFacilities').show();
    }
  });

  // click event of hostel facilities back button
  $('#hostelFacilitiesBackBtn').click(function(){
    $('#hostelInformation').show();
    $('#hostelFacilities').hide();
  });

  // click event of hostel facilities next button
  $('#hostelFacilitiesNextBtn').click(function(){
    $('#hostelFacilities').hide();
    $('#hostelInformation2').show();
  });

  // click event of hostel information 2 back button
  $('#hostelInformation2BackBtn').click(function(){
    $('#hostelFacilities').show();
    $('#hostelInformation2').hide();
  });

  // click event hostel information 2 save button
  $('#hostelInformation2SaveBtn').click(function(){
    // hostel information 2
    var description = $('textarea[name = description').val();
    var landmarks = $('textarea[name = landmark').val();
    var estimateRent = $('input[name = estimateRent').val();
    var image1 = $('input[name = image1]').val();
    var image2 = $('input[name = image2]').val();
    var image3 = $('input[name = image3]').val();
    var image4 = $('input[name = image4]').val();
    var error = false;
    
    if(description == '')
    {
      $('#descriptionSpan').html('Please write hostel description');
      error = true;
    }
    else
    {
      if(description.length < 10)
      {
        $('#descriptionSpan').html('Description should contain more than 10 characters');
        error = true;
      }
      else
      {
        $('#descriptionSpan').html('');
      }
    }

    if(landmarks == '')
    {
      $('#landmarkSpan').html('Please enter landmarks near hostel');
      error = true;
    }
    else
    {
      if(description.length < 6)
      {
        $('#landmarkSpan').html('Landmarks should contain more than 6 characters');
        error = true;
      }
      else
      {
        $('#landmarkSpan').html('');
      }
    }

    if(estimateRent == '')
    {
      $('#estimateRentSpan').html('Please enter estimate hostel rent');
      error = true;
    }
    else
    {
      if(estimateRent <= 0)
      {
        $('#estimateRentSpan').html('Estimated rent should not be less than or equal to zero');
        error = true;
      }
      else
      {
        $('#estimateRentSpan').html('');
      }
    }

    // images validation
    if(image1 != '')
   {
    var image1Extension = image1.substring(image1.lastIndexOf('.') + 1).toLowerCase();
    if(!(image1Extension == "jpeg" || image1Extension == "jpg"))
     {
      $('#image1Span').html('File extension should only be jpeg or jpg');
      error = true;
     }
   }

   if(image2 != '')
   {
    var image2Extension = image2.substring(image2.lastIndexOf('.') + 1).toLowerCase();
    if(!(image2Extension == "jpeg" || image2Extension == "jpg"))
     {
      $('#image2Span').html('File extension should only be jpeg or jpg');
      error = true;
     }
   }

   if(image3 != '')
   {
    var image3Extension = image3.substring(image3.lastIndexOf('.') + 1).toLowerCase();
    if(!(image3Extension == "jpeg" || image3Extension == "jpg"))
     {
        $('#image3Span').html('File extension should only be jpeg or jpg');
        error = true;
     }
   }

   if(image4 != '')
   {
      var image4Extension = image4.substring(image4.lastIndexOf('.') + 1).toLowerCase();
      if(!(image4Extension == "jpeg" || image4Extension == "jpg"))
      {
        $('#image4Span').html('File extension should only be jpeg or jpg');
        error = true;
      }
   }

    if(!error)
    {
      $('#saveBtn').show();
    }
  });

  $('#saveBtn').click(function(){
    $('#myLoader').show();
  });

  // END OF HOSTEL REGISTRATION FORM

  /**
   *  UPDATE HOSTEL FACILITIES
   */
$('#hostelFacilityBtn').click(function(){

  var wifi = $('select[name = wifi]').val();
  var mess = $('select[name = mess]').val();
  var tv = $('select[name = tv]').val();
  var cctvCamera = $('select[name = cctvCamera]').val();
  var laundry = $('select[name = laundry]').val();
  var powerBackup = $('select[name = powerBackup]').val();
  var dailyClean = $('select[name = dailyClean]').val();
  var iron = $('select[name = iron]').val();
  var geyser = $('select[name = geyser]').val();
  var refrigerator = $('select[name = refrigerator]').val();
  var parking = $('select[name = parking]').val();
  var other1 = $('input[name = other1]').val();
  var other2 = $('input[name = other2]').val();
  var token = $('input[name = token]').val();
  var facilityId = $('input[name = facilityId]').val();
  var message = '<div class="alert alert-success mt-3" role="alert">Facilities updated successfully</div>';

  // creating a json array of the facilities
  facilities = {
    'facilityId':facilityId,
    'wifi':wifi,
    'mess':mess,
    'tv':tv,
    'cctv':cctvCamera,
    'laundry':laundry,
    'powerBackup':powerBackup,
    'dailyClean':dailyClean,
    'iron':iron,
    'geyser':geyser,
    'refrigerator':refrigerator,
    'parking': parking,
    'other1':other1,
    'other2':other2
  }
  
  $.post(url_updateHostelFacilities,{facilities:facilities, _token:token}, function(data){
    $('#success').html(message);
  });

});

/**
 * UPDATE HOSTEL INFORMATIONS
 */
$('#editHostelInformationBackBtn').click(function(){
  $('#hostelInformation').show();
  $('#hostelInformation2').hide();
});

$('#editHostelInformationNextBtn').click(function(){

    var hostelName = $('input[name = hostelName]').val();
    var phoneNo = $('input[name = phoneNumber]').val();
    var street = $('input[name = streetAddress]').val();
    var addressLine = $('input[name = addressLine]').val();
    var error = false;

    if(hostelName == '')
    {
      $('#hostelNameSpan').html('Please enter hostel name');
      error = true;
    }
    else
    {
      if((hostelName.length < 8) || (hostelName.length > 20))
      {
        $('#hostelNameSpan').html('Hostel name should be grater than 8 characters and less than 20 characters');
        error = true; 
      }
      else
      {
        $('#hostelNameSpan').html('');
      }
    }

    if(phoneNo == '')
    {
      $('#phoneNoSpan').html('Please enter phone number');
      error = true;
    }
    else
    {
      // phone no pattern
      var numberPattern = /^[0-9]{11}$/;
      var result = numberPattern.test(phoneNo);
      if(!result)
      {
        $('#phoneNoSpan').html('Phone number should contain 11 digits');
        error = true;
      }
      else
      {
        if(phoneNo.indexOf('0') != 0)
        {
          $('#phoneNoSpan').html('Phone number first letter should be zero');
          error = true;  
        }
        else
        {
          $('#phoneNoSpan').html('');
        }
        
      }
    }

    if(street == '')
    {
      $('#streetSpan').html('Please enter hostel street');
      error = true;
    }
    else
    {
      if((street.length < 8) || (street.length > 30))
      {
        $('#streetSpan').html('Street address should contain more than 8 and less than 30 characters');
        error = true;
      }
      else
      {
        $('#streetSpan').html('');
      }
    }

    if(addressLine == '')
    {
      $('#addressLineSpan').html('Please enter address line');
      error = true;
    }
    else
    {
      if((addressLine.length < 8) || (addressLine.length > 30))
      {
        $('#addressLineSpan').html('Address line should contain more than 8 and less than 30 characters');
        error = true;
      }
      else
      {
        $('#addressLineSpan').html('');
      }
    }

    if(!error)
    {
      $('#hostelInformation').hide();
      $('#hostelInformation2').show();
    }
});

$('#editHostelInformationUpdateBtn').click(function(){

  // hostel information
  var hostelName = $('input[name = hostelName]').val();
  var phoneNo = $('input[name = phoneNumber]').val();
  var street = $('input[name = streetAddress]').val();
  var category = $('select[name = hostelCategory]').val();
  var country = $('select[name = hostelCountry]').val();
  var province = $('select[name = hostelProvince]').val();
  var city = $('select[name = hostelCity]').val();
  var street = $('input[name = streetAddress]').val();
  var addressLine = $('input[name = addressLine]').val();

  // hostel information 2
  var description = $('textarea[name = description').val();
  var landmarks = $('textarea[name = landmark').val();
  var estimateRent = $('input[name = estimateRent').val();
  var rentPeriod = $('select[name = rentPeriod]').val();
  var message = '<div class="alert alert-success mt-3" role="alert">Hostel informations updates successfully</div>';
  var token = $('input[name = token]').val();
  var informationId = $('input[name = informationId]').val();
  var error = false;

 
  if(description == '')
  {
    $('#descriptionSpan').html('Please write hostel description');
    error = true;
  }
  else
  {
    if(description.length < 10)
    {
      $('#descriptionSpan').html('Description should contain more than 10 characters');
      error = true;
    }
    else
    {
      $('#descriptionSpan').html('');
    }
  }

  if(landmarks == '')
  {
    $('#landmarkSpan').html('Please enter landmarks near hostel');
    error = true;
  }
  else
  {
    if(description.length < 6)
    {
      $('#landmarkSpan').html('Landmarks should contain more than 6 characters');
      error = true;
    }
    else
    {
      $('#landmarkSpan').html('');
    }
  }

  if(estimateRent == '')
  {
    $('#estimateRentSpan').html('Please enter estimate hostel rent');
    error = true;
  }
  else
  {
    if(estimateRent <= 0)
    {
      $('#estimateRentSpan').html('Estimated rent should not be less than or equal to zero');
      error = true;
    }
    else
    {
      $('#estimateRentSpan').html('');
    }
  }

  if(!error)
  {
    // creating a jason array
    hostelInformation = {
      'informationId':informationId,
      'hostelName':hostelName,
      'phoneNo':phoneNo,
      'street':street,
      'category':category,
      'country':country,
      'province':province,
      'city':city,
      'street':street,
      'addressLine':addressLine,
      'description':description,
      'landmarks':landmarks,
      'estimatedRent':estimateRent,
      'rentPeriod':rentPeriod
    }

    $.post(url_editHostelInformation,{hostelInformation:hostelInformation, _token:token}, function(data){
      $('#success').html(message);
    }); 
  }

});

function getData()
{
  alert('hello');
  /* var hostelId = id;
  var token = token;
  $.post(url_getHostelData,{hostelId:hostelId, _token:token}, function(data){
    alert(data);
  }); */
}


// ***************************************** ROOM ****************************************************
/**
 * ROOM MANAGEMENT
 */
// shift hostell room
$('#shiftHostellerDiv').click(function(){
  $('#myLoader').show();
});
// add hosteller
$('#addHostellerBtn').click(function(){
  $('#addHostellerForm').show();
  $('#hostelRoomDeleteAlert').hide();
});

$('#addHostellerCancelBtn').click(function(){
  $('#addHostellerForm').hide();
});

$('#romateAddBtn').click(function(){
  
  var message = '<div class="alert alert-success ml-2 mt-2" role="alert"><p>Hosteller successfully registered</p></div>';
  var errorMessage = '<div class="alert alert-success ml-2 mt-2" role="alert"><p>Please fix the errors</p></div>';
  var existMessage = '<div class="alert alert-success ml-2 mt-2" role="alert"><p>Hosteller with the same email already exists in you hostel</p></div>';
  var alreadyMessage = '<div class="alert alert-success ml-2 mt-2" role="alert"><p>Hosteller was already registered with the system, so is added to the bookings</p></div>';
  var name = $('input[name = name]').val();
  var email = $('input[name = email]').val();
  var password = $('input[name = password]').val();
  var confirm = $('input[name = password_confirmation]').val();
  var token = $('input[name = token]').val();
  var checkin = $('input[name = checkin]').val();
  var checkout = $('input[name = checkout]').val();
  var roomId = $('input[name = roomId]').val();
  var error = false;

  if(checkin == "")
  {
    $('#checkinSpan').html('Please select checked in date');
    error = true;
  }
  else
  {
    $('#checkinSpan').html('');
  }

  if(checkout == "")
  {
    $('#checkoutSpan').html('Please select check out date');
    error = true;
  }
  else
  {
    $('#checkoutSpan').html('');
  }

  if(name == "")
  {
    $('#usernameSpan').html('Enter username');
    error = true;
  }
  else
  {
    if(isNaN(name))
    {
      if(name.length < 8)
      {
        $('#usernameSpan').html('Name should contain atleast 8 characters');
        error = true;
      }
      else
      {
        $('#usernameSpan').html('');
      }
    }
    else
    {
      $('#usernameSpan').html('Name should not contain only digist');
      error = true;
    }
  }

  if(email == "")
  {
    $('#emailSpan').html('Enter email address');
    error = true;
  }
  else
  {
    var emailPattern = /\S+@\S+\.\S+/;
    if(emailPattern.test(email))
    {
      $('#emailSpan').html('');
    }
    else
    {
      $('#emailSpan').html('Invalid email');
      error = true;
    }
  }

  if(password == "")
  {
    $('#passwordSpan').html('Enter password');
    error = true;
  }
  if(confirm == "")
  {
    $('#confirmPassSpan').html('Enter confirmation password');
    error = true;
  }
  
  if((password != "") && (confirm != ""))
  {
    if(password == confirm)
    {
      if(password.length >= 8)
      {
        if((password.indexOf('@') > 0) || (password.indexOf('#') > 0) || (password.indexOf('$') > 0) || (password.indexOf('%') > 0) || (password.indexOf('&') > 0))
        {
          $('#confirmPassSpan').html('');
          $('#passwordSpan').html('');
        }
        else
        {
          $('#passwordSpan').html('Password should contain atlease on special character(@, #, $, %, &)');
          $('#confirmPassSpan').html('');
          error = true;
        }
      }
      else
      {
        $('#passwordSpan').html('Password shuld contain atleast 8 characters');
        $('#confirmPassSpan').html('');
        error = true;
      }
    }
    else
    {
      $('#passwordSpan').html('');
      $('#confirmPassSpan').html('Passwords didnt match');
      error = true;
    }
  }
    
  if(!error)
  {
    $('#myLoader').show();
    userData = {
      'roomId':roomId,
      'name': name,
      'email': email,
      'password': password,
      'checkin':checkin,
      'checkout':checkout
    }
    $.post(url_addHosteller,{userData:userData, _token:token}, function(data){
      $('#myLoader').hide();
      if(data == 'userExist')
      {
        $('#hostellerSuccess').html(existMessage);
      }
      else if(data == 'regUser')
      {
        $('#hostellerSuccess').html(alreadyMessage);
      }
      else if(data == 'registered')
      {
        $('input').val('');
        $('#hostellerSuccess').html(message);
      }
    });
  }
  else
  {
    $('#hostellerSuccess').html(errorMessage);
  }
});

$('#addRoomCancelBtn').click(function(){
  $('#myForm').hide();
});
// add room
$('#addRoomBtn').click(function(){
  var message = '<div class="alert alert-success mt-3" role="alert">Room added successfully</div>';
  var existMessage = '<div class="alert alert-success mt-3" role="alert">Room with that number already exist please try another room no</div>';
  var rentMessage = '<div class="alert alert-success mt-3" role="alert">You cannot fix room rent greater than estimated room rent, you can update that in hostel informations</div>';
  var capacity = $('#capacity').val();
  var rent = $('input[name = rent]').val();
  var roomNo = $('input[name = no]').val();
  var hostelId = $('input[name = hostelId]').val();
  var token = $('input[name = token]').val();
  var error = false;

  // facilities
  var ac = $('select[name = ac]').val();
  var fan = $('select[name = fan]').val();
  var washroom = $('select[name = attachWashroom]').val();
  var ventilation = $('select[name = ventilation]').val();
  var wardrobe = $('select[name = wardrobe]').val();
  var other1 = $('input[name = other1]').val();
  var other2 = $('input[name = other2]').val();

  if(rent === '')
  {
      $('#rentSpan').html('Please enter room rent');
      error = true;
  }
  else
  {
    if(rent <= 0)
    {
      $('#rentSpan').html('Room rent should be greater then zero');
      error = true;
    }
    else
    {
      $('#rentSpan').html('');
    }
  }

  if(roomNo === '')
  {
      $('#noSpan').html('Please enter room number');
      error = true;
  }
  else
  {
    if(roomNo <= 0)
    {
      $('#noSpan').html('Room number should be greater than zero');
      error = true;
    }
    else
    {
      $('#noSpan').html('');
    }
  }

  if(!error)
  {
    $('#myLoader').show();
    // creating json array of room details
    roomData = {
      'hostelId':hostelId,
      'roomNo':roomNo,
      'capacity':capacity,
      'rent':rent
    }
    // creating json array of facilities
      roomFacilities = {
        'ac':ac,
        'fan':fan,
        'washroom':washroom,
        'ventilation':ventilation,
        'wardrobe':wardrobe,
        'other1':other1,
        'other2':other2
    }
      
      $.post(url_addRoom, {roomFacilities:roomFacilities, roomData:roomData, _token:token}, function(data){
          if(data == 'exist')
          {
            $('#myLoader').hide();
            $('#success').html(existMessage);
          }
          else if(data == 'rent')
          {
            $('#myLoader').hide();
            $('#success').html(rentMessage);
          }
          else if(data == 'success')
          {
            $('#myLoader').hide();
            $('#success').html(message);
          }
      });
  }
});
/**
 * update room function
 */
$('#updateRoomCancelBtn').click(function(){
  $('#myForm').hide();
});
$('#updateRoomBtn').click(function(){
  
    var message = '<div class="alert alert-success mt-3" role="alert">Room updated successfully</div>';
    var capacity = $('select[name = capacity]').val();
    var rent = $('input[name = rent]').val();
    var roomId = $('input[name = roomId]').val();
    var facId = $('input[name = facilityId]').val();
    var token = $('input[name = token]').val();
      
    // facilities
    var ac = $('select[name = ac]').val();
    var fan = $('select[name = fan]').val();
    var washroom = $('select[name = attachWashroom]').val();
    var ventilation = $('select[name = ventilation]').val();
    var wardrobe = $('select[name = wardrobe]').val();
    var other1 = $('input[name = other1]').val();
    var other2 = $('input[name = other2]').val();
   
    var error = false;
    if(rent === '')
    {
        $('#rentSpan').html('Please enter room rent');
        error = true;
    }
    else
    {
      if(rent <= 0)
      {
        $('#rentSpan').html('Room rent should be greater then zero');
        error = true;
      }
      else
      {
        $('#rentSpan').html('');
      }
    }

    if(!error)
    {

      // creating json array of facilities
        roomFacilities = {
          'facId':facId,
          'ac':ac,
          'fan':fan,
          'washroom':washroom,
          'ventilation':ventilation,
          'wardrobe':wardrobe,
          'other1':other1,
          'other2':other2
        }

        $.post(url_updateRoom, {capacity:capacity, rent:rent, roomId:roomId, roomFacilities:roomFacilities, _token:token}, function(data){ 
          $('#success').html(message);
         }); 
    }
});

// remove room
$('#hostelRoomDeleteAlertYes').click(function(){

    var message = '<div class="alert alert-success mt-3" role="alert">Unable to remove room because it may contain hostellers</div>';
    var roomId = $('input[name = roomId]').val();
    var token = $('input[name = token]').val();
    $('#myLoader').hide();
    $.post(url_removeRoom, {roomId:roomId, _token:token}, function(data){ 
        $('#myLoader').hide();
        if(data == 1)
        {
          $('#hostelRoomDeleteAlert').hide();
          $('#success2').html(message);
        }
        else
        {
          window.location.href = "http://localhost/hostel4student/public/hostelRoom";
        }
    });
});

/**************************************** DUES ******************************** */
// calculating the dues
$('#duesCalculateBtn').click(function(){

  var payable = parseInt($('input[name = payableDues]').val());
  var previous = parseInt($('input[name = previousDues]').val());
  var paid = $('input[name = paidDues]').val();
  var error = false;
  
  if(paid == '')
  {
    $('#amountPaid').html('Please enter paid amount');
    error = true;
  }
  else
  {
    if(paid <= 0)
    {
      $('#amountPaid').html('Paid amount should be greater than zero');
      error = true;
    }
    else
    {
      $('#amountPaid').html('');
    }
  }
  
  if(!error)
  {
    if(payable >= parseInt(paid))
    {
      var remaining = payable - parseInt(paid);
      $('#paidAmount').html('Paid amount Rs'+paid);
      $('#dues').html('<br>Room rent Rs'+payable);
      $('#previousAmount').html('<br>Remaining amount is Rs'+remaining);
      $('#duesSaveBtn').show();
    }
    else
    {
      var remaining = parseInt(paid) - payable ;
      $('#paidAmount').html('Paid amount Rs'+paid);
      $('#dues').html('<br>Room rent Rs'+payable);
      $('#previousAmount').html('<br>Remaining amount is Rs'+remaining);
      $('#payableAmountMoreDiv').show();
    }
  }
});

$('#notifyDefaultersBtn').click(function(){
  $('#myLoader').show();
});

$('#resetDuesBtn').click(function(){
  $('#myLoader').show();
});

// saving the data
$('#duesSaveBtn').click(function(){
  var message = '<div class="alert alert-success mt-3" role="alert"><p>Hosteller dues updated successfully</p></div>';
  var payable = parseInt($('input[name = payableDues]').val());
  var previous = parseInt($('input[name = previousDues]').val());
  var paid = parseInt($('input[name = paidDues]').val());
  var duesId = $('input[name = duesId]').val();
  var token = $('input[name = token]').val();
  /* var remaining = payable - paid;
  previous = previous + remaining; */

  duesInfo = {
    'duesId':duesId,
    'paid':paid,
    'previous':previous
  }
  $('#myLoader').show();
  $.post(url_updateHostellerDues,{duesInfo:duesInfo, _token:token}, function(data){
    $('#myLoader').hide();
    $('input').val('');
    $('#payableAmountLessDiv').hide();
    $('#success').html(message);
  }); 
});

$('#EditDuesYesBtn').click(function(){
  var message = '<div class="alert alert-success mt-3" role="alert"><p>Hosteller dues updated successfully</p></div>';
  var payable = parseInt($('input[name = payableDues]').val());
  var previous = parseInt($('input[name = previousDues]').val());
  var paid = parseInt($('input[name = paidDues]').val());
  var duesId = $('input[name = duesId]').val();
  var token = $('input[name = token]').val();
  

  duesInfo = {
    'duesId':duesId,
    'paid':paid,
    'previous':previous
  }
  $('#myLoader').show();
  $.post(url_updateHostellerDues,{duesInfo:duesInfo, _token:token}, function(data){
    $('#myLoader').hide();
    $('#payableAmountMoreDiv').hide();
    $('#success').html(message);
  });

});

$('#EditDuesNoBtn').click(function(){
  var message = '<div class="alert alert-success mt-3" role="alert"><p>Hosteller dues updated successfully</p></div>';
  var previous = parseInt($('input[name = previousDues]').val());
  var paid = parseInt($('input[name = paidDues]').val());
  var payable = parseInt($('input[name = payableDues]').val());
  var duesId = $('input[name = duesId]').val();
  var token = $('input[name = token]').val();

  duesInfo = {
    'duesId':duesId,
    'paid':payable,
    'previous':previous
  }

  $('#myLoader').show();
  $.post(url_updateHostellerDues,{duesInfo:duesInfo, _token:token}, function(data){
    $('#myLoader').hide();
    $('#payableAmountMoreDiv').hide();
    $('#success').html(message);
  });
});

/********************************************** USER ************************************ */
function showHostelManagerDeleteAlert(id)
{
  $userId = id;
  var link = "http://localhost/hostel4student/public/removeHostelManager/"+$userId+"";
  $('#deleteHostelManagerLink').attr("href",link);
  $('#hostelManagerDeleteAlert').show();
}

$('#deleteHostelManagerLink').click(function(){
  $('#myLoader').show();
});

// adding hostel manager

$('#hostelManagerAddBtn').click(function(){
  
  var message = '<div class="alert alert-success ml-4 mt-2" role="alert"><p>Hostel manager successfully registered</p></div>';
  var errorMessage = '<div class="alert alert-success ml-4 mt-2" role="alert"><p>Please fix the errors</p></div>';
  var existMessage = '<div class="alert alert-success ml-4 mt-2" role="alert"><p>Manager with the same email is working in your hostel</p></div>';
  var notRegisterMessage = '<div class="alert alert-success ml-4 mt-2" role="alert"><p>You cannot register yourself as a hostel manager in your hostel</p></div>';
  var name = $('input[name = name]').val();
  var email = $('input[name = email]').val();
  var password = $('input[name = password]').val();
  var confirm = $('input[name = password_confirmation]').val();
  var type = $('input[name = type]').val();
  var token = $('input[name = token]').val();
  var error = false;

  if(name == "")
  {
    $('#usernameSpan').html('Enter username');
    error = true;
  }
  else
  {
    if(isNaN(name))
    {
      if(name.length < 8)
      {
        $('#usernameSpan').html('Name should contain atleast 8 characters');
        error = true;
      }
      else
      {
        $('#usernameSpan').html('');
      }
    }
    else
    {
      $('#usernameSpan').html('Name should not contain only digist');
      error = true;
    }
  }

  if(email == "")
  {
    $('#emailSpan').html('Enter email');
    error = true;
  }
  else
  {
    $('#emailSpan').html('');
  }

  if(password == "")
  {
    $('#passwordSpan').html('Enter password');
    error = true;
  }
  if(confirm == "")
  {
    $('#confirmPassSpan').html('Enter confirmation password');
    error = true;
  }
  
  if((password != "") && (confirm != ""))
  {
    if(password == confirm)
    {
      if(password.length >= 8)
      {
        if((password.indexOf('@') > 0) || (password.indexOf('#') > 0) || (password.indexOf('$') > 0) || (password.indexOf('%') > 0) || (password.indexOf('&') > 0))
        {
          $('#confirmPassSpan').html('');
          $('#passwordSpan').html('');
        }
        else
        {
          $('#passwordSpan').html('Password should contain atlease on special character(@, #, $, %, &)');
          $('#confirmPassSpan').html('');
          error = true;
        }
      }
      else
      {
        $('#passwordSpan').html('Password shuld contain atleast 8 characters');
        $('#confirmPassSpan').html('');
        error = true;
      }
    }
    else
    {
      $('#passwordSpan').html('');
      $('#confirmPassSpan').html('Passwords didnt match');
      error = true;
    }
  }
    
  if(!error)
  {
    $('#myLoader').show();
    userData = {
      'name': name,
      'email': email,
      'password': password,
      'type': type
    }
    $.post(url_addHostelManager,{userData:userData, _token:token}, function(data){
      $('#myLoader').hide();
      if(data == 'hostelOwner')
      {
        $('#success').html(notRegisterMessage);
      }
      else if(data == 'exist')
      {
        $('#success').html(existMessage);
      }
      else if(data == 'userExist')
      {
        $('input').val('');
        $('#success').html(message);
      }
      else if(data == 'registered')
      {
        $('input').val('');
        $('#success').html(message);
      }
    });
  }
  else
  {
    $('#success').html(errorMessage);
  }
});

/********************************************** BOOKING ********************************** */

// book hostel
/* $('#bookHostelBtn').click(function(){
  alert('hello');
  var checkin = $('input[name = checkin]').val();
  var checkout = $('input[name = checkout]').val();
  var hostelId = $('input[name = hostelId]').val();
  var token = $('input[name = token]').val();

  if((checkin == "") || (checkout == ""))
  {
    $('#success').html('Please eneter check in or checkout dates');
  }
  else
  {
    bookData = {
      'hostelId':hostelId,
      'checkin':checkin,
      'checkout':checkout
    }
  }
}); */

// getting hostel room status
$('#checkAvailabilityBtn').click(function(){
  var token = $('input[name = token]').val();
  $.post(url_getRoomStatus,{_token:token}, function(data){
    if(data == 'Not found')
    {
      $('#success').html('<div class="alert alert-success mt-3" role="alert"><p>No room found</p></div>');
    }
    else
    {
      $('#success').html(data);
      $('#success').show();
      $('#checkAvailabilityCloseBtn').show();
    }
    
  });
});

$('#checkAvailabilityCloseBtn').click(function(){
  $('#success').hide();
  $('#checkAvailabilityCloseBtn').hide();
});

$('#acceptBookingDiv').click(function(){
  $('#myLoader').show();
});
/**
 * update booking
 */

$('#editBookingBtn').click(function(){
  $('#updateBookingForm').show();
  $('#cancelBookingAlert').hide();
});
$('#updateBookingBtn').click(function(){

  var message = '<div class="alert alert-success ml-4 mt-5" role="alert"><p>Booking updated successfully</p></div>';
  var checkin = $('input[name = checkin]').val();
  var checkout = $('input[name = checkout]').val();
  var token = $('input[name = token]').val();
  var bookingId = $('input[name = bookingId]').val();
  var error = false;

  if(checkin == '')
  {
    $('#checkinSpan').html('Please enter check in date');
    error = true;
  }

  if(checkout == '')
  {
    $('#checkoutSpan').html('Please enter check out date');
    error = true;
  }
  if(!error)
  {
    if(checkin > checkout)
    {
      $('#success').html('<div class="alert alert-success ml-4 mt-5" role="alert"><p>Check out date sould be greater than the check in date</p></div>');
    }
    else 
    {
      bookingData = {
        'bookingId':bookingId,
        'checkin':checkin,
        'checkout':checkout
      }
      $.post(url_updateBooking,{bookingData:bookingData, _token:token}, function(data){
        $('input').val('');
        $('#success').html(message);
      });
    }
  }
});

// cancel booking
$('#cancelBookingNoBtn').click(function(){
  $('#cancelBookingAlert').hide();
});

$('#cancelBookingBtn').click(function(){
  $('#updateBookingForm').hide();
  $('#cancelBookingAlert').show();
});

$('#cancelBookingYesBtn').click(function(){
 
  var checkout = $('input[name = cancelCheckout]').val();
  var token = $('input[name = token]').val();
  var error = false;
  if(checkout == "")
  {
    $('#cancelCheckoutSpan').html('Please enter check out data');
    error = true;
  }
   
  if(!error)
  {
    $.post(url_cancelBooking,{checkout:checkout, _token:token}, function(data){
      $('#cancelBookingAlert').hide();
      $('#success').html(data);
    });
  }

});

/********************************************** MESS MENU ************************************ */
// add breakfast
$('#addBreakfastBtn').click(function(){

  var SucessMessage = '<div class="alert alert-success mt-3" role="alert">Breakfast menu added successfully</div>';
  var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
  var existMessage = '<div class="alert alert-success mt-3" role="alert">Breadfast menu already addes, you can update the breakfast menu</div>';
  var bMonday = $('textarea[name = bMonday]').val();
  var bTuesday = $('textarea[name = bTuesday]').val();
  var bWednesday = $('textarea[name = bWednesday]').val();
  var bThursday = $('textarea[name = bThursday]').val();
  var bFriday = $('textarea[name = bFriday]').val();
  var bSaturday = $('textarea[name = bSaturday]').val();
  var bSunday = $('textarea[name = bSunday]').val();
  var token = $('input[name = token]').val();
  var error = false;

  if(bMonday == "")
  {
    $('#bmSpan').html('Please enter monday breakfast menu');
    error = true;
  }
  else
  {
    if(bMonday.length < 5)
    {
      $('#bmSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bMonday))
      {
        $('#bmSpan').html('');
      }
      else
      {
        $('#bmSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bTuesday == "")
  {
    $('#btSpan').html('Please enter tuesday breakfast menu');
    error = true;
  }
  else
  {
    if(bTuesday.length < 5)
    {
      $('#btSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bTuesday))
      {
        $('#btSpan').html('');
      }
      else
      {
        $('#btSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bWednesday == "")
  {
    $('#bwSpan').html('Please enter wednesday breakfast menu');
    error = true;
  }
  else
  {
    if(bWednesday.length < 5)
    {
      $('#bwSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bWednesday))
      {
        $('#bwSpan').html('');
      }
      else
      {
        $('#bwSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bThursday == "")
  {
    $('#bthSpan').html('Please enter thursday breakfast menu');
    error = true;
  }
  else
  {
    if(bThursday.length < 5)
    {
      $('#bthSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bThursday))
      {
        $('#bthSpan').html('');
      }
      else
      {
        $('#bthSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bFriday == "")
  {
    $('#bfSpan').html('Please enter friday breakfast menu');
    error = true;
  }
  else
  {
    if(bFriday.length < 5)
    {
      $('#bfSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bFriday))
      {
        $('#bfSpan').html('');
      }
      else
      {
        $('#bfSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSaturday == "")
  {
    $('#bstSpan').html('Please enter saturday breakfast menu');
    error = true;
  }
  else
  {
    if(bSaturday.length < 5)
    {
      $('#bstSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSaturday))
      {
        $('#bstSpan').html('');
      }
      else
      {
        $('#bstSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSunday == "")
  {
    $('#bsSpan').html('Please enter sunday breakfast menu');
    error = true;
  }
  else
  {
    if(bSunday.length < 5)
    {
      $('#bsSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSunday))
      {
        $('#bsSpan').html('');
      }
      else
      {
        $('#bsSpan').html('menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(!error)
  {
    breakfastData = {
      'bMonday':bMonday,
      'bTuesday':bTuesday,
      'bWednesday':bWednesday,
      'bThursday':bThursday,
      'bFriday':bFriday,
      'bSaturday':bSaturday,
      'bSunday':bSunday
    }

    $.post(url_addBreakfastMenu,{breakfastData:breakfastData, _token:token}, function(data){
      if(data == 1)
      {
        $('#success').html(existMessage);
        $('#success').show();
      }
      else
      {
        $('textarea').val('');
        $('#success').html(SucessMessage);
        $('#success').show();
      }
    });

  }
  else
  {
    $('#success').html(ErrorMessage);
    $('#success').show();
  }

});

// adding lunch menu
$('#addLunchBtn').click(function(){

  var SucessMessage = '<div class="alert alert-success mt-3" role="alert">Lunch menu added successfully</div>';
  var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
  var existMessage = '<div class="alert alert-success mt-3" role="alert">Lunch menu already exist, you can edit the lunch menu</div>';
  var bMonday = $('textarea[name = lMonday]').val();
  var bTuesday = $('textarea[name = lTuesday]').val();
  var bWednesday = $('textarea[name = lWednesday]').val();
  var bThursday = $('textarea[name = lThursday]').val();
  var bFriday = $('textarea[name = lFriday]').val();
  var bSaturday = $('textarea[name = lSaturday]').val();
  var bSunday = $('textarea[name = lSunday]').val();
  var token = $('input[name = token]').val();
  var error = false;

  if(bMonday == "")
  {
    $('#lmSpan').html('Please enter monday lunch menu');
    error = true;
  }
  else
  {
    if(bMonday.length < 5)
    {
      $('#lmSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bMonday))
      {
        $('#lmSpan').html('');
      }
      else
      {
        $('#lmSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bTuesday == "")
  {
    $('#ltSpan').html('Please enter tuesday lunch menu');
    error = true;
  }
  else
  {
    if(bTuesday.length < 5)
    {
      $('#ltSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bTuesday))
      {
        $('#ltSpan').html('');
      }
      else
      {
        $('#ltSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bWednesday == "")
  {
    $('#lwSpan').html('Please enter wednesday lunch menu');
    error = true;
  }
  else
  {
    if(bWednesday.length < 5)
    {
      $('#lwSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bWednesday))
      {
        $('#lwSpan').html('');
      }
      else
      {
        $('#lwSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bThursday == "")
  {
    $('#lthSpan').html('Please enter thursday lunch menu');
    error = true;
  }
  else
  {
    if(bThursday.length < 5)
    {
      $('#lthSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bThursday))
      {
        $('#lthSpan').html('');
      }
      else
      {
        $('#lthSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bFriday == "")
  {
    $('#lfSpan').html('Please enter friday lunch menu');
    error = true;
  }
  else
  {
    if(bFriday.length < 5)
    {
      $('#lfSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bFriday))
      {
        $('#lfSpan').html('');
      }
      else
      {
        $('#lfSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSaturday == "")
  {
    $('#lstSpan').html('Please enter saturday lunch menu');
    error = true;
  }
  else
  {
    if(bSaturday.length < 5)
    {
      $('#lstSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSaturday))
      {
        $('#lstSpan').html('');
      }
      else
      {
        $('#lstSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSunday == "")
  {
    $('#lsSpan').html('Please enter sunday lunch menu');
    error = true;
  }
  else
  {
    if(bSunday.length < 5)
    {
      $('#lsSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSunday))
      {
        $('#lsSpan').html('');
      }
      else
      {
        $('#lsSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(!error)
  {
    lunchData = {
      'lMonday':bMonday,
      'lTuesday':bTuesday,
      'lWednesday':bWednesday,
      'lThursday':bThursday,
      'lFriday':bFriday,
      'lSaturday':bSaturday,
      'lSunday':bSunday
    }

    $.post(url_addLunchMenu,{lunchData:lunchData, _token:token}, function(data){
      if(data == 1)
      {
        $('#success').html(existMessage);
        $('#success').show();
      }
      else
      {
        $('textarea').val('');
        $('#success').html(SucessMessage);
        $('#success').show();
      }
    });

  }
  else
  {
    $('#success').html(ErrorMessage);
    $('#success').show();
  }
});

// add dinner menu
$('#addDinnerBtn').click(function(){

  var SucessMessage = '<div class="alert alert-success mt-3" role="alert">Dinner menu added successfully</div>';
  var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
  var existMessage = '<div class="alert alert-success mt-3" role="alert">Dinner menu already exist, you can edit the menu</div>';
  var bMonday = $('textarea[name = dMonday]').val();
  var bTuesday = $('textarea[name = dTuesday]').val();
  var bWednesday = $('textarea[name = dWednesday]').val();
  var bThursday = $('textarea[name = dThursday]').val();
  var bFriday = $('textarea[name = dFriday]').val();
  var bSaturday = $('textarea[name = dSaturday]').val();
  var bSunday = $('textarea[name = dSunday]').val();
  var token = $('input[name = token]').val();
  var error = false;
 

  if(bMonday == "")
  {
    $('#dmSpan').html('Please enter monday dinner menu');
    error = true;
  }
  else
  {
    if(bMonday.length < 5)
    {
      $('#dmSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bMonday))
      {
        $('#dmSpan').html('');
      }
      else
      {
        $('#dmSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bTuesday == "")
  {
    $('#dtSpan').html('Please enter tuesday dinner menu');
    error = true;
  }
  else
  {
    if(bTuesday.length < 5)
    {
      $('#dtSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bTuesday))
      {
        $('#dtSpan').html('');
      }
      else
      {
        $('#dtSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bWednesday == "")
  {
    $('#dwSpan').html('Please enter wednesday dinner menu');
    error = true;
  }
  else
  {
    if(bWednesday.length < 5)
    {
      $('#dwSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bWednesday))
      {
        $('#dwSpan').html('');
      }
      else
      {
        $('#dwSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bThursday == "")
  {
    $('#dthSpan').html('Please enter thursday dinner menu');
    error = true;
  }
  else
  {
    if(bThursday.length < 5)
    {
      $('#dthSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bThursday))
      {
        $('#dthSpan').html('');
      }
      else
      {
        $('#dthSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bFriday == "")
  {
    $('#dfSpan').html('Please enter friday dinner menu');
    error = true;
  }
  else
  {
    if(bFriday.length < 5)
    {
      $('#dfSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bFriday))
      {
        $('#dfSpan').html('');
      }
      else
      {
        $('#dfSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSaturday == "")
  {
    $('#dstSpan').html('Please enter saturday dinner menu');
    error = true;
  }
  else
  {
    if(bSaturday.length < 5)
    {
      $('#dstSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSaturday))
      {
        $('#dstSpan').html('');
      }
      else
      {
        $('#dstSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSunday == "")
  {
    $('#dsSpan').html('Please enter sunday dinner menu');
    error = true;
  }
  else
  {
    if(bSunday.length < 5)
    {
      $('#dsSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSunday))
      {
        $('#dsSpan').html('');
      }
      else
      {
        $('#dsSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(!error)
  {
    dinnerData = {
      'dMonday':bMonday,
      'dTuesday':bTuesday,
      'dWednesday':bWednesday,
      'dThursday':bThursday,
      'dFriday':bFriday,
      'dSaturday':bSaturday,
      'dSunday':bSunday
    }

    $.post(url_addDinnerMenu,{dinnerData:dinnerData, _token:token}, function(data){
      if(data == 1)
      {
        $('#success').html(existMessage);
        $('#success').show();
      }
      else
      {
        $('textarea').val('');
        $('#success').html(SucessMessage);
        $('#success').show();
      }
    });

  }
  else
  {
    $('#success').html(ErrorMessage);
    $('#success').show();
  }
});

// update breakfast
$('#updateBreakfastMenuBtn').click(function(){
  var SucessMessage = '<div class="alert alert-success mt-3" role="alert">Breakfast menu updated successfully</div>';
  var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
  var bMonday = $('textarea[name = monday]').val();
  var bTuesday = $('textarea[name = tuesday]').val();
  var bWednesday = $('textarea[name = wednesday]').val();
  var bThursday = $('textarea[name = thursday]').val();
  var bFriday = $('textarea[name = friday]').val();
  var bSaturday = $('textarea[name = saturday]').val();
  var bSunday = $('textarea[name = sunday]').val();
  var breakfastId = $('input[name = breakfastId]').val();
  var token = $('input[name = token]').val();
  var error = false;

  if(bMonday == "")
  {
    $('#bmSpan').html('Please enter monday breakfast menu');
    error = true;
  }
  else
  {
    if(bMonday.length < 5)
    {
      $('#bmSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bMonday))
      {
        $('#bmSpan').html('');
      }
      else
      {
        $('#bmSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bTuesday == "")
  {
    $('#btSpan').html('Please enter tuesday breakfast menu');
    error = true;
  }
  else
  {
    if(bTuesday.length < 5)
    {
      $('#btSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bTuesday))
      {
        $('#btSpan').html('');
      }
      else
      {
        $('#btSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bWednesday == "")
  {
    $('#bwSpan').html('Please enter wednesday breakfast menu');
    error = true;
  }
  else
  {
    if(bWednesday.length < 5)
    {
      $('#bwSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bWednesday))
      {
        $('#bwSpan').html('');
      }
      else
      {
        $('#bwSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bThursday == "")
  {
    $('#bthSpan').html('Please enter thursday breakfast menu');
    error = true;
  }
  else
  {
    if(bThursday.length < 5)
    {
      $('#bthSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bThursday))
      {
        $('#bthSpan').html('');
      }
      else
      {
        $('#bthSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bFriday == "")
  {
    $('#bfSpan').html('Please enter friday breakfast menu');
    error = true;
  }
  else
  {
    if(bFriday.length < 5)
    {
      $('#bfSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bFriday))
      {
        $('#bfSpan').html('');
      }
      else
      {
        $('#bfSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSaturday == "")
  {
    $('#bstSpan').html('Please enter saturday breakfast menu');
    error = true;
  }
  else
  {
    if(bSaturday.length < 5)
    {
      $('#bstSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSaturday))
      {
        $('#bstSpan').html('');
      }
      else
      {
        $('#bstSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSunday == "")
  {
    $('#bsSpan').html('Please enter sunday breakfast menu');
    error = true;
  }
  else
  {
    if(bSunday.length < 5)
    {
      $('#bsSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSunday))
      {
        $('#bsSpan').html('');
      }
      else
      {
        $('#bsSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(!error)
  {
    $('#myLoader').show();
    breakfastData = {
      'breakfastId':breakfastId,
      'bMonday':bMonday,
      'bTuesday':bTuesday,
      'bWednesday':bWednesday,
      'bThursday':bThursday,
      'bFriday':bFriday,
      'bSaturday':bSaturday,
      'bSunday':bSunday
    }

    $.post(url_updateBreakfastMenu,{breakfastData:breakfastData, _token:token}, function(data){
      $('#myLoader').hide();
      $('textarea').val('');
      $('#success').html(SucessMessage);
      $('#success').show();
    });

  }
  else
  {
    $('#success').html(ErrorMessage);
  }
});

$('#editLunchMenuBtn').click(function(){

  var SucessMessage = '<div class="alert alert-success mt-3" role="alert">Lunch menu updated successfully</div>';
  var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
  var bMonday = $('textarea[name = monday]').val();
  var bTuesday = $('textarea[name = tuesday]').val();
  var bWednesday = $('textarea[name = wednesday]').val();
  var bThursday = $('textarea[name = thursday]').val();
  var bFriday = $('textarea[name = friday]').val();
  var bSaturday = $('textarea[name = saturday]').val();
  var bSunday = $('textarea[name = sunday]').val();
  var lunchId = $('input[name = lunchId]').val();
  var token = $('input[name = token]').val();
  var error = false;

  if(bMonday == "")
  {
    $('#lmSpan').html('Please enter monday lunch menu');
    error = true;
  }
  else
  {
    if(bMonday.length < 5)
    {
      $('#lmSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bMonday))
      {
        $('#lmSpan').html('');
      }
      else
      {
        $('#lmSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bTuesday == "")
  {
    $('#ltSpan').html('Please enter tuesday lunch menu');
    error = true;
  }
  else
  {
    if(bTuesday.length < 5)
    {
      $('#ltSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bTuesday))
      {
        $('#ltSpan').html('');
      }
      else
      {
        $('#ltSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bWednesday == "")
  {
    $('#lwSpan').html('Please enter wednesday lunch menu');
    error = true;
  }
  else
  {
    if(bWednesday.length < 5)
    {
      $('#lwSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bWednesday))
      {
        $('#lwSpan').html('');
      }
      else
      {
        $('#lwSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bThursday == "")
  {
    $('#lthSpan').html('Please enter thursday lunch menu');
    error = true;
  }
  else
  {
    if(bThursday.length < 5)
    {
      $('#lthSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bThursday))
      {
        $('#lthSpan').html('');
      }
      else
      {
        $('#lthSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bFriday == "")
  {
    $('#lfSpan').html('Please enter friday lunch menu');
    error = true;
  }
  else
  {
    if(bFriday.length < 5)
    {
      $('#lfSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bFriday))
      {
        $('#lfSpan').html('');
      }
      else
      {
        $('#lfSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSaturday == "")
  {
    $('#lstSpan').html('Please enter saturday lunch menu');
    error = true;
  }
  else
  {
    if(bSaturday.length < 5)
    {
      $('#lstSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSaturday))
      {
        $('#lstSpan').html('');
      }
      else
      {
        $('#lstSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSunday == "")
  {
    $('#lsSpan').html('Please enter sunday lunch menu');
    error = true;
  }
  else
  {
    if(bSunday.length < 5)
    {
      $('#lsSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSunday))
      {
        $('#lsSpan').html('');
      }
      else
      {
        $('#lsSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(!error)
  {
    $('#myLoader').show();
    lunchData = {
      'lunchId':lunchId,
      'lMonday':bMonday,
      'lTuesday':bTuesday,
      'lWednesday':bWednesday,
      'lThursday':bThursday,
      'lFriday':bFriday,
      'lSaturday':bSaturday,
      'lSunday':bSunday
    }

    $.post(url_updateLunchMenu,{lunchData:lunchData, _token:token}, function(data){
      $('#myLoader').hide();
      $('textarea').val('');
      $('#success').html(SucessMessage);
    });

  }
  else
  {
    $('#success').html(ErrorMessage);
  }
});

// update dinner
$('#editDinnerBtn').click(function(){

  var SucessMessage = '<div class="alert alert-success mt-3" role="alert">Dinner menu added successfully</div>';
  var ErrorMessage = '<div class="alert alert-success mt-3" role="alert">Please fix the errors</div>';
  var bMonday = $('textarea[name = monday]').val();
  var bTuesday = $('textarea[name = tuesday]').val();
  var bWednesday = $('textarea[name = wednesday]').val();
  var bThursday = $('textarea[name = thursday]').val();
  var bFriday = $('textarea[name = friday]').val();
  var bSaturday = $('textarea[name = saturday]').val();
  var bSunday = $('textarea[name = sunday]').val();
  var dinnerId = $('input[name = dinnerId]').val();
  var token = $('input[name = token]').val();
  var error = false;
 

  if(bMonday == "")
  {
    $('#dmSpan').html('Please enter monday dinner menu');
    error = true;
  }
  else
  {
    if(bMonday.length < 5)
    {
      $('#dmSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bMonday))
      {
        $('#dmSpan').html('');
      }
      else
      {
        $('#dmSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bTuesday == "")
  {
    $('#dtSpan').html('Please enter tuesday dinner menu');
    error = true;
  }
  else
  {
    if(bTuesday.length < 5)
    {
      $('#dtSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bTuesday))
      {
        $('#dtSpan').html('');
      }
      else
      {
        $('#dtSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bWednesday == "")
  {
    $('#dwSpan').html('Please enter wednesday dinner menu');
    error = true;
  }
  else
  {
    if(bWednesday.length < 5)
    {
      $('#dwSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bWednesday))
      {
        $('#dwSpan').html('');
      }
      else
      {
        $('#dwSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bThursday == "")
  {
    $('#dthSpan').html('Please enter thursday dinner menu');
    error = true;
  }
  else
  {
    if(bThursday.length < 5)
    {
      $('#dthSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bThursday))
      {
        $('#dthSpan').html('');
      }
      else
      {
        $('#dthSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bFriday == "")
  {
    $('#dfSpan').html('Please enter friday dinner menu');
    error = true;
  }
  else
  {
    if(bFriday.length < 5)
    {
      $('#dfSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bFriday))
      {
        $('#dfSpan').html('');
      }
      else
      {
        $('#dfSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSaturday == "")
  {
    $('#dstSpan').html('Please enter saturday dinner menu');
    error = true;
  }
  else
  {
    if(bSaturday.length < 5)
    {
      $('#dstSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSaturday))
      {
        $('#dstSpan').html('');
      }
      else
      {
        $('#dstSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(bSunday == "")
  {
    $('#dsSpan').html('Please enter sunday dinner menu');
    error = true;
  }
  else
  {
    if(bSunday.length < 5)
    {
      $('#dsSpan').html('Menu is too short');
      error = true;
    }
    else
    {
      if(isNaN(bSunday))
      {
        $('#dsSpan').html('');
      }
      else
      {
        $('#dsSpan').html('Menu cannot only be a digit');
        error = true;
      }
    }
  }

  if(!error)
  {
    $('#myLoader').show();
    dinnerData = {
      'dinnerId':dinnerId,
      'dMonday':bMonday,
      'dTuesday':bTuesday,
      'dWednesday':bWednesday,
      'dThursday':bThursday,
      'dFriday':bFriday,
      'dSaturday':bSaturday,
      'dSunday':bSunday
    }

    $.post(url_updateDinnerMenu,{dinnerData:dinnerData, _token:token}, function(data){
      $('#myLoader').hide();
      $('textarea').val('');
      $('#success').html(SucessMessage);
    });
  }
  else
  {
    $('#success').html(ErrorMessage);
  }
});

/* ********************************************** USER **************************************** */
$('#hostelLeaveValidateBtn').click(function(){
  var time = $('input[name = leaveDate]').val();
  if(time == '')
  {
    $('#leavedateSpan').html('Please enter leave date');
  }
  else
  {
    $('#hostelManagerLeaveYesBtn').show();
  }
});

$('#hostelManagerLeaveYesBtn').click(function(){
  $('#myLoader').show();
});

$('#deleteAccountBtn').click(function(){
  $('#deleteAccountAlert').show();
});

$('#deleteAccountNoBtn').click(function(){
  $('#deleteAccountAlert').hide();
});

$('#deleteAccountYesBtn').click(function(){
  $('#myLoader').show();
});

/* ****************************************** Hostel Registration ********************** */
function provinceChange()
{
  var province = $('select[name = hostelProvince]').val();
  alert(province);
}

/* **************************************** Admin ********************** */
$('#issueWarningBtn').click(function(){
  $('#myLoader').show();
});

$('#notifyHostelOwnerBtn').click(function(){
  $('#myLoader').show();
});

$('#blockedHostelNotifyOwner').click(function(){
  $('#myLoader').show();
});