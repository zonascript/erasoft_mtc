@extends("template.master")
@section("title","Bugs Add")
@section("breadcrumbs",Breadcrumbs::render('bugs'))
@section("sidebar_menu")
    @include("menu.support_menu")
@endsection
@section("content")
    <div class="page-content">
        <div class="page-header">
            <h1>
                Bugs
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Add Bugs
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                @if(!$errors->isEmpty())
                <?php
                $data ="";
                $data .= '<ul>';
                foreach($errors->all() as $error)
                {
                    $data .= '<li>'.$error.'</li>';
                }
                $data .='</ul>';
                ?>
                {!! CustomLib::generate_notification($data,"error") !!}
                @endif


                        <!-- PAGE CONTENT BEGINS -->
                {!! Form::model($bugs,array('route' => ['bugs.update',$bugs->id_bugs],'class'=>'form-horizontal','method'=>'PUT')) !!}

                        <!-- #section:elements.form -->
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bugs </label>

                    <div class="col-sm-9">
                        {!! Form::text('bugs', $bugs->nama_bugs,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Bugs')); !!}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Penyelesaian </label>

                    <div class="col-sm-9">
                        {!! Form::textarea('penyelesaian', $bugs->penyelesaian,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-8','placeholder'=>'Penyelesaian')); !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Software </label>

                    <div class="col-sm-9">
                        {!! Form::select('software', $software, $bugs->id_software, ['placeholder' => '--- Software ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5','onchange'=>'get_software_detail(this)']); !!}

                    </div>
                </div>
                <div class="form-group" id="sd">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Software Detail </label>

                    <div class="col-sm-9">
                        {!! Form::select('software_detail', $software_detail, $bugs->id_modul, ['placeholder' => '--- Modul ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5']); !!}

                    </div>
                </div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">

                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Clear Form
                        </button>
                    </div>
                </div>


                </form>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section("js_script")
    <script src="{{ asset('assets/js/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/jquery.dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var oTable1 =
                    $('#dynamic-table')
                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                            .dataTable( {
                                bAutoWidth: false,

                                "aaSorting": [],

                                //,
                                //"sScrollY": "200px",
                                //"bPaginate": false,

                                //"sScrollX": "100%",
                                //"sScrollXInner": "120%",
                                //"bScrollCollapse": true,
                                //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                                //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                                //"iDisplayLength": 50
                            } );
            //oTable1.fnAdjustColumnSizing();




            //initiate TableTools extension
            var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
                "sSwfPath": "../assets/js/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf", //in Ace demo ../assets will be replaced by correct assets path

                "sRowSelector": "td:not(:last-child)",
                "sRowSelect": "multi",
                "fnRowSelected": function(row) {
                    //check checkbox when row is selected
                    try { $(row).find('input[type=checkbox]').get(0).checked = true }
                    catch(e) {}
                },
                "fnRowDeselected": function(row) {
                    //uncheck checkbox
                    try { $(row).find('input[type=checkbox]').get(0).checked = false }
                    catch(e) {}
                },

            } );
            //we put a container before our table and append TableTools element to it
            $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));



            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) tableTools_obj.fnSelect(row);
                    else tableTools_obj.fnDeselect(row);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                var row = $(this).closest('tr').get(0);
                if(!this.checked) tableTools_obj.fnSelect(row);
                else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
            });




            $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });


            //And for the first simple table, which doesn't have TableTools or dataTables
            //select/deselect all rows according to table header checkbox
            var active_class = 'active';

            /********************************/
            //add tooltip for small view action buttons in dropdown menu
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

            //tooltip placement on right or left
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }

        })
    </script>
    <script>
        function get_software_detail(gp){
            var value = $(gp).val();
            $.ajax({
                method:"GET",
                url: "{{ action('BugsController@get_software_detail') }}",
                data: {id_software:value},
                success: function(data){
                    if(data.status == true){
                        $('#sd').html(data.data).slideDown('slow');
                    }
                }
            });
        }
    </script>
@endsection