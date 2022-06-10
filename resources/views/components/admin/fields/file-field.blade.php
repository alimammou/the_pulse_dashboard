<div class="form-group row">
    {{ Form::label($name, $placeholder, ['class' => "col-md-2 from-control-label $required"]) }}

    @if(!empty($value))
        <div class="col-lg-1">
            <img src="{{ $value }}" alt="{{$alt ?? ''}}" height="80" width="80">
        </div>

        <div class="col-lg-9">
            {!! Form::file($name, ["class" => "form-control", "placeholder" => $placeholder] + $field_attributes) !!}
        </div>
    @else
        <div class="col-lg-5">
            {!! Form::file($name, ["class" => "form-control", "placeholder" => $placeholder] + $field_attributes) !!}
        </div>

    @endif

</div>
