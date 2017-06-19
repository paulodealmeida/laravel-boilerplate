@extends('layouts.base')

@section('content')
<section class="content-header">
    <h1>Examples</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                {!! Form::open(['route' => ['examples.store'], 'novalidate']) !!}
                <div class="box-body">
                    @include('examples._form')
                </div>

                <div class="box-footer">
                    <a href="{!! url()->previous() !!}" class="btn btn-default">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</section>
@endsection