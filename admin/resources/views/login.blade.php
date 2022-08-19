@extends('layout.login')
@section('title')
    Admin | Login
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-5 mx-auto">
            <h3 class="text-center mb-5 ">Login Form</h3>
            <form action="" method="" class="loginForm">
                <div class="form-floating mb-3">
                    <input type="email" name="email" value="" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" value="" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>

            </form>
        </div>
    </div>
</div>
    
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

        });
        $('.loginForm').on('submit', function(event){
            event.preventDefault();
                let loginData = $(this).serializeArray();
                let email=loginData[0]['value'];
                let password=loginData[1]['value'];
                axios.post('/loginRequest', {
                    email:email,
                    pass:password
                }).then(function(response){
                    if(response.status==200){
                        if(response.data==1){
                            toastr.success('Login Success');
                            window.location.replace("/");
                        }else{
                            toastr.error('Email or password incorrect!');
                        }
                    }else{
                        toastr.error('Try Again!');
                    }
                }).catch(function(error){
                    toastr.error(error.message);
                })
            })
    </script>
@endsection