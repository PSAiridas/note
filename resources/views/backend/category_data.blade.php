
<x-app-layout>
    <div id="dataRight">
        <div>
            <h2 class="create"><a href="{{ route('dashboard.category_data_create', ['id' => $catid]) }}" >Create</a></h2>
            <h2 class="edit"><a href="{{ route('dashboard.category_data_edit_listorder', ['id' => $catid]) }}" >Edit_Order</a></h2>
        </div>
        @foreach ($databoxs as $databox)
            <div class="databox">
                <div class="option"><a href="{{ route('dashboard.category_data_edit', ['id' => $databox->id]) }}" >Edit</a>
                    <a href="{{ route('dashboard.category_data_delete', ['id' => $databox->id]) }}" ><i>Delete</i></a></div>
                <h3><?php echo $databox->name; ?></h3>


                <div id='datausername'><i class="fas fa-copy copy"></i><i class="fas fa-eye view"></i> <div><?php echo $databox->username; ?></div></div>
                <div id='datapassword'><i class="fas fa-copy copy"></i><i class="fas fa-eye view"></i> <div><?php echo $databox->password; ?> </div></div>
            </div>
        @endforeach
    </div>
</x-app-layout>
