<div class="form-group">
    <label for="name" class="control-label sr-only">Company Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
        placeholder="Company Name">
    @foreach ($errors->get('name') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>

<div class="form-group" hidden>
    <label for="slug" class="control-label sr-only">Slug</label>
    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" placeholder="Slug">
    @foreach ($errors->get('slug') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>

<div class="form-group">
    <label for="email" class="control-label sr-only">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Email">
    @foreach ($errors->get('email') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>

<div class="form-group">
    <label for="logo" class="control-label sr-only">Logo</label>
    <small>Company Logo</small>
    <input type="file" name="logo" class="form-control-file" id="logo">
    @error('logo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="website_url" class="control-label sr-only">Website URL</label>
    <input type="text" name="website_url" class="form-control" id="website_url" value="{{ old('website_url') }}"
        placeholder="Website URL">
    @foreach ($errors->get('website_url') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>


<a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
<button type="submit" class="btn btn-primary">Submit</button>
