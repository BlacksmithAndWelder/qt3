@if (Session::get('classe'))
    <div id="message" class="alert alert-{{Session::get('classe')}}">
        {{ Session::get('mensagem') }}
    </div>
@endif 