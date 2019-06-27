@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-deck">
        @each('projects._cardlist', $projects, 'project', 'projects._cardempty')

        <div class="card col-4 my-3">
            <div class="card-body d-flex align-items-center justify-content-center">
                @include('projects._createModal')
            </div>
        </div>
  
    </div>
</div>
@endsection

@section('customJS')
    <script>
        $(function(){
            $('.icon-bar').hide();

            $('.project-card').hover(function(){
                $(this).find('.icon-bar').toggle();
            })
        })
    </script>
@endsection