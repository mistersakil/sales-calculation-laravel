<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Edit') @lang('common.Expense')</h4>
            </div>
            <div class="modal-footer">
                @isset($model)
                <form method="post" action="" class="modal_form_edit form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th width="30%">Head</th>
                                    <th width="15%">Amount</th>
                                    <th width="20%">Date</th>
                                    <th width="15%">Type</th>
                                    <th width="15%">Status</th>
                                    <th width="5%" class="text-center">
                                        <i class="fa fa-wrench"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row1">
                                    <td contenteditable="true" class="title text-left">{{ $model->title }}</td>
                                    <td contenteditable="true" class="amount text-left">{{ $model->amount }}</td>
                                    <td class="date">
                                        <div class='input-group date' id='datepicker1'>
                                            <input type='text' class="form-control" name="date" id="date" value="{{ $model->custom_date_time($model->date,'Y-m-d') }}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="type">
                                        <select name="type" id="type" class="custom_select">
                                            @foreach($model->custom_expense_type() as $key => $value)
                                            <option value="{{ $key }}" {{ $key == $model->type ? 'selected' : '' }} >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="status">
                                        <select name="status" id="status" class="custom_select">
                                            @foreach($model->custom_status() as $key => $value)
                                            <option value="{{ $key }}" {{ $key == $model->status ? 'selected' : '' }} >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                        
                        
                    </div>
                    <!-- /.col -->
                    <!-- Form footer button area -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button id="save" type="submit" class="btn btn-primary btn-block" >
                                @lang('common.SAVE')</button>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <button type="reset" class="btn btn-warning btn-block"  data-dismiss="modal">
                                @lang('common.Close')</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endisset
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>
<script>
$('#datepicker1').datetimepicker({format: 'YYYY-MM-DD'});
</script>