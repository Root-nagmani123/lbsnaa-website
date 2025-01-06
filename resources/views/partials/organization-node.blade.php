 <div class="card rounded-4 card-bordered card-lift" style="width: 18rem;">
    <div class="p-3 d-flex flex-column gap-3">
        <!--img-->
        <a href="#">
            <img src="{{ asset($node->image) }}" alt="{{ $node->name }}" class="img-fluid rounded-4" style="height:150px; object-fit:cover;width:100%;">
        </a>
        <!--content-->
        @php
        $keywokrd = str_replace(' ', '+', $node->name);
        @endphp
        <div class="d-flex flex-column gap-4">
            <div class="d-flex flex-column gap-2">
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h3 class="mb-0">{{ $node->name }}</h3>
                    </div>
                    <span class="text-gray-800">{{ $node->designation }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between fs-6">
                <div>
                    <span>Email: <?= $node->email;?></span>
                </div>
                <div class="d-flex gap-1 align-items-center lh-1">
                    <span><?= $node->phone_pt_office;?></span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between align-items-center gap-3">
            <div>
                <a href="{{ route('user.faculty_responsibility') }}?keywords={{ $keywokrd }}" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#signupModal">Responsibilities</a>
            </div>
            <div>
                <a href="#!" class="btn btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#signupModal">Biodata</a>
            </div>
        </div>
    </div>
</div>
@if (!empty($node->children))
<div class="branch">
    @foreach ($node->children as $child)
    @include('partials.organization-node', ['node' => $child])
    @endforeach
</div>
@endif