<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">
                @lang('common.Amc') @lang('common.Pending') @lang('common.For')
                <br>
                {{ $client_name }}
                </h4>
                <p class="text-center badge center-block">
                    @lang('common.Amc') @lang('common.Started'):
                    {{ _custom_date_time($amc_start_date,'F Y') }}
                </p>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_create form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Pending List -->
                        @isset($pending_month_list)
                        @if(count($pending_month_list))
                        <table class="table table-striped table-responsive report_table">
                            <thead>
                                <tr>
                                    <th class="text-primary">Pending On</th>
                                    {{-- <th width="20%" class="text-primary text-center">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($pending_month_list as $single)
                                <tr class="text-left">
                                    <td>{{ _custom_date_time($single,'F Y') }}</td>
                                    {{-- <td class="text-center"> <button type="button" class="btn btn-primary btn-xs">Receive</button></td> --}}
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                        @endisset

                        <!-- Received List -->
                        @isset($received_month_list)
                        @if(count($received_month_list))
                        <table class="table table-striped table-responsive report_table">
                            <thead>
                                <tr>
                                    <th class="text-success">Received On</th>
                                    <th width="30%" class="text-success text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($received_month_list as $single)
                                <tr class="text-left">
                                    <td>{{ _custom_date_time($single->collection_date,'d F, Y') }}</td>
                                    <td class="text-center">{{ number_format($single->amount) }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        @endisset
                        
                        
                    </div>
                    <!-- /.col -->
                    <!-- Form footer button area -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <hr>
                        <div class="form-group">
                            <button type="reset" class="btn btn-warning btn-block"  data-dismiss="modal">
                            @lang('common.Close')</button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Brand Modal -->
</div>
<script>
</script>