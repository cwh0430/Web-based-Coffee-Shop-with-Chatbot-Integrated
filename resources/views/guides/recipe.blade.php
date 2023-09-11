<div class="container-fluid mt-5">
    <div class="row mb-5">
        @foreach ($recipes as $recipe)
        <div class="col-4">
            <a href="/recipedetail/{{$recipe->id}}">
                <div class="recipe-img-box">
                    <img src="/storage/{{$recipe->img}}" alt="{{$recipe->name}}" class="img-fluid">
                    <p class="text-center py-2 recipe-name">
                        {{$recipe->name}}
                    </p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>