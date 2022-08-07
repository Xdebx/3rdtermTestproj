<style>
  .navbar-brand {
      color: #FFFFFF;
      /* white */
  }

  .signin {
      color: #FFFFFF;
      /* white */
  }

  .signup {
      color: #FFFFFF;
      /* white */
  }

  span {
      color: #00FF00;
      /* lime */
  }

  a:hover {
      background-color: #00FFFF;
      color: #000000;
  }
</style>
{{-- <nav class="navbar navbar-default"> --}}
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="home"><strong>PET</strong><span>CLINIC</span></a>
          <a class="navbar-brand" href="{{ url('customers') }}">Customers</a>
          <a class="navbar-brand" href="{{ url('employees') }}">Employees</a>
          <a class="navbar-brand" href="{{ url('grooming') }}">Grooming Services</a>
          <a class="navbar-brand" href="{{ url('pets') }}">Pets</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">

              {{-- <li>
                    <a class="navbar-brand" href="{{ route('customer.index') }}">Customer</a>

                 </li> --}}
              {{-- @if (Auth::check()) --}}
              <li class="dropdown">
              <li>
                  <a href="#">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
                      <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                  </a>
              </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span
                          class="caret"></span></a>
                  <ul class="dropdown-menu">
                      @if (Auth::check())
                          @if (auth()->user()->role === 'admin')
                              <li><a href="{{ route('user.eprofile') }}"><i class="fa fa-user"></i>
                                      <strong>{{ Auth::User()->name }}</strong><i style="font-size:15px; color:red">
                                          {{ Auth::User()->role }}</i></a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="{{ route('user.logout') }}">Logout</a></li>
                          @elseif (auth()->user()->role === 'customer')
                              <li><a href="{{ route('user.profile') }}"><i class="fa fa-user"></i>
                                      <strong>{{ Auth::User()->name }}</strong><i style="font-size:15px; color:red">
                                          {{ Auth::User()->role }}</i></a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="{{ route('user.logout') }}">Logout</a></li>
                          @endif
                      @else
                          <li><a href="{{ route('user.signup') }}"><i class="fas fa-user-circle"
                                      style="color:red"></i> Signup as customer</a></li>
                          <li><a href="{{ route('user.esignup') }}"><i class="fas fa-user" style="color:blue"></i>
                                  Signup as admin</a></li>
                          <li><a href="{{ route('user.signin') }}">Signin</a></li>
                      @endif
                      {{-- <i class="fa-solid fa-user-crown"></i> --}}
                  </ul>
              </li>
          </ul>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
