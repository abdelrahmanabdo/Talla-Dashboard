@extends('layouts.email.index')

@section('header-image')
  <img src={{asset('images/emails/header-1png')}} />
@endsection

@section('title')
  Neutral Skin Tones Message
@endsection

@section('sub-title')
  Dear Lady ... of Tallah
@endsection

@section('content')
  <div class="section">
    <span class="section-title"> 
      Picking the colors that complement your skin tone can transform the way you 
      look. These tips will  help you  choose the  right colors  for your  neutral  skin 
      tone: 
    </span>
    <div class="section-content">
      <ol class="section-list">
        <li>
           Since your skin tone is neutral you can wear both warm and  cool-toned 
           shades. However, try to stay away from overly saturated colors. 
        </li>
        <li>
           True red shades will help you stand out and look great on neutral skin tones.
        </li>
        <li>
            White is a simple, yet effective choice. 
        </li>
        <li>
           Toned down blue and green shades will also look amazing.
        </li>
        <li>
          Try experimenting with pastel colors.
        </li>
      </ol>
    </div>
  <div> 


  <div class="copy">
   To further elevate  your style  and  make  each  outfit  impactful,  you  should 
    explore the tips on the Chic Chat blog and the  styling sessions on Tallah app, 
    explore and make best use of your color choices.
  </div>

 <div class="copy">
   Tallah Wish you colorful days.
  </div>

  <div class="images-section">
    <img src={{ asset('images/emails/tops-section.png')}} />
    <img src={{ asset('images/emails/image-3.png')}} />
    <img src={{ asset('images/emails/dresses-section.png')}} />
  </div>
@endsection