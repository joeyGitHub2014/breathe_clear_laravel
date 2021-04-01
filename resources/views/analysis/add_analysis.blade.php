@extends('layouts.app')
@section('content')
<div class="container   items-center ">

    <div class="row title">
        <h1>Add New Analysis For:</h1>
    </div>
    @include('layouts.patient')
    <form action="/patient/analysis/store" method="POST" class="" novalidate>
        @csrf

        <section class="treatment">
            <div class=" row justify-content-sm-center">
                <input class="btn btn-success" type="submit" name="submit">
            </div>
            <a href="#" class="btn btn-success">Add Custom Analysis</a>
            <div class="row pt-3">
                <p> Type of Treatment:
                    <input type="radio" name="treatment" value="0" checked> Not Yet Determined
                    <input type="radio" name="treatment" value="1"> Drops
                    <input type="radio" name="treatment" value="2"> Injection
                </p>
            </div>
            <div class="row">
                <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}">
                <input type="button" name="resetmsp" value="Reset MSP to 0" onclick="resetV(0,'mspid')">
                <input type="button" name="resetisp" value="Reset ISP to 0" onclick="resetV(0,'ispid')">
            </div>

        </section>

        <div class="row">

            @foreach ($allergens as $allergen)
            <div class="col-md">

                <table class="table  table-striped ">

                    <thead>
                        <tr>
                            <th scope="col">Allergen Group {{$allergen[0]->group_id}}</th>
                            <th scope="col">Multitest Skin Prick Wheel (mm) </th>
                            <th scope="col">Intradermal Test Wheel (mm)</th>
                            <th scope="col">Check to Disable Allergen</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $allergen = $allergen->sortBy('antigen_name') @endphp
                        @foreach ($allergen as $allergen_group)
                        <tr>
                            <td><img style="width:20%; height:auto;margin-right:1rem" src="/images/{{$allergen_group->file_name}}" />{{$allergen_group->antigen_name}}</td>
                            <td><select class="selectNum" data-wheelvalue="5" id="MSP{{$allergen_group->id}}" name="MSP[{{$allergen_group->id}}]">
                                @php
                                    $arrayValues=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                                    foreach($arrayValues as $value) {
                                        echo  ($value === 5) ? "<option selected>" .$value. "</option>" : "<option>" .$value. "</option>";                                                       
                                    }
                                @endphp
                                </select>
                            </td>
                            <td><select class="selectNum" data-wheelvalue="5" id="ISP{{$allergen_group->id}}" name="ISP[{{$allergen_group->id}}]">
                                @php
                                    foreach($arrayValues as $value) {
                                        echo  ($value === 5) ? "<option selected>" .$value. "</option>" : "<option>" .$value. "</option>";                                                       
                                    }
                                @endphp
                                </select>
                            </td>
                            <td><input type="checkbox" class="checkbox_check" name="disableAllergen[]" value="{{$allergen_group->id}}" onclick="disable(this)"></td>
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
    function disable(e){
        console.log(e.value);
    }
</script>
@endsection