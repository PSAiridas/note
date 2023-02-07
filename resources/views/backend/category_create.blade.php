<x-app-layout>
<h1> Create Section</h1>
<div class="section_create">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dashboard.category_store') }}" method="POST" >
        @csrf
        <div>
            <input type="text" name="name" placeholder="Name" />
        </div>
        <div>
            <input type="number" name="order" placeholder="order" />
        </div>
        <div>
            <button type="submit" >Create</button>
        </div>
    </form>
</div>

</x-app-layout>
