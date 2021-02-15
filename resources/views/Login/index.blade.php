<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <style>
        .icon-login{
            width: 200px;
            top:2px;
            margin-top: -120px;
            position: absolute;
        }
        .title-login{
            font-family: 'Bungee', cursive;
            font-size: 30px;
        }
        label{
            font-family:Arial, Helvetica, sans-serif;
            font-weight: bold;
            
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
    <div class="loading pt-5" style="display: none;  background-color: #f2f2f2;z-index: 99;opacity: 1; position:fixed; text-align:center; height:100%;width:100%;">
    <img src="{{asset('loader/Rolling.svg')}}" style=" width:115px;padding-top:10%" alt="">
  </div>  
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 ">
                <div class="text-center mt-4">
                    <div class="title-login text-dark">Sistem <br> Purcase Request</div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12  d-flex justify-content-center p-2">
                        <div class="card" style="width: 100%; position: relative; margin-top: 120px; box-shadow: 2px 2px #888888;">
                            <br>
                            <br>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{asset('img/default.png')}}" class="icon-login" alt="">
                                    </div>
                                    <form id="loginForm">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                                            <div class="notivUser text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                                            <div class="notivPass text-danger"></div>
                                        </div>
                                        <hr>
                                        <button type="button" class="btn btn-block btn-primary mb-4" id="actLogin">Login</button>
                                    </form>
                                </div>

                        </div>
                    
            </div>
            <div class="col-md-12 text-center" class="" style="color:#888888;">
                <label for="">Copyright&copy;kelompok21-2020 <br> VR 0.1</label> 
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#actLogin').on('click', function(){
                let username = $('input[name="username"]').val();
                let password = $('input[name="password"]').val();
                var _token = $("input[name='_token']").val();

                // console.log(password);
                if(username=="" || password==""){
                    if(username==""){
                        $('.notivUser').html('Username Harus Diisi !')
                    }else{
                        $('.notivUser').html('')
                    }
                    if(password==""){
                        $('.notivPass').html('Password Harus Diisi !')
                    }else{
                        $('.notivPass').html('')
                    }
                }else{
                    $.ajax({
                        url:"{{route('login.check_login')}}",
                        method:'post',
                        data:{_token:_token,username:username,password:password},
                        dataType:'json',
                        beforeSend:function(){
                            $('#form_modal').modal('hide');
                            $(".loading").css("display","block");
                        },
                        success:function(res){
                            // console.log(res)

                            if(res=='berhasil'){

                                $('input[name="username"]').val('');
                                $('.notivUser').html('');
                                $('.notivPass').html('');
                                $('input[name="password"]').val('');
                                
                                window.location = "/Dashboard";
                            $(".loading").css("display","none");
                            }else{
                            $(".loading").css("display","none");

                                $('.notivUser').html('');
                                $('.notivPass').html('');
                                $('input[name="username"]').val('');
                                $('input[name="password"]').val('');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login gagal!',
                                    text: 'pastikan username dan password benar'
                                });
                            }
                        }
                    })
                }
                
            });
        });
    </script>
</body>
</html>