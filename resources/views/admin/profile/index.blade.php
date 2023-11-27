@extends('admin.layouts.app')

@section('conteudo')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Perfil') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"> {{ __('Perfil') }}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Olá, {{ $user->name}}!</h2>
        <p class="section-lead">
            {{ __('Altere sobre você nessea pagina.') }}
        </p>

        <div class="row mt-sm-4">

            <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                    <form method="post" class="needs-validation" action="{{ route('admin.profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>{{ __('Editar Perfil') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-md-6 col-12">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="image" id="image-upload" />
                                    <input type="hidden" name="old_image" value="{{ $user->image }}">
                                   
                                </div>
                                @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('Nome') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name}}" required="">
                                <div class="invalid-feedback">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>{{ __('E-mail') }}</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email}}" required="">
                                <div class="invalid-feedback">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('Salvar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                <form method="post" action="{{ route('admin.profile-password.update', $user->id) }}" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{ __('Editar Senha') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-12">
                                    <label>{{ __('Senha anterior') }}</label>
                                    <input type="password" class="form-control" value="" required="" name="current_password">
                                    <div class="invalid-feedback">
                                        {{ __('admin.Please fill in the old password') }}
                                    </div>
                                    @error('current_password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('Nova senha') }}</label>
                                    <input type="password" class="form-control" value="" required="" name="password">
                                    <div class="invalid-feedback">
                                        {{ __('admin.Please fill in the new password') }}
                                    </div>
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label>{{ __('Confirmar nova senha') }}</label>
                                    <input type="password" class="form-control" value="" required="" name="password_confirmation">
                                    <div class="invalid-feedback">
                                        {{ __('admin.Please fill in the confirmed password') }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Salvar alteração') }}</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection()
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                "background-image": "url({{ asset($user->image) }})",
                "background-size": "cover",
                "background-position": "center center"
            });
        })
    </script>
@endpush
