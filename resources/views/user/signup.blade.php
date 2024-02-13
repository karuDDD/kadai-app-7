<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}" />

    <title>kadai-app | 新規登録</title>
</head>
<!-- ログイン画面 -->

<body class="">
    <x-header></x-header>
    <div class="page singup-page">
        <form class="form" action="/signup" method="create">
            @csrf
            <div class="form-item name">
               <label for="name">Name</label>
               <input type="text" id="name" name="name" />
            </div>
              @error('name')
               {{$message}}
               @enderror
            <div class="form-item email">
                <label for="email">Email</label>
                 <input type="text" id="email" name="email" />
            </div>
              @error('name')
               {{$message}}
              @enderror
            <div class="form-item pasword">
                  <label for="password">Password</label>
                  <input type="password" id="password" name="password" />
             </div>
               @error('password')
                  {{ $message }}
                   @enderror
              <div class="login-button">
                  <button class="buton-white" id="createbtn" type="submit">新規登録</button>
              </div>
        </form>
   </div>
</body>

      

<script src="{{ asset('/js/app.js') }}"></script>
<style scoped></style>

 <script>
      window.onload = function (){
     const postbtnSubmit = document.getElementById('createbtn');
     const inputName = document.getElementById('name');
     const inputEmail = document.getElementById('email');
     const inputPassword = document.getElementById('password');
     const regMall = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/;
     const regPass = /[A-Za-z0-9_.-]/;

     postbtnSubmit.addEventListener('click',function(event){
        let message = [];

        if(inputName.value == ""){
            message.push("名前が未入力です。");
        }

        if(inputEmail.value == ""){
            message.push("メールアドレスが未入力です。");
        }else if(!regMail.test(inputEmail.valie)){
            massage.push("入力されたメールアドレスの形態が無効です")
        }else if(inputEmail.value.length > 140){
            message.push("入力可能文字数は140文字以内です。")
        }

        if (inputPassword.value == "") {
                message.push("パスワードが未入力です。");
            } else if (!regPass.test(inputPassword.value)) {
                message.push("パスワードは半角英数字、記号のみで入力してください");
            } else if (inputPassword.value.length < 8) {
                message.push("パスワードは８文字以上です。");
            }

            if (message.length > 0) {
                alert(message);
                return;
            }
            document.create.submit();



       })
      }
 </script>   


<style scoped>
    
  </html>