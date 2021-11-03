<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать заказ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

@if (session("success"))
    <div class="alert alert-success">
        {{session("success")}}
    </div>
@endif

@if (session("error"))
    <div class="alert alert-danger">
        {{session("error")}}
    </div>
@endif

<h1>Создать заказ</h1>
    <form action="{{route ('createOrder')}}" method="POST">
        @csrf

        <div class="mb-3 col-6">
            <label for="FIO" class="form-label">ФИО</label>
            <input type="text" class="form-control {{$errors->has('FIO') ? 'is-invalid' : ''}}" name="FIO" id="FIO" value="{{(old('FIO') ? old('FIO') : '') }}">
            @if($errors->has("FIO"))
            <div class="text-danger">
                {{$errors->first("FIO")}}
            </div>
            @endif
        </div>

        <div class="mb-3 col-6">
            <label for="comment" class="form-label">Textarea</label>
            <textarea class="form-control {{$errors->has('comment') ? 'is-invalid' : ''}}" id="validationTextarea" placeholder="Ваш комментарий">{{(old('comment') ? old('comment') : '') }}</textarea>
            @if($errors->has("comment"))
                <div class="text-danger">
                    {{$errors->first("comment")}}
                </div>
            @endif
        </div>

        <div class="mb-3 col-6">
            <label for="article" class="form-label">Артикул товара</label>
            <input type="text" class="form-control {{$errors->has('article') ? 'is-invalid' : ''}}" name="article" id="article" value="{{(old('article') ? old('article') : '') }}">
            @if($errors->has("article"))
            <div class="text-danger">
                {{$errors->first("article")}}
            </div>
            @endif
        </div>

        <div class="mb-3 col-6">
            <label for="brand" class="form-label">Бренд</label>
            <input type="text" class="form-control {{$errors->has('brand') ? 'is-invalid' : ''}}" name="brand" id="brand" value="{{(old('brand') ? old('brand') : '') }}">
            @if($errors->has("brand"))
            <div class="text-danger">
                {{$errors->first("brand")}}
            </div>
            @endif
        </div>

        <button class="btn btn-primary">Создать заказ</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
