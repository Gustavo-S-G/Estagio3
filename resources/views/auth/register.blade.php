@extends('layouts.app')

@section('content')
  <div class="card">

    <div class="card-header text-center">
        <img class="mb-4" src="{{ url('imagens/logoLogin.png') }}" alt="" width="100%">
        {{-- <a href="../../index2.html" class="h1"><b>Persis</b></a> --}}
    </div>

    <div class="card-body login-card-body">
        <p class="login-box-msg"><b>Criar nova conta</b></p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="name" type="text" placeholder="Nome" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

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

            <div class="input-group mb-3">
                <input id="password-confirm" type="password" placeholder="Confirmar Senha" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>


            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </div>
        </form>
        <p class="mb-0">
            <a href="{{route('login')}}" class="text-center">Já possui uma conta?</a>
        </p>
    </div>
    <!-- /.Register-card-body -->

@endsection
