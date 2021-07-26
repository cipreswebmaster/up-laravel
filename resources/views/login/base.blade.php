@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/login.css") }}">
@endsection

@section('body')
  <div class="container">
    <div class="image">
      <img src="{{ asset("images/login/graduated-smiling.jpg") }}" alt="" />
    </div>
    <div class="form">
      @yield('form')
    </div>
  </div>
  {{-- <GraduatedSmilingContainer videoId={careerVideo}>
    {!isValidated ? (
      <CredentialsForm onLogin={handleLogin} />
    ) : (
      <CodeForm
        email={email}
        onMailChange={handleMailChange}
        setIsValidated={setIsValidated}
        onLoginComplete={handleLoginComplete}
      />
    )}
    {/* <CreateAccountBtn /> */}
  </GraduatedSmilingContainer> --}}
  
@endsection
