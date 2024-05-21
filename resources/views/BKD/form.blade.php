<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/dist/css/bootstrap-select.css">


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="/dist/js/bootstrap-select.js"></script>
<script src="/dist/js/jquery-select-chained/jquery-select-chained.js"></script>

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
        {{ Form::label('human_resource_id', 'Nama Dosen', ['class' => 'form-label']) }}
        {{ Form::select('human_resource_id', 
        $lecturers->pluck('sdm_name', 'id')->prepend('Pilih nama dosen', ''), 
        old('human_resource_id', $bkd->human_resource_id), 
        [
            'class' => 'form-control w-100 border rounded selectpicker ' . ($errors->has('human_resource_id') ? ' is-invalid' : ''), 
            'id' => 'human_resource_id', 
            'data-live-search' => 'true'
        ]) 
        }}
        {!! $errors->first('human_resource_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label">{{ Form::label('nidn', 'NIDN') }}</label>
        <div>
            <select name="nidn" id="nidn" class="form-control w-100 border rounded {{ $errors->has('nidn') ? ' is-invalid' : '' }}">
                @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->id }}" data-chained="{{ $lecturer->id }}" {{ old('nidn', $bkd->nidn) == $lecturer->id ? 'selected' : '' }}>
                    {{ $lecturer->nidn }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('nidn', '<div class="invalid-feedback">:message</div>') !!}
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
        ], $bkd->jafung, ['class' => 'form-control selectpicker ' . ($errors->has('jafung') ? ' is-invalid' : '')]) }}
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
        <label class="form-label">{{ Form::label('status', 'Status') }}</label>
        <div>
            {{ Form::select('status', ['DS' => 'DS', 'DT' => 'DT'], $bkd->status, ['class' => 'form-control selectpicker ' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Select Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-6 mb-3">
        <label class="form-label">{{ Form::label('summary', 'Summary') }}</label>
        <div>
            {{ Form::select('summary', 
            ['TM' => 'TM', 'M' => 'M'], 
            old('summary', $bkd->summary), 
            [
                'class' => 'form-control selectpicker ' . ($errors->has('summary') ? ' is-invalid' : ''), 
                'placeholder' => 'Select Summary'
            ]) 
        }}
            {!! $errors->first('summary', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="form-group col-md-12 mb-3">
        <label class="form-label"> {{ Form::label('description') }}</label>
        <div>
            {{ Form::textarea('description', $bkd->description, ['class' => 'form-control' .
            ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description', 'rows' => 3]) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('bkd.index') }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>
<script>
    // jQuery(document).ready(function() {
    // })
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.selectpicker').selectpicker()
        $("#series").chained("#mark");
        $("#nidn").chained("#human_resource_id");
    });
</script>