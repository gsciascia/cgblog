@if(Session::has('flash_message_error'))
    <div class="alert alert-error">
        {{ Session::get('flash_message_error') }}
    </div>
@endif



@if(Session::has('flash_message_success'))
    <div class="alert alert-success">
       {{ Session::get('flash_message_success') }}
    </div>
@endif
