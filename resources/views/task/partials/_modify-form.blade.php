<div class="modify-form">
    <div class="form-group">
        <input class="form-control name" name="name" type="text"
               placeholder="Feladat megnevezése..." value="{{ $task->name }}">
    </div>
    <div class="form-group name-error-container">
        <span class="alert alert-danger name-error"></span>
    </div>


    <div class="form-group">
        <textarea class="form-control description" name="description" cols="30"
                  rows="3" placeholder="Feladat leírása...">{{ $task->description }}</textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-primary modify-btn"><span class="glyphicon glyphicon-plus"></span>
            Módosítás
        </button>
    </div>
</div>