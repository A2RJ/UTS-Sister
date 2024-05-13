<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('nidn') }}</label>
    <div>
        {{ Form::text('nidn', $bkd->nidn, ['class' => 'form-control' .
        ($errors->has('nidn') ? ' is-invalid' : ''), 'placeholder' => 'Nidn']) }}
        {!! $errors->first('nidn', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('period') }}</label>
    <div>
        {{ Form::text('period', $bkd->period, ['class' => 'form-control' .
        ($errors->has('period') ? ' is-invalid' : ''), 'placeholder' => 'Period']) }}
        {!! $errors->first('period', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('lecture_name') }}</label>
    <div>
        {{ Form::text('lecture_name', $bkd->lecture_name, ['class' => 'form-control' .
        ($errors->has('lecture_name') ? ' is-invalid' : ''), 'placeholder' => 'Lecture Name']) }}
        {!! $errors->first('lecture_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('study_program') }}</label>
    <div>
        {{ Form::text('study_program', $bkd->study_program, ['class' => 'form-control' .
        ($errors->has('study_program') ? ' is-invalid' : ''), 'placeholder' => 'Study Program']) }}
        {!! $errors->first('study_program', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('status') }}</label>
    <div>
        {{ Form::text('status', $bkd->status, ['class' => 'form-control' .
        ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('jafung') }}</label>
    <div>
        {{ Form::text('jafung', $bkd->jafung, ['class' => 'form-control' .
        ($errors->has('jafung') ? ' is-invalid' : ''), 'placeholder' => 'Jafung']) }}
        {!! $errors->first('jafung', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('ab') }}</label>
    <div>
        {{ Form::text('ab', $bkd->ab, ['class' => 'form-control' .
        ($errors->has('ab') ? ' is-invalid' : ''), 'placeholder' => 'Ab']) }}
        {!! $errors->first('ab', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('c') }}</label>
    <div>
        {{ Form::text('c', $bkd->c, ['class' => 'form-control' .
        ($errors->has('c') ? ' is-invalid' : ''), 'placeholder' => 'C']) }}
        {!! $errors->first('c', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('d') }}</label>
    <div>
        {{ Form::text('d', $bkd->d, ['class' => 'form-control' .
        ($errors->has('d') ? ' is-invalid' : ''), 'placeholder' => 'D']) }}
        {!! $errors->first('d', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('e') }}</label>
    <div>
        {{ Form::text('e', $bkd->e, ['class' => 'form-control' .
        ($errors->has('e') ? ' is-invalid' : ''), 'placeholder' => 'E']) }}
        {!! $errors->first('e', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('total') }}</label>
    <div>
        {{ Form::text('total', $bkd->total, ['class' => 'form-control' .
        ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
        {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('summary') }}</label>
    <div>
        {{ Form::text('summary', $bkd->summary, ['class' => 'form-control' .
        ($errors->has('summary') ? ' is-invalid' : ''), 'placeholder' => 'Summary']) }}
        {!! $errors->first('summary', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label"> {{ Form::label('description') }}</label>
    <div>
        {{ Form::text('description', $bkd->description, ['class' => 'form-control' .
        ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
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