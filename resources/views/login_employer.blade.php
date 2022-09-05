<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<div class="p-3 mt-5">
    <h1 class="card-title mt-3 text-center">Login Perusahaan</h1>
    <form action="{{url('/loginCompany/validate')}}" method="post" class="col-lg-6 offset-lg-3 form-horizontal" id="loginForm">
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
            {{ csrf_field() }}
            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Email Perusahaan:</label>
                    <input onfocus="this.value=null" class="form-control fadeIn second" type="email" name="isiEmail" placeholder="Email">
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Password:</label>
                    <input onfocus="this.value=null" class="form-control fadeIn third" type="password" name="isiPassword" placeholder="Password">
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Masuk</button>
        </fieldset>
    </form>


</div>
</body>
</html>

