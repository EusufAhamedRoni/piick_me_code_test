<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title></title>

    <!-- Icons font CSS-->
    <link href="{{ asset('css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" media="all">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('homeView') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('create.permission') }}">Give permission to User for creating license</a>
            </li>
          </ul>

          <a class="nav-link active" aria-current="page" href="{{ route('logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
      <div class="card card-5">
        <div class="card-heading">
          <h2 class="title">Create License as an admin</h2>
        </div>
        <div class="card-body">
          @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
          @endforeach
          <div class="alert" role="alert">

          </div>
          <div id="show_user" style="width: 18rem;">
          </div>
          <form action="{{route('key.save')}}" method="POST" id="form">
            @csrf

            <div class="form-row">
              <div class="name">Client ID</div>
              <div class="value">
                <div class="input-group">
                  <input id="client_id" class="input--style-5" type="text" name="client_id"  value={{ old('client_id')}}>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="name">License Key</div>
              <div class="value">
                <div class="input-group">
                  <input id="licence_key" class="input--style-5" type="text" name="licence_key" readonly value={{ old('licence_key')}}>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="name"></div>
              <div class="value">
                <a id="key_generate" class="btn btn--radius-2 btn--red" style="width:100%;">Key Genarate</a>
              </div>

            </div>

            <div class="form-row">
              <div class="name">License For</div>
              <div class="value">
                <div class="input-group">
                  <div class="rs-select2 js-select-simple select--no-search">
                    <select name="duration">
                      <option disabled="disabled" selected="selected">Choose Months</option>
                      <option value="3">3 months</option>
                      <option value="6">6 months</option>
                      <option value="12">1year</option>
                    </select>
                    <div class="select-dropdown"></div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <a id="submit" class="btn btn--radius-2 btn--blue"  style="float: right;">Save</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>

  //Variables
  const key_generate=document.getElementById('key_generate');
  const client_id=document.getElementById('client_id');
  const licence_key=document.getElementById('licence_key');
  const alert=document.querySelector('.alert');
  const show_user=document.getElementById('show_user');
  const submit=document.getElementById('submit');
  const form=document.getElementById('form');
  //event lisner
  client_id.addEventListener('keyup',client_id_validation)
  key_generate.addEventListener('click',generateKey)
  submit.addEventListener('click',function(){
    form.submit();
  })
  //function
  function client_id_validation(e)
  {
    if(client_id.value.length && e.keyCode==13){
      getUser()
    }else{
      show_user.innerHTML=''
      alert .innerHTML=''
    }
  }
  function getUser(){
    const xhr = new XMLHttpRequest();
    const url=`client/${client_id.value}`
    // Open the connection
    xhr.open('GET', url, true);

    xhr.onload = function() {
      if(this.status === 200) {
        const client = JSON.parse(this.responseText);
        let prev=`
        <table class="table table-bordered">

          <tbody>
            <tr>
              <td>First Name</td>
              <td>${client['first_name']}</td>
            </tr>
            <tr>
              <td>Last Name</td>
              <td>${client['last_name']}</td>
            </tr>
            <tr>
              <td>Name of Organization</td>
              <td>${client['organization_name']}</td>
            </tr>
            <tr>
              <td>Street</td>
              <td>${client['street']}</td>
            </tr>
            <tr>
              <td>City</td>
              <td>${client['city']}</td>
            </tr>
            <tr>
              <td>Upazila</td>
              <td></td>
            </tr>
            <tr>
              <td>District</td>
              <td></td>
            </tr>
            <tr>
              <td>State</td>
              <td></td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>${client['mobile']}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>${client['email']}</td>
            </tr>
            <tr>
              <td>Licence Key</td>
              <td>${client['licence_key']}</td>
            </tr>
          </tbody>
        </table>
        `
        successAlert('Client Found')
        show_user.innerHTML=prev
      }else if(this.status === 404){
        errorAlert('Client not found')
        show_user.innerHTML=''
      }
    }

    xhr.send();
  }

  function generateKey(){
    console.log("{{ csrf_token() }}")
    const xhr = new XMLHttpRequest();
    data={client_id:client_id.value}
    const url=`client/licence_key/generate`
    // Open the connection
    xhr.open('POST', url, true);

    xhr.onload = function() {
      if(this.status === 200) {
        const data = JSON.parse(this.responseText);
        licence_key.value=data.key
        client_id.setAttribute('readonly',true)
        successAlert('Key Generated')
      }else{
        errorAlert('Some Think Went Wrong')

      }
    }
    xhr.setRequestHeader('X-CSRF-TOKEN',"{{ csrf_token() }}");
    xhr.setRequestHeader('Content-Type','application/json');

    xhr.send(JSON.stringify(data));

  }

  function errorAlert(message){
    alert.classList.remove('alert_primary')
    alert.classList.add('alert-warning')
    alert.innerHTML=message
  }
  function successAlert(message){
    alert.classList.add('alert-warning')
    alert.classList.remove('alert_primary')
    alert.innerHTML=message
  }


  </script>
  <!-- Jquery JS-->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- Vendor JS-->
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/daterangepicker.js') }}"></script>

  <!-- Main JS-->
  <script src="{{ asset('js/global.js') }}"></script>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>
<!-- end document-->
