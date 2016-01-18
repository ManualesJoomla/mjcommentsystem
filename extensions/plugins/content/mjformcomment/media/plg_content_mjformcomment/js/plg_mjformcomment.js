(function($){
	$(document).ready(function() {
    /* Send a comment */
		$("#mjformcomments #comments-form").submit(function(event){
			event.preventDefault();
			var form = $(this);
	    doAjax(form);
	  });

    /* Obtain data to be processed. Instantiating the Ajax*/
    function doAjax(form) {
      var array, ajax;
      var	url         = form.attr("action"),
          article_id	= form.find("#article_id").val(),
          name        = form.find("#jform_visitor_name").val(),
          email	      = form.find("#jform_visitor_email").val(),
          comments    = form.find("#jform_visitor_comments").val();

      // Always set content_id as last value
      var data = JSON.stringify({visitor_name: name, visitor_email: email, visitor_comments: comments, content_id: article_id});

      /*Pass the values to the AJAX request*/
      /*'ajax' is the jqXHR object*/
      ajax = theAjax(url, data)
        .done(function( response ){
          if( response.success && response.data) {
            $("#jform_visitor_comments").val('');
            mjNotification(response.message, 'green');
          } else {
            mjNotification(response.message, 'red');
          }
        })

        .fail( function( jqXHR, textStatus, errorThrown ) {
          if (jqXHR.status === 0) {
            mjNotification('Not connect: Verify Network.', 'red');
          } else if (jqXHR.status == 404) {
                mjNotification('Requested page not found [404]', 'red');
              } else if (jqXHR.status == 500) {
                  mjNotification('Internal Server Error [500].', 'red');
                } else if (textStatus === 'parsererror') {
                    mjNotification('Requested JSON parse failed.', 'red');
                  } else if (textStatus === 'timeout') {
                      mjNotification('Time out error.', 'red');
                    } else if (textStatus === 'abort') {
                        mjNotification('Ajax request aborted.', 'red');
                      } else {
                          mjNotification('Uncaught Error: ' + jqXHR.responseText, 'red');
                      }
        });
    }

    /*Returns the jqXHR object*/
    function theAjax(requrl, reqdata) {
      return $.ajax({
        url : requrl,
        type: 'post',
        dataType: 'json',
        data: {jform: reqdata}
      });
    }

    /* Comment notification system  */
    function mjNotification(text, color, icon) {
      var icon_markup = "",
          html,
          time = '5000',
          $container = $('body');

      if ($('#mjNotification').length) {
        $container = $('#mjNotification');
      }

      if (icon) {
        icon_markup = "<i class='" + icon + "'></i> ";
      }
      else {
        icon_markup = "<i class='fa fa-info-circle'></i> ";
      }

      // Generate the HTML
      html = $('<div class="mjalert mjalert-' + color + '"><p>' + icon_markup + text + '</p></div>').fadeIn('fast');

      // Append the label to the container
      $container.append(html);

      // Remove the notification on click
      html.on('click', function() {
        mjNotificationX($(this));
      });

      // After 'time' seconds, the animation fades out
      setTimeout(function() {
        mjNotificationX($container.children('.mjalert').first());
      }, time);
    }

    function mjNotificationX(element) {
      // Called without argument, the function removes all alerts
      // element must be a jQuery object

      if (typeof element !== "undefined") {
        element.fadeOut('fast', function() {
          $(this).remove();
        });
      } else {
        $('.mjalert').fadeOut('fast', function() {
          $(this).remove();
        });
      }
    }
  });
})(jQuery);
