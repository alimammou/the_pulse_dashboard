<div class="form-group row">
    {{ Form::label($name, $placeholder, ['class' => "col-md-2 from-control-label $required"]) }}

    <div class="col-md-10">
        {{ Form::text($name, null, ['class' => 'form-control', 'placeholder' => $placeholder] + $field_attributes) }}
    </div>
    <!--col-->
</div>
<!--form-group-->
