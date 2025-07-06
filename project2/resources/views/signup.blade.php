<x-base-layout title="signup" bodyClass="page-signup">


<main>
    <div class="container-small page-login">
      <div class="flex" style="gap: 5rem">
        <div class="auth-page-form">
          <div class="text-center">
            <a href="/">
              <img src="/img/logoipsum-265.svg" alt="" />
            </a>
          </div>
          <h1 class="auth-page-title">Signup</h1>

          <form action="{{route("createUser")}}" method="post">
              @csrf
            <div class="form-group">
              <input type="email" placeholder="Your Email" name="email"/>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Your Password" name="password"/>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Repeat Password" name="password2"/>
            </div>
            <hr />
            <div class="form-group">
              <input type="text" placeholder="First Name"  name="n1"/>
            </div>
            <div class="form-group">
              <input type="text" placeholder="Last Name" name="n2"/>
            </div>
            <div class="form-group">
              <input type="text" placeholder="Phone" name="phone"/>
            </div>
            <button class="btn btn-primary btn-login w-full" type="submit">Register</button>

            <div class="grid grid-cols-2 gap-1 social-auth-buttons">
              <button
                class="btn btn-default flex justify-center items-center gap-1"
              >
                <img src="/img/google.png" alt="" style="width: 20px" />
                Google
              </button>
              <button
                class="btn btn-default flex justify-center items-center gap-1"
              >
                <img src="/img/facebook.png" alt="" style="width: 20px" />
                Facebook
              </button>
            </div>
            <div class="login-text-dont-have-account">
              Already have an account? -
              <a href="{{route("login")}}"> Click here to login </a>
            </div>
          </form>
        </div>
        <div class="auth-page-image">
          <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
        </div>
      </div>
    </div>
  </main>

</x-base-layout>
