<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name" class="control-label sr-only">First Name</label>
            <input type="text" class="form-control input-sm @error('first_name') is-invalid @enderror" name="first_name"
                value="{{ $employee->first_name }}" required autocomplete="first_name" autofocus id="first_name"
                placeholder="First Name">
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name" class="control-label sr-only">Last Name</label>
            <input type="text" class="form-control input-sm @error('last_name') is-invalid @enderror" name="last_name"
                value="{{ $employee->last_name }}" required autocomplete="last_name" autofocus id="last_name"
                placeholder="Last Name">
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="username" class="control-label sr-only">Username</label>
    <input type="text" class="form-control input-sm @error('username') is-invalid @enderror" name="username"
        value="{{ $employee->username }}" required autocomplete="username" autofocus id="username"
        placeholder="Username">
    @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="signin-email" class="control-label sr-only">Email</label>
    <input type="email" class="form-control input-sm @error('email') is-invalid @enderror" name="email"
        value="{{ $employee->email }}" required autocomplete="email" autofocus id="signin-email" placeholder="Email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="phone" class="control-label sr-only">Phone</label>
    <input id="phone" type="text" class="form-control input-sm @error('phone') is-invalid @enderror" name="phone"
        value="{{ $employee->phone }}" required placeholder="Phone" maxlength="13">

    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="photo" class="control-label sr-only">Photo</label>
    <small>Photo Profile</small>
    <input type="file" name="photo" class="form-control-file @error('phone') is-invalid @enderror" id="photo"
        value="{{ $employee->photo }}">
    @error('photo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @if (strlen($employee->photo) > 0)
        <img src="{{ asset('image/profile/' . $employee->photo) }}" width="80px" class="mt-1">
    @endif
</div>

<div class="form-group">
    <select class="form-control input-sm @error('company_id') is-invalid @enderror" name="company_id">
        <option value="" selected>Your Company</option>
        @foreach ($companies as $company)
            @if ($company->id == $employee->company_id)
                @php($select = 'selected')
            @else
                @php($select = '')
            @endif
            <option {{ $select }} value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
    </select>
    @error('company_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <select class="form-control input-sm @error('departement_id') is-invalid @enderror" name="departement_id">
        <option value="" selected>Your Departement</option>
        @foreach ($departements as $departement)
            @if ($departement->id == $employee->departement_id)
                @php($select = 'selected')
            @else
                @php($select = '')
            @endif
            <option {{ $select }} value="{{ $departement->id }}">{{ $departement->name }}</option>
        @endforeach
    </select>
    @error('departement_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
<button type="submit" class="btn btn-primary">Submit</button>
