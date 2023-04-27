@extends('layouts.major')
<link rel="stylesheet" href="css/app.css">
@section('content')
<div class="container w-100">
    <script src="{{ asset('js/authors_list.js') }}"></script>
    <h1 class=''>Здесь можно добавить новые книги и авторов книг а также удалить книги</h1>
    <div class="row">
        <div class="col border">
            <h3>список всех книг</h3>
            <?php foreach($books_arr as $id=>$book):?>
                <form action="{{ url('delete_book') }}" method="post" class='delete_form'>
                    <div class='font-weight-bold'><?=$book['title']?></div>
                    <div>
                        <div class=''><?= implode( ', ', $book['authors']);?></div>
                        <button type="submit">удалить</button>
                    </div>
                    <input type="hidden" name="book_id" value="<?=$id?>">
                    {{ csrf_field() }}
                </form>
            <?php endforeach?>
        </div>
        <div class='col border'>
            <form action="{{ url('add_book') }}" method="post">
                {{ csrf_field() }}
                <label for="title" style="width:100%">название книги</label>
                <input type="text" style="width:100%" name="title" id="title">
                <input type="submit" style="width:100%" value="add_book">
                <div>авторы книги</div>
                <div id='authors_target'>
                </div>
            </form>
            <div>
                <h3>список авторов</h3>
                <h6>(тут можно просто кликать по названиям)</h6>
                <div id='authors_holder'>
                    <?php foreach($authors as $author):?>
                        <div role='authors_item' onclick='toggle_author(authors_target, authors_holder, event)'>
                            <span  >
                                <?=$author->full_name?>
                            </span>
                            <input type="hidden" name='authors[<?=$author->id?>]' value='<?=$author->full_name?>' >
                        </div>

                    <?php endforeach?>
                </div>
            </div>
        </div>
        <div class='col border'>
            <form action="{{ url('add_author') }}" method="post" style="width:100%">
                {{ csrf_field() }}
                <label for="full_name" style="width:100%" >ФИО</label>
                <input type="text" name="full_name" style="width:100%" id="full_name">
                <input type="submit" value="add_author" style="width:100%">
            </form>
        </div>
        <div class="col border">
            <h3>список всех авторов</h3>
            <?php foreach($authors as $author):?>
                <form action="{{ url('delete_author') }}" method="post" class='delete_form'>
                    <div class='font-weight-bold'><?=$author->full_name?></div>
                    <div style="display:none;">
                        <div class='' ><?=$author->full_name?></div>
                        <button type="submit">удалить</button>
                    </div>
                    <input type="hidden" name="author_id" value="<?=$author->id?>">
                    {{ csrf_field() }}
                </form>
            <?php endforeach?>
        </div>
    </div>
</div>
@endsection