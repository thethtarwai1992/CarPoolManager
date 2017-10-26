@extends('layouts.design')
@section('title', '- My Rides') 
@section('styles')
<style> 
    @media only screen and (min-width: 992px){
        .rides-list{
            margin-left: 15%;
            margin-right: 15%;
        }
    }
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>My Rides</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->  

        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="rides-list">  

                <div class="clearfix"></div>

                @if(count($rides) > 0 )

                @foreach ($rides as $ride)
                <article class="ride-box clearfix">
                    <div class="ride-content">
                        <h3><a href="#">From <b> {{ $ride->start_point }} </b> to <b> {{ $ride->destination }}</b></a></h3> 
                        <i class="fa fa-money"></i> {{ $ride->price }} 
                    </div>

                    <ul class="ride-meta">
                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                {{ $ride->created_at }}  
                            </a>
                        </li><!-- end .ride-date --> 

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->
                @endforeach
                @else
                <article class="ride-box clearfix">
                    <div class="ride-content">
                        No Record Found.
                    </div>
                </article> 
                @endif 

            </div><!-- end .events-list -->

        </div><!-- end .page-content -->

    </div><!-- end .row -->
</div><!-- end .container -->

@stop
