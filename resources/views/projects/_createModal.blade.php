<!-- Button trigger modal -->
<button type="button" class="btn model-trigger" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-btn fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新建项目</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['url'=>'/projects', 'method'=>'POST', 'files'=>true]) !!}
                <div class="modal-body">
                    <div class="group">
                        <div class="form-group">
                            {!! Form::label('name', '项目名称：') !!}
                            {!! Form::text('name', '', ['class'=>'form-control']) !!}
                            {!! $errors->create->first('name', '<div class="alert alert-danger">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('thumbnail', '项目缩略图：') !!}
                            {!! Form::file('thumbnail', ['class'=>'form-control-file']) !!}
                            {!! $errors->create->first('thumbnail', '<div class="alert alert-danger">:message</div>') !!}
                        </div>
                    </div> 

                    {{--  @include('errors._errors')  --}}
                    {{--  @if ( $errors->create->any() )
                        <dl class="alert alert-danger">
                            @foreach ( $errors->create->all() as $error )
                                <dd>{{ $error }}</dd>
                            @endforeach
                        </dl>
                    @endif  --}}
                    

                </div>
                <div class="modal-footer">
                    {!! Form::submit('新建项目', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>