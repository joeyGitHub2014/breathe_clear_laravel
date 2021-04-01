@extends('layouts.app')
@section('content')
<div class="container   items-center ">
    <div class="row title">
        <h1>Edit Analysis For:</h1>
    </div>
    @include('layouts.patient')
    <form action="/patient/analysis/update" method="POST" class="" novalidate>
        @csrf
        {{ method_field('PUT') }}
         <section class="treatment">
            <div class=" row justify-content-sm-center">
                <input class="btn btn-success" type="submit" name="submit">
            </div>
            <a href="#" class="btn btn-success">Add Custom Analysis</a>
            <div class="row pt-3">
                <p> Type of Treatment:
                    @if ($treatment['treatment_type'] === 0 )
                        <input type="radio" name="treatment" value="0" checked> Not Yet Determined
                        <input type="radio" name="treatment" value="1" > Drops
                        <input type="radio" name="treatment" value="2" > Injection
                    @elseif ($treatment['treatment_type']  === 1 )
                        <input type="radio" name="treatment" value="0" > Not Yet Determined
                        <input type="radio" name="treatment" value="1" checked> Drops
                        <input type="radio" name="treatment" value="2" > Injection
                    @else 
                        <input type="radio" name="treatment" value="0" > Not Yet Determined
                        <input type="radio" name="treatment" value="1" > Drops
                        <input type="radio" name="treatment" value="2" checked> Injection                    
                    @endif
                </p>
            </div>
            <div class="row">
                <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}">
                <input type="button" name="resetmsp" value="Reset MSP to 0" onclick="resetV(0,'mspid')">
                <input type="button" name="resetisp" value="Reset ISP to 0" onclick="resetV(0,'ispid')">
            </div>

        </section>
        <div class="pt-3"><p><b>NOTE: 7 or > = positive allergy</b></p></div>
        <div class="row">
            @foreach ($results as $result)
            <div class="col-md">

                <table class="table  table-striped ">

                    <thead>
                        <tr>
                            <th scope="col">Allergen Group {{$result[0]['group_id']}}</th>
                            <th scope="col">Multitest Skin Prick Wheel (mm) </th>
                            <th scope="col">Intradermal Test Wheel (mm)</th>
                            <th scope="col">Check to Disable Allergen</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $result_record)
                        <tr>
                            <td><img style="width:20%; height:auto;margin-right:1rem" src="/images/{{$result_record['file_name']}}" />{{$result_record['name']}}</td>
                            <td><select class="selectNum" data-wheelvalue="5" id="MSP{{$result_record['id']}}" name="MSP[{{$result_record['id']}}]">
                                @php
                                    $arrayValues=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                                    foreach($arrayValues as $value) {
                                        echo  ($value === $result_record['MSP_score']) ? "<option selected>" .$value. "</option>" : "<option>" .$value. "</option>";                                                       
                                    }
                                @endphp
                                </select>
                            </td>
                            <td><select class="selectNum" data-wheelvalue="5" id="ISP{{$result_record['id']}}" name="ISP[{{$result_record['id']}}]">
                                @php
                                    foreach($arrayValues as $value) {
                                        echo  ($value === $result_record['IT_score']) ? "<option selected>" .$value. "</option>" : "<option>" .$value. "</option>";                                                       
                                    }
                                @endphp
                                </select>
                            </td>
                            <td><input type="checkbox" class="checkbox_check" name="disableAllergen[]" value="{{$result_record['id']}}" onclick="disable(this)"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </form>
</div>
<script>
    function disable(e) {
        console.log(e.value);
    }
</script>
@endsection