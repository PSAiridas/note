{{-- <x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> }}

    <input />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    asdasd asd
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<x-app-layout>
<h2>DataInfo Edit</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="databox_create">

    <form action="{{ route('dashboard.category_data_update') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div>
            <input type="number" name="id" placeholder="id" value="{{ $cat->id }}" hidden />
        </div>
        <div>
            <input type="text" name="name" placeholder="Name" value="{{ $cat->name }}" />
        </div>
        <div>
            <input type="text" name="username" placeholder="username"  value="{{ $cat->username }}"/>
        </div>
        <div>
            <input type="text" name="password" placeholder="password"  value="{{ $cat->password }}"/>
        </div>
        <div>
            <input type="number" name="order" placeholder="order" value="{{ $cat->order }}"/>
        </div>

        {{-- <input type="number" name="cat_id" value="{{ $cat->cat_id }}"  /> --}}
        <div>
            <select name="cat_id">
                @foreach ($cats as $cat0)
                    <option value="{{ $cat0->id }}"
                            @if (($cat0->id) == ($cat->cat_id))
                                selected
                            @endif
                            >
                        {{ $cat0->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" >Update</button>
        </div>
    </form>
</div>

</x-app-layout>
