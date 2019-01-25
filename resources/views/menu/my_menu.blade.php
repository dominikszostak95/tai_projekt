<ul class="navbar-nav ml-auto">
    @foreach ($items as $item)

        @php

            $isActive = null;

            // Check if link is current
            if(url($item->link()) == url()->current()){
                $isActive = 'active';
            }

        @endphp

        <li class="nav-item {{ $isActive }}">
            <a href="{{ url($item->link()) }}" target="{{ $item->target }}" class="nav-link">{{ $item->title }}</a>
        </li>

    @endforeach
</ul>

