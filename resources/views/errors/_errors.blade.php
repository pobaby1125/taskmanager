@if ( $errors->any() )
    <dl class="alert alert-danger">
        @foreach ( $errors->all() as $error )
            <dd>{{ $error }}</dd>
        @endforeach
    </dl>
@endif