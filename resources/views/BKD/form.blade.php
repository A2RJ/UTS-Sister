<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/dist/css/bootstrap-select.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="/dist/js/bootstrap-select.js"></script>

<div class="row">
    <div class="form-group col-md-6 mb-3">
        <label class="form-label"> {{ Form::label('periode') }}</label>
        <div>
            {{ Form::text('period', $bkd->period, ['class' => 'form-control' .
            ($errors->has('period') ? ' is-invalid' : ''), 'placeholder' => 'Period']) }}
            {!! $errors->first('period', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label">{{ Form::label('lecture_name', 'Nama Dosen') }}</label>
        <select class="w-100  border rounded selectpicker @error('lecture_name') is-invalid @enderror" id="lecture_name" name="lecture_name" data-live-search="true">
            <option>Pilih Nomor PPUF</option>
            @foreach ($lecturers as $ppuf)
            <option value="{{ $ppuf->id }}" {{ old('lecture_name') == $ppuf->id ? 'selected' : '' }}>
                {{ $ppuf->sdm_name }}
            </option>
            @endforeach
        </select>
        {!! $errors->first('lecture_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label"> {{ Form::label('nidn') }}</label>
        <div>
            {{ Form::text('nidn', $bkd->nidn, ['class' => 'form-control' .
            ($errors->has('nidn') ? ' is-invalid' : ''), 'placeholder' => 'Nidn']) }}
            {!! $errors->first('nidn', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label"> {{ Form::label('Program Studi') }}</label>
        <div>
            {{ Form::text('study_program', $bkd->study_program, ['class' => 'form-control' .
            ($errors->has('study_program') ? ' is-invalid' : ''), 'placeholder' => 'Study Program']) }}
            {!! $errors->first('study_program', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label">{{ Form::label('status', 'Status') }}</label>
        <div>
            {{ Form::select('status', ['DS' => 'DS', 'DT' => 'DT'], $bkd->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Select Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label">{{ Form::label('jafung', 'Jabatan Fungsional') }}</label>
        <div>
            {{ Form::select('jafung', [
            '' => 'Select Jafung',
            'tenaga kependidikan' => 'Tenaga Kependidikan',
            'lektor' => 'Lektor',
            'lektor kepala' => 'Lektor Kepala',
            'asisten ahli' => 'Asisten Ahli',
        ], $bkd->jafung, ['class' => 'form-control' . ($errors->has('jafung') ? ' is-invalid' : '')]) }}
            {!! $errors->first('jafung', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-2 mb-3">
        <label class="form-label"> {{ Form::label('ab') }}</label>
        <div>
            {{ Form::text('ab', $bkd->ab, ['class' => 'form-control' .
            ($errors->has('ab') ? ' is-invalid' : ''), 'placeholder' => 'Ab']) }}
            {!! $errors->first('ab', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-2 mb-3">
        <label class="form-label"> {{ Form::label('c') }}</label>
        <div>
            {{ Form::text('c', $bkd->c, ['class' => 'form-control' .
            ($errors->has('c') ? ' is-invalid' : ''), 'placeholder' => 'C']) }}
            {!! $errors->first('c', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-2 mb-3">
        <label class="form-label"> {{ Form::label('d') }}</label>
        <div>
            {{ Form::text('d', $bkd->d, ['class' => 'form-control' .
            ($errors->has('d') ? ' is-invalid' : ''), 'placeholder' => 'D']) }}
            {!! $errors->first('d', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-2 mb-3">
        <label class="form-label"> {{ Form::label('e') }}</label>
        <div>
            {{ Form::text('e', $bkd->e, ['class' => 'form-control' .
            ($errors->has('e') ? ' is-invalid' : ''), 'placeholder' => 'E']) }}
            {!! $errors->first('e', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-4 mb-3">
        <label class="form-label"> {{ Form::label('total') }}</label>
        <div>
            {{ Form::text('total', $bkd->total, ['class' => 'form-control' .
            ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
            {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label"> {{ Form::label('summary') }}</label>
        <div>
            {{ Form::text('summary', $bkd->summary, ['class' => 'form-control' .
            ($errors->has('summary') ? ' is-invalid' : ''), 'placeholder' => 'Summary']) }}
            {!! $errors->first('summary', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label"> {{ Form::label('description') }}</label>
        <div>
            {{ Form::text('description', $bkd->description, ['class' => 'form-control' .
            ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
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
<script>
    $('.selectpicker').selectpicker()
</script>