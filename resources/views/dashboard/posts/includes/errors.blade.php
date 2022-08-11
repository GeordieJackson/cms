@if($errors->any())
    <fieldset class="flex w-50 mx-auto" style="border: 4px solid red; margin-top: -3rem; margin-bottom: 3rem;">
        <legend><h2 class="text-bold mx-1">Errors found </h2></legend>
        <ul class="mt-0">
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </fieldset>
@endif
