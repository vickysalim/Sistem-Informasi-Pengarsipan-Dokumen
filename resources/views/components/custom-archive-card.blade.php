{{-- <div class="col-lg-4 col-6">
    <div class="small-box">
        <div class="inner">
            <h5><b>{{ $item->name }}</b></h5>
            @php
                $x = 0;    
            @endphp
            @foreach ($archive as $item3)
                @if ($item2->category_id == $item->id)
                    @php
                        $x = $x + 1;    
                    @endphp
                @endif
            @endforeach
            <p>{{ $x }} arsip</p>
        </div>
        <div class="icon">
            <i class="fas fa-copy"></i>
        </div>
        <a href="{{ route('category.show', $item->id) }}" class="small-box-footer bg-primary">
            Info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div> --}}

<div class="col-lg-4 col-6">
    <div class="small-box">
        <div class="inner">
            <h5><b>{{ $category_title }}</b></h5>
            
            <p>{{ $count }} arsip</p>
        </div>
        <div class="icon">
            <i class="fas fa-copy"></i>
        </div>
        <a href="{{ $link }}" class="small-box-footer bg-primary">
            Info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>