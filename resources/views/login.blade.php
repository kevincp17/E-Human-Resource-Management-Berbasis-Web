<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <style>
        .box
        {
            width:100%;
            max-width:600px;
            background-color:#f9f9f9;
            border:1px solid #ccc;
            border-radius:5px;
            padding:16px;
            margin:0 auto;
        }
        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 1px solid #EED3D7;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .parsley-errors-list.filled {
            opacity: 1;
        }

        .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
            color:#ff0000;
        }

    </style>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<div class="p-3 mt-5">
        <h1 class="card-title mt-3 text-center">Login</h1>
        <form action="{{url('/loginApplicant/validate')}}" method="post" class="col-lg-6 offset-lg-3 form-horizontal" id="validate_form">
            <fieldset style="background-color:deepskyblue;" class="rounded p-2">
            {{ csrf_field() }}
            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Email:</label>
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

{{--<script>--}}
{{--    $(document).ready(function(){--}}

{{--        $('#validate_form').parsley();--}}

{{--        $('#validate_form').on('submit', function(event){--}}
{{--            event.preventDefault();--}}

{{--            if($('#validate_form').parsley().isValid())--}}
{{--            {--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route("form-validation.insert") }}',--}}
{{--                    method:"POST",--}}
{{--                    data:$(this).serialize(),--}}
{{--                    dataType:"json",--}}
{{--                    beforeSend:function()--}}
{{--                    {--}}
{{--                        $('#submit').attr('disabled', 'disabled');--}}
{{--                        $('#submit').val('Submitting...');--}}
{{--                    },--}}
{{--                    success:function(data)--}}
{{--                    {--}}
{{--                        $('#validate_form')[0].reset();--}}
{{--                        $('#validate_form').parsley().reset();--}}
{{--                        $('#submit').attr('disabled', false);--}}
{{--                        $('#submit').val('Submit');--}}
{{--                        alert(data.success);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}

{{--    });--}}
{{--</script>--}}

</body>
</html>

