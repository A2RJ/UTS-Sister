<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('Nama Dosen') }}</label>
    <div>
        {{ Form::text('', auth()->user()->sdm_name, [
            'class' => 'form-control',
            'placeholder' => 'Nama Dosen',
            'readonly' => 'readonly'
        ]) }}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('jafung') }}</label>
    <div>
        {{ Form::select('jafung', [
            'asisten ahli 150' => 'Asisten Ahli 150',
            'lektor 200' => 'Lektor 200',
            'lektor 300' => 'Lektor 300',
            'lektor kepala 400' => 'Lektor Kepala 400',
            'lektor kepala 550' => 'Lektor Kepala 550',
            'lektor kepala 700' => 'Lektor Kepala 700',
            'profesor 800' => 'Profesor 800',
            'profesor 1050' => 'Profesor 1050'
        ], old('jafung', $jafung->jafung), [
            'class' => 'form-control' . ($errors->has('jafung') ? ' is-invalid' : ''),
            'placeholder' => 'Select Jafung'
        ]) }}
        {!! $errors->first('jafung', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('sk_number') }}</label>
    <div>
        {{ Form::text('sk_number', $jafung->sk_number, ['class' => 'form-control' .
        ($errors->has('sk_number') ? ' is-invalid' : ''), 'placeholder' => 'Sk Number']) }}
        {!! $errors->first('sk_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('start_from') }}</label>
    <div>
        {{ Form::date('start_from', $jafung->start_from, ['class' => 'form-control' .
        ($errors->has('start_from') ? ' is-invalid' : ''), 'placeholder' => 'Start From']) }}
        {!! $errors->first('start_from', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('attachment') }}</label>
    <div>
        {{ Form::file('attachment', ['class' => 'form-control' .
        ($errors->has('attachment') ? ' is-invalid' : ''), 'placeholder' => 'attachment']) }}
        {!! $errors->first('attachment', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="#" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>