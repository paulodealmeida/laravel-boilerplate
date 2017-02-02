@extends('layouts.base')

@section('content')
<section class="content-header">
    <h1>Examples</h1>
    <a href="{!! url('examples/create') !!}">
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> Adicionar novo
        </button>
    </a>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Imagem</th>
                                <th>Booleano</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($examples as $example)
                            <tr>
                                <td>{!! $example->id !!}</td>
                                <td>{!! $example->name !!}</td>
                                <td>
                                    @if($example->image)
                                    <img class="img-circle" src="{!! route('images.examples', $example->image) !!}" alt="{!! $example->name !!}" data-pin-nopin="true" width="60" height="60">
                                    @else
                                    <img class="img-circle" src="{!! url('assets/img/no_image.png') !!}" alt="{!! $example->name !!}" data-pin-nopin="true" width="60" height="60">
                                    @endif
                                </td>
                                <td>{!! $example->boolean ? 'Sim' : 'Não' !!}</td>
                                <td>
                                    <a href="{!! route('examples.edit', $example->id) !!}"><button class="btn btn-primary">Editar</button></a>
                                    <div class="btn-group">
                                        {!! Form::open(['route'=>['examples.destroy', $example->id], 'method' => 'DELETE']) !!}
                                        <button class="btn btn-danger" type="submit">Excluir</button>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Nada foi encontrado!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection