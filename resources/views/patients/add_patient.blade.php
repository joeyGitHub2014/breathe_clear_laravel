@extends('layouts.app')

@section('content')


<div class="container">

    <form action="/patient/store" method="POST" class="needs-validation patientForm" novalidate>
    @csrf
        <div class="row title justify-content-center">
            <h1>Add New Patient</h1>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="patient_first">First Name</label>
                <input type="text" class="form-control" id="patient_first" placeholder="First Name" name="patient_first" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                        Please provide a First Name.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="patient_last">Last Name</label>
                <input type="text" class="form-control" id="patient_last" placeholder="Last name" name="patient_last" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                        Please provide a Last Name.
                </div>
            </div>
            <div class="col-md-1 mb-3">
                <label for="sex">Sex</label>
                <div>
                    <select name="sex" id="sex">
                        <option name="male" value="M">M</option>
                        <option name="female" value="F">F</option>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a sex.
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="chart_num">Chart Number</label>
                <input type="text" class="form-control" id="chart_num" placeholder="Chart Number" name="chart_num" required>
                <div class="invalid-feedback">
                    Please provide a Chart Number.
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="date_of_birth">Date of Birth </label>
                <input type="date" class="form-control" id="date_of_birth"  name= "date_of_birth" required>
                <div class="invalid-feedback">
                    Please provide a Date of Birth.
                </div>
            </div>

        </div>
        <hr />
        <p style="font-size:.6rem">(optional)</p>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="zipcode_home">Home Zip</label>
                <input type="text" class="form-control" id="zipcode_home" name="zipcode_home" placeholder="Zip Code">
                <div class="invalid-feedback">
                    Please provide a valid zip.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="zipcode_work">Work Zip</label>
                <input type="text" class="form-control" id="zipcode_work" name="zipcode_work" placeholder="Zip Code">
                <div class="invalid-feedback">
                    Please provide a valid zip.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="email">Email</label>
                <div class="input-group">

                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" aria-describedby="inputGroupPrepend">
                    <div class="invalid-feedback">
                        Email address.
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="tester">Tester</label>
                <input type="text" class="form-control" id="tester" name="tester" placeholder="Tester">
                <div class="invalid-feedback">
                    Please provide a tester.
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</div>
@endsection