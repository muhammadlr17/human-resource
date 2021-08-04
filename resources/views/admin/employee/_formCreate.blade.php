<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name" class="control-label sr-only">First Name</label>
            <input type="text" class="form-control input-sm @error('first_name') is-invalid @enderror" name="first_name"
                value="{{ old('first_name') }}" required autocomplete="first_name" autofocus id="first_name"
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
                value="{{ old('last_name') }}" required autocomplete="last_name" autofocus id="last_name"
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
        value="{{ old('username') }}" required autocomplete="username" autofocus id="username" placeholder="Username">
    @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="signin-email" class="control-label sr-only">Email</label>
    <input type="email" class="form-control input-sm @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email" autofocus id="signin-email" placeholder="Email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password" class="control-label sr-only">Password</label>
            <input id="password" type="password" class="form-control input-sm @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password" class="control-label sr-only">Password</label>
            <input id="password-confirm" type="password" class="form-control input-sm" name="password_confirmation"
                required autocomplete="new-password" placeholder="Confirm Password">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="phone" class="control-label sr-only" max="13">Phone</label>
    <input id="phone" type="text" class="form-control input-sm @error('phone') is-invalid @enderror" name="phone"
        value="{{ old('phone') }}" required placeholder="Phone" maxlength="13">

    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <select class="form-control input-sm @error('company_id') is-invalid @enderror" name="company_id">
        <option value="" selected>Your Company</option>
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
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
            <option value="{{ $departement->id }}">{{ $departement->name }}</option>
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
