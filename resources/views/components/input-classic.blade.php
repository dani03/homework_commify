<div class="mt-2">
    <label>{{$label}}</label>
    <input {{ $isRequired ? 'required' : ''}} type="{{$type}}" value="{{old($name)}}" name="{{$name}}" id="{{$name}}"
           placeholder="{{$placeholder}}"
           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">

</div>
