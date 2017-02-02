<div class="row">
    <div class="col-md-4">
        <div class="form-group has-feedback {!! $errors->has('name')?'has-error':null !!}">
            {!! Form::label('name', 'Nome *'); !!}
            {!! Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'required' => '']) !!}
            @if($errors->has('name'))
            <span class="help-block">{!! $errors->first('name') !!}</span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback {!! $errors->has('boolean')?'has-error':null !!}">
            {!! Form::label('boolean', 'É dinheiro'); !!}
            {!! Form::select('boolean', ['1' => 'Sim', '0' => 'Não'], old('boolean'), ['id' => 'boolean', 'class' => 'form-control']) !!}
            @if($errors->has('boolean'))
            <span class="help-block">{!! $errors->first('boolean') !!}</span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback {!! $errors->has('image')?'has-error':null !!}">
            {!! Form::label('image', 'Imagem'); !!}
            {!! Form::file('image', '', ['id' => 'image', 'class' => 'form-control']) !!}
            @if($errors->has('image'))
            <span class="help-block">{!! $errors->first('image') !!}</span>
            @endif
        </div>
    </div>
</div>