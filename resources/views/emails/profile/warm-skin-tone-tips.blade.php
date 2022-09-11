@extends('layouts.email.index')

@section('header-image')
  <img src={{asset('images/emails/header-2.png')}} />
@endsection

@section('title')
  Warm Skin Tones Message
@endsection

@section('sub-title')
  Dear Lady ... of Tallah
@endsection

@section('content')
  <div class="section">
    <span class="section-title"> 
      A great way to elevate your outfit and make  it  flattering  is to  use  colors  that 
      complement your skin tone  well. When it comes to  the warm skin  tone, these 
      colors will work wonders:  
    </span>
    <div class="section-content">
      <ol class="section-list">
        <li>
          Deep green shades go well with oranges and reds, which is why they are
          great for you
        </li>
        <li>
          Coral shades are in the same color family as your undertone, which is
          why they are a great choice
        </li>
        <li>
           You can't go wrong with warm tones like oranges and browns
        </li>
        <li>
          If you decide to go for blue shades, don't go for icy blues, instead opt for 
            something toned down
        </li>
      </ol>
    </div>
  <div> 


  <div class="copy">
   To learn more about which colors you should use for your outfits, check styling
    advices from Tallah stylists and Chic Chat Blog Tallah app.
  </div>

 <div class="copy">
   Tallah wish you a vibrant colorful days. 
  </div>

  <div class="images-section">
    <img src={{ asset('images/emails/tops-section.png')}} />
    <img src={{ asset('images/emails/image-3.png')}} />
    <img src={{ asset('images/emails/dresses-section.png')}} />
  </div>
@endsection