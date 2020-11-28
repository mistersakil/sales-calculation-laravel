<div class="modal fade" role="dialog">
    <!-- Modal: Create Brand -->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title text-center  text-info text-uppercase">@lang('common.Edit') @lang('common.client')</h4>
            </div>
            <div class="modal-footer">
                <form method="post" action="" class="modal_form_edit form-horizontal form-label-left" enctype="multipart/form-data" style="margin-bottom: 0px">
                    @csrf
                    @method('post')
                    <input type="hidden" name="id" id="id" value="{{ $client->id }}">
                    <!-- Left column  -->
                <div class="col-md-6 col-sm-12 col-xs-12">
                        
                    <!-- Name -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input value="{{ $client->name }}" type="text" id="name" name="name" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.name') (@lang('common.required'))
                            </span>
                        </div>
                    </div>    
                    <!-- contact_person -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input value="{{ $client->contact_person }}" type="text" id="contact_person" name="contact_person" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.contact person') (@lang('common.required'))
                            </span>
                        </div>
                    </div>   
                    <!-- phone -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input value="{{ $client->phone }}" type="text" id="phone" name="phone" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.phone') (@lang('common.optional'))
                            </span>
                        </div>
                    </div>   
                    <!-- email -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input value="{{ $client->email }}" type="text" id="email" name="email" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.email') (@lang('common.optional'))
                            </span>
                        </div>
                    </div>  
                       
                      
                </div>
                <!-- Right column  -->
                <div class="col-md-6 col-sm-12 col-xs-12">
                    
                    <!-- country_id -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="country_id" id="country_id">
                                @isset($countries)
                                @foreach($countries as $single)
                                <option value="{{ $single->id }}" {{ $single->id == $client->country_id ? 'selected' : '' }}>{{ $single->name }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.country') (@lang('common.required'))
                            </span>
                        </div>
                    </div>   

                    <!-- address -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <textarea rows="2" id="address" name="address" class="form-control"> {{ $client->address }}</textarea>
                            <span class="help-block">
                               @lang('common.client') @lang('common.address') (@lang('common.optional'))
                            </span>
                        </div>
                    </div> 
                    <!-- website -->
                    <div class="col-xs-12">
                        <div class="item form-group">
                            <input value="{{ $client->website }}" type="text" id="website" name="website" class="form-control"
                             />
                            <span class="help-block">
                                @lang('common.client') @lang('common.website') (@lang('common.optional'))
                            </span>
                        </div>
                    </div> 

                    <!-- status -->
                    <div class="col-xs-12">
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                @isset($client)
                                @foreach($client->custom_status() as $key => $value)
                                <option value="{{ $key }}" {{ $key == $client->status ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                                @endisset
                            </select>
                            <span class="help-block">
                                @lang('common.publish type') (@lang('common.required'))
                            </span>
                        </div>
                    </div>  

                                      
                    
                </div>
                <!-- End: Right column  -->
                
                <!-- Form footer button area -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <hr>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-xs-12 col-md-offset-5">
                                    <button type="button" class="btn btn-danger btn-block"
                                    data-dismiss="modal">@lang('common.CANCEL')</button>
                                </div>
                                <div class="col-md-3 col-xs-12 col-md-offset-1">
                                    <button id="save" type="submit" class="btn btn-primary btn-block">
                                    @lang('common.Update')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End: Brand Modal -->
</div>