<!DOCTYPE html>
<html>
  <body class="body">
    @include('layouts.email.header')
    <h3 class="title">
      New E-mail subscription
    </h3>
    <span class="welcome-text">Welcome Dahlia,
      There is new E-mail subscription sent.
    </span>
    <p class="email"> 
      E-mail: {{ $data['email'] ?? '' }}
    </p>
  </body>
</html>

<style>
  .body {
    padding: 0;
    margin: 0;
    magin: auto;
    text-align: center;
    font-family: monospace;
  }
  .title {
    text-align: center;
    margin: 30px 0;
    color: #d4af37;
    font-size: 28px;
  }
  .welcome-text {
    font-size:20px;
    line-height: 2
  }
  .email {
    font-size: 20px;
    font-weight: 600;
    font-family: monospace;
    color: #012647;
  } 
</style>