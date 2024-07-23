$(document).ready(function() {
  $.ajax({
    url: '/admin/get_notifications',
    method: 'GET',
    success: function(response) {
      var notifications = JSON.parse(response);
      if (notifications.length > 0) {
        var $panel = $('#notificationPanel');
        notifications.forEach(function(notification) {
          $panel.append('<div>' + notification.message + '</div>');
        });
        $panel.fadeIn();
        setTimeout(function() {
          $panel.fadeOut();
        }, 5000);
      }
    },
    error: function(xhr, status, error) {
      console.error('Error en la solicitud AJAX:', status, error);
    }
  });
});
