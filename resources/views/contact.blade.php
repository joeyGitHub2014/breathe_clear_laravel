@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
             
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"> 
                            Contact Information:
                    </div>
                    <form method = "POST" action="/contact">   
                        @csrf
                        <div class="card-body">
                        
                            <labeL for="email" >Your Email Address:</label>
                            <input type="text" id="email" name="email" class="border px-2 py-1 text-sm w-full"> 
                            @error('email')
                                <div class="text-danger">{{$message}} </div>       
                            @enderror        
                        </div>
                        <div>
                            <button class="btn btn-primary" style="margin:20px" type="submit"> Submit  </button> 
                        </div> 
                            @if (session('message'))
                                <div class="text-success">{{ session('message') }} </div>   
                            @endif    

                    </form>  
                </div>
            </div>

     </div>
                    
</div>
@endsection
