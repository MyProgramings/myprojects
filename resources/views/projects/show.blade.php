@extends('layouts.app')

@section('content')
<header class="d-flex justify-content-between align-items-center my-5" dir="rtl">
    <div class="h6 text-dark">
        <a href="/projects">المشاريع / {{ $project->title }}</a>
    </div>

    <div>
        <a href="/projects/{{ $project->id }}/edit" class="btn btn-primary px-4" role="button">تعديل المشروع</a>
    </div>
</header>

<section class="row text-right" dir="rtl">
            {{-- Project Details --}}
    <div class="col-lg-4">
        <div class="card text-right shadow-sm">
            <div class="card-body">
                <div class="status">
                    @switch($project->status)
                        @case(1)
                            <span class="text-success">مكتمل</span>
                        @break
                        @case(2)
                            <span class="text-danger">ملغي</span>
                        @break
                        @default
                        <span class="text-warning">قيد الانجاز</span>                                    
                    @endswitch
                    <h5 class="font-weight-bold card-title">
                        <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
                    </h5>

                    <div class="card-text mt-4">
                        {{ $project->description }}
                    </div>
                </div>
            </div>
            @include('projects.footer')
        </div>
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h5 class="font-weight-bold">تغيير حالة المشروع</h5>
                <form action="/projects/{{ $project->id }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <select name="status" class="form-select border-0" onchange="this.form.submit()">
                        <option value="0" {{ ($project->status == 0) ? 'selected' : "" }}>قيد الانجاز</option>
                        <option value="1" {{ ($project->status == 1) ? 'selected' : "" }}>مكتمل</option>
                        <option value="2" {{ ($project->status == 2) ? 'selected' : "" }}>ملغي</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    {{-- Tasks --}}
    <div class="col-lg-8">
        @foreach ($project->tasks as $task)
            <div class="card d-felx flex-row mt-3 py-2 px-4 align-items-center shadow-sm">
                <div class="{{ $task->done ? 'checked muted' : '' }}">
                    {{ $task->body }}
                </div>
        
                 
                <div class="me-auto ms-4">
                    <form action="/projects/{{ $project->id }}/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" name="done" class="form-check-input" {{ $task->done ? 'checked' : '' }} onchange="this.form.submit()">
                    </form>
                </div>

                <div class="d-flex align-items-center">
                    <form action="/projects/{{$task->project_id}}/tasks/{{ $task->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="" class="btn-delete mt-2">
                    </form>
                </div>
            </div>
        @endforeach

        <div class="card mt-4 shadow-sm">
            <form action="/projects/{{ $project->id }}/tasks" method="POST" class="d-flex p-3">
                @csrf
                <input type="text" name="body" class="form-control p-2 ms-2 border-0" placeholder="اضف مهمة جديدة">
                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>
        </div>
    </div>
</section>

@endsection