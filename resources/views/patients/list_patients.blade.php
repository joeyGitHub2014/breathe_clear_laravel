@extends('layouts.app')
@section('content')
<div class="container ">

    {{ $patients->links() }}

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
                <th scope="col">Utills</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
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
                    <td>&nbsp<button class="btn-primary">Edit</button >&nbsp<button class="btn-primary">Del</button>&nbsp<a href="{{ route('add_analysis',[$patient->id]) }}" > Add Analysis</a></td>
                </tr>
                @php $records = $patient->analysis_count()->get()@endphp
                @if ( count($records) > 0) 
                    <tr style="background-color:aquamarine">
                        <td colspan=12>
                            @foreach ($records as $record)
                                <div class="row">
                                    <div class="col-md-4">Analysis Add: {{$record->created_at}} </div>
                                    <div class="col-md-8"><a class="pr-3" href="{{route('edit_analysis',[$patient->id,$record->id])}}">Edit </a><a class="pr-5"href= "{{route('delete_analysis',[$record->id])}} ">Delete </a>
                                    <a class="pr-3" href= "{{ route('patientReport',[$patient->id, $record->id]) }} "> Patient Report</a>
                                    <a class="pr-3"href= "{{ route('immunoReport',[$patient->id, $record->id]) }} "> Immonotherapy Report</a>
                                    <button onclick="openPrint()">Print Labels</button> </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    {{ $patients->links() }}

</div>
<script>
    function openPrint(){
        var theWin = "'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=812,height=992'";
	    littleWin = window.open("../html/printLabel.html","opened",theWin);
	    window.resizeTo(812,992);
	    littleWin.focus();
    }
</script>
@endsection