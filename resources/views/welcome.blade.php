@extends('layouts.app')
@section('content')
<div class="container">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
            <div style="padding:2em">
                @auth
                Hi, {{ Auth::user()->name }}
                @endauth
            </div>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        fdgdgdsfgdg
                     </div>

                    <div class="ml-12">
                        dffsdaf
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                    <div class="flex items-center">
                        sdfgg
                    </div>

                    <div class="ml-12">
                        fsfsdf
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    sdfdsfffdgdfg
                </div>

                <div class="ml-12">
                    CXZCZC
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                <div class="flex items-center">
                    dsfsadfas
                </div>

                <div class="ml-12">
                    dfafd
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-center mt-4 sm:items-center sm:justify-between">
    <div class="text-center text-sm text-gray-500 sm:text-left">
        <div class="flex items-center">
fsfsf
        </div>
    </div>

    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
        fsddsfa
    </div>
</div>
</div>
</div>
</div>
@endsection