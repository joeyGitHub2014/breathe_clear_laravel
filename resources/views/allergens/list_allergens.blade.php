@extends('layouts.app')
@section('content')
<div class="container   items-center ">
    <div  class=" row justify-content-sm-center">
        <a href="#" class="btn btn-success">Add New Allergen</a>
    </div>
    @foreach ($allergens as $allergen)
    <div class="row pb-2">
        <h1> Group: {{$allergen[0]->group_id}} </h1>
    </div>
    <div class="row pb-3 pt-3 justify-content-sm-center allergenGroup" >
        @php $allergen = $allergen->sortBy('antigen_name') @endphp
        @foreach ($allergen as $allergen_group)
        <div class="card bg-light justify-content-sm-center mb-3 ml-3" style="max-width: 12.5rem;">
            <img class="card-img-top" src="/images/{{$allergen_group->file_name}}" alt="{{$allergen_group->antigen_name}}">
            <div class="card-body">
                <h5 class="card-title">{{$allergen_group->antigen_name}}</h5>
                <!--<p class="card-text">{{$allergen_group->caption}}</p>-->
                <a href="#" class="btn btn-primary">Edit</a>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection