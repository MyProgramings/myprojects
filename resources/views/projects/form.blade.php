@csrf
<div class="form-group">
    <label for="title">عنوان المشروع</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" placeholder="أدخل العنوان">
</div>
<div class="form-group">
    <label for="description">وصف المشروع</label>
    <textarea class="form-control" id="description" name="description" placeholder="أدخل الوصف">{{ $project->description }}</textarea>
</div>