<form action="/embeddings" method="POST">
    @csrf
    <input type="text" name="question" placeholder="Ask a question">
    <button type="submit">Submit</button>
</form>

@if ($result)
<p>{{$result}}</p>
@endif