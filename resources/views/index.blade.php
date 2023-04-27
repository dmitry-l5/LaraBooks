@extends('layouts.major')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>
                <a href="{{ url('edit') }}" class="btn btn-primary w-100">Панель управления</a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col border">
                <div class = 'd-flex  border'>
                    <div class = 'border d-inline w-50 text-center'>Имя автора</div>
                    <div class = 'border d-inline w-50 text-center'>Количество написанных книг</div>
                </div>
            <?php foreach($authors_arr as $author):?>
                <div  class = 'd-flex border '>
                    <div class = 'border d-inline w-50 text-center'><?=$author['full_name']?></div>
                    <div class = 'border d-inline w-50 text-center'><?=$author['books_count']?></div>
                </div>
            <?php endforeach?>
        </div>
        <div class="col border">
                <div class = 'd-flex  border'>
                    <div class = 'border d-inline w-50 text-center'>Название книги</div>
                    <div class = 'border d-inline w-50 text-center'>Авторы книги</div>
                </div>
            <?php foreach($books_arr as $book):?>
                <div  class = 'd-flex border '>
                    <div class = 'border d-inline w-50 text-center'><?=$book['title']?></div>
                    <div class = 'border d-inline w-50 text-center'><?= implode( ', ', $book['authors']);?></div>
                </div>
            <?php endforeach?>
        </div>
    </div>
</div>

@endsection