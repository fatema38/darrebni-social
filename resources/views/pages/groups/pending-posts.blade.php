@extends('layouts.master')
<head>

    <!-- تضمين CSS الخاص بـ select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.0.3/dist/select2-bootstrap4.min.css" rel="stylesheet" />

    <!-- تضمين مكتبة jQuery (إذا لم تكن مضمنة بالفعل) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- تضمين JS الخاص بـ select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

</head>
@section('content')
    <div class="col-lg">

        <div class="box"style="width: 600px; margin-left: 50px">
            <div class="box-header">
                <h3>Pending Posts of Group {{$group->name}} </h3>
            </div>
            <div class="box-body">
                <div class="streamline b-l m-l-md">
                    @foreach($group->posts as $post)
                        <div class="box-body " style="border: 1px solid #ddd; /* إضافة حدود خفيفة حول كل منشور */
    border-radius: 5px; /* زوايا دائرية للصندوق */
    padding: 15px; /* حشوة داخلية للصندوق */
    margin-bottom: 20px; /* مسافة أسفل كل صندوق للفصل بين المنشورات */
    background-color: #ffffff; /* تعيين لون الخلفية للصندوق */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف للصندوق */
     /* لجعل الصندوق المرجع بالنسبة لعناصره المطلقة */
    min-height: 250px; /* تحديد ارتفاع أدنى للصندوق */

">
                        <div class="sl-item">


                            <div class="sl-content">

                                <div class="sl-author font-weight-bold size-6">
                                    <a style="color: #6f2877" href="">{{$post->user->name}}</a>
                                </div>
                                <div class="sl-date text-muted">{{$post->created_at->diffForHumans()}}</div>

                                <div class="sl-author text-center font-weight-bold h3">
                                    <a href="">{{$post->title}}</a>
                                    <div>
                                        @foreach($post->allTags() as $tag)
                                            <span class=" text-sm ">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <p>{{$post->content}}</p>
                                </div>
                                @if($post->image)
                                    <div class="d-flex justify-content-center align-items-center" style="max-width: 450px ;max-height: 400px ;margin-top: 50px; margin-bottom:40px " >
                                        <div class="text-center">
                                            <img  src="{{asset($post->image)}}" width=100% height="auto" >
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <a class="btn btn pull-right " style="background-color: silver; color:white" href="{{route("approve",$post->id)}}">approve</a>
                            <a  class="btn btn-danger pull-right mr-2 " href="{{route("reject",$post->id)}}">reject</a>

                        </div>
                        </div>

                    @endforeach
                    {{--                    <div class="sl-item">--}}
                    {{--                        <div class="sl-left">--}}
                    {{--                            <img src="../assets/images/a2.jpg" class="img-circle">--}}
                    {{--                        </div>--}}
                    {{--                        <div class="sl-content">--}}
                    {{--                            <div class="sl-date text-muted">8:30</div>--}}
                    {{--                            <div class="sl-author">--}}
                    {{--                                <a href>Moke</a>--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <p>Just followed <a href class="text-info">Jacob</a> and she followed you too.</p>--}}
                    {{--                                <p>--}}
                    {{--		                      <span class="inline p-a-xs b-a dark-white">--}}
                    {{--		                        <img src="../assets/images/b2.jpg" class="img-responsive">--}}
                    {{--		                      </span>--}}
                    {{--                                </p>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{--    <script>--}}
    {{--        $(selector).select2({--}}
    {{--            multiple:true--}}
    {{--        });--}}
    {{--    </script>--}}


    <script>
        $(document).ready(function() {
            function initializeSelect2(selector) {
                $(selector).select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    ajax: {
                        url: "{{ route('tags.index') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id ? item.id : item.name // استخدم `id` إن وجد، وإلا استخدم `name`
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            }
            initializeSelect2('#tags1');
            initializeSelect2('#tags2');

        });
    </script>

@endpush

