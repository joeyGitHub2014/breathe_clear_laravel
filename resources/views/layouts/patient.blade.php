 
    <table class="table  table-striped  ">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Chart Number</th>
                <th scope="col">Sex</th>
                <th scope="col">DOB</th>
                <th scope="col">Home Zip</th>
                <th scope="col">Work Zip</th>
                <th scope="col">Date Added</th>
                <th scope="col">Email</th>
                <th scope="col">Tester</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$patient->patient_first}}</td>
                <td>{{$patient->patient_last}}</td>
                <td>{{$patient->chart_num}}</td>
                <td>{{$patient->sex}}</td>
                <td>{{$patient->date_of_birth}}</td>
                <td>{{$patient->zipcode_home}}</td>
                <td>{{$patient->zipcode_work}}</td>
                <td>{{$patient->date_added}}</td>
                <td>{{$patient->email}}</td>
                <td>{{$patient->tester}}</td>

            </tr>
        </tbody>
    </table>
