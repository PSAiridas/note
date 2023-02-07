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
    <div class="section_edit">
        <h2>Edit Section</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div >
            <form action="{{ route('dashboard.category_update') }}" method="POST"  >
            @csrf
            <div>
                <input type="number" name="id" placeholder="id" value="{{ $cat->id }}" hidden />
            </div>
            <div>
                <input type="text" name="name" placeholder="Name" value="{{ $cat->name }}" />
            </div>
            <div>
                <input type="number" name="order" placeholder="order" value="{{ $cat->order }}" />
            </div>
            <div>
                <button type="submit" >Update</button>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>
