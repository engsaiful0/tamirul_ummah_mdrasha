<div class="row mb-20 student-details" id="siblingInfo">
    
    <input type="hidden" name="student_id" id="student_id" value="{{$student_id}}">
    <input type="hidden" name="sibling_id" id="sibling_id" value="">
    @foreach ($siblings as $sibling)        
        <div class="col-sm-12 col-md-6 col-lg-3 mb-30">
            <div class="col-lg-1 text-right col-md-2">                
                
            </div>

            <div class="student-meta-box">
                <div class="student-meta-top siblings-meta-top position-relative"> 
                    <button type="button" class="primary-btn small bg-white icon-only ml-10 position-absolute popup-model-close" id="removeSiblingbtn" onclick="removeStudentSibling({{$sibling->id}});">
                        <span class="pr ti-close text-black"></span>
                    </button>
                </div>
                    @if(is_show('photo'))
                    <img class="student-meta-img img-100"
                        src="{{ file_exists(@$sibling->student_photo)? asset($sibling->student_photo): asset('public/uploads/staff/demo/staff.jpg') }}"
                        alt="">
                    @endif
                <div class="white-box radius-t-y-0">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('student.full_name')
                            </div>
                            <div class="value">
                                {{ $sibling->full_name }}
                            </div>
                        </div>
                    </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('student.admission_number')
                            </div>
                            <div class="value">
                                {{ $sibling->admission_no }}
                            </div>
                        </div>
                    </div>

                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('common.class')
                            </div>
                            <div class="value">
                                {{ $sibling->class != '' ? $sibling->class->class_name : '' }}
                            </div>
                        </div>
                    </div>

                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('common.section')
                            </div>
                            <div class="value">
                                {{ $sibling->section != '' ? $sibling->section->section_name : '' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>            
    @endforeach
</div>

<div class="modal admin-query" id="removeSiblingModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('student.remove')</h4>
                <button type="button" class="close" onclick="closemodel();">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('student.are_you')</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" onclick="closemodel();">@lang('common.cancel')</button>
                    <button type="button" class="primary-btn fix-gr-bg" data-dismiss="modal"
                            id="yesStdRemoveSibling" onclick="deleteSibling()">@lang('common.delete')</button>

                </div>
            </div>
        </div>
    </div>
</div>

