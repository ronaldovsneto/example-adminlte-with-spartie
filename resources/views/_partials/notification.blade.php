{{-- INCLUDED IN views/vendos/adminlte/master.blade.php --}}
@if(session('http'))
    <div id="notification" class="alert alert-default-{{ session('http')['box'] }} fade show" role="alert">
        <h4 class="alert-heading">{{ session('http')['title'] }}</h4>
        <p>{{ session('http')['message'] }}</p>
    </div>
@endif
