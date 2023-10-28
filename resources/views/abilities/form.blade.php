<form id="modal_form" method="POST" action="{{ route('dashboard.roles.store') }}">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="form-label" for="name">Nom</label>
        <input type="text" id="role-name" name="name" placeholder="Administrateur" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="required" autofocus>
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>
</form>
