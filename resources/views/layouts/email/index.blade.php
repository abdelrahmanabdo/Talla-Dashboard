<!DOCTYPE html>
<html>
  <body>
    @include('layouts.email.header')
    <div class="email-body">
      <div class="header-image">
        @yield('header-image')
      </div>
      <div class="content">
        <h3 class="title">
          @yield('title')
        </h3>
        <span class="sub-title">
          @yield('sub-title')
        </span>

        @yield('content')

      </div>
    </div>
    @include('layouts.email.footer')
  </body>
</html>

<style>
  body {
    padding: 0;
    margin: 0;
    background: #000523;
    text-align: center;
    font-family: Times New Roman;
  }
  .header-image {
    width: 85%;
    height: 30rem;
    margin-top: -150px !important;
    margin: auto;
  }
  .header-image img {
    width: 100%;
    height: 100%;
  }
  .content {
    min-height: 700px;
    padding: 30px !important;
  }
  .title {
    text-align: center;
    margin: 30px 0;
    color: #d4af37;
    font-size: 34px;
    font-weight: normal;
  }
  .sub-title {
    color: #FFF;
    font-size: 25px;
    font-weight: normal;
    text-align: center;
  }
  .copy {
    color: #FFF;
    font-size: 1.2rem;
    margin: 40px 0;
    text-align: start;
    line-height: 32px;
  }
  .section {
    margin: 50px 0;
    text-align: start;
  }
  .section-title {
    color: #D4AF37;
    font-size: 25px;
  }
  .section-content {
    display: flex;
    justify-content: space-between;
  }
  .section-list {
    padding: 10px 20px;
    list-style-type: disc;
    color: #FFF;
    font-size: 1.1rem;
  }
  .section-list li {
    margin-bottom: 10px;
    font-size: 26px;
  }
  .section-content img {
    width: 25%;
    height: 400px;
  }
  .section-content img.right {

  }
  .section-content img.left {
    
  }
  .images-section {
    display: flex;
    justify-content: center;
    gap: 2%;
    margin-top: 50px;
  }
  .images-section img {
    width: 30%;
    height: 300px;
  }
</style>