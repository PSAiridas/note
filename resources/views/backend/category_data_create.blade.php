<x-app-layout>
<h2>Create InfoBox</h2>
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
    <form action="{{ route('dashboard.category_data_store') }}" method="POST" >
        @csrf
        <div>
            <input type="text" name="name" placeholder="Name" />
        </div>
        <div>
            <input type="text" name="username" placeholder="username" />
        </div>
        <div>
            <input type="text" name="password" placeholder="password" />
        </div>
        <div>
            <input type="number" name="order" placeholder="order" />
        </div>
        <div>
            <input type="number" name="cat_id" value="{{$catid}}" hidden />
        </div>
        <div>
            <button type="submit" >Create</button>
        </div>
    </form>
</div>

</x-app-layout>
