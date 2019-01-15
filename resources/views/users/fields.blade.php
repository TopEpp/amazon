{{-- username /pass --}}
<div class="row">
    <div class="col-md-4 col-lg-4 col-sm-4">
        <!-- About Me Box -->
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">รหัสเข้าใช้งานระบบ</h3>
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
    <div class="col-md-8 col-lg-8 col-sm-8">

            <div class="card ">
                <div class="card-header">
                        <h3 class="card-title">ข้อมูลบัญชีผู้ใช้งาน</h3>
     
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- First Name Field -->
                                <div class="form-group">
                                    {!! Form::label('name', 'ชื่อ') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">                                    
                                <!-- Last Name Field -->
                                <div class="form-group">
                                    {!! Form::label('address', 'ที่อยู่') !!}
                                    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                                    
                                <!-- Last Name Field -->
                                <div class="form-group">
                                    {!! Form::label('address_stock', 'ที่อยู่คลังสินค้า') !!}
                                    {!! Form::textarea('address_stock', null, ['class' => 'form-control', 'rows' => 2, 'cols' => 40]) !!}
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
                                            <span class="btn" style="background-color: #256139;color:white;" onclick="$(this).parent().find('input[type=file]').click();">เลือกไพล์</span>
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
                                    {!! Form::label('type', 'สิทธิการใช้งาน',['class'=>'control-label ']) !!}
                                   
                                    {!! Form::select('type',['1'=>'Admin','2'=>'Manager','3'=>'Sale'] ,null, ['class' => 'form-control']) !!}
                                   
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('บันทึก', ['class' => 'btn btn-submit-custom']) !!}
                                    <a href="{!! route('users.index') !!}" class="btn btn-default">ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>

    </div>

</div>