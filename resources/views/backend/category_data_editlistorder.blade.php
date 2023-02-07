@section('footer')
<script>
    $( function() {
        $( "#sortable" ).sortable({
            stop: function( event, ui ) {
                let datalist = [];
                $("#sortable > div").each(function( index ) {
                    $(this).attr("data-order", index );
                    $(this).find(".infoid").html(index);
                    let post_id = $(this).find(".infoid").data("id");
                    let obj = {
                        id: post_id,
                        order: index,
                    }
                    datalist.push(obj);
                });
                $("#formvalue").val(JSON.stringify(datalist));
            }
        });
    } );
</script>
@endsection


<x-app-layout>
<h2>({{ $section_name }}) Edit List Order </h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="sortable" class="section_order_container">
<?php
    foreach ($databoxs as $databox) {
        ?>
            <div class="ui-state-default"><?php echo $databox->name; ?> <div class="infoid" data-id="<?php echo $databox->id; ?>" data-order=""><?php echo $databox->order; ?></div></div>
        <?php
    }
?>
</div>


<div>

    <form action="{{ route('dashboard.category_data_update_listorder', ['id' => $id]) }}" method="POST" class="sections_update_form">
    @csrf
        <input type="text" name="list" placeholder="list" id="formvalue" hidden />
        <button type="submit" >Update</button>
    </form>
</div>

</x-app-layout>
