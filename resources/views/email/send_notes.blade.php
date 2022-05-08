<html>

<body style="direction:rtl;background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px rgb(121, 127, 129);">
    <thead>
      <tr>
        <th style="text-align:left;"><img style="max-width: 150px;" src="
            @if(get_setting('logo'))
            {{ asset(get_setting('logo')) }}
            @else
            {{ asset('/media/logo.jpg') }}
            @endif
            " alt="bachana tours"></th>
        <th style="text-align:right;font-weight:400;">{{ date('yy-m-d') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
            @if($data['topic'])
                <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">الأسم</span>{{ $data['name'] }}</p>
            @endif
            @if($data['txt'])
                <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">البريد الألكترونى</span>{{ $data['email'] }}</p>
            @endif
        </td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">الموضوع</span><b style="color:green;font-weight:normal;margin:0">{{ $data['topic'] }}</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">النص</span> {{ $data['txt'] }}</p>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>
