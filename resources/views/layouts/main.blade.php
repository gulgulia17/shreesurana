<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title',config('app.name'))</title>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/sp-1.0.1/sl-1.3.1/datatables.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <style>
      .select2 {
        width: 100% !important;
      }

      .required {
        color: #dc3545 !important;
        margin: 0 0.2rem;
      }

    </style>
    @yield('style')
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      @include('layouts.includes.navbar')
      @include('layouts.includes.sidebar')
      @include('layouts.includes.header',[$name])
      @include('layouts.includes.footer')
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/js/OverlayScrollbars.min.js"></script>
    <script src="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/sp-1.0.1/sl-1.3.1/datatables.min.js">
    </script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script>
      $(".selectSearch").select2({
        width: 'resolve' // need to override the changed default
      });

    </script>
    @yield('script')
    <script type="text/javascript">
      function getCurrentTime() {
        var now = new Date();
        var hh = now.getHours();
        var min = now.getMinutes();
        var ampm = (hh >= 12) ? 'PM' : 'AM';
        hh = hh % 12;
        hh = hh ? hh : 12;
        hh = hh < 10 ? '0' + hh : hh;
        min = min < 10 ? '0' + min : min;
        var time = hh + ":" + min + " " + ampm;
        return time;
      }

      function send_msg() {
        $('.start_chat').hide();
        const _token = $('input[name="_token"]').val();
        const message = $('input[name="message"]').val();
        const ip = $('input[name="ip"]').val();
        var html = '<li class="messages-me clearfix"><span class="message-img"><img src="assets/images/logo/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + message + '</p></div></li>';
        $('.messages-list').append(html);
        $('#input-me').val('');
        if (message) {
          $.ajax({
            type: "post",
            url: "/sendmessage",
            data: {
              'message': message,
              'ip': ip,
              '_token': _token
            },
            success: function(result) {
              var html = '<li class="messages-you clearfix"><span class="message-img"><img src="assets/images/logo/logo.png" style="width: 10%;" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">School App</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + result + '</p></div></li>';
              $('.messages-list').append(html);
              $('.messages-box').scrollTop($('.messages-box')[0].scrollHeight);
            }
          });
        }
      }
    </script>
  </body>

</html>
