@extends('layouts.email.index')

@section('header-image')
  <img src={{asset('images/emails/header-2.png')}} />
@endsection

@section('title')
  Cool Skin Tones Message
@endsection

@section('sub-title')
  Tallah Lady
@endsection

@section('content')
  <div class="section">
    <span class="section-title"> To  make  sure  your  skin  tone  stands  out ,  you should  wear the  colors  that 
    complement it nicely. When it comes to cool skin tone, these tips will help you
    to find the right color combinations:  </span>
    <div class="section-content">
      <ol class="section-list">
        <li>
           Blue shades are on the same end of spectra, which is why they will look
           amazing on you.
        </li>
        <li>
          Although you may fear that gray shades will make your outfits look dull, it's quite the opposite! 
        </li>
        <li>
          Pink shades with blue undertones will flatter your skin type.
        </li>
        <li>
          If you enjoy wearing warmer colors, try pastels or faded yellow shades.
        </li>
      </ol>
    </div>
  <div> 


  <div class="copy">
   You can learn how to make your outfits look  perfect  every time thanks  to the
   professional  stylists  at  the  online  service  of  Tallah . Book  your  makeover
   session and explore your closet styling possibilities.
  </div>

  <div class="images-section">
    <img src={{ asset('images/emails/tops-section.png')}} />
    <img src={{ asset('images/emails/image-3.png')}} />
    <img src={{ asset('images/emails/dresses-section.png')}} />
  </div>
@endsection