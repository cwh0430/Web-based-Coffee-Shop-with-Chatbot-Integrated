<div class="container-fluid mt-5">
    <div class="row mb-5">
        @foreach ($brews as $brew)
        <div class="col-4">
            <div class="brew-img-box">
                <a href="/brewdetail/{{$brew->id}}"><img src="/storage/{{$brew->img}}" alt="{{$brew->name}}"
                        class="img-fluid">
                </a>
                <p class="text-center py-2 brew-name">
                    {{$brew->name}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>