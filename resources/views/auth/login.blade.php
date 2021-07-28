<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>E-KRS &mdash; Login</title>

    @include('template.partials._style')
</head>

<style>
body{
    background-image: url("gambar/bg.png");
    background-size: cover; 
}
</style>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                        <img src="gambar/logo.png"  width="200px">
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger mt-1">
                                <i class="fas fa-info-circle mr-2"></i>
                                {{ session('error') }}
                            </div>
                        @enderror

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ url('/login') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" placeholder="Username" type="text" class="form-control" name="username" tabindex="1"
                                            required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input id="password" placeholder="Password" type="password" class="form-control" name="password"
                                            tabindex="2" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; E-KRS {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('template.partials._script')
</body>

</html>
