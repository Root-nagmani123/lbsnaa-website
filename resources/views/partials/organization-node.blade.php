<div class="chart-box w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 p-2">
    <div class="card gap-3">
        <div class="card-body text-center">
            <strong class="card-title text-primary">{{ $node->name }}</strong><br>
            <small>{{ $node->designation }}</small>
            @php
            $keywokrd = str_replace(' ', '+', $node->name);
            @endphp
            <a href="{{ route('user.faculty_responsibility') }}?keywords={{ $keywokrd }}" class="btn btn-primary btn-sm mt-2">
                    Responsibilities
                </a>
        <p>Biodata: <?= $node->description;?></p>
        <img src="{{ asset($node->image) }}" style="height: 50px">
<p>Email: <?= $node->email;?></p>
<p><?= $node->phone_pt_office;?></p>
        </div>
    </div>

    @if (!empty($node->children))
        <div class="branch">
            @foreach ($node->children as $child)
                @include('partials.organization-node', ['node' => $child])
            @endforeach
        </div>
    @endif
</div>
