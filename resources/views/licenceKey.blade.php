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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Create License</h2>
                </div>
                <div class="card-body">
                  @foreach ($errors->all() as $error)
                      <div>{{ $error }}</div>
                  @endforeach
                    <div class="alert" role="alert">

                      </div>
                    <form action="{{route('save.key')}}" method="POST">
                        @csrf
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
                                            <option value="12">1 year</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button id="submit" class="btn btn--radius-2 btn--blue" type="submit" style="float: right;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        //Variables
        const key_generate=document.getElementById('key_generate');
        const licence_key=document.getElementById('licence_key');
        const alert=document.querySelector('.alert');
        const show_user=document.getElementById('show_user');
        const submit=document.getElementById('submit');
        //event lisner
        key_generate.addEventListener('click',generateKey)
        //function

        function generateKey(){
            console.log("{{ csrf_token() }}")
            const xhr = new XMLHttpRequest();
            const url=`{{route('generate.key')}}`
         // Open the connection
          xhr.open('get', url, true);

          xhr.onload = function() {
              if(this.status === 200) {
                  const data = JSON.parse(this.responseText);
                  licence_key.value=data.key
                  successAlert('Key Generated')
              }else{
                errorAlert('Some Think Went Wrong')

              }
          }
          xhr.setRequestHeader('X-CSRF-TOKEN',"{{ csrf_token() }}");
          xhr.send();

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>
<!-- end document-->
