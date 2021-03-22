@extends(backpack_view('blank'))

@php
    Widget::add([
         'type'    => 'div',
         'class'   => 'row',
         'content' => [
             // New users
             [
                 'type'       => 'chart',
                 'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,
                 'class'   => 'card mb-2',
                 'wrapper' => ['class'=> 'col-md-6'],
                 'content' => [
                     'header' => 'New Users',
                     'header_class' => 'app-header bg-dark',
                     'body'   => 'This chart should make it obvious how many new users have signed up in the past 30 days.<br><br>',
                 ]
             ],
             // New stylists
             [
                 'type'       => 'chart',
                 'controller' => \App\Http\Controllers\Admin\Charts\WeeklyStylistsChartController::class,
                 'class'   => 'card mb-2',
                 'wrapper' => ['class'=> 'col-md-6'],
                 'content' => [
                     'header' => 'New Stylists',
                     'header_class' => 'app-header bg-dark',
                     'body'   => 'This chart should make it obvious how many new stylists have signed up in the past 30 days.<br><br>',
                 ]
             ],
             [ 'type' => 'card', 'content' => ['body' => 'Blogs'] ],
             [ 'type' => 'card', 'content' => ['body' => 'Categories'] ],
             [ 'type' => 'card', 'content' => ['body' => 'Colors'] ],
         ]
     ])
@endphp

@section('content')
@endsection
