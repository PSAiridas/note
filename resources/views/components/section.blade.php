@section('footer_sections')
    <script>
        //password show
        $('#datausername i.view, #datapassword i.view').click(function() {
            $(this).siblings("div").toggleClass('show')
        });
        $('#datausername i.copy, #datapassword i.copy').click(function() {
            var copyText = $(this).siblings("div").html();

            navigator.clipboard.writeText(copyText);
        });

        //Password generate
        function get_random (list) {
             return list[Math.floor((Math.random()*list.length))];
        }
        function generatePW() {
            array=[]
            array1=["!", "@", "#", "$", "%", "^", "&", "*"];
            array2=["0", "2", "3", "4", "5", "6", "7", "8", "9"];
            array3=["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
            array4=["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
            array5=["{", "}", "[", "]", "/", "~", ",", ";", ":", ".", ">", "<", "_"];

            n=document.querySelector("#pg_Length").value;
            ele1= document.getElementById('pg_Symbols');
            ele2= document.getElementById('pg_Numbers');
            ele3= document.getElementById('pg_Lowercase');
            ele4= document.getElementById('pg_Uppercase');
            ele5= document.getElementById('pg_Symbols2');

            if (ele1.checked == true) {
                array.push(...array1)
            }
            if (ele2.checked == true) {
                array.push(...array2)
            }
            if (ele3.checked == true) {
                array.push(...array3)
            }
            if (ele4.checked == true) {
                array.push(...array4)
            }
            if (ele5.checked == true) {
                array.push(...array5)
            }

            pwGen=""
            for (var i=0; i<n; i++) {
                pwGen+=get_random(array);
            }
            console.log(pwGen);

            document.querySelector("#final_pass0").value=pwGen;
        }
        // onclick="OnCopy();"
        function OnCopy() {
            var copyText = $('#final_pass0').val();
            console.log(copyText)
            navigator.clipboard.writeText(copyText);
        };

        function pw_show() {
            $("#pg_fixed").addClass("show");
        }
        function pw_close() {
            $("#pg_fixed").removeClass("show");
        }
    </script>
@endsection

<div class="catmod">
    <h1>Sections</h1>
    <div class="user">
        <a href="{{route('profile.edit')}}" >{{ Auth::user()->name }}</a>
        <form action="{{ route('logout') }}" method="POST" >
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>

    <div class="sectionright">
        <a href="{{ route('dashboard.category_create') }}"><i class="fas fa-plus-square"></i></a>
        <a href="{{ route('dashboard.category_listorder') }}"><i class="fas fa-edit"></i></a>
        <a href="#"><i class="fas fa-unlock-alt" onclick="pw_show();"></i> </a>

        <div id="passwordGenerator">
            <div id="pg_fixed" class="pg_fixed">
                <div>
                    <div>
                        <select id="pg_Length" title="Select the length of your password.">
                            <optgroup label="Weak">
                                <option value="6">6</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                                <option value="14">14</option>
                            </optgroup>
                            <optgroup label="Strong">
                                <option value="16" selected>16</option>
                                <option value="24">24</option>
                                <option value="32">32</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="100">100</option>
                                <option value="128">128</option>
                                <option value="128">256</option>
                                <option value="128">512</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="chboxr"><label><input type="checkbox" name="pg_Symbols" id="pg_Symbols" checked>( e.g. !@#$%^&* )</label></div>
                    <div class="chboxr"><label><input type="checkbox" name="pg_Numbers" id="pg_Numbers" checked>( e.g. 0123456789 )</label></div>
                    <div class="chboxr"><label><input type="checkbox" name="pg_Lowercase" id="pg_Lowercase" checked>( e.g. abcdefgh )</label></div>
                    <div class="chboxr"><label><input type="checkbox" name="pg_Uppercase" id="pg_Uppercase" checked>( e.g. ABCDEFGH )</label></div>
                    <div class="chboxr"><label><input type="checkbox" name="pg_Symbols2" id="pg_Symbols2" checked>( { } [ ] ( ) / ~ , ; : . &lt; &gt; )</label></div>

                    <div class="button GenerateBtn" onclick="generatePW();">Generate Password </div>

                    <div id="sec_password">
                            <div class="chboxl">PW:</div>
                            <input name="final_pass" id="final_pass0" type="text" size="17" value="New password">
                            <i class="fas fa-copy" onclick="OnCopy();"></i>
                    </div>

                </div>
                <i class="fa fa-times pw_fixed_close" aria-hidden="true" onclick="pw_close();"></i>

            </div>
        </div>
    </div>
</div>

<div class="cats_box">
    <?php
        foreach ($section as $cat) {
        ?>
            <div>
                <a href="{{ route('dashboard.category_data_list', ['id' => $cat->id]) }}" ><span><?php echo $cat->name; ?></span></a>
                <a href="{{ route('dashboard.category_edit', ['id' => $cat->id]) }}" ><i class="fas fa-edit"></i></a>
                <a href="{{ route('dashboard.category_delete', ['id' => $cat->id]) }}" ><i class="fas fa-minus-square"></i></a>
            </div>
        <?php
        }
    ?>
</div>


