{{-- username /pass --}}
<div class="row">
    <div class="col-md-3 col-lg-3 col-sm-3">
        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h6 class="card-title">รหัสเข้าใช้งานระบบ</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <!-- Username Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('username', 'รหัสผู้ใช้งาน') !!}
                        {!! Form::text('username', null, ['class' => 'form-control']) !!}
                    </div>
                    <!-- Password Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('password', 'รหัสผ่าน') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>
               
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    {{-- info user --}}
    <div class="col-md-9 col-lg-9 col-sm-9">

            <div class="card card-primary">
                <div class="card-header">
                        <h6 class="card-title">ข้อมูลบัญชีผู้ใช้งาน</h6>
     
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- First Name Field -->
                                <div class="form-group">
                                    {!! Form::label('first_name', 'ชื่อ') !!}
                                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">                                    
                                <!-- Last Name Field -->
                                <div class="form-group">
                                    {!! Form::label('last_name', 'นามสกุล') !!}
                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    {!! Form::label('phone', 'เบอร์โทรศัพท์',['class'=>'control-label']) !!}
                                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    {!! Form::label('image', 'ภาพ',['class'=>'control-label']) !!}
                                    <div class="input-group">
                                        <span class="input-group-btn ">
                                            <span class="btn" style="background-color: #263d90;color:white;" onclick="$(this).parent().find('input[type=file]').click();">เลือกไพล์</span>
                                            <input name="image" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
                                        </span>
                                        <span class="form-control">{!! @$user->image !!}</span>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                 <!-- Status Field -->
                                <div class="form-group">
                                    {!! Form::label('status', 'สถานะบัญชี') !!}
                                    {!! Form::select('status',['1' =>'ใช้งาน','0' =>'ไม่ใช้งาน'] ,null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    {!! Form::label('permission', 'สิทธิการใช้งาน',['class'=>'control-label ']) !!}
                                   
                                    {!! Form::select('permission',['1'=>'Admin','2'=>'Manager','3'=>'Sale'] ,null, ['class' => 'form-control']) !!}
                                   
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>

    </div>

</div>