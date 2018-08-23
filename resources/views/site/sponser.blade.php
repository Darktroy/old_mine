<!--Client Logos-->
<section class="sponsors-section">
    <div class="container">
        <ul class="slider">
        @foreach($sponsers as $sponser)
            <li>
                <a href="{{ $sponser->url }}">
                    <img src="{{ asset('media/sponsers/'.$sponser->image_name) }}" alt="" title="">
                </a>
            </li>
        @endforeach
        </ul>
    </div>
</section>