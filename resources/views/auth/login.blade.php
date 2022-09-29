@extends('layouts.app')

@section('content')
    <!-- /.login-logo -->
  <div class="card">

    <div class="card-header text-center">
        <img class="mb-4" src="{{ url('imagens/logoLogin.png') }}" alt="" width="100%">
        {{-- <a href="../../index2.html" class="h1"><b>Persis</b></a> --}}
    </div>

    <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Login</b></p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" placeholder="Senha" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row" style="margin-left: 10px;">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Lembrar de mim
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
                <!-- /.col -->
            </div>

        </form>
        <p class="mb-0">
            <a href="#" class="text-center">Esqueceu sua senha?</a>
            {{-- <a href="{{ route('forget.password.get') }}">Esqueceu sua senha?</a> --}}
        </p>
        <p class="mb-0">
            <a href="{{route('register')}}" class="text-center">Create new account</a>
        </p>
    </div>
    <!-- /.login-card-body -->
@endsection


