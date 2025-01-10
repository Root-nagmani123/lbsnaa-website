@include('user.pages.microsites.includes.header')

@if(isset($trainingprograms))
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Training Program </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Training Program Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid">
    <!-- Gallery Display -->
    @if($trainingprograms->isNotEmpty())
    <div class="row">
        @foreach ($trainingprograms as $index => $training)
        <div class="col-md-3 mb-4">
            <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Program Name</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Registration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $training->program_name }}</td>
                            <td>{{ $training->venue }}</td>
                            <td>{{ $training->start_date }} To {{ $training->end_date }}</td>
                            <td>{{ $training->registration_status == 1 ? 'On' : 'Off' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>No training programs available at the moment.</p>
    @endif
</section>

@include('user.pages.microsites.includes.footer')

@endif
