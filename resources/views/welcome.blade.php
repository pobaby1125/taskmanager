@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-deck">
        @each('projects._cardlist', $projects, 'project', 'projects._cardempty')
    </div>

    @include('projects._createModal')
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