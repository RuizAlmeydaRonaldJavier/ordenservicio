(function ($) {
  'use strict';

  $(document).ready(function () {
      GrowlNotification.setGlobalOptions({
          buttons: {
              action: {
                  text: 'Apply'
              },
              cancel: {
                  text: 'Dismiss'
              }
          }
      });

      function getOptions() {
          var position = $('#notification-position').val();
          var closeTimeout = $('#close-timeout').val();
          var animation = $('#animation').val();
          var showButtons = $('#show-buttons').get(0).checked;
          var showProgressBar = $('#show-progress-bar').get(0).checked;
          var animationOptions = {
              open: animation + '-in',
              close: animation + '-out'
          };

          if (animation === 'none') {
              animationOptions = {
                  open: false,
                  close: false
              };
          }

          return {
              description: 'I am a default notification',
              position: position,
              closeTimeout: closeTimeout,
              closeWith: ['click'],
              animation: animationOptions,
              showButtons: showButtons,
              buttons: {
                  action: {
                      callback: function (notification) {
                          console.log('action button');
                      }
                  }
              },
              showProgress: showProgressBar
          };
      }

      $('#notification-theme').on('change', function() {
        $('#growl-notification-theme').attr('href', this.value);
      });

      $('#show-notification-default-simple').on('click', function () {
          GrowlNotification.notify(getOptions());
      });

      $('#show-notification-default-alert').on('click', function () {
          var options = getOptions();
          options.title = 'Hello!';
          options.description = 'I am a default notification. I am a default notification. I am a default notification. I am a default notification.';
          options.width = 500;
          GrowlNotification.notify(options);
      });

      $('#show-notification-default-success').on('click', function () {
          var options = getOptions();
          options.title = 'Well Done!';
          options.description = 'You just submit your resume successfully.';
          options.type = 'success';
          GrowlNotification.notify(options);
      });

      $('#show-notification-default-error').on('click', function () {
          var options = getOptions();
          options.title = 'Warning!';
          options.description = 'The data presentation here can be change.';
          options.type = 'error'; // or danger
          GrowlNotification.notify(options);
      });

      $('#show-notification-default-warning').on('click', function () {
          var options = getOptions();
          options.title = 'Reminder!';
          options.description = 'You have a meeting at 10:30 АМ';
          options.type = 'warning';
          GrowlNotification.notify(options);
      });

      $('#show-notification-default-info').on('click', function () {
          var options = getOptions();
          options.title = 'Sorry!';
          options.description = 'Could not complete your transaction.';
          options.type = 'info';
          options.image = {
              visible: true
          };
          GrowlNotification.notify(options);
      });

      $('#show-notification-icon-alert').on('click', function () {
          var options = getOptions();
          options.title = 'Hello!';
          options.description = 'I am a default notification.';
          options.image = {
              visible: true
          };
          GrowlNotification.notify(options);
      });

      $('#show-notification-icon-success').on('click', function () {
          var options = getOptions();
          options.title = 'Well Done!';
          options.description = 'You just submit your resume successfully.';
          options.image = {
              visible: true
          };
          options.type = 'success';
          GrowlNotification.notify(options);
      });

      $('#show-notification-icon-error').on('click', function () {
          var options = getOptions();
          options.title = 'Warning!';
          options.description = 'The data presentation here can be change.';
          options.image = {
              visible: true
          };
          options.type = 'danger';
          GrowlNotification.notify(options);
      });

      $('#show-notification-icon-warning').on('click', function () {
          var options = getOptions();
          options.title = 'Reminder!';
          options.description = 'You have a meeting at 10:30 АМ';
          options.image = {
              visible: true
          };
          options.type = 'warning';
          GrowlNotification.notify(options);
      });

      $('#show-notification-icon-info').on('click', function () {
          var options = getOptions();
          options.title = 'Sorry!';
          options.description = 'Could not complete your transaction.';
          options.image = {
              visible: true
          };
          options.type = 'info';
          GrowlNotification.notify(options);
      });
  });
})(jQuery);
